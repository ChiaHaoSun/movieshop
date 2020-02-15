<?php
include("../DB/dbmovieshop.php");
include("../DB/check_admin_login.php");
include("resize.php");

$query_rs_member = "SELECT id, name FROM member WHERE id =" . $_SESSION["id"];
$rs_member = mysqli_query($dbconn_movieshop, $query_rs_member);
$row_rs_member = mysqli_fetch_assoc($rs_member);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addform")) 
{ 
  $title = $_POST['title'];
  $director = $_POST['director'];
  $actor = $_POST['actor'];
  $country = $_POST['country'];
  $category = $_POST['category'];
  $movietype = $_POST['movietype'];
  $storetype = $_POST['storetype'];
  $oldnewtype = $_POST['oldnewtype'];
  $issuedate = $_POST['issuedate'];
  $lengthmin = $_POST['lengthmin'];
  $web = $_POST['web'];
  $amount = $_POST['amount'];

  /****** 圖片上傳 ******/
  // 1. 先判斷上傳至網站的暫存目錄是否有錯誤
  if ($_FILES['uploadfile']['error']>0)
  {
	  switch ($_FILES['uploadfile']["error"])
    {
      case 1: die('ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制'); break;
      case 2: die('ErrCode: 2 檔案大小超出 max_file_size 限制'); break;
      case 3: die('ErrCode: 3 檔案僅被部份上傳,上傳不完整');  break;
      case 4: die('ErrCode: 4 檔案未被上傳'); break;
      case 6: die('ErrCode: 6 暫存目錄不存在');  break;
      case 7: die('ErrCode: 7 無法寫入到檔案'); break;
      case 8: die('ErrCode: 8 上傳停止'); break;
    }
  }
  // 2. 前面 1. 成功, 再將上傳至網站的暫存檔案搬至到另個目錄, 並存成不同檔名
  if(is_uploaded_file($_FILES['uploadfile']['tmp_name']))
  {
    $chkImg=getimagesize($_FILES['uploadfile']['tmp_name']);
    $Width=$chkImg[0];
    $Height=$chkImg[1];
    
    if (!$chkImg)
      die("不是圖檔");
    if (!is_dir("files") || !is_writeable("files"))
      die("目錄不存在或無法寫入");
    
    //$imgName = explode(".", $_FILES["file"]["name"]);
	  //$imgName_new = date(mdHis).".".$imgName[1];

    $tmp_filename = $_FILES['uploadfile']['tmp_name'];
    $originalfilename = explode(".", $_FILES['uploadfile']['name']);
    $Orifile = "files/". $originalfilename[0]. ".". $originalfilename[1];
    $Thumbfile = "thumbnail/". $originalfilename[0]. ".". $originalfilename[1];
    
    if (move_uploaded_file($tmp_filename, iconv("utf-8", "big5", $Orifile)))
    {
      echo $originalfilename ." 檔案上傳成功";		
      $srcfile=iconv("utf-8", "big5", $Orifile);
      $destfile=iconv("utf-8", "big5", $Thumbfile);
      
      if ($Width <= $Height && $Height > 960)
        imageResize($srcfile, $destfile, 960);
      else if ($Width >= $Height && $Width > 672)		
        imageResize($srcfile, $destfile, 672);
      else
        copy($srcfile, $destfile);
    }
    else
      die("檔案上傳失敗");
  }

  $insertSQL = "INSERT INTO movie (title, director, actor, country, category, movietype, storetype, oldnewtype, issuedate, lengthmin, web, amount, original, thumbnail) 
                VALUES ('$title', '$director', '$actor', '$country', '$category', '$movietype', '$storetype', '$oldnewtype', '$issuedate', '$lengthmin', '$web', '$amount', '$Orifile', '$Thumbfile')";

  mysqli_query($dbconn_movieshop, $insertSQL);
  header("Location: ../index_login.php");
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

  <title>影片出租店 - 新增電影</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">
    .disNon {
      display:none;
    }
  </style>

  <script type="text/javascript"> 
    function check_data() {
      var obj = {
        'title': '* 片名為必填。'
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
      } 
      else 
      {
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

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index_login.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Movie Shop</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Movie:</h6>
            <a class="collapse-item" href="../index_login.php">Movie DataTables</a>
            <a class="collapse-item active" href="add.php">Add Movie</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Member:</h6>
            <a class="collapse-item" href="../member/index.php">Member DataTables</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Search -->
          <div class="container-fluid">
            <h1 class="h4 text-gray-800 font-weight-bold">歡迎來到影片出租店</h1>
            <p class="mb-1">已經租片的顧客請記得登出會員唷！感謝您的蒞臨！</p>
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
          
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $row_rs_member['name']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../member/profile.php?ID=<?php echo $row_rs_member['id']; ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="../rental_record.php?ID=<?php echo $row_rs_member['id']; ?>">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Rental Record
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="font-weight-bold text-primary" align="center">Add Movie</h1>

          <div align="center">
            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Movie Datatable</h6>
                </div>
                <form id="addform" name="addform" method="POST" enctype="multipart/form-data">
                  <div class="card-body">
                    <table width="320" height="500" align="center">
                      <tr>
                        <td align="center" width="120">片名</td>
                        <td width="180">
                          <input type="text" name="title" id="title" />
                          <span style="color: red; font-size: 12px;" id="span_title"></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">導演</td>
                        <td><input type="text" name="director" id="director" /></td>
                      </tr>
                      <tr>
                        <td align="center">演員</td>
                        <td><input type="text" name="actor" id="actor" /></td>
                      </tr>
                      <tr>
                        <td align="center">國家</td>
                        <td><input type="text" name="country" id="country" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片分級</td>
                        <td><input type="text" name="category" id="category" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片類型</td>
                        <td><input type="text" name="movietype" id="movietype" /></td>
                      </tr>
                      <tr>
                        <td align="center">格式</td>
                        <td><input type="text" name="storetype" id="storetype" /></td>
                      </tr>
                      <tr>
                        <td align="center">新舊片</td>
                        <td><input type="text" name="oldnewtype" id="oldnewtype" /></td>
                      </tr>
                      <tr>
                        <td align="center">發行日期</td>
                        <td><input type="text" name="issuedate" id="issuedate" /><font size=2>格式：2001-01-01</font></td>
                      </tr>
                      <tr>
                        <td align="center">片長(分鐘)</td>
                        <td><input type="text" name="lengthmin" id="lengthmin" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片介紹</td>
                        <td><input type="text" name="web" id="web" /></td>
                      </tr>
                      <tr>
                        <td align="center">庫存量</td>
                        <td><input type="text" name="amount" id="amount" /></td>
                      </tr>
                      <tr>
                        <td align="center">圖片</td>
                        <td>
                          <input type="file" name="uploadfile" id="uploadfile" class="disNon" onchange="this.form.upfile.value=this.value.substr(this.value.lastIndexOf('\\')+1);" >
                          <input type="text" name="upfile" size="12" readonly>
                          <input type="button" class="btn bg-gray-200" value="瀏覽" onclick="this.form.uploadfile.click();">
                        </td>
                      </tr>
                    </table>
                    <h1 align="center">                 
                      <button type="reset" class="btn btn-info">Reset</button>
                      <button type="button" class="btn btn-primary" onclick="check_data()">Create</button>
                      <input type="hidden" name="MM_insert" value="addform" />               
                    </h1>
                  </div>
                </form>
              </div>

            </div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>
</html>
