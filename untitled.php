<?php
/*
UPC
Vendor
Price
*/

require_once 'connect.php';

mysql_select_db("jbs44",$con);

function adjust($string){
	return mysql_real_escape_string(htmlentities($string));
}

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vendor - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>

<?php
if(isset($_COOKIE['username'])&&$_COOKIE['username']=='Gehani') {
	
include_once 'header.php';
?>
<div class="title">
	<h1>Vendor - CD Manager</h1>
</div>
<div class="query">
	<textarea style="width:1180px; height:70px;">MySQL Query:
	<?php
	if(isset($_POST['upc'])&&isset($_POST['vendor'])&&isset($_POST['price'])){
	
	$upc=adjust($_POST['upc']);
	$vendor=adjust($_POST['vendor']);
	$price=adjust($_POST['price']);
	
		if(!empty($upc)&&!empty($vendor)&&!empty($price)){
			$mysql_insertquery = "INSERT INTO Vendor (UPC, Vendor, Price) VALUES ('$ups', '$vendor', '$price');";
			echo $mysql_insertquery;
			
			if(!mysql_query($mysql_insertquery, $con)){
				echo'<h3>Error Registering into Database: </h3>'.mysql_error();
			} else{
			echo "<h3>Vendor & Price Added!</h3>";
			}
		} else{
			echo '<h3>Error: Please check if all the required fields are entered.</h3>'.mysql_error();	
		}
	}
	?></textarea>
</div>
<div class="entryblock">
<form action="vendor.php" method="POST">
	UPC: <br />
    <input type="number" name="upc" size="12" maxlength="8" />
    Vendor: <br />
    <input type="text" name="vendor" size="30" maxlength="30"/> <br /><br />
    Price: <br />
    $<input type="number" name="price" value="0.00" min="0.00" step="0.01" maxlength="8" size="8"/> <br /><br />
    
    <input type="submit" value="Add Album"/>
    
</form>

</div>

<div id="table_vendor">
<?php
//FETCH ALL DATA
$fieldsort = 'Vendor';
$query = "SELECT * FROM Vendor ORDER BY $fieldsort;";
echo '<div id="query_album">
		MySQL Query: '.$query.' 
	  </div>';

if($Album = mysql_query($query)){
	echo "<table border=\"1\" width=\"1200\">
		<tr>
			<th bgcolor=\"#CCCCFF\" colspan=\"9\"><h3>Albums</h3></th>
		</tr>
		<tr bgcolor=\"#BBBBFF\">
			<th width=\"10%\">Album Name</th>
			<th width=\"13%\">Artist</th>
			<th width=\"10%\">Genre</th>
			<th width=\"10%\">Publisher</th>
			<th width=\"7%\">Release Date</th>
			<th width=\"10%\">Date Purchased</th>
			<th width=\"30%\">Comments</th>
			<th width=\"5%\">Vendor</th>
			<th width=\"5%\">Price</th>
		</tr>";
		
		while($row = mysql_fetch_array($Album))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['Album_Name'] . "</td>";
	  echo "<td>" . $row['Artist'] . "</td>";
	  echo "<td>" . $row['Genre'] . "</td>";
	  echo "<td>" . $row['Publisher'] . "</td>";
	  echo "<td>" . $row['Release_Date'] . "</td>";
	  echo "<td>" . $row['Date_Purchased'] . "</td>";
	  echo "<td>" . $row['Comments'] . "</td>";
	  echo "<td>" . $row['Vendor'] . "</td>";
	  echo "<td>" . $row['Price'] . "</td>";
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
