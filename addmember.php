<?php
include("DB/dbmovieshop.php");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addform")) 
{
  $account = $_POST['account'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $sex = $_POST['sex'];
  $birthday = $_POST['birthday'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $address = $_POST['address'];

  //檢查帳號是否有人申請
  $checkSQL = "SELECT * FROM member Where account = '$account'";
  $result = mysqli_query($dbconn_movieshop, $checkSQL);

  if (mysqli_num_rows($result) != 0) 
  {
    //顯示訊息要求使用者更換帳號名稱
    echo "<script>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  } 
  else 
  {
    $insertSQL = "INSERT INTO member (account, password, name, sex, birthday, email, telephone, address) 
                  VALUES('$account', '$password', '$name', '$sex', '$birthday', '$email', '$telephone', '$address')";

    mysqli_query($dbconn_movieshop, $insertSQL);

    echo "<script>";
    echo "alert('恭喜您成功註冊會員！您現在可以登入會員了！');";
    echo "location.href = 'login.php';";
    echo "</script>";

    //header("Location: login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>影片出租店 - 註冊</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <script type="text/javascript">
    function check_data() {
      var obj = {
        'account': '* 帳號為必填。',
        'password': '* 密碼為必填。',
        'name': '* 姓名為必填。',
        'email': '* E-mail為必填。'
      };

      if (isEmptyInput(obj, 'span')) return;

      addform.submit();
    }

    //檢查必填,下提醒與焦點
    function isEmptyInput(obj, msgType) {
      var emptyInput = false;

      if (msgType == 'alert') {
        var alertMsg = '';
        $.each(obj, function(key, value) {
          if (!$("#" + key).val()) {
            alertMsg += value + '\n';
            if (!emptyInput) emptyInput = key;
          }
        });
        if (emptyInput)
          $("#" + emptyInput).focus();
        if (alertMsg)
          alert(alertMsg);
      } else {
        $.each(obj, function(key, value) {
          $("#span_" + key).html('');
          if (!$("#" + key).val()) {
            $("#span_" + key).html(value);
            if (!emptyInput)
              emptyInput = key;
          }
        });
        if (emptyInput)
          $("#" + emptyInput).focus();
      }
      return emptyInput;
    }
  </script>
</head>

<body class="bg-gradient-info">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">

            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>

              <div class="col-lg-6">
                <div class="p-5">

                  <div class="text-center">
                    <h4 class="font-weight-bold text-primary">註冊會員</h4>
                  </div>

                  <form id="addform" name="addform" method="POST" enctype="multipart/form-data">
                    <table width="280" height="420" align="center">
                      <tr>
                        <td align="center" width="100">帳號</td>
                        <td width="180">
                          <input type="text" name="account" id="account" />
                          <span style="color: red; font-size: 12px;" id="span_account"></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">密碼</td>
                        <td>
                          <input type="password" name="password" id="password" />
                          <span style="color: red; font-size: 12px;" id="span_password"></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">姓名</td>
                        <td>
                          <input type="text" name="name" id="name" />
                          <span style="color: red; font-size: 12px;" id="span_name"></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">性別</td>
                        <td>
                          <input type="radio" name="sex" value="M" checked>&nbsp;Male
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="sex" value="F">&nbsp;Female
                        </td>
                      </tr>
                      <tr>
                        <td align="center">生日</td>
                        <td>
                          <input type="text" name="birthday" id="birthday" />
                          <font size=2>格式：2001-01-01</font>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">E-mail</td>
                        <td>
                          <input type="text" name="email" id="email" />
                          <span style="color: red; font-size: 12px;" id="span_email"></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">電話</td>
                        <td><input type="text" name="telephone" id="telephone" /></td>
                      </tr>
                      <tr>
                        <td align="center">地址</td>
                        <td><input type="text" name="address" id="address" /></td>
                      </tr>
                    </table>
                    <p align="center">
                      <button class="btn btn-info" type="reset">Reset</button>
                      <button class="btn btn-primary" type="button" onClick="check_data()">Create</button>
                      <input type="hidden" name="MM_insert" value="addform" />
                    </p>
                  </form>

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
<?php
mysqli_close($dbconn_movieshop);
?>