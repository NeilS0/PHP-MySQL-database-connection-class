<?php

include "_DBConnect.php";

class DBConnect extends _DBConnect{
	///////////////////////////////
	//	Constructor
	///////////////////////////////
	public function __construct($Host = "", $Username = "", $Password = "", $Database = "", $Charset = "utf8")
	{
		//catch errors coming from _DBConnect::__construct
		try {
			_DBConnect::__construct($Host, $Username, $Password, $Database, $Charset);
		} catch (Exception $error){
			echo "Error:<br> <pre>".$error->getMessage()."</pre>";
		}
	}

	///////////////////////////////
	//	Destructor
	///////////////////////////////
	public function __destruct()
	{	
		_DBConnect::__destruct();
	}


	///////////////////////////////
	//	Methods
	///////////////////////////////
	
	//
	//	execute queries
	//
	public function DoQuery($SQL, $debug = 0)	//debug = 1 to print out the sql
	{
		if (!$this->MYSQL){	//check if we have a valid connection
			return false;
		}

		$this->Result = mysqli_query($this->MYSQL, $SQL);

		//debug sql
		if ($debug){
			echo "<pre>";
			print_r($SQL);
			echo "</pre>";
		}

		//handle mysqli_query error
		if (!$this->Result){
			echo "<pre>";
			print_r(mysqli_error($this->MYSQL));
			echo "</pre>";

			return false;
		}

		return true;
	}

	//
	//	return the data as object
	//
	public function FetchObject()
	{
		if (!$this->Result){	//check if we have a valid result set
			return false;
		}

		$row = mysqli_fetch_object($this->Result);

		if (!$row){	//if last row, free the result set
			mysqli_free_result($this->Result);
		}

		return $row;
	}

	//
	//	return the data as array
	//
	public function FetchArray()
	{
		if (!$this->Result){	//check if we have a valid result set
			return false;
		}

		$row = mysqli_fetch_array($this->Result);

		if (!$row){	//if last row, free the result set
			mysqli_free_result($this->Result);
		}

		return $row;
	}


	///////////////////////////////
	//	DATA
	///////////////////////////////
	private $Result;
};


?>