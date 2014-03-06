<?php
$http_client_ip;
$http_x_forwarded_for;
$remote_addr = $_SERVER;
if(isset($_SERVER['HTTP_CLIENT_IP']))
	$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
if(isset($_SERVER['REMOTE_ADDR']))
	$remote_addr = $_SERVER['REMOTE_ADDR'];

if(!empty($http_client_ip)){
	$ip_address = $http_client_ip;	
} else if(!empty($http_x_forwarded_for)){
	$ip_address = $http_x_forwarded_for;
} else {
	$ip_address = $remote_addr;
}

if($ip_address=='::1'){
	$dbServer = "localhost";
}else{
	$dbServer = "sql2.njit.edu";
}
$dbuserName = "jbs44";
$dbpassword = "";
$dbName = "jbs44";

// ********** Connect. Change fields above.
// ********** Do not edit below
$con = mysql_connect($dbServer, $dbuserName, $dbpassword);

if(!$con){
	die('Could not connect: '.mysql_error());	
}
?>
