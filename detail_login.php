<?php
include("DB/dbmovieshop.php");
include("DB/check_login.php");

$query_rs_movie_dtl = "SELECT * FROM movie WHERE id = " . $_GET["ID"];
$rs_movie_dtl = mysqli_query($dbconn_movieshop, $query_rs_movie_dtl);
$row_rs_movie_dtl = mysqli_fetch_assoc($rs_movie_dtl);

$query_rs_member_dtl = "SELECT id, name FROM member WHERE id =" . $_SESSION["id"];
$rs_member_dtl = mysqli_query($dbconn_movieshop, $query_rs_member_dtl);
$row_rs_member_dtl = mysqli_fetch_assoc($rs_member_dtl);

if(isset($_POST["rental"]))
{
  $movieid = $_GET["ID"];
  $memberid = $_SESSION["id"];
  $rentdate = date("Y-m-d");
  
  $rentalSQL = "INSERT INTO rental (memberid, movieid, rentdate, rentstate) VALUES ('$memberid', '$movieid', '$rentdate', '租借中')";
  mysqli_query($dbconn_movieshop, $rentalSQL);

  echo "<script>";
  echo "alert('恭喜您租借成功！');";
  echo "location.href = 'member/rental_record.php?ID=$memberid';";
  echo "</script>";

    //header("Location: rental_record.php?ID=". $memberid);
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

  <title>影片出租店 - <?php echo $row_rs_movie_dtl['title']; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_login.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Movie Shop</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Pages Collapse Menu -->
      <?php if ($row_rs_member_dtl['id'] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Movie:</h6>
              <a class="collapse-item" href="index_login.php">Movie DataTables</a>
              <a class="collapse-item" href="movie/add.php">Add Movie</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Member:</h6>
              <a class="collapse-item" href="member/index.php">Member DataTables</a>
            </div>
          </div>
        </li>
      <?php } ?>
      
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
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $row_rs_member_dtl['name']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="member/profile.php?ID=<?php echo $row_rs_member_dtl['id']; ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="member/rental_record.php?ID=<?php echo $row_rs_member_dtl['id']; ?>">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Rental Record
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary" align="center"><?php echo $row_rs_movie_dtl['title']; ?></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php if ($row_rs_member_dtl['id'] == 1) { ?>
                  <h5 align="center">
                    <a href="movie/update.php?ID=<?php echo $row_rs_movie_dtl['id']; ?>" class="font-weight-bold text-success">Update</a>
                    &nbsp;&nbsp;
                    <a href="movie/delete.php?ID=<?php echo $row_rs_movie_dtl['id']; ?>" class="font-weight-bold text-danger">Delete</a>
                  </h5>
                <?php } else { ?>
                  <h5 align="center">
                    <a href="#" class="font-weight-bold text-warning" data-toggle='modal' data-target='#rental'>我要租片</a>
                  </h5>
                <?php } ?>
                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0" align="center">
                  <tr align="center">
                    <td colspan="6"><strong class="columntitle">影片介紹</strong></td>
                  </tr>
                  <tr align="center">
                    <td colspan="6">
                      <a href="<?php echo $row_rs_movie_dtl['web']; ?>" target="_blank"><img src="<?php echo "movie/" . $row_rs_movie_dtl['thumbnail']; ?>" /></a></td>
                  </tr>
                  <tr align="center">
                    <th><strong class="columntitle">導演</strong></th>
                    <th><strong class="columntitle">演員</strong></th>
                    <th><strong class="columntitle">國家</strong></th>
                    <th><strong class="columntitle">影片分級</strong></th>
                    <th><strong class="columntitle">影片類型</strong></th>
                  </tr>
                  <tr align="center">
                    <td><?php echo $row_rs_movie_dtl['director']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['actor']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['country']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['category']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['movietype']; ?></td>
                  </tr>
                  <tr align="center">
                    <th><strong class="columntitle">格式</strong></th>
                    <th><strong class="columntitle">新舊片</strong></th>
                    <th><strong class="columntitle">發行日期</strong></th>
                    <th><strong class="columntitle">片長(分鐘)</strong></th>
                    <th><strong class="columntitle">庫存量</strong></th>
                  </tr>
                  <tr align="center">
                    <td><?php echo $row_rs_movie_dtl['storetype']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['oldnewtype']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['issuedate']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['lengthmin']; ?></td>
                    <td><?php echo $row_rs_movie_dtl['amount']; ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- End of Page Content -->

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

  <!-- Rental Modal-->
  <form method="post">
    <div class="modal fade" id="rental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rental Movie</h5>
          </div>

          <div align="center" class="modal-body"><?php echo "您確定要租『" . $row_rs_movie_dtl['title'] . "』嗎?"; ?></div>

          <div class="modal-footer">
            <button class="btn btn-primary btn-sm" type="submit" name="rental">確定</button>
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">取消</button>
          </div>

        </div>
      </div>
    </div>
  </form>

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
          <a class="btn btn-primary" href="logout.php">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
<?php
mysqli_free_result($rs_movie_dtl);
?>