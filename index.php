<?php
require_once 'connect.php';

?>
<head>
<title>Project 1 - Intro to Database</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>
	<div class="title">
    	<h1>Welcome to the CD Manager</h1>
    </div>
    <?php
	$_COOKIE['username']='Gehani';
	include 'header.php';
	?>
    <div id="indexcontent">
    	<p>This database project is created by: </p>
        <ul id="names">
        	<li>Joshua</li>
            <li>Harsha</li>
            <li>Max</li>
        	<li>John</li>
        <ul>
    </div>
    
</body>
</html>