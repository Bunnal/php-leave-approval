<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    if(isset($_POST['signin']))
    {
        $uname=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0)
        {
            foreach ($results as $result) {
                $status=$result->Status;
                $_SESSION['eid']=$result->id;
        }
            if($status==0)
        {
            $msg="In-Active Account. Please contact your administrator!";
        } else  {
            $_SESSION['emplogin']=$_POST['username'];
            echo "<script type='text/javascript'> document.location = 'employees/leave.php'; </script>";
        }
            }   else  {
                echo "<script>alert('Sorry, Invalid Details.');</script>";
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
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- class="hold-transition sidebar-mini" put in body -->
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
                <?php $page='dashboard'; include '../includes/admin-sidebar.php'; ?>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="page-container pl-0">

                <!-- main content area start -->
                <div class="main-content">

                    <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Dashboard</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="dashboard.php">Home</a></li>
                                        <li><span>Admin's Dashboard</span></li>
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
                        <!-- sales report area start -->
                        <div class="sales-report-area mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-4">
                                <a href="leave-section.php">
                                    <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-briefcase"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Available Leave Types</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/leavetype-counter.php'?></h1>
                                                    <span>Leave Types</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales1" height="100"></canvas> -->
                                        </div>
                                </a>
                                </div>
                                <div class="col-md-4">
                                        <a href="employees.php">
                                            <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-users"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Registered Employees</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/emp-counter.php'?></h1>
                                                    <span>Active Employees</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales2" height="100"></canvas> -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                <a href="department.php">
                                    <div class="single-report">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-th-large"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Available Departments</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/dept-counter.php'?></h1>
                                                    <span>Employee Departments</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales3" height="100"></canvas> -->
                                        </div>
                                </a>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-4">
                                    <a href="pending-history.php">
                                        <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-spinner"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Pending Application</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/pendingapp-counter.php'?></h1>
                                                    <span>Pending</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales1" height="100"></canvas> -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="declined-history.php">
                                        <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-times"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Declined Application</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/declineapp-counter.php'?></h1>
                                                    <span>Declined</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales2" height="100"></canvas> -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                <a href="approved-history.php">
                                    <div class="single-report">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Approved Application</h4>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <h1 class ="text-dark"><?php include 'counters/approvedapp-counter.php'?></h1>
                                                    <span>Approved</span>
                                                </div>
                                            </div>
                                            <!-- <canvas id="coin_sales3" height="100"></canvas> -->
                                        </div>
                                </a>
                                </div>
                            </div>
                        </div>
                        <!-- sales report area end -->
                        
                        <!-- row area start -->
                        <div class="row">
                            
                            <!-- trading history area start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                            <!-- <h4 class="header-title">Employee Leave History</h4> -->
                                            <div class="trd-history-tabs">
                                                <ul class="nav" role="tablist">
                                                    <li>
                                                        <a class="active" data-toggle="tab" href="dashboard.php" role="tab">Recent List</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <select class="custome-select border-0 pr-3">
                                                <option selected>Last 24 Hours</option>
                                                
                                            </select>
                                        </div>
                                                <!-- <h4 class="header-title"></h4> -->
                                                <div class="single-table">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered table-striped progress-table text-center">
                                                        <thead class="text-uppercase">

                                                        <tr>
                                                                <td>S.N</td>
                                                                <td>Employee ID</td>
                                                                <td width="120">Full Name</td>
                                                                <td>Leave Type</td>
                                                                <td>Applied On</td>
                                                                <td>Current Status</td>
                                                                <td></td>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php 
                                                            
                                                            $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id order by lid desc limit 7";
                                                            $query = $dbh -> prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt=1;
                                                            if($query->rowCount() > 0){
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
                                                        <span style="color: green">Approved <i class="fa fa-check-square-o"></i></span>
                                                        <?php } if($stats==2)  { ?>
                                                        <span style="color: red">Declined <i class="fa fa-times"></i></span>
                                                        <?php } if($stats==0)  { ?>
                                                    <span style="color: blue">Pending <i class="fa fa-spinner"></i></span>
                                                    <?php } ?>


                                                    </td>

                                                    
                                                    <td><a href="employeeLeave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="btn btn-secondary btn-sm">View Details</a></td>
                                                    </tr>
                                                        <?php $cnt++;} }?>
                                                    </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                </div>
                            </div>
                            <!-- trading history area end -->
                        </div>
                        <!-- row area end -->
                        
                        </div>
                        <!-- row area start-->
                    </div>

                    <?php include '../includes/footer.php' ?>
                    <!-- footer area end-->
                </div>

            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="../assets/js/adminlte.min.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
