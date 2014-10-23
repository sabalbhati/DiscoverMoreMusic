<?php
/**
* used to upload files securely to the server
*/
class UploadFile
{
  // variables declearation
  protected $destination;
  protected $messages = array();
  protected $maxSize = 1024;

  protected $permittedImageTypes = array(
              'image/jpeg',
              'image/jpg',
              'image/png');

  protected $permittedAudioTypes = array(
              'audio/mp3',
              'audio/mpeg',
              'audio/acc');
  protected $newName;
  protected $typeCheckingOn = true;
  protected $notTrusted = array('bin', 'cgi','exe','js','pl','php','py','sh');
  protected $suffix = '.upload';
  protected $renameDuplicates;
  protected $uploadType;
  protected $filename;

  /**
   * Constructor function that checks the upload directory and sets the path
   * @param [type] $uploadFolder the path where the uploaded file will be stored
   */
  public function __construct($uploadFolder, $uploadType)
  {
    if (!file_exists($uploadFolder)) 
    {
       mkdir($uploadFolder, octdec(0777), true);
    }

    if(!is_dir($uploadFolder) || !is_writable($uploadFolder))
    {
      throw new \Exception("$uploadFolder must be a valid, writable folder.");
    }
    // checks if the folder is the root
    if($uploadFolder[strlen($uploadFolder)-1] != '\\'){
      $uploadFolder .= '\\';
    }
    // set the destination property to the uploadfolder path
    $this->destination = $uploadFolder;
    $this->uploadType = $uploadType;
  }

  public function getFilename()
  { 
    return $this->filename;
  }

  /**
   * Sets the maximumsize that can be stored for the file
   * @param [type] $bytes
   */
  public function setMaxSize($bytes)
  {
    // gets the server's maximum set size
    $serverMax = self::convertToBytes(ini_get('upload_max_filesize'));

    //checks passed maxsize is less then server max size
    if($bytes > $serverMax){
      throw new \Exception('Maximum size cannot exceed server limit for individual files: '. 
        self::convertFromBytes($serverMax));
    }
    //checks that size is numeric and greater than 0
    //sets the maxsize property with the passed in value ($bytes)
    if(is_numeric($bytes) && $bytes > 0)
    {
      $this->maxSize = $bytes;
    }
  }

  /**
   * converts size to bytes
   * @param  [type] $val the size passed into the function 
   * (could be gb,mb,or kb)
   * @return Integer the value in bytes
   */
  public static function convertToBytes($val)
  {
    $val = trim($val);
    //checks the last letter to get type
    $last = strtolower($val[strlen($val)-1]);
    if(in_array($last, array('g','m','k')))
    {
      //falls throught the case list (no breaks)
      switch($last)
      {
        case 'g':
          $val *= 1024;
        case 'm':
          $val *= 1024;
        case 'k':
          $val *=1024;
      }
    }
    return $val;
  }
  /**
   * Convert to a readable format
   * @param  [type] $bytes size in bytes
   * @return [type] size in KB or Bytes
   */
  public static function convertFromBytes($bytes) {
    $bytes /= 1024;
    if($bytes > 1024) {
      return number_format($bytes/1024, 1). ' MB';
    }
    else
    {
      return number_format($bytes, 1) . ' KB';
    }
  }

  /**
   * uploads the file and renames if dupicated
   * @param  boolean $renameDuplicates filter 
   * for how to handle duplicate files
   * @return [type]
   */
  public function upload($renameDuplicates = true)
  {
    $this->renameDuplicates = $renameDuplicates;

    $uploaded = current($_FILES);

    if ($this->checkFile($uploaded)){

      $this->moveFile($uploaded);
    }
    return isset($newName) ? $newName : $_FILES['avatar']['name'];
  }

  /**
   * gets all the messages stored in the array messages
   * @return Array of messages(error, etc)
   */
  public function getMessages()
  {
    return isset($messages) ? $messages : null;
  }

  /**
   * Checks the size and type of the file (if type checking is on)
   * @param  [type] the file that is going to be uploaded
   * @return [type]
   */
  protected function checkFile($file)
  { 
    // return false if there are errors
    if ($file['error'] !=0)
    {
      $this->getErrorMessage($file);
      return false;
    }
    // if wrong size retur false
    if(!$this->checkSize($file))
    {
      return false;
    }
    // if type checking is on check the type by
    // calling the checkType function
    if ($this->typeCheckingOn)
    {
      if (!$this->checkType($file))
      {
        return false;
      }
    }
    $this->checkName($file);
    return true;
  }

