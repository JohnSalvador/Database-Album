<?php
require_once 'connect.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Table Creation in MySQL</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>
<div class="title">
	<h1>Table Creation - MySQL Commands</h1>
</div>
<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {
	
include_once 'header.php';
?>
<div class="entryblock">
<p>
CREATE TABLE P1_Artist (<br />
	Name VARCHAR(30) PRIMARY KEY,<br />
	Bio VARCHAR(400),<br />
	Official_site VARCHAR (50)<br />

);
</p>
<p>
CREATE TABLE P1_Album (<br />
	Album_Name VARCHAR(30) PRIMARY KEY,<br />
	Artist VARCHAR(30),<br />
	Genre VARCHAR(20),<br />
	Publisher VARCHAR(30),<br />
	Release_Date DATE,<br />
	Date_Purchased TIMESTAMP DEFAULT NOW(),<br />
	Comments VARCHAR(100)<br />
	

)
</p>
<p>
CREATE TABLE P1_Songs (<br />
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,<br />
	Title VARCHAR(30),<br />
	Track_Number INT,<br />
	Length TIME,<br />
	Last_Played TIMESTAMP DEFAULT 0 ON UPDATE CURRENT_TIMESTAMP,<br />
	Lyrics VARCHAR(2000),<br />
	Song_Comments VARCHAR(100)<br />

)
</p>
<p>
ALTER TABLE P1_Songs ADD Other_Artist VARCHAR(60) AFTER Lyrics;<br />
ALTER TABLE P1_Songs ADD (Language VARCHAR(10), Ratings TINYINT);<br />
<br />
Note: Other_Artists, Last_Played, & Ratings are not required<br />
ALTER TABLE P1_Songs ADD Album_Name varchar(30) AFTER Title;<br />
</p>
<p>
CREATE TABLE P1_Playlist (<br />
Playlist_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,<br />
Playlist_Name varchar(30),<br />
Title varchar(30)<br />
)
</p>
<p>
RENAME TABLE P1_Album TO Album,<br />
	P1_Artist TO Artist, <br />
	P1_Playlist TO Playlist, <br />
	P1_Songs TO SOngs; <br />
</p>
<p>
ALTER TABLE Playlist DROP Title;<br />
ALTER TABLE Playlist ADD Song_ID;<br />
</p>
<p>
CREATE TABLE Vendor (<br />
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, <br />
    UPC BIGINT(12),<br />
    Vendor VARCHAR(30),<br />
    Price decimal(5,2));<br />
</p>
<?php
} else{
	header("Location: index.php");
}
mysql_close($con);
?>
</body>
</html>