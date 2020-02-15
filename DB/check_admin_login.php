<?php
    /* 檢查"管理員"是否登入 */
    session_start();
    $login = "../login.php";
    if($_SESSION["id"] != "1")
        header("Location: $login");
?>