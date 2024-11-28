<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$Badge = "warning";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?php include('extension/title.php'); ?>" />
    <meta name="description" content="<?php include('extension/title.php'); ?> - VPN Panel System" />
    <meta name="author" content="<?php include('extension/title.php'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php include('extension/title.php'); ?> | Dashboard</title>

    <script src="js/jquery-3.3.1.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php include('extension/logo.php'); ?>" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<style>
    .sky {
        background-color: skyblue;
    }
    
.totals {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}

.total-box {
    display: flex;
    align-items: center;
    background-color: skyblue;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    position: relative;
}

.box-icon {
    width: 50px;
    height: 50px;
    margin-right: 15px;
}

.box-content {
    flex: 1;
}

.box-content p {
    margin: 0;
    font-size: 1.2em;
    color: #555;
}

.total-number {
    font-size: 2em;
    font-weight: bold;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
}

.month-text {
    font-size: 0.6em;
    color: #888;
    margin-left: 8px;
}
.toggle-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.5rem; /* Icon size */
}



.notification {
    position: relative;
    cursor: pointer;
}

.notification-icon {
    font-size: 1.5rem; /* Icon size */
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 5px;
    font-size: 0.7rem;
}

.notification-dropdown {
    position: absolute;
    top: 60px; /* Adjust based on your top-bar height */
    right: 10px; /* Align to the right */
    width: 300px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    display: none; /* Hidden by default */
    z-index: 1000;
}

