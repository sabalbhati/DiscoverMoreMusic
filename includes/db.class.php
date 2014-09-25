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

	/*
	* purpose: opens a connection to the database
	* return : void
	*/
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

	/*
	* Closes the connection to the database
	*/
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

	/*
	* purpose: queries the database
	* return: The result set
	*/
	public function query($query)
	{
		try
		{
			if ($this->config->connector == "mysqli")
			{
				$result = mysqli_query($this->connection, $query);
			}
			return $result;
		}
		catch(exception $e)
		{
			return $e;
		}
	}

	/*
	* purpose: pings the database to see if a connection already exists
	* return: (boolean) Yes: connection exists, No: There is no open connection
	*/
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

	/*
	*	purpose: checks to see if there are any results returned
	* return: (boolean) Yes: rows <= 1, No rows > 1
	*/
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

	/*
	* purpose: counts the number of rows returned by a query
	* return: num of rows
	*/
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

	public function rowsAffected()
	{
		try
		{
			if($this->config->connector=="mysqli")
			{
				return mysqli_affected_rows($this->connection);
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

	/*
	* purpose: escapes any invalid characters
	* result: string without invalid characters
	*/
	public function stringEscape($string)
	{
    if($this->config->connector == "mysqli")
    {
        return mysqli_real_escape_string($this->connection, $string);
    }
	}

}

?>