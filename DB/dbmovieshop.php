<?php
$url      = parse_url(getenv("DATABASE_URL"));
$server   = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db       = substr($url["path"],1);

$dbconn_movieshop = mysqli_connect($server, $username, $password); 
mysqli_query($dbconn_movieshop, "SET NAMES 'UTF8'");

if (!$dbconn_movieshop) {
	echo "資料庫連線失敗:".mysqli_connect_error();
	exit();
}
else{
	mysqli_select_db($dbconn_movieshop, $db);
	//echo "資料庫連線成功";
}
?>