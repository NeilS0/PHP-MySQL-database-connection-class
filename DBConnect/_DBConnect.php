<?php

ini_set("display_errors", "0");	//turn off errors, DBConnect handles mysqli errors

class _DBConnect{
	///////////////////////////////
	//	Constructor
	///////////////////////////////
	public function __construct(&$Host, &$Username, &$Password, &$Database, &$Charset)
	{
		//make connection
		$this->MYSQL = mysqli_connect($Host, $Username, $Password);

		//check if connection is valid
		if (!$this->MYSQL){
			throw new Exception("mysqli_connect(\"{$Host}\", \"{$Username}\", \"{$Password}\"): ".mysqli_connect_error());
		}

		//set the character set
		if (!$this->SetCharset($Charset)){
			throw new Exception("mysqli_set_charset(MYSQL, \"{$Charset}\"): ".mysqli_error($this->MYSQL));
		}

		//select the given database, if provided, can always select one later
		if ($Database != ""){
			if (!$this->SelectDB($Database)){
				throw new Exception("mysqli_select_db(MYSQL, \"{$Database}\"): ".mysqli_error($this->MYSQL));
			}
		}

		//store the information for when we might need it
		$this->HOST = $Host;
		$this->USER = $Username;
		$this->PASS = $Password;
	}

	///////////////////////////////
	//	Constructor
	///////////////////////////////
	public function __destruct()
	{
		//if a valid connection was made, close the connection
		if ($this->MYSQL){
			mysqli_close($this->MYSQL);
		}
	}


	///////////////////////////////
	//	Methods
	///////////////////////////////

	//
	//	set the character set
	//
	public function SetCharset($Charset)
	{
		if (!mysqli_set_charset($this->MYSQL, $Charset)){
			return false;
		}
		return true;
	}

	//
	//	selects a database
	//
	public function SelectDB($DB)
	{
		if (!mysqli_select_db($this->MYSQL, $DB)){
			return false;
		}
		return true;
	}


	///////////////////////////////
	//	DATA
	///////////////////////////////
	protected $MYSQL;
	protected $HOST;
	protected $USER;
	protected $PASS;	//password

};

?>