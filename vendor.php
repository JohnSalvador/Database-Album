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
	MySQL Query:
	<?php
	if(isset($_POST['upc'])&&isset($_POST['vendor'])&&isset($_POST['price'])){
	
	$upc=adjust($_POST['upc']);
	$vendor=adjust($_POST['vendor']);
	$price=adjust($_POST['price']);
	
		if(!empty($upc)&&!empty($vendor)&&!empty($price)){
			$mysql_insertquery = "INSERT INTO Vendor (UPC, Vendor, Price) VALUES ('$upc', '$vendor', '$price');";
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
	?>
</div>
<div class="entryblock">
<form action="vendor.php" method="POST">
	UPC: *<br />
    <input type="number" name="upc" size="12" maxlength="12" /> <br /><br />
    Vendor: * <br />
    <input type="text" name="vendor" size="30" maxlength="30"/> <br /><br />
    Price: *<br />
    $<input type="number" name="price" value="0.00" min="0.00" step="0.01" maxlength="8" size="8"/> <br /><br />
    
    <input type="submit" value="Add Album"/>
    
</form>

</div>

<div id="table_vendor">
<?php
//FETCH ALL DATA
$fieldsort = 'Vendor';
$query = "SELECT * FROM Vendor ORDER BY $fieldsort;";
echo '<div id="query_vendor">
		MySQL Query: '.$query.' 
	  </div>';

if($Album = mysql_query($query)){
	echo "<table border=\"1\" width=\"1200\">
		<tr>
			<th bgcolor=\"#CCCCFF\" colspan=\"4\"><h3>Albums</h3></th>
		</tr>
		<tr bgcolor=\"#BBBBFF\">
			<th width=\"20%\">ID</th>
			<th width=\"30%\">UPC</th>
			<th width=\"30%\">Vendor</th>
			<th width=\"20%\">Price</th>
		</tr>";
		
		while($row = mysql_fetch_array($Album))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['ID'] . "</td>";
	  echo "<td>" . $row['UPC'] . "</td>";
	  echo "<td>" . $row['Vendor'] . "</td>";
	  echo "<td>$ " . $row['Price'] . "</td>";
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
