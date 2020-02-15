<?php
include("../DB/dbmovieshop.php");
include("../DB/check_admin_login.php");

$query_rs_update = "SELECT * FROM movie WHERE id = " . $_GET['ID'];
$rs_update = mysqli_query($dbconn_movieshop, $query_rs_update);
$row_rs_update = mysqli_fetch_assoc($rs_update);

$query_rs_member = "SELECT id, name FROM member WHERE id =" . $_SESSION["id"];
$rs_member = mysqli_query($dbconn_movieshop, $query_rs_member);
$row_rs_member = mysqli_fetch_assoc($rs_member);

if (isset($_POST["Update"])) 
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

  $updateSQL = "UPDATE movie SET  title = '$title', 
                                  director = '$director', 
                                  actor = '$actor', 
                                  country = '$country', 
                                  category = '$category', 
                                  movietype = '$movietype', 
                                  storetype = '$storetype', 
                                  oldnewtype = '$oldnewtype', 
                                  issuedate = '$issuedate', 
                                  lengthmin = '$lengthmin', 
                                  web = '$web', 
                                  amount = '$amount' 
                                  WHERE id = " . $_GET['ID'];

  mysqli_query($dbconn_movieshop, $updateSQL);

  $url = "../detail_login.php?ID=" . $_GET['ID'];

  echo "<script>";
  echo "alert('更新成功');";
  echo "location.href='$url';";
  echo "</script>";

  //header("Location: $url");
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

  <title>影片出租店 - 更新電影</title>

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
          <h1 class="font-weight-bold text-success" align="center">Update Movie</h1>

          <div align="center">
            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card border-left-success shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Movie Datatable</h6>
                </div>

                <form id="form1" name="form1" method="POST" enctype="multipart/form-data">

                  <div class="card-body">
                    <table width="320" height="500" align="center">
                      <tr>
                        <td align="center" width="120">片名</td>
                        <td width="180"><input type="text" name="title" id="title" value="<?php echo $row_rs_update['title']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">導演</td>
                        <td><input type="text" name="director" id="director" value="<?php echo $row_rs_update['director']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">演員</td>
                        <td><input type="text" name="actor" id="actor" value="<?php echo $row_rs_update['actor']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">國家</td>
                        <td><input type="text" name="country" id="country" value="<?php echo $row_rs_update['country']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片分級</td>
                        <td><input type="text" name="category" id="category" value="<?php echo $row_rs_update['category']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片類型</td>
                        <td><input type="text" name="movietype" id="movietype" value="<?php echo $row_rs_update['movietype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">格式</td>
                        <td><input type="text" name="storetype" id="storetype" value="<?php echo $row_rs_update['storetype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">新舊片</td>
                        <td><input type="text" name="oldnewtype" id="oldnewtype" value="<?php echo $row_rs_update['oldnewtype']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">發行日期</td>
                        <td><input type="text" name="issuedate" id="issuedate" value="<?php echo $row_rs_update['issuedate']; ?>" />
                          <font size=2>格式：2001-01-01</font>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">片長(分鐘)</td>
                        <td><input type="text" name="lengthmin" id="lengthmin" value="<?php echo $row_rs_update['lengthmin']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">影片介紹</td>
                        <td><input type="text" name="web" id="web" value="<?php echo $row_rs_update['web']; ?>" /></td>
                      </tr>
                      <tr>
                        <td align="center">庫存量</td>
                        <td><input type="text" name="amount" id="amount" value="<?php echo $row_rs_update['amount']; ?>" /></td>
                      </tr>
                    </table>
                    <h1 align="center">
                      <button class="btn btn-success" type="button" data-target="#updateMovie" data-toggle="modal">Update</button>
                    </h1>
                  </div>

                  <!--UpdateMovie Modal-->
                  <div class="modal fade" id="updateMovie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Movie</h5>
                        </div>

                        <div align="center" class="modal-body"><?php echo "您確定要更新『" . $row_rs_update['title'] . "』嗎?"; ?></div>

                        <div class="modal-footer">
                          <button class="btn btn-primary btn-sm" type="submit" name="Update" id="Update">確定</button>
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