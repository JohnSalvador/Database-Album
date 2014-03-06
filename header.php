<?php

//Detect if page is currently in index.php
$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);

?>

<div id="logout">

<input type="button" value="Logout" style="float:inherit; margin-left: 5px; margin-right:25px; margin-top: 25px; width:100px;border:1px solid #ddd;background:blue;padding:3px;color:white;" onClick="location.href='logout.php'" />
</div>


<div id="cd_pic">
<img src="files/animated_cd.gif"/>
</div>

<div id="nav">
	<ul id="headerlist">
    <?php
		//if ($basename != 'index'){
			echo '<li><a href="index.php">Home</a></li>';
		//}
	?>
    	<li><a href="artist.php">Artists</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="songs.php">Songs</a></li>
        <li><a href="playlist.php">Playlist</a></li>
        <li><a href="vendor.php">Vendor</a></li>
        <li><a href="console.php">Query Console</a></li>
        <li><a href="tablecreation.php">Table Creation</a></li>
    </ul>
</div>

