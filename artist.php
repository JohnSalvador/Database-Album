<?php
require_once 'connect.php';

mysql_select_db("jbs44", $con);

function adjust($string){
	return mysql_real_escape_string(htmlentities($string));
}
 
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Artists - CD Manager</title>
	<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>

<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {

include 'header.php';
?>

<div class="title">
	<h1>Artist - CD Manager</h1>
</div>

<div class="query">
	MySQL Query:
    <?php
    if(isset($_POST['artist_name'])&&isset($_POST['bio'])&&isset($_POST['official_site'])){
		$Name=adjust($_POST['artist_name']);
		$Bio=adjust($_POST['bio']);
		$Official_Site=adjust($_POST['official_site']);
		if(!empty($Name)&&!empty($Bio)&&!empty($Official_Site)){
			echo $mysql_insertquery = "INSERT INTO Artist (Name, Bio, Official_Site) VALUES ('$Name','$Bio','$Official_Site');";
			
			if (!mysql_query($mysql_insertquery,$con))
				{
				echo '<h3>Error Registering into Database: </h3>'.mysql_error();
				}
				echo "<br /><br /><h3>Artist Added!</h3>";
		} else{
			echo '<h3>Error: Please enter Artist Name, Bio and Official Site.</h3>'.mysql_error();
		}
		
	}
	?>
</div>

<div class="entryblock">
<form action="artist.php" method="POST">
	Name: <br /> 
    <input type="text" name="artist_name" size="30" maxlength="30"/> <br /><br />
    Bio: <br />
    <textarea name="bio" rows="10" cols="50"maxlength="1000"></textarea><br /<br />
    Official Site: <br />
    <input type="text" name="official_site" size="30" maxlength="50" value="http://"/><br /><br />
    <input type="submit" value="Add Artist"/>
</form>
</div>

<div id="table_artist">
<?php
//FETCH ALL DATA
$fieldsort = 'Name';
$query = "SELECT * FROM Artist ORDER BY $fieldsort";
echo '<div id="query_artist">
		MySQL Query: '.$query.'
	</div>
		';

if($Artist = mysql_query($query)){
	echo "<table border=\"1\" width=\"1200\">
		<tr>
			<th bgcolor=\"#CCCCFF\"colspan=\"3\" cellpadding=\"30\"><h3>Artists</h3></th>
		</tr>
		<tr bgcolor=\"#BBBBFF\">
			<th width=\"10%\">Name</th>
			<th width=\"80%\">Bio</th>
			<th width=\"10%\">Official Site</th>
		</tr>";
	
	while($row = mysql_fetch_array($Artist))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['Name'] . "</td>";
	  echo "<td>" . $row['Bio'] . "</td>";
	  echo "<td><a href=\"".$row['Official_site']."\"target=\"_blank\">".$row['Official_site']."</a></td>";
	  echo "</tr>";
	  }
	echo "</table>";
} else{
	echo '<h3>Error Fetching Data: </h3> <br />'.mysql_error();
}

}else{
	header("Location: index.php");
}

?>
</div>


<?php
//CLOSE CONNECTION TO DATABASE
mysql_close($con);
?>
</body>