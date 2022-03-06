<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['emplogin'])==0){   
    header('location:../index.php');
    } else {
    
    if(isset($_POST['change']))
        {
            $password=md5($_POST['password']);
            $newpassword=md5($_POST['newpassword']);
            $username=$_SESSION['emplogin'];
                $sql ="SELECT Password FROM tblemployees WHERE EmailId=:username and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':username', $username, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query -> rowCount() > 0){

            $con="UPDATE tblemployees set Password=:newpassword where EmailId=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
           
            $msg="Your Password Has Been Updated.";
            } else {
                $error="Sorry your current password is wrong!";    
            }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Employee Leave Management System</title>
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

     <!-- Custom form script -->
     <script type="text/javascript">
        function valid(){
            if($("#newpassword").val() != $("#confpassword").val()) {
            alert("New Password and Confirm Password Field do not match  !!");
            $("#confpassword").focus();
            return false;
                } return true;
        }
    </script>

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
            <img src="../assets/images/icon/eleave-logo2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light" style="margin-left: -20px;">Eleave</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column metismenu" id="menu">

                        <li class="#">
                            <a href="leave.php" aria-expanded="true"><i class="ti-user"></i><span>Apply Leave
                                </span></a>
                        </li>

                        <li class="#">
                            <a href="leave-history.php" aria-expanded="true"><i class="ti-agenda"></i><span>View My Leave History
                                </span></a>
                        </li>

                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Main Sidebar Container end-->

        <div class="content-wrapper">
            <!-- page container area start -->
            <div class="page-container pl-0">
                <!-- main content area start -->
                <div class="main-content">
                    <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Change Current Password</h4>
                                    <ul class="breadcrumbs pull-left">
                                        
                                        <li><span>Password Fields</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 clearfix">
                                    
                                    <?php include '../includes/employee-profile-section.php'?>

                            </div>
                        </div>
                    </div>
                    <!-- page title area end -->
                    <div class="main-content-inner">
                        <div class="row">
                            <div class="col-12 mt-5">
                                    <?php if($error){?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    
                                    </div><?php } 
                                        else if($msg){?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?> 
                                        <button type="button"  class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div><?php }?>
                                        <div class="card">
                                        <form name="chngpwd" method="POST" autocomplete="off">

                                            <div class="card-body">
                                                <h4 class="header-title">Change Password</h4>
                                                <p class="text-muted font-14 mb-4">Please fill up the form to change your current password.</p>

                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">Existing Password</label>
                                                    <input class="form-control" id="password" type="password" autocomplete="new-password" name="password"  required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">New Password</label>
                                                    <input class="form-control" type="password" name="newpassword" id="newpassword" autocomplete="off" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">Confirm Password</label>
                                                    <input class="form-control" type="password" name="confirmpassword" id="confpassword" autocomplete="off" required>
                                                </div>


                                                <button class="btn btn-primary" name="change" type="submit" onclick="return valid();">CHANGE PASSWORD</button>
                                                
                                            </div>
                                        </form>
                                        </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                <!-- main content area end -->
                <!-- footer area start-->
                <?php include '../includes/footer.php' ?>
                <!-- footer area end-->
            </div>
            <!-- page container area end -->
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

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/adminlte.min.js"></script>
</body>

</html>

<?php } ?> 