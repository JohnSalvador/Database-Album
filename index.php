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
	if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani'){
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
    <?php
	} else{
	?>
    <div id="indexlogin">
    	Please Log in:
        <?php
		if(isset($_POST['username'])&&isset($_POST['password'])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			if(!empty($username)&&!empty($password)){
				echo 'Logging in...';
				
				if($username=='Gehani'&&$password='database'){
					$allow=1;
					setcookie('username','Gehani',time()+4800);
					header("Location: index.php");
				}
			}else{
				echo '<h3>Error Logging in: Please enter your username and password</h3>';	
			}
		}
		?>
        <form action="index.php" id="login_form" method="POST">
            <input type="text" name="username" value="" placeholder="Username"/><br />
            <input type="password" name="password" value="" placeholder="Password"/> <br />
            <input type="submit" value="Sign In" style="background:blue; color: white;" />
        </form>
    </div>
    
    <?php
	}
	?>
</body>
</html>