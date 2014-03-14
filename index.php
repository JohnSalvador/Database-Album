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
	$_COOKIE['username']=='Gehani';
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
   
        <form action="index.php" id="login_form" method="POST">
            <input type="text" name="username" value="" placeholder="Username"/><br />
            <input type="password" name="password" value="" placeholder="Password"/> <br />
            <input type="submit" value="Sign In" style="background:blue; color: white;" />
        </form>
    </div>
    
</body>
</html>