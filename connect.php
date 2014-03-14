<?php
include '../config.php';

$dbServer = DB_HOST;
$dbuserName = DB_USER;
$dbpassword = DB_PASSWORD;
$dbName = DB_DATABASE;

// ********** Connect. Change fields above.
// ********** Do not edit below
$con = mysql_connect($dbServer, $dbuserName, $dbpassword);

if(!$con){
	die('Could not connect: '.mysql_error());	
}
?>
