<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
        header('location:index.php');
    } else {
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel - Employee Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/buttons.bootstrap4.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <!-- Notification bell -->
            <?php include '../includes/admin-notification.php'?>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="ti-fullscreen"></i>
                </a>
            </li>
            
            </ul>
        </nav>
        <!-- /.navbar -->

         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Eleave</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <?php $page='manage-leave'; include '../includes/admin-sidebar.php'; ?>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Main Sidebar Container end-->

        <div class="content-wrapper">
            <div class="page-container pl-0">
                <!-- main content area start -->
                <div class="main-content">
                    <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Pending Leaves</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="dashboard.php">Home</a></li>
                                        <li><span>Pending List</span></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 clearfix">
                                <div class="user-profile pull-right">
                                    <img class="avatar user-thumb" src="../assets/images/admin.png" alt="avatar">
                                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">ADMIN <i class="fa fa-angle-down"></i></h4>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="logout.php">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- page title area end -->
                    <div class="main-content-inner">
                        
                        
                        <!-- row area start -->
                        <div class="row">
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <!-- <h4 class="header-title"></h4> -->
                                        <div class="single-table">
                                            <div class="table-responsive">
                                                <table  id="example2" class="table table-bordered table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <td>S.N</td>
                                                        <td>Employee ID</td>
                                                        <td width="120">Full Name</td>
                                                        <td>Leave Type</td>
                                                        <td>Applied On</td>
                                                        <td>Current Status</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $status=2;
                                                    $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.Status=:status order by lid desc";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->bindParam(':status',$status,PDO::PARAM_STR);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {         
                                                        ?>  

                                                        <tr>
                                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                                            <td><?php echo htmlentities($result->EmpId);?></td>
                                                            <td><a href="update-employee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                                                                    <td><?php $stats=$result->Status;
                                                                if($stats==1){
                                                            ?>
                                                                <span style="color: green">Approved <i class="fa fa-thumbs-o-up"></i></span>
                                                                <?php } if($stats==2)  { ?>
                                                                <span style="color: red">Declined <i class="fa fa-thumbs-o-down"></i></span>
                                                                <?php } if($stats==0)  { ?>
                                                            <span style="color: blue">Pending <i class="fa fa-spinner"></i></span>
                                                            <?php } ?>


                                                            </td>

                                                
                                                    <td><a href="employeeLeave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="btn btn-secondary btn-sm"  > View Details</a></td>
                                                    </tr>
                                                        <?php $cnt++;} }?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row area end -->
                        
                        </div>
                        <!-- row area start-->
                    </div>
                    <?php include '../includes/footer.php' ?>
                <!-- footer area end-->
                </div>
                <!-- main content area end -->
            </div>
        </div>

    </div>
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/dataTables.responsive.min.js"></script>
    <script src="../assets/js/responsive.bootstrap4.min.js"></script>
    <script src="../assets/js/dataTables.buttons.min.js"></script>
    <script src="../assets/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/js/jszip.min.js"></script>
    <script src="../assets/js/pdfmake.min.js"></script>
    <script src="../assets/js/vfs_fonts.js"></script>
    <script src="../assets/js/buttons.html5.min.js"></script>
    <script src="../assets/js/buttons.print.min.js"></script>
    <script src="../assets/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching":true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script> 
    
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
     <!-- AdminLTE App -->
     <script src="../assets/js/adminlte.min.js"></script>
</body>

</html>

<?php } ?>