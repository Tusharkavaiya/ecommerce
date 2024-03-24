<?php
//database connection
$obj = new mysqli("localhost", "root", "", "ecommece");
$errno = $obj->connect_error;
if($errno != 0)
{
	echo $obj->connect_error;
	exit;
}



?>