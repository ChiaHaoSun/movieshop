<?php
  session_start();

  //清除並釋放session變數
  unset($_SESSION["id"]);
	
  //將使用者導回登入網頁
  header("location: login.php");
?>