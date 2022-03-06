<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['emplogin'])==0){   
        header('location:../index.php');
    } else {
    $eid=$_SESSION['emplogin'];
    if(isset($_POST['update'])){

    $fname=$_POST['firstName'];
    $lname=$_POST['lastName'];   
    $gender=$_POST['gender']; 
    $dob=$_POST['dob']; 
    $department=$_POST['department']; 
    $address=$_POST['address']; 
    $city=$_POST['city']; 
    $country=$_POST['country']; 
    $mobileno=$_POST['mobileno']; 
    $sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmailId=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':lname',$lname,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':department',$department,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':country',$country,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
    $msg="Your record has been updated Successfully";
    } ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Employee Leave Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="http://localhost/EmployeeLeaveSystem-PHP/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
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
                                    <h4 class="page-title pull-left">My Profile</h4>  
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
                            <!-- Textual inputs start -->
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
                                    <form name="addemp" method="POST">

                                        <div class="card-body">
                                            <h4 class="header-title">Update My Profile</h4>
                                            <p class="text-muted font-14 mb-4">Please make changes on the form below in order to update your profile</p>

                                            <?php 
                                                $eid=$_SESSION['emplogin'];
                                                $sql = "SELECT * from  tblemployees where EmailId=:eid";
                                                $query = $dbh -> prepare($sql);
                                                $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt=1;
                                                if($query->rowCount() > 0){
                                                    foreach($results as $result)
                                                { 
                                            ?> 
                                        

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">First Name</label>
                                                <input class="form-control" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" required id="example-text-input">
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Last Name</label>
                                                <input class="form-control" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" required id="example-text-input">
                                            </div>

                                            <div class="form-group">
                                                <label for="example-email-input" class="col-form-label">Email</label>
                                                <input class="form-control" name="email" type="email"  value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required id="example-email-input">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Gender</label>
                                                <select class="custom-select" name="gender" autocomplete="off">
                                                    <option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">D.O.B</label>
                                                <input class="form-control" type="date" name="dob" id="birthdate" value="<?php echo htmlentities($result->Dob);?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Contact Number</label>
                                                <input class="form-control" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Employee ID</label>
                                                <input class="form-control" name="empcode" type="text" autocomplete="off" readonly required value="<?php echo htmlentities($result->EmpId);?>" id="example-text-input">
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Country</label>
                                                <input class="form-control" name="country" type="text"  value="<?php echo htmlentities($result->Country);?>" autocomplete="off" required id="example-text-input">
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Address</label>
                                                <input class="form-control" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">City</label>
                                                <input class="form-control" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Selected Department</label>
                                                <select class="custom-select" name="department" autocomplete="off">
                                                <option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>

                                                <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0){
                                                    foreach($results as $resultt)
                                                    {   
                                                ?>  
                                                    <option value="<?php echo htmlentities($resultt->DepartmentName);?>"><?php echo htmlentities($resultt->DepartmentName);?></option>
                                            <?php }} ?>
                                            </select>
                                            </div>

                                            <?php }
                                            }?>

                                            <button class="btn btn-primary" name="update" id="update" type="submit">MAKE CHANGES</button>
                                            
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

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/adminlte.min.js"></script>
</body>

</html>

<?php } ?> 