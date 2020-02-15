<?php
$hostname_dbmovieshop = "localhost";
/*$database_dbmovieshop = "livvvvvi_practice";
$username_dbmovieshop = "livvvvvi_how";
$password_dbmovieshop = "@Practice2019";*/

$database_dbmovieshop = "movieshop";
$username_dbmovieshop = "root";
$password_dbmovieshop = "";

$dbconn_movieshop = mysqli_connect($hostname_dbmovieshop, $username_dbmovieshop, $password_dbmovieshop); 
mysqli_query($dbconn_movieshop, "SET NAMES 'UTF8'");

if (!$dbconn_movieshop) {
	echo "資料庫連線失敗:".mysqli_connect_error();
	exit();
}
else{
	mysqli_select_db($dbconn_movieshop, $database_dbmovieshop);
	//echo "資料庫連線成功";
}
?>