.notification-dropdown .notification-search {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.notification-dropdown .notification-search input {
    flex-grow: 1;
    padding: 5px;
    border: none;
    outline: none;
}

.notification-dropdown .notification-search-icon {
    margin-left: 10px;
    font-size: 1rem;
}

.notification-dropdown .notification-list {
    max-height: 200px; /* Adjust for scroll */
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.notification-item img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.notification-content p {
    margin: 0;
    font-size: 0.9rem;
    font-weight: bold;
}

.notification-content small {
    color: #777;
}
/* General Dark Mode Styles */
/* General Dark Mode Styles */
.dark-mode {
    background-color: #121212; /* Dark background for the whole page */
    color: #ffffff; /* Light text color for general text */
}

/* Navbar in Dark Mode */
.dark-mode .navbar {
    background-color: #333333; /* Darker navbar background */
    color: #ffffff; /* Light text color for navbar items */
}

/* Navbar brand in Dark Mode */
.dark-mode .navbar-brand {
    color: #ffffff !important; /* Ensure navbar brand text is white */
}

/* Sidebar in Dark Mode */
.dark-mode .side-menu-fixed {
    background-color: #2c2c2c; /* Dark background for sidebar */
    color: #ffffff; /* Light text color for sidebar */
}

.dark-mode .side-menu-fixed a {
    color: #ffffff !important; /* Light text color for sidebar links */
}

/* Sidebar active item in Dark Mode */
.dark-mode .side-menu-fixed .nav > li.active > a,
.dark-mode .side-menu-fixed .nav > li > a:hover {
    background-color: #3c3c3c !important; /* Highlighted background for active or hovered items */
    color: #ffffff !important; /* Light text color for active or hovered items */
}

/* Content wrapper in Dark Mode */
.dark-mode .content-wrapper {
    background-color: #121212; /* Dark background for content area */
    color: #ffffff; /* Light text color for content area */
}

/* Card elements in Dark Mode */
.dark-mode .card {
    background-color: #2a2a2a; /* Darker background for cards */
    color: #ffffff; /* Light text color for cards */
    border: none; /* Optional: remove borders for a cleaner look */
}

/* Specific elements in Dark Mode */
.dark-mode .totals {
    background-color: #1e1e1e; /* Darker background for totals section */
}

.dark-mode .total-box {
    background-color: #333333; /* Darker background for total boxes */
    color: #ffffff; /* Light text color for total box content */
}

.dark-mode .total-number {
    color: #ffffff; /* Ensure total number text is white */
}

.dark-mode .month-text {
    color: #aaaaaa; /* Slightly lighter color for secondary text */
}

/* Additional styles for buttons, links, and other elements */
.dark-mode .btn {
    background-color: #444444; /* Dark background for buttons */
    color: #ffffff; /* Light text color for buttons */
}

.dark-mode a {
    color: #ffffff; /* Light text color for links */
}

/* Notification dropdown in Dark Mode */
.dark-mode .notification-dropdown {
    background-color: #333333; /* Darker background for notification dropdown */
    color: #ffffff; /* Light text color for notification content */
}

.dark-mode .notification-dropdown .notification-search {
    background-color: #444444; /* Darker background for search box */
    color: #ffffff; /* Light text color for search input */
}

/* Adjust other specific styles as needed */
#chartContainer {
    padding: 20px;
    background: linear-gradient(to bottom, #e0f7fa, #ffffff); /* Light gradient background */
    border-radius: 15px;
    height: 20%;
    width: 70%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

</style>

<body>

    <div class="wrapper">





        <!--=================================
 header start-->

        <?php include('extension/topnav.php'); ?>

        <!--=================================
 header End-->

        <!--=================================
 Main content -->

        <?php
    $query = mysqli_query($con,"select * from users where user_id='$userid'");
    $result = mysqli_fetch_array($query);
 
    // if($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'administrator'){
    //     $credits = '&#8734;';
    //     $cred_details = 'Unlimited Credits';
    // }else{
    //     $credits = $result['user_credits'];
    //     $cred_details = 'Available Credit(s)';
    // }
    
    // if($result['user_credits'] > 0){
    //     $icon = 'text-success';
    // }else{
    //     $icon = 'text-danger';
    // }
    
    // if($result['user_rank']=='superadmin'){
    //     $que3 = mysqli_query($con,"select * from users where user_rank='export'");
    // }else{
    //     $que3 = mysqli_query($con,"select * from users where user_rank='export' and user_upline='$userid'");
    // }
    // $exp = mysqli_num_rows($que3);
    
    // if($exp == 0){
    //     $desc_exp = 'You have no  export users!';
    // }else{
    //     $desc_exp = 'Total export user(s)';
    // }
    
    //  if($result['user_rank']=='superadmin'){
    //     $que5 = mysqli_query($con,"select * from users where user_rank='subadmin'");
    // }else{
    //     $que5 = mysqli_query($con,"select * from users where user_rank='subadmin' and user_upline='$userid'");
    // }
    // $suba = mysqli_num_rows($que5);
    
    // if($suba == 0){
    //     $desc_suba = 'You have no Subadmin!';
    // }else{
    //     $desc_suba = 'Total Subadmin(s)';
    // }
    
    
    // if($result['user_rank']=='superadmin'){
    //     $que2 = mysqli_query($con,"select * from users where user_rank='reseller'");
    // }else{
    //     $que2 = mysqli_query($con,"select * from users where user_rank='reseller' and user_upline='$userid'");
    // }
    // $rese = mysqli_num_rows($que2);
    
    // if($rese == 0){
    //     $desc_reseller = 'You have no resellers!';
    // }else{
    //     $desc_reseller = 'Total reseller(s)';
    // }
    
      if($result['user_rank']=='superadmin'){
        $que6 = mysqli_query($con,"select * from users where user_rank='normal'");
    }else{
        $que6 = mysqli_query($con,"select * from users where user_rank='normal' and user_upline='$userid'");
    }
    $users = mysqli_num_rows($que6);
    
    if($users == 0){
        $desc_users = 'You have no bhw!';
    }else{
        $desc_users = 'Total Sub bhw(s)';
    }
    
    
    if($result['user_rank']=='superadmin' || $result['user_rank']=='normal' ){
        $que = mysqli_query($con,"select * from users where user_rank='normal' or user_rank='export'");
    }
    $client = mysqli_num_rows($que);
    
    if($client == 0){
        $desc3 = 'You have no users!';
    }else{
        $desc3 = 'Total Patients(s)';
    }


    if($result['user_rank']=='superadmin'|| $result['user_rank'] == 'normal'){
      $que11 = mysqli_query($con,"select * from patient  ");
  }
  $patients = mysqli_num_rows($que11);
  
  if($patients == 0){
      $desc2= 'You have no users!';
  }else{
      $desc2 = 'Total Patients(s)';
  }
  
    

  $uname = $t['user_name']; // Get the current logged-in user's username

  if ($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'normal') {
      // Query to count the number of patients where appointmentstatus is '0' and uname matches the logged-in user's username
      $que1 = mysqli_query($con, "SELECT * FROM patient WHERE appointmentstatus='0' AND uname='$uname'");
      $patient = mysqli_num_rows($que1);
  }


  
  if ($patient == 0) {
      $desc1 = 'You have no users!';
  } else {
      $desc1 = 'Total Patient(s): ' . $patient;
  }


  if ($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'normal') {
    // Query to count the number of patients where appointmentstatus is '0' and uname matches the logged-in user's username
    $que11 = mysqli_query($con, "SELECT * FROM patient WHERE tb_type='eptb'");
    $tbpatient = mysqli_num_rows($que11);
}

if ($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'normal') {
    // Query to count the number of patients where appointmentstatus is '0' and uname matches the logged-in user's username
    $que111 = mysqli_query($con, "SELECT * FROM patient WHERE tb_type='ptb'");
    $ptbpatient = mysqli_num_rows($que111);
}

 
    // if($result['user_rank']=='superadmin'){
    //     $que4 = mysqli_query($con,"select * from users where is_active='1' and user_duration>'0'");
    // }else{
    //     $que4 = mysqli_query($con,"select * from users where is_active='1' and user_duration>'0' and user_upline='$userid'");
    // }
    // $onl = mysqli_num_rows($que4);
    
    // if($onl == 0){
    //     $desc_online = 'You have no users online!';
    // }else{
    //     $desc_online = 'Total user(s) online';
    // }
    
    // if($result['user_rank']=='superadmin'){
    //     $que11 = mysqli_query($con,"select * from users where user_rank='administrator'");
    // }else{
    //     $que11 = mysqli_query($con,"select * from users where user_rank='administrator' and user_upline='$userid'");
    // }
    // $administrator_ = mysqli_num_rows($que11);
    
    // if($administrator_ == 0){
    //     $desc11 = 'You have no administrators!';
    // }else{
    //     $desc11 = 'Total administrator(s)';
    // // }
    
    // if($result['user_rank']=='superadmin'){
    //     $que12 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='1' and user_duration>'0' and is_freeze='0'");
    // }else{
    //     $que12 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='1' and user_duration>'0' and is_freeze='0' and user_upline='$userid'");
    // }
    // $aclient = mysqli_num_rows($que12);
    
    // if($aclient == 0){
    //     $desc12 = 'You have no active users!';
    // }else{
    //     $desc12 = 'Total active user(s)';
    // }
    
    // if($result['user_rank']=='superadmin'){
    //     $que13 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='0' and user_duration>'0' and is_freeze='0'");
    // }else{
    //     $que13 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='0' and user_duration>'0' and is_freeze='0' and user_upline='$userid'");
    // }
    // $iclient = mysqli_num_rows($que13);
    
    // if($iclient == 0){
    //     $desc13 = 'You have no inactive users!';
    // }else{
    //     $desc13 = 'Total inactive user(s)';
    // }
    
    // if($result['user_rank']=='superadmin'){
    //     $que14 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and user_duration<1 and is_freeze='0'");
    // }else{
    //     $que14 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and user_duration<1 and is_freeze='0' and user_upline='$userid'");
    // }
    // $iexpired = mysqli_num_rows($que14);
    
    // if($iexpired == 0){
    //     $desc14 = 'You have no expired users!';
    // }else{
    //     $desc14 = 'Total expired user(s)';
    // }
    
    //  $dur = calc_time($bio); 
    //  $pdays = $dur['days'] . " days";
    //  $phours = $dur['hours'] . " hours";
    // $pminutes = $dur['minutes'] . " minutes";
    // $pseconds = $dur['seconds'] . " seconds";
                               		
    // $user_dur1 = strtotime($pdays . $phours . $pminutes . $pseconds);
    // $iac = date('F d, Y ', $user_dur1);
    // $kwery = mysqli_query($con,"select bio from users where user_id='$userid'");
    //             $rows_kwery = mysqli_fetch_array($kwery);      
    //             $dura = $rows_kwery['bio'];
       
    
    // if(  $bio >= '1'){
    //            $dura = $iac;
    // }elseif( $bio == '0'){
    //        $dura = '<label class="badge badge-danger">IN-ACTIVE</label>';
    // } 

 
  
?>

        <div class="container-fluid  ">
            <div class="row">

                <?php include('extension/sidenav.php'); ?>

                <!-- main content wrapper start-->


                <div class="content-wrapper sky">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php 
                $kwery = mysqli_query($con,"select maintenance from admin");
                $rows_kwery = mysqli_fetch_array($kwery);      
                $maintenance_mode = $rows_kwery['maintenance'];
                if($maintenance_mode == 1){ ?>
                                <h4 class="mb-0">ðŸ”§ UNDER MAINTENANCE ðŸ”§ </h4>
                                <?php }else{ ?>

                                <?php } ?>
                            </div>

                        </div>
                    </div>


                    <!-- widgets -->
















                    <div>


                        <?php if($user_rank == 'normal'){ ?>

                        <!-- <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100"
                                style="background-color: <?php include('extension/theme.php'); ?>;">
                                <div class="card-body">
                                    <a href="patient">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span class="text-danger">
                                                    <i class="fa fa-users highlight-icon" aria-hidden="true"
                                                        style="color: <?php include('extension/theme_text.php'); ?>;"></i>
                                                </span>
                                            </div>
                                            <div class="float-right text-right">
                                                <p class="card-text"
                                                    style="color: <?php include('extension/theme_text.php'); ?>;"><label
                                                        class="badge badge-<?php echo $Badge; ?>">YOUR PATIENTS</label>
                                                </p>
                                                <h4 style="color: <?php include('extension/theme_text.php'); ?>;">
                                                    <?php echo $patient; ?></h4>
                                            </div>
                                        </div>
                                        <p class="pt-3 mb-0 mt-2 border-top"
                                            style="color: <?php include('extension/theme_text.php'); ?>;">
                                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                            <?php echo $desc1; ?>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-12 col-md-6 " style="background-color: #40a3ed;">
                            <div class="login-fancy" align="center">

                                <br><br><br>
                                <img src="https://img.sikatpinoy.net/images/2024/07/26/image2ef05744bf65557a.png"
                                    height="200px" width="300px">
                                <div>
                                    <img src="https://img.sikatpinoy.net/images/2024/07/26/imageefccf6d4db09c2b9.png"
                                        height="50px" width="150px"
                                        style="filter: drop-shadow(0 0 0 black) drop-shadow(1px 1px 0 black) drop-shadow(-1px -1px 0 black) drop-shadow(1px -1px 0 black) drop-shadow(-1px 1px 0 black);">
                                </div>

                            </div>
                        </div>
                        <?php } ?>

                        <?php if($user_rank == 'superadmin'){ ?>
                        <!-- <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100"
                                style="background-color: <?php include('extension/theme.php'); ?>;">
                                <div class="card-body">
                                    <a href="patient">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span class="text-danger">
                                                    <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                                        alt="Dashboard Image" height="50" width="50">
                                                </span>
                                            </div>
                                            <div class="float-right text-right">
                                                <p class="card-text"
                                                    style="color: <?php include('extension/theme_text.php'); ?>;"><label
                                                        class="badge badge-<?php echo $Badge; ?>">TOTAL PATIENTS</label>
                                                </p>
                                                <h4 style="color: <?php include('extension/theme_text.php'); ?>;">
                                                    <?php echo $patients; ?></h4>
                                            </div>
                                        </div>

                                    </a>

                                </div>
                            </div>
                        </div> -->
                        <?php } ?>


                        <?php if($user_rank == 'superadmin'){ ?>
                        <!-- <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100"
                                style="background-color: <?php include('extension/theme.php'); ?>;">
                                <div class="card-body">
                                    <a href="bhw">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span class="text-danger">
                                                    <img src="https://img.sikatpinoy.net/images/2024/08/03/image.png"
                                                        alt="Dashboard Image" height="50" width="50">
                                                </span>
                                            </div>
                                            <div class="float-right text-right">
                                                <p class="card-text"
                                                    style="color: <?php include('extension/theme_text.php'); ?>;"><label
                                                        class="badge badge-<?php echo $Badge; ?>">TOTAL BHW</label></p>
                                                <h4 style="color: <?php include('extension/theme_text.php'); ?>;">
                                                    <?php echo $client; ?></h4>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100"
                                style="background-color: <?php include('extension/theme.php'); ?>;">
                                <div class="card-body">
                                    <a href="bhw">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span class="text-danger">
                                                    <img src="https://img.sikatpinoy.net/images/2024/08/03/image2b8a96c656590a23.png"
                                                        alt="Dashboard Image" height="50" width="50">
                                                </span>
                                            </div>
                                            <div class="float-right text-right">
                                                <p class="card-text"
                                                    style="color: <?php include('extension/theme_text.php'); ?>;"><label
                                                        class="badge badge-<?php echo $Badge; ?>">TOTAL RHU</label></p>
                                                <h4 style="color: <?php include('extension/theme_text.php'); ?>;">
                                                    1</h4>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </div>
                        </div>







 -->



                        <div class="totals">
                            <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $patients; ?>
                                        <span class="month-text"> TOTAL PATIENTS </span>
                                    </h3>
                                </div>
                            </div>
                            <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image.png" alt="Icon"
                                    class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $client; ?>
                                        <span class="month-text"> TOTAL BHW </span>
                                    </h3>
                                </div>
                            </div>
                            <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image2b8a96c656590a23.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        1
                                        <span class="month-text"> RHU</span>
                                    </h3>
                                </div>
                            </div>

                            <!-- <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $tbpatient; ?>
                                        <span class="month-text" style="color:#1136ad"> TOTAL EPTB PATIENTS </span>
                                    </h3>
                                </div>
                            </div> -->

                            <!-- <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $ptbpatient; ?>
                                        <span class="month-text" style="color:#1136ad"> TOTAL PTB PATIENTS </span>
                                    </h3>
                                </div>
                            </div> -->
                        </div>
                        <br>

                        <div id="chartContainer">
    <canvas id="patientChart"></canvas>
</div>

                        <canvas id="patientCharts" width="400" height="100"></canvas>
                        <canvas id="patientCharts1" width="400" height="100"></canvas>
                        <?php } ?>


                    </div>

                    <!--=================================
 wrapper -->

                    <!-- main content wrapper end-->

                    <?php include('extension/footer.php'); ?>

                </div>

            </div>
        </div>
    </div>

    <!--=================================
 footer -->



    <!--=================================
 jquery -->

    <!-- jquery -->
    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/assets/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
    var plugin_path = '/assets/js/';
    </script>

    <!-- chart -->
    <script src="/assets/js/chart-init.js"></script>

    <!-- calendar -->
    <script src="/assets/js/calendar.init.js"></script>

    <!-- charts sparkline -->
    <script src="/assets/js/sparkline.init.js"></script>

    <!-- charts morris -->
    <script src="/assets/js/morris.init.js"></script>

    <!-- sweetalert2 -->
    <script src="/assets/js/sweetalert2.js"></script>

    <!-- toastr -->
    <script src="/assets/js/toastr.js"></script>

    <!-- validation -->
    <script src="/assets/js/validation.js"></script>

    <!-- lobilist -->
    <script src="/assets/js/lobilist.js"></script>

    <!-- custom -->
    <script src="/assets/js/custom.js"></script>


    <script>
   fetch('api/patient_data.php') // Or use your PHP file directly
    .then(response => response.json())
    .then(data => {
        const months = data.map(item => {
            const [year, month] = item.month.split('-');
            const date = new Date(year, month - 1); // month is 0-indexed
            return date.toLocaleString('default', { month: 'short' }) + ' ' + year;
        });

        const tbCounts = data.map(item => item.tb_count);
        const ptbCounts = data.map(item => item.ptb_count);

        const ctx = document.getElementById('patientChart').getContext('2d');
        
        // Create gradient for EPTB Patients
        const gradientTB = ctx.createLinearGradient(0, 0, 0, 400);
        gradientTB.addColorStop(0, 'rgba(17, 54, 173, 1)'); // blue color
        gradientTB.addColorStop(1, 'rgba(17, 54, 173, 0)'); // transparent

        // Create gradient for PTB Patients
        const gradientPTB = ctx.createLinearGradient(0, 0, 0, 400);
        gradientPTB.addColorStop(0, 'rgba(255, 165, 0, 1)'); // orange color
        gradientPTB.addColorStop(1, 'rgba(255, 165, 0, 0)'); // transparent

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                        label: 'EPTB Patients',
                        data: tbCounts,
                        backgroundColor: gradientTB,
                        borderRadius: 10, // Rounded bars
                        barPercentage: 0.8, // Width of bars
                    },
                    {
                        label: 'PTB Patients',
                        data: ptbCounts,
                        backgroundColor: gradientPTB,
                        borderRadius: 10, // Rounded bars
                        barPercentage: 0.8, // Width of bars
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#333' // Adjust legend color
                        }
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#333' // Adjust tick color
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e5e5', // Light grid lines
                            borderDash: [5, 5], // Dashed grid lines
                        },
                        ticks: {
                            color: '#333' // Adjust tick color
                        }
                    }
                }
            }
        });
    });

    </script>

    <script>
    fetch('api/pc.php') // Adjust the path as needed
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const treatmentCounts = data.map(item => item.treatment_count);
            const patientCounts = data.map(item => item.patient_count);

            const ctx = document.getElementById('patientCharts').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                            label: 'Treatment Count',
                            data: treatmentCounts,
                            backgroundColor: 'blue',
                            borderColor: 'green',
                            borderWidth: 1
                        },
                        {
                            label: 'Patient Count',
                            data: patientCounts,
                            backgroundColor: 'green',
                            borderColor: 'blue',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>


    <script>
    fetch('api/brgy.php') // Adjust the path as needed
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const patientCounts = data.map(item => item.patient_count);

            const ctx = document.getElementById('patientCharts1').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                        label: 'Patient Count by Address',
                        data: patientCounts,
                        backgroundColor: 'blue',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>

<script src="/js/dashboard.js"></script>

</body>

</html>
