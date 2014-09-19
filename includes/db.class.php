<?php

class db{
	private $connection;
	private $selectDb;
	private $lastQuery;
	private $config;

	function __construct($config)
	{
		$this->config = $config;
	}

	function __destruct(){}

	public function openConnection()
	{
		try
		{
			if($this->config->connector == "mysqli")
			{
				$this->connection = mysqli_connect($this->config->hostname, 
																					 $this->config->username, 
																					 $this->config->password);
				
				
				$this->selectdb = mysqli_select_db($this->connection, 
																					 $this->config->database);
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function closeConnection()
	{
		try
		{
			if($this->config->connection == "mysqli")
			{
				mysqli_close($this->connection);
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function query($query)
	{

		$query = str_replace("}", "", $query);
		$query = str_replace("{", $this->config->prefix, $query);
		try
		{
			if ($this->config->connector == "mysqli")
			{
				$result = mysqli_query($this->connection, $this->stringEscape($query));
				
				if (!$result )
			  {
			  	die(mysql_error());
			  }
			}


			return $result;
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function pingServer()
	{
		$connectionOpen = true;
		try
		{
			if($this->config->connector == "mysqli")
			{
				if(!mysqli_ping($this->connection))
				{
					$connectionOpen = false;
				}
				return $connectionOpen;

			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}


	public function hasRows($result)
	{
		$returnedRows = false;
		try
		{
			if($this->config->connector == "mysqli")
			{
				if(mysqli_num_rows($result) > 0)
				{
					$returnedRows = true;
				}
			}
			return $returnedRows;
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function countRows($result)
	{
		try
		{
			if($this->config->connector=="mysqli")
			{
				return mysqli_num_rows($result);
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function fetchAssoc($result)
	{
		try
		{
			if($this->config->connector=="mysqli")
			{
				return mysqli_fetch_assoc($result);
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function fetchArray($result)
	{
		try
		{
			if($this->config->connector=="mysqli")
			{
				return mysqli_fetch_array($result);
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	public function stringEscape($string)
	{
	    if($this->config->connector == "mysql")
	    {
	        return mysql_real_escape_string($string);
	    }
	    elseif($this->config->connector == "mysqli")
	    {
	        return mysqli_real_escape_string($this->connection, $string);
	    }
	}

}

?>