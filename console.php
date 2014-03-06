<?php
require_once 'connect.php';

mysql_select_db("jbs44",$con);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Console Query - CD Manager</title>
<link rel="stylesheet" type="text/css" href="cd.css"/>
</head>

<body>
<div>
<?php
include 'header.php';
?>
</div>
<div class="title">
	<h1>Console Query - CD Manager</h1>
</div>

<div class="entryblock">
<form action="console.php" method="GET">
	MySQL Console Query: <br />
    <textarea name="console_query" rows="10" cols="50" maxlength=2000></textarea> <br /><br />
    <input type="submit" value="Go"/>
</form>
</div>

<div id="table_console">
<?php
if(isset($_GET['console_query'])){
	$console_query=$_GET['console_query'];
	if(!empty($console_query)){
		
		if($Console=mysql_query($console_query)){
			$Console2=mysql_query($console_query);
			//
			//print_r($Console);
			//echo '<br /><br />';
			
			//
			while($display_index=mysql_fetch_array($Console)){
				$array_index=array_keys($display_index);
				$max=sizeof($array_index);
				$span=$max/2;
				//echo $array_index['5'];
				if($span<=5)
					echo "<table border=\"1\" style=\"width:auto; max-width: 1180px; display: block;\">";
				else
					echo "<table border=\"1\" style=\"width:1200; display: block;\">";
				echo "<tr>
						<th class=\"table_title\" colspan=\"$span\">Query</th>
					</tr>
					<tr>";
				for($a=1;$a<=$max;$a+=2){
					echo '<th>'.$array_index[$a].'</th>';
				}
				echo '</tr>';
				echo '<br /><br />';
				mysql_free_result($Console);
				break;
			}
			
			
			while($row=mysql_fetch_array($Console2)){
				echo "<tr>";
				
				for($b=0;$b<$span;$b++){
					echo '<td>'.$row[$b].'</td>';
				}
				
				echo "</tr>";
			}
			
			echo "</table>";
			
			//
		} else{
			echo '<h3>Error Fetching Data: </h3> <br />'.mysql_error();
		}
		
	} else{
		echo '<h3>Error: Please enter a query.</h3>'.mysql_error();
	} 
}
?>
</div>
<div class="query">
	MySQL Query:
	<?php
	if(isset($_GET['console_query'])&&!empty($_GET['console_query']))
		echo $console_query;
	//CLOSE CONNECTION TO DATABASE
	mysql_close($con);
	?>
</div>
</body>
</html>