<?php
/*
Playlist_Name	varchar(30)
Title			varchar(30)
*/
require_once 'connect.php';

mysql_select_db("jbs44",$con);

function adjust($string){
	return mysql_real_escape_string(htmlentities($string));
}


?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Playlist - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>

<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {

include_once 'header.php';
?>
<div class="title">
	<h1>Playlist - CD Manager</h1>
</div>

<div class="query">
	MySQL Query:
    <?php
	if(isset($_POST['playlist_name'])&&!empty($_POST['playlist_name'])) {
		$playlist_name=adjust($_POST['playlist_name']);
	} else if(isset($_POST['recorded_playlist'])) {
		$playlist_name=adjust($_POST['recorded_playlist']);
	}
	if(isset($_POST['song_id'])) {
		$song_id=adjust($_POST['song_id']);
		
		if(!empty($playlist_name)&&!empty($song_id)){
			echo $mysql_insertquery = "INSERT INTO Playlist (Playlist_Name, Song_ID) VALUES ('$playlist_name', '$song_id');";
			
			if(!mysql_query($mysql_insertquery, $con)){
				echo '<h3>Error Registering into Database: </h3>'.mysql_error();
			} else{
			echo "<h3>Song added into $playlist_name!</h3>";
			}
		} else{
			echo '<h3>Error: Enter a new playlist or select one then enter Song ID of the song.</h3>'.mysql_error();
		}
		
	}
	?>
</div>

<div class="entryblock">
<form action="playlist.php" method="POST">
	New Playlist Name: <br />
    <input type="text" name="playlist_name" size="30" maxlength="30"/> <br />
    OR Choose Previous Playlist: <br />
    <?php
	$fetch = 'Playlist_Name';
	$fetchquery = "SELECT DISTINCT $fetch FROM Playlist;";
	echo "MySQL Query: $fetchquery <br />";
    	
	if($fetched=mysql_query($fetchquery)) {
		echo '<select name="recorded_playlist">';
		while($rows = mysql_fetch_array($fetched)){
			echo '<option value=\''.$rows['Playlist_Name'].'\'>'.$rows['Playlist_Name'].'</option>';
		
		}
		echo '</select>';
	} 
    
	else {
		echo 'Error fetching Playlists'.mysql_error();
	}
	?><br /><br />
    
    
    Song - ID: <br />
    <?php
	//FETCH SCRIPT FOR SONGS
	$fetch = 'ID, Title';
	$fetchquery = "SELECT $fetch FROM Songs ORDER BY Title;";
	echo "MySQL Query: $fetchquery <br />";
    	
	if($fetched=mysql_query($fetchquery)) {
		echo '<select name="song_id">';
		while($rows = mysql_fetch_array($fetched)){
			echo '<option value=\''.$rows['ID'].'\'>'.$rows['Title'].' - '.$rows['ID'].'</option>';
		
		}
		echo '</select>';
	} 
    
	else {
		echo 'Error fetching Songs'.mysql_error();
	}
	?><br /><br />
    
    <input type="submit" value="Add Playlist"/>
</form>
</div>

<div id="table_playlist">
<?php
//FETCH ALL DATA
$fieldsort = 'Playlist_Name';
$query = "SELECT Playlist_ID, Playlist_Name, ID, Title FROM Playlist,Songs WHERE ID=Song_ID ORDER BY $fieldsort";
echo '<div id="query_playlist">
		MySQL Query: '.$query.'
		</div>';

if($Playlist = mysql_query($query)){
	echo "<table border=\"1\" width = \"600\">
		<tr>
			<th bgcolor=\"#CCCCFF\" colspan=\"4\"><h3>Playlists</h3></th>
		</tr>
		<tr>
			<th width=\"10%\">Playlist ID</th>
			<th width=\"40%\">Playlist Name</th>
			<th width=\"10%\">ID</th>
			<th width=\"40%\">Title</th>
		</tr>
	";
	while($row = mysql_fetch_array($Playlist)){
		echo "<tr>";
		echo "<td>" . $row['Playlist_ID'] . "</td>";
		echo "<td>" . $row['Playlist_Name'] . "</td>";
		echo "<td>" . $row['ID'] . "</td>";
		echo "<td>" . $row['Title'] . "</td>";
		echo "</tr>";
	}
} else{
	echo '<h3>Error Fetching Data: </h3>'.mysql_error();
}

} else {
	header("Location: index.php");
}

//CLOSE CONNECTION TO DATABASE
mysql_close($con);
?>
</div>

</body>