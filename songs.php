<?php
/*
ID				int(11)
Title			varchar(30)
Album_Name		varchar(30)
Track_Number	int(11)
Length			time
Last_Played		timestamp
Lyrics			varchar(1000)
Other_Artist	varchar(60)
Song_Comments	varchar(100)
Language		varchar(10)
Ratings			tinyint(4)
*/
require_once 'connect.php';

mysql_select_db("jbs44", $con);

function adjust($string){
	return mysql_real_escape_string(htmlentities($string));
}

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Songs - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>
<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {

include_once 'header.php';
?>
<div class="title">
	<h1>Songs - CD Manager</h1>
</div>
<div class="query">
	MySQL Query:
    <?php
	if(isset($_POST['title'])&&isset($_POST['track_number'])&&isset($_POST['lyrics'])
	&&isset($_POST['other_artist'])&&isset($_POST['song_comments'])&&isset($_POST['language'])
	&&isset($_POST['album_name'])){
		
		$title=adjust($_POST['title']);
		$track_number=adjust($_POST['track_number']);
		$album_name=$_POST['album_name'];
		$length=$_POST['length_h'].':'.$_POST['length_m'].':'.$_POST['length_s'];
		$lyrics=adjust($_POST['lyrics']);
		$song_comments=adjust($_POST['song_comments']);
		$language=adjust($_POST['language']);
		
		if(isset($_POST['last_played'])){
			$last_played=adjust($_POST['last_played']);
		} else {
			$last_played='';
		}
		if(isset($_POST['ratings'])){
			$ratings=adjust($_POST['ratings']);
		} else{
			$ratings='';
		}
		if(isset($_POST['other_artist'])){
			$other_artist=adjust($_POST['other_artist']);
		} else{
			$ratings='';
		}
		
		if(!empty($title)&&!empty($track_number)&&!empty($length)
		&&!empty($lyrics)&&!empty($song_comments)&&!empty($language)
		&&!empty($album_name)){
			echo $mysql_insertquery = "INSERT INTO Songs(Title, Track_Number, Album_Name, Length, Last_Played, Lyrics, Other_Artist, Song_Comments, Language, Ratings) VALUES ('$title', '$track_number', '$album_name', '$length', '$last_played', '$lyrics', '$other_artist', '$song_comments', '$language', '$ratings');";
			
			if (!mysql_query($mysql_insertquery,$con))
				{
				echo '<h3>Error Registering into Database: </h3>'.mysql_error();
				}
				echo "<br /><br /><h3>Song Added!</h3>";
		} else{
			echo '<h3>Error: Please check if all the required fields are entered.</h3>'.mysql_error();
		}
		
	}

	?>
</div>
<div class="entryblock">
<form action="songs.php" method="POST">
	Title: *<br />
    <input type="text" name="title" size="30" maxlength="30"/> <br /><br />
	Track Number: *<br />
    <input type="number" name="track_number" size="2" maxlength="2"/> <br /><br />
    Album Name: *<br />
    <input type="text" name="album_name" size="30" maxlength="30" /> <br /><br />
	Length: *<br />
    <select name="length_h" >
    	<?php
		for($a=00;$a<=23;$a++){
			if($a>=10){
				echo "<option value='$a'>$a</option>";
			} else {
				echo "<option value='0$a'>0$a</option>";
			}
		}
        ?>
	</select>:
    <select name="length_m">
    	<?php
		for($a=00;$a<=59;$a++){
			if($a>=10){
				echo "<option value='$a'>$a</option>";
			} else {
				echo "<option value='0$a'>0$a</option>";
			}
		}
        ?>
    </select>:
    <select name="length_s">
    	<?php
		for($a=00;$a<=59;$a++){
			if($a>=10){
				echo "<option value='$a'>$a</option>";
			} else {
				echo "<option value='0$a'>0$a</option>";
			}
		}
        ?>
    </select>
    
    <br /><br />
	Last Played: <br />
    Press the update button if it is played <br /><br />
	Lyrics: *<br />
    <textarea name="lyrics" rows="10" cols="50"maxlength="2000"></textarea> <br /><br />
	Other Artist: <br />
    <input type="text" name="other_artist" size="30" maxlength="60" value="none"/> <br /><br />
	Song Comments: *<br />
    <textarea name="song_comments" rows="10" cols="50"maxlength="100"></textarea> <br /><br />
	Language: *<br />
    <input type="text" name="language" size="30" maxlength="10" value="English"/> <br /><br />
	Ratings: <br />
    <select name="ratings">
    	<?php
		for($a=0;$a<=5;$a++){
			if($a!=3){ 
			//DEFAULT RATING 3
				echo "<option value='$a'>$a</option>";
			} else {
				echo "<option value='$a' selected>$a</option>";
			}
		}
        ?>
    </select> <br /><br />
    <input type ="submit" value="Add Song"/>
</form>
<p>*fields are required</p>
</div>

<div id="table_songs">
<?php
//FETCH ALL DATA
$fieldsort = 'Title';
$query = "SELECT * FROM Songs ORDER BY $fieldsort;";
echo '<div id="query_songs">
		MySQL Query: '.$query.'
		</div>';

if($Song = mysql_query($query)){
	echo "<table border=\"1\" width=\"1200\">
		<tr>
			<th  bgcolor=\"#CCCCFF\" colspan=\"11\" cellpadding=\"30\"><h3>Songs</h3></th>
		</tr>
		<tr bgcolor=\"#BBBBFF\">
			<th width=\"2%\">ID</th>
			<th width=\"8%\">Title</th>
			<th width=\"3%\">Track Number</th>
			<th widt=\"10%\">Album Name</th>
			<th width=\"5%\">Length</th>
			<th width=\"5%\">Last Played</th>
			<th width=\"35%\">Lyrics</th>
			<th width=\"10%\">Other Artist</th>
			<th width=\"20%\">Song Comments</th>
			<th width=\"5%\">Language</th>
			<th width=\"3%\">Ratings</th>
		</tr>";
	
	while($row = mysql_fetch_array($Song))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['ID'] . "</td>";
	  echo "<td>" . $row['Title'] . "</td>";
	  echo "<td>" . $row['Track_Number'] . "</td>";
	  echo "<td>" . $row['Album_Name'] . "</td>";
	  echo "<td>" . $row['Length'] . "</td>";
	  echo "<td>" . $row['Last_Played'] . "<br />
	  		<input type='button' value='Played' style='width:100px;border:1px solid #ddd;background:blue;padding:3px;color:white;' onClick='location.href=\"updateplay.php?ID=".$row['ID']."\"' /></td>";
	  echo "<td><a name=" . $row['ID'] . ">" . $row['Lyrics'] . "</a></td>";
	  echo "<td>" . $row['Other_Artist'] . "</td>";
	  echo "<td>" . $row['Song_Comments'] . "</td>";
	  echo "<td>" . $row['Language'] . "</td>";
	  echo "<td>" . $row['Ratings'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
} else{
	echo '<h3>Error Fetching Data: </h3> <br />'.mysql_error();
}


}else{
	header("Location: index.php");
}

//CLOSE CONNECTION TO DATABASE
mysql_close($con);
?>
</div>
</body>
