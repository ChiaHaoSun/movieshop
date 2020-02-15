<?php
include("../DB/dbmovieshop.php");
include("../DB/check_login2.php");
 
$sql_query = "SELECT * FROM member WHERE id = " . $_SESSION["id"];
$rs_profile = mysqli_query($dbconn_movieshop, $sql_query);
$row_rs_profile = mysqli_fetch_assoc($rs_profile);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>影片出租店 - 會員資料</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
  
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
      <?php if ($row_rs_profile['id'] == 1) {?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Movie:</h6>
            <a class="collapse-item" href="../index.php">Movie DataTables</a>
            <a class="collapse-item" href="../movie/add.php">Add Movie</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Member:</h6>
            <a class="collapse-item" href="index.php">Member DataTables</a>
          </div>
        </div>
      </li>
      <?php }?>

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
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $row_rs_profile['name']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php?ID=<?php echo $row_rs_profile['id']; ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="rental_record.php?ID=<?php echo $row_rs_profile['id']; ?>">
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
          <br>
          <h1 align="center" class="font-weight-bold text-warning"><?php echo $row_rs_profile['name']; ?></h1>

          <div align="center">
            <div class="col-lg-4">        
              <div class="card border-left-warning shadow mb-4">
                <div class="card-header py-3">
                  <p align="center" class="m-0 font-weight-bold text-warning">Member Datatable</p>
                </div>
                <form id="form1" name="form1" method="POST">
                  <table width="280" height="420" align="center">
                  <tr>
                    <td align="center" width="100">帳號</td>
                    <td width="180"><input type="text" name="account" id="account" value="<?php echo $row_rs_profile['account']; ?>" readonly="readonly"/></td>
                  </tr>
                  <tr>
                    <td align="center">密碼</td>
                    <td><input type="password" name="password" id="password" value="<?php echo $row_rs_profile['password']; ?>" readonly="readonly"/></td>
                  </tr>  
                  <tr>
                    <td align="center" width="100">姓名</td>
                    <td><input type="text" name="name" id="name" value="<?php echo $row_rs_profile['name']; ?>" readonly="readonly"/></td>
                  </tr>
                  <tr>
                    <td align="center">性別</td>
                    <td> 
                      <?php if( $row_rs_profile['sex'] == "M") { ?>
                                <input type="radio" name="sex" value="M" checked/>&nbsp;Male
                                &nbsp;&nbsp;
                                <input type="radio" name="sex" value="F"/>&nbsp;Female
                      <?php } 
                            if( $row_rs_profile['sex'] == "F") {?>
                                <input type="radio" name="sex" value="M"/>&nbsp;Male
                                &nbsp;&nbsp;
                                <input type="radio" name="sex" value="F" checked/>&nbsp;Female
                      <?php }?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">生日</td>
                    <td><input type="text" name="birthday" id="birthday" value="<?php echo $row_rs_profile['birthday']; ?>" readonly="readonly"/><font size=2>格式：2001-01-01</font></td>
                  </tr>
                  <tr>
                    <td align="center">E-mail</td>
                    <td><input type="text" name="email" id="email" value="<?php echo $row_rs_profile['email']; ?>" readonly="readonly"/></td>
                  </tr>
                  <tr>
                    <td align="center">電話</td>
                    <td><input type="text" name="telephone" id="telephone" value="<?php echo $row_rs_profile['telephone']; ?>" readonly="readonly"/></td>
                  </tr>
                  <tr>
                    <td align="center">地址</td>
                    <td><input type="text" name="address" id="address" value="<?php echo $row_rs_profile['address']; ?>" readonly="readonly"/></td>
                  </tr>
                  </table>
                  <h5 align="center">
                    <a href="update.php?ID=<?php echo $row_rs_profile['id']; ?>" class="font-weight-bold text-success">Update</a>
                    &nbsp;&nbsp;
                    <a href="delete.php?ID=<?php echo $row_rs_profile['id']; ?>" class="font-weight-bold text-danger">Delete</a>
                  </h5>
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

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  
  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>