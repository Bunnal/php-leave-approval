<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    } else {
    if(isset($_POST['add'])){
    $leavetype=$_POST['leavetype'];
    $description=$_POST['description'];
    $sql="INSERT INTO tblleavetype(LeaveType,Description) VALUES(:leavetype,:description)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
    $query->bindParam(':description',$description,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId){
    $msg="Leave type added Successfully";
    } else {
    $error="Something went wrong. Please try again";
    }

  }

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
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
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
                <?php $page='leave'; include '../includes/admin-sidebar.php'; ?>
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
                                    <h4 class="page-title pull-left">Leave Section</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="leave-section.php">Manage Type</a></li>
                                        <li><span>Add</span></li>
                                        
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
                            <!-- Dark table start -->
                            <div class="col-12 mt-5">
                                <?php if($error){?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    
                                    </div><?php } 
                                        else if($msg){?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div><?php }?>
                                <div class="card">
                                    <form method="POST">
                                        <div class="card-body">
                                                
                                            <p class="text-muted font-14 mb-4">Please fill up the form in order to add new leave type</p>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Leave Type</label>
                                                <input class="form-control" name="leavetype" type="text" required id="example-text-input" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Short Description</label>
                                                <input class="form-control" name="description" type="text" autocomplete="off" required id="example-text-input" required>
                                                    
                                            </div>

                                            <button class="btn btn-primary" name="add" id="add" type="submit">ADD</button>
                                                
                                        </div>
                                     </form>
                                </div>
                            </div>
                            <!-- Dark table end -->
                            
                        </div>
                        <!-- row area end -->
                        
                        </div>
                        <!-- row area start-->
                    </div>
                    <?php include '../includes/footer.php' ?>
                    <!-- footer area end-->
                    </div>
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
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/adminlte.min.js"></script>
</body>

</html>

<?php } ?>