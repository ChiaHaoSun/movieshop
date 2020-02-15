<?php
include("DB/dbmovieshop.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>影片出租店 - 忘記密碼</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-warning">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">忘記密碼?</h1>
                    <p class="mb-4">請輸入您的帳號即可顯示您的密碼</p>
                  </div>
                  <?php
                  if (isset($_POST['search'])) {
                    //取得表單資料
                    $account = $_POST["account"];
                    $email = $_POST["email"];

                    //檢查查詢的帳號是否存在
                    $searchSQL = "SELECT name, password FROM member WHERE account = '$account' AND email = '$email'";
                    $result = mysqli_query($dbconn_movieshop, $searchSQL);
                    $row = mysqli_fetch_assoc($result);

                    //如果帳號不存在
                    if (mysqli_num_rows($result) == 0) {
                      //顯示訊息告知使用者，查詢的帳號並不存在
                      echo "<script type='text/javascript'>";
                      echo "alert('您所查詢的資料不存在，請檢查是否輸入錯誤。');";
                      echo "history.back();";
                      echo "</script>";
                    }
                    //如果帳號存在
                    else {
                      $name = $row["name"];
                      $password = $row["password"];

                      //顯示訊息告知使用者帳號密碼
                      echo "<div align='center'>$name 您好，您的帳號資料如下：<br>";
                      echo "帳號：$account<br>";
                      echo "密碼：$password<br>";
                      echo "</div>";
                    }

                    //釋放 $result 佔用的記憶體
                    mysqli_free_result($result);

                    //關閉資料連接	
                    mysqli_close($dbconn_movieshop);
                  } else {
                    ?>
                    <form class="user" method="post">
                      <div class="form-group">
                        <input type="text" name="account" class="form-control form-control-user" placeholder="帳號">
                      </div>
                      <div class="form-group">
                        <input type="text" name="email" class="form-control form-control-user" placeholder="E-mail">
                      </div>
                      <button type="submit" name="search" class="btn btn-primary btn-user btn-block">查詢密碼</button>
                    </form>
                  <?php
                }
                ?>
                  <hr>
                  <div class="text-center">
                    <a class="large" href="addmember.php">加入會員!</a>
                  </div>
                  <div class="text-center">
                    <a class="large" href="login.php">已經是會員了? 請登入!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>