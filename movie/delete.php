<?php
include("../DB/dbmovieshop.php");
include("../DB/check_admin_login.php");

$query_rs_delete = "SELECT * FROM movie WHERE id = " . $_GET['ID'];
$rs_delete = mysqli_query($dbconn_movieshop, $query_rs_delete);
$row_rs_delete = mysqli_fetch_assoc($rs_delete);

$query_rs_member = "SELECT id, name FROM member WHERE id =" . $_SESSION["id"];
$rs_member = mysqli_query($dbconn_movieshop, $query_rs_member);
$row_rs_member = mysqli_fetch_assoc($rs_member);

if (isset($_POST['Delete'])) {
  //刪除 files 裡的檔案
  $original = $row_rs_delete['original'];
  if (file_exists($original)) {
    unlink($original);
  }

  //刪除 thumbnail 裡的檔案
  $thumbnail = $row_rs_delete['thumbnail'];
  if (file_exists($thumbnail)) {
    unlink($thumbnail);
  }

  $deleteSQL = "DELETE FROM movie WHERE id = " . $_GET['ID'];
  mysqli_query($dbconn_movieshop, $deleteSQL);

  echo "<script>";
  echo "alert('刪除成功');";
  echo "location.href='../index_login.php';";
  echo "</script>";

  //header("Location: ../index_login.php");
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

  <title>影片出租店 - 刪除電影</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Movie:</h6>
            <a class="collapse-item" href="../index_login.php">Movie DataTables</a>
            <a class="collapse-item" href="add.php">Add Movie</a>
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
          <h1 class="font-weight-bold text-danger" align="center">Delete Movie</h1>

          <div align="center">
            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card border-left-danger shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Movie Datatable</h6>
                </div>

                <form id="form1" name="form1" method="POST" enctype="multipart/form-data">

                  <div class="card-body">
                    <table width="320" height="500" align="center">
                      <tr>
                        <td align="center" width="120">片名</td>
                        <td width="180"><input type="text" name="title" id="title" readonly="readonly" value="<?php echo $row_rs_delete['title']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">導演</td>
                        <td><input type="text" name="director" id="director" readonly="readonly" value="<?php echo $row_rs_delete['director']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">演員</td>
                        <td><input type="text" name="actor" id="actor" readonly="readonly" value="<?php echo $row_rs_delete['actor']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">國家</td>
                        <td><input type="text" name="country" id="country" readonly="readonly" value="<?php echo $row_rs_delete['country']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片分級</td>
                        <td><input type="text" name="category" id="category" readonly="readonly" value="<?php echo $row_rs_delete['category']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片類型</td>
                        <td><input type="text" name="movietype" id="movietype" readonly="readonly" value="<?php echo $row_rs_delete['movietype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">格式</td>
                        <td><input type="text" name="storetype" id="storetype" readonly="readonly" value="<?php echo $row_rs_delete['storetype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">新舊片</td>
                        <td><input type="text" name="oldnewtype" id="oldnewtype" readonly="readonly" value="<?php echo $row_rs_delete['oldnewtype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">發行日期</td>
                        <td><input type="text" name="issuedate" id="issuedate" readonly="readonly" value="<?php echo $row_rs_delete['issuedate']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">片長(分鐘)</td>
                        <td><input type="text" name="lengthmin" id="lengthmin" readonly="readonly" value="<?php echo $row_rs_delete['lengthmin']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片介紹</td>
                        <td><input type="text" name="web" id="web" readonly="readonly" value="<?php echo $row_rs_delete['web']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">庫存量</td>
                        <td><input type="text" name="amount" id="amount" readonly="readonly" value="<?php echo $row_rs_delete['amount']; ?>" /></td>
                      </tr>
                    </table>
                    <h1 align="center">
                      <button class="btn btn-danger" type="button" data-target="#deleteMovie" data-toggle="modal">Delete</button>
                    </h1>
                  </div>

                  <!--DeleteMovie Modal-->
                  <div class="modal fade" id="deleteMovie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Movie</h5>
                        </div>

                        <div align="center" class="modal-body"><?php echo "您確定要刪除『" . $row_rs_delete['title'] . "』嗎?"; ?></div>

                        <div class="modal-footer">
                          <button class="btn btn-primary btn-sm" type="submit" name="Delete" id="Delete">確定</button>
                          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">取消</button>
                        </div>

                      </div>
                    </div>
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