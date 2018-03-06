<?php

include "DBConnect/DBConnect.php";


//make a db server connection
$db = new DBConnect("host", "username", "password");	//minimum required
//$db = new DBConnect("host", "username", "password", "database");
//$db = new DBConnect("host", "username", "password", "database", "charset");

//set charset
$db->SetCharset("charset");

//select a database
$db->SelectDB("database");

//run a query
$db->DoQuery("SELECT columns FROM table WHERE;", 1);

//process the result
while ($row = $db->FetchObject()){	//or FetchArray
	//process $row
	echo "<pre>";
	print_r($row);
	echo "</pre>";
}


?>