  /**
   * Checks the file type against list of allowed types
   * @param  [type] $file the file to be uploaded
   * @return Boolean true permitted, false not permitted file type
   */
  protected function checkType($file)
  {
    $lUploadType = ($this->uploadType == "image") ? 
                  $this->permittedImageTypes :
                  $this->permmittedAudioTypes;

    if (in_array($file['type'], $lUploadType ))
    {
      return true;
    }
    else
    {
      $this->messages[] = $file['name'] . ' is not a permitted filetype';
      return false;
    }
  }

  /**
   * [checkName description]
   * @param  [type] $file
   * @return [type]
   */
  protected function checkName($file)
  {
    $this->newName = null;

    // remove spaces and replace with '_'
    $noSpaces = str_replace(' ', '_', $file['name']);
 
    // if the file name has been modified set the new name property
    // to the filename with noSpaces(contains '_')
    if ($noSpaces != $file['name']){
      $this->newName = $noSpaces;
    }
    
    //gets filename and extension
    $path_parts =  pathinfo($noSpaces);
    $extension = $path_parts['extension'];
    $filename = $path_parts['basename'];

    //if type checking is off and suffix is not blank
    if(!$this->typeCheckingOn && !empty($this->suffix)){
      //if extension is a not trusted type or is empty, add our suffix
      if (in_array($extension, $this->notTrusted) || empty($extension))
      {
        $this->newName = $noSpaces . $this->suffix; 
      }
    }

    // if duplicate name changing is set to true
    // rename the file
    if($this->renameDuplicates)
    {
      $name = isset($this->newName) ? $this->newName : $file['name'];
      $existing = scandir($this->destination);

      //if name exists in the directory the file is to be saved
      //append number to end of file eg audio_1.suffix
      if (in_array($name, $existing))
      {
        $i = 1;
        do
        {
          $this->newName = $nameParts['filename'] . '_' . $i++;
          if(!empty($extension)) {
            $this->newName .= ".$extension"; 
          }
          if(in_array($extension, $this->notTrusted))
          {
            $this->newName .= $this->suffix;
          }
        }while($in_array($this->newName, $existing));
      }
    }
  }

  /**
   * All  the error messages based on the return code of the file if error
   * @param  [type] $file [description]
   * @return [type]       [description]
   */
  protected function getErrorMessage($file)
  {
    switch($file['error'])
    {
      case 1:
      case 2:
        $this->messages[] = $file['name'] . ' is too big: (max: ' . 
          self::convertFromBytes($this->maxSize) . ').';
        break;
      case 3:
        $this->messages[] = 'was unable to complete uploading ' . 
          $file['name'] . 'try again';
        break;
      case 4:
        $this->messages[] = 'No file submitted.';
        break;
      default:
        $this->messages[] = 'Was unable to upload ' . $file['name'];
    }
  }

  /**
   * Checks the size of the file
   * @param  [type] the file being saved
   * @return Boolean true if file is ok to be saved
   */
  protected function checkSize($file)
  {
    if ($file['size'] == 0)
    {
      $this->messages[] = $file['name'] . ' is empty';
      return false;
    }
    elseif ($file['size'] > $this->maxSize)
    {
      $this->messages[] = $file['name'] . 'exceeds limit: (max: ' . 
        self::convertFromBytes($this->maxSize) . ').'; 
      return false;
    }
    else
    {
      return true;
    }
  }

  /**
   * moves the file to the proper location from the temporary location
   * @param  [type] $file
   * @return [type]
   */
  protected function moveFile($file)
  {
    // check newName or original name(original name is safe)
    $filename= isset($this->newName) ? $this->newName : $file['name'];

    $success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
    
    // if moved successfully pass 'success' to the messages array
    if($success)
    {
      $result = $file['name'] . ' was uploaded successfully';
      if (!is_null($this->newName)){
        $result .= ', and was renamed ' . $this->newName;
      }
      $result .= '.';
      $this->messages[] = $result;
    }
    else
    {
      $this->messages[] ="Could not upload " . $file['name'];
    }
  }
}
?>