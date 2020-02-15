<?php
    /* 檢查"一般會員"是否登入 */
    session_start();
    $login = "../login.php"; //有目錄的檔案
    if(!$_SESSION["id"])
        header("Location: $login");
?>