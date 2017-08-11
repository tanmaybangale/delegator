<?php

class DBOperations {

var $servername = "localhost";
var $username = "root";
var $password = "";
var $conn ="";
var $result ="";
var $dbname = "db_delegator";

function connectToDB ()
{
try {
	$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	}
catch(Exception $e)
	{
	echo $this->conn."<br>".$e->getMessage();
	}	
}

function executeQuery($sql)
{
	
try {
	$this->connectToDB();
	$this->result = $this->conn->query($sql);
    }
catch(Exception $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
}
}

?>