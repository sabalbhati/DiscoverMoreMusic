<?php

class Utility
{
  public static function renameFile($name) {
    $expression = "~[.*?/]~";
    $newName = str_replace('','_', $name);
    $newName = preg_replace($expression, '', $newName);

    return $newName;
  }	
}

?>

