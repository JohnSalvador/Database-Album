<html>
<header>
<title>Updating Last Played - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</header>
<body>
<?php
include_once 'connect.php';
mysql_select_db("jbs44",$con);

if(isset($_GET['ID']) && !empty($_GET['ID'])) {
	$ID = $_GET['ID'];
	echo $updatequery = "UPDATE Songs SET Last_Played=NOW() WHERE ID='$ID';";
	if(!mysql_query($updatequery,$con)) {
		echo '<h3>Error Updating Within MySQL Database</h3>'.mysql_error();
		echo '<a href="songs.php">Return to Songs Page</a>';
	} else {
	header('Location: songs.php#'.$_GET['ID'].'');
	}
} else {
	echo 'Did not get the song ID to update the time played.<br /> <br />';
	echo '<a href="songs.php">Return to Songs Page</a>';
}

?>
</body>

<html>