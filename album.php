<?php
/*
UPC					int(12)
Album_Name			varchar(30)
Artist				varchar(30)
Genre				varchar(20)
Publisher			varchar(30)
Release_Date		date
Date_Purchased		timestamp
Comments			varchar(100)
*/

require_once 'connect.php';

mysql_select_db("jbs44",$con);

function adjust($string){
	return mysql_real_escape_string(htmlentities($string));
}

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Albums - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>

<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {
	
include_once 'header.php';
?>
<div class="title">
	<h1>Albums - CD Manager</h1>
</div>
<div class="query">
	MySQL Query:
	<?php
	if(isset($_POST['upc'])&&isset($_POST['album_name'])&&isset($_POST['artist'])&&isset($_POST['genre'])
&&isset($_POST['publisher'])&&isset($_POST['release_date'])){
	
	$upc=adjust($_POST['upc']);
	$album_name=adjust($_POST['album_name']);
	$artist=adjust($_POST['artist']);
	$genre=adjust($_POST['genre']);
	$publisher=adjust($_POST['publisher']);
	$release_date=adjust($_POST['release_date']);
	
	if(isset($_POST['comments'])){
		$comments=adjust($_POST['comments']);
	}else{
		$comments="";
	}
		if(!empty($album_name)&&!empty($artist)&&!empty($genre)&&!empty($publisher)){
			$mysql_insertquery = "INSERT INTO Album (UPC, Album_Name, Artist, Genre, Publisher, Release_Date, Comments) VALUES ('$upc','$album_name', '$artist', '$genre', '$publisher', '$release_date', '$comments');";
			echo $mysql_insertquery;
			
			if(!mysql_query($mysql_insertquery, $con)){
				echo'<h3>Error Registering into Database: </h3>'.mysql_error();
			} else{
			echo "<h3>Album Added!</h3>";
			}
		} else{
			echo '<h3>Error: Please check if all the required fields are entered.</h3>'.mysql_error();	
		}
	}
	?>
</div>
<div class="entryblock">
<form action="album.php" method="POST">
	UPC: * <br />
    <input type="number" name="upc" size="12" maxlength="12" /> <br /><br />
	Album Title: *<br />
    <input type="text" name="album_name" size="30" maxlength="30" /> <br /> <br />
    Artist: *<br />
    <input type="text" name="artist" size="30" maxlength="30" /> <br /><br />
    Genre: *<br />
    <input type="text" name="genre" size="20" maxlength="20" /> <br /><br />
    Publisher: *<br />
    <input type="text" name="publisher" size="30" maxlength="30" /> <br /><br />
    Release Date: *<br />
    <input type="text" name="release_date" value="YYYY-MM-DD"size="30" maxlength="30" /> <br /><br />
    <!--Date Purchased: <br />
    <input type="text" name="date_purchased" size="30" maxlength="30" /> <br /><br />-->
    Date Purchased: <br />
    Automatically logged.
    <br /><br />
    Comments: <br />
    <textarea name="comments" rows="10" cols="50" maxlength="100"></textarea> <br /><br />
    
    <input type="submit" value="Add Album"/>
    
</form>

</div>

<div id="table_album">
<?php
//FETCH ALL DATA
$fieldsort = 'Album_Name';
$query = "SELECT * FROM Album ORDER BY $fieldsort;";
echo '<div id="query_album">
		MySQL Query: '.$query.' 
	  </div>';

if($Album = mysql_query($query)){
	echo "<table border=\"1\" width=\"1200\">
		<tr>
			<th bgcolor=\"#CCCCFF\" colspan=\"8\"><h3>Albums</h3></th>
		</tr>
		<tr bgcolor=\"#BBBBFF\">
			<th width=\"5%\">UPC</th>
			<th width=\"10%\">Album Name</th>
			<th width=\"13%\">Artist</th>
			<th width=\"8%\">Genre</th>
			<th width=\"8%\">Publisher</th>
			<th width=\"7%\">Release Date</th>
			<th width=\"10%\">Date Purchased</th>
			<th width=\"29%\">Comments</th>
		</tr>";
		
		while($row = mysql_fetch_array($Album))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['UPC'] . "</td>";
	  echo "<td>" . $row['Album_Name'] . "</td>";
	  echo "<td>" . $row['Artist'] . "</td>";
	  echo "<td>" . $row['Genre'] . "</td>";
	  echo "<td>" . $row['Publisher'] . "</td>";
	  echo "<td>" . $row['Release_Date'] . "</td>";
	  echo "<td>" . $row['Date_Purchased'] . "</td>";
	  echo "<td>" . $row['Comments'] . "</td>";
	  echo "</tr>";
	  }
}else{
	echo '<h3>Error Fetching Data: </h3>'.mysql_error();
}

} else{
	header("Location: index.php");
}

//CLOSE CONNECTION TO DATABASE
mysql_close($con);
?>

</div>
</body>
