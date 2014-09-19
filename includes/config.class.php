<?php

class config {

	protected $db_name =  "localhost";
	protected $db_user = "ddm_admin";
	protected $db_pword = "CrouchingTigress1101";
	protected $db_host = "DiscoverMoreMusic"; 

	function __construct($hostname = NULL, 
											 $username = NULL, 
											 $password = NULL, 
											 $database = NULL, 
											 $prefix = NULL, 
											 $connector = NULL)
	{
		$this->hostname  = empty($hostname) ? $this->db_name : $hostname;
    $this->username  = empty($username) ? $this->db_user : $username;
    $this->password  = empty($password) ? $this->db_pword : $password;
    $this->database  = empty($database) ? $this->db_host : $database;
    $this->prefix    = empty($prefix) ? "prefix" : $prefix;
    $this->connector = empty($connector) ? "mysqli": $connector;

		
	}

	function __destruct(){}
}

?>