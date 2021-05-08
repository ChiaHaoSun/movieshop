<?php
// Host: ec2-54-87-112-29.compute-1.amazonaws.com
// Database: d4s4tq503f7655
// User: wbdomoqgkqfegd
// Password: 99b8d5758a4a108a264265f9b5d9911b23e524155bb079aab3c42a6d72fb2deb

$url      = parse_url(getenv("DATABASE_URL"));
$server   = $url["ec2-54-87-112-29.compute-1.amazonaws.com"];
$username = $url["wbdomoqgkqfegd"];
$password = $url["99b8d5758a4a108a264265f9b5d9911b23e524155bb079aab3c42a6d72fb2deb"];
$db       = substr($url["d4s4tq503f7655"],1);

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