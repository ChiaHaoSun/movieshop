<?php
include("../DB/dbmovieshop.php");
include("../DB/check_admin_login.php");

/* 取出該會員的全部租片紀錄 */
$query_rs_rental = "SELECT rental.id AS rid, memberid, movieid, rentdate, rentstate, title 
                    FROM rental, member, movie 
                    WHERE memberid = member.id and movieid = movie.id and memberid = " . $_GET['ID'];
$rs_rental = mysqli_query($dbconn_movieshop, $query_rs_rental);

/* 取出管理員的資料 */
$query_rs_member = "SELECT id FROM member WHERE id = 1";
$rs_member = mysqli_query($dbconn_movieshop, $query_rs_member);
$row_rs_member = mysqli_fetch_assoc($rs_member);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editform")) 
{
  $rentstate = $_POST['rentstate'];
  $rentID = $_POST['rentID'];

  $updateSQL = "UPDATE rental SET rentstate = '$rentstate' WHERE id = '$rentID' and memberid = " . $_GET['ID'];
  mysqli_query($dbconn_movieshop, $updateSQL);

  echo "<script>";
  echo "alert('更新成功');";
  echo "history.back();";
  echo "</script>";
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

  <title>影片出租店</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
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
            <a class="collapse-item" href="../movie/add.php">Add Movie</a>
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
          </div>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div align="center">
            <div class="col-lg-7">
              <div class="card shadow mb-4">

                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary" align="center">Rental DataTables</h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr align="center" class="font-weight-bold text-primary">
                          <th>租片ID</th>
                          <th>影片片名</th>
                          <th>租片日期</th>
                          <th>租片狀態</th>
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row_rs_rental = mysqli_fetch_assoc($rs_rental)) { ?>
                          <tr align="center">
                            <td class="rental_id"><?php echo $row_rs_rental['rid']; ?></td>
                            <td>
                              <a href="../detail_login.php?ID=<?php echo $row_rs_rental['movieid']; ?>" class="rental_title"><?php echo $row_rs_rental['title']; ?></a>
                            </td>
                            <td class="rental_rentdate"><?php echo $row_rs_rental['rentdate']; ?></td>
                            <td class="rental_rentstate"><?php echo $row_rs_rental['rentstate']; ?></td>
                            <td>
                              <button class="btn btn-success btn-sm editbtn" type="button" data-target="#edit" data-toggle="modal">編輯</button>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                  </div>
                </div>

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

  <!-- Rentstate Form -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('.editbtn').click(function() {
        var rentID = $(this).closest('tr').find('.rental_id').text();
        var title = $(this).closest('tr').find('.rental_title').text();
        var rentdate = $(this).closest('tr').find('.rental_rentdate').text();
        var rentstate = $(this).closest('tr').find('.rental_rentstate').text();

        $('input[name="rentID"]').val(rentID);
        $('input[name="title"]').val(title);
        $('input[name="rentdate"]').val(rentdate);

        if (rentstate == "租借中")
          $("input[name='rentstate']")[0].checked = true;
        else if (rentstate == "已歸還")
          $("input[name='rentstate']")[1].checked = true;
      });
    });
  </script>

  <!-- Rentstate Form -->
  <form id="editform" name="editform" method="POST" enctype="multipart/form-data" action="">

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content card border-left-success">

          <div class="modal-header">
            <h5 class="modal-title font-weight-bold text-success" id="exampleModalLabel">更新租借狀態</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body font-weight-bold text-primary" align="center">
            <table width="250" height="200">
              <tr>
                <td width="80">租片ID</td>
                <td width="80"><input type="text" name="rentID" id="rentID" size="16" readonly /></td>
              </tr>
              <tr>
                <td>影片片名</td>
                <td><input type="text" name="title" id="title" size="16" readonly /></td>
              </tr>
              <tr>
                <td>租片日期</td>
                <td><input type="text" name="rentdate" id="rentdate" size="16" readonly /></td>
              </tr>
              <tr>
                <td>租片狀態</td>
                <td class="text-danger">
                  <input type="radio" name="rentstate" id="rentstate" value="租借中" />&nbsp;租借中
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="rentstate" id="rentstate" value="已歸還" />&nbsp;已歸還
                </td>
              </tr>
            </table>
            <p>
              <button class="btn btn-success btn-sm" type="button" data-target="#return" data-toggle="modal">更新</button>
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">取消</button>
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- Return Modal-->
    <div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div align="center" class="modal-body">確定是否已歸還?</div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-sm" type="submit">確定</button>
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">取消</button>
            <input type="hidden" name="MM_update" value="editform" />
          </div>
        </div>
      </div>
    </div>

  </form>
  <!-- End of Rentstate Form -->

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