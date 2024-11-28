<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$Badge = "warning";
//<span class="badge badge-primary">Primary</span>
//<span class="badge badge-secondary">Secondary</span>
//<span class="badge badge-success">Success</span>
//<span class="badge badge-danger">Danger</span>
//<span class="badge badge-warning">Warning</span>
///<span class="badge badge-info">Info</span>
//<span class="badge badge-light">Light</span>
//<span class="badge badge-dark">Dark</span>
// function calc_time($duration_string) {
//     $pattern = '/(\d+)\s+day(s)?\s+(\d+)\s+hour(s)?\s+(\d+)\s+minute(s)?\s+(\d+)\s+second(s)?/';
//     $matches = array();
//     preg_match($pattern, $duration_string, $matches);
    
//     $days = isset($matches[1]) ? (int)$matches[1] : 0;
//     $hours = isset($matches[3]) ? (int)$matches[3] : 0;
//     $minutes = isset($matches[5]) ? (int)$matches[5] : 0;
//     $seconds = isset($matches[7]) ? (int)$matches[7] : 0;
    
//     $time = array(
//         'days' => $days,
//         'hours' => $hours,
//         'minutes' => $minutes,
//         'seconds' => $seconds
//     );
    
//     return $time;
// }
 
?>

<?php
// Retrieve the user rank and username
$rank_check = mysqli_query($con, "SELECT user_rank FROM users WHERE user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

// Fetch the username
$y = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$userid'");
$t = mysqli_fetch_array($y);
$uname = $t['user_name']; // Logged-in user's username

// Query to get the total counts for EPTB and PTB for the logged-in user
$query = "
    SELECT 
        SUM(CASE WHEN tb_type = 'eptb' THEN 1 ELSE 0 END) as tb_count,
        SUM(CASE WHEN tb_type = 'ptb' THEN 1 ELSE 0 END) as ptb_count
    FROM patient
    WHERE uname = '$uname'
";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

// Calculate total patients
$total_patients = $data['tb_count'] + $data['ptb_count'];

// Calculate percentages
$ptb_percentage = ($total_patients > 0) ? ($data['ptb_count'] / $total_patients) * 100 : 0;
$eptb_percentage = ($total_patients > 0) ? ($data['tb_count'] / $total_patients) * 100 : 0;

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
    <!-- <meta name="viewport" content="width=1024, initial-scale=1, maximum-scale=1, user-scalable=no" /> -->
    <!-- <meta name="viewport" content="width=1280, initial-scale=1, maximum-scale=1, user-scalable=no"> -->


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

#patientChart,
#patientCharts,
#patientCharts1 {
    background-color: #ffffff;
    /* White background */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    /* Soft shadow */
    border-radius: 20px;
    /* Rounded corners for the canvas */
    padding: 20px;
    /* Padding inside the canvas */
}

#incidenceChart {
    width: 300px;
    /* Adjust the width as needed */
    height: 300px;
    /* Adjust the height as needed */
    margin: 0 auto;
    /* Center the chart horizontally */
}

/* Wrapper for all charts */
.chart-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px;
}

/* Top chart taking full width */
.top-chart {
    width: 100%;
    max-width: 1200px;
    /* Adjust based on your preference */
}

/* Bottom two charts arranged side by side */
.bottom-charts {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
    /* Adjust based on your preference */
}

/* General chart container to control size */
.chart-container {
    width: 100%;
    /* Responsive width */
    max-width: 600px;
    /* Limit maximum width */
    height: 400px;
    /* Set height */
    margin: 0 auto;
    /* Center the chart container */
    padding-top: 10px;
    /* Optional: Add padding for spacing */
}


.chart-containers {
    width: 100%;
    max-width: 1200px;
    /* Adjust for the bar and pie chart */
    height: 400px;
    /* Adjust height for both charts */
    margin: 0 0;
}

/* Ensure the canvas takes full space of the chart-container */
canvas {
    display: block;
    width: 100%;
    height: 100%;
}

@media (max-width: 768px) {
    .box-content p {
        font-size: 1em;
        /* Reduce font size for mobile */
    }

    .total-number {
        font-size: 1.5em;
        /* Reduce number size */
    }

    .month-text {
        font-size: 0.5em;
        /* Further reduce the month text */
    }

    .chart-wrapper {
        padding: 10px;
        /* Reduce padding on mobile */
    }

    .bottom-charts {
        flex-direction: column;
        /* Stack charts vertically */
        gap: 10px;
        /* Reduce the gap */
    }

    .chart-container {
        width: 100%;
        /* Let charts take full width */
        height: auto;
        /* Adjust the height automatically */
        margin: 0 auto;
        /* Center the charts */
    }

    #patientChart,
    #patientCharts,
    #patientCharts1 {
        width: 100%;
        /* Full width on mobile */
        height: 250px;
        /* Set a lower height for mobile */
    }

    .chart-container {
        overflow-x: scroll;
        /* Allow horizontal scrolling if needed */
    }
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
    
    
    if ($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'normal') {
        // Query for users where is_active is 0 or 1, regardless of user_rank
        $que = mysqli_query($con, "SELECT * FROM users WHERE is_active = 0 OR is_active = 1");
    }
    
    $client = mysqli_num_rows($que);
    
    if ($client == 0) {
        $desc3 = 'You have no users!';
    } else {
        $desc3 = 'Total Patient(s)';
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

        <div class="container-fluid" style="background-color:skyblue;">
            <div class="row">

                <?php include('extension/sidenav.php'); ?>

                <!-- main content wrapper start-->


                <div class="content-wrapper" style="background-color:skyblue;">
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

                        <div class="chart-container" style="width: 280px; height: 280px; margin: auto;">
                            <canvas id="incidenceChartbhw"></canvas>
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

                            <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $tbpatient; ?>
                                        <span class="month-text"> EXTRA PULMONARY TUBERCULOSIS PATIENTS </span>
                                    </h3>
                                </div>
                            </div>

                            <div class="total-box">
                                <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                    alt="Icon" class="box-icon">
                                <div class="box-content">

                                    <h3 class="total-number">
                                        <?php echo $ptbpatient; ?>
                                        <span class="month-text"> PULMONARY TUBERCULOSIS PATIENTS</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div>
                            <canvas id="patientCharts" height="350%"></canvas><br>
                        </div>
                        <!-- Bottom two side-by-side charts -->
                        <div class="bottom-charts">
                            <!-- Left chart (Bar chart for patient count by address) -->
                            <div class="chart-container">
                                <br> <canvas id="patientCharts1"></canvas>
                            </div>

                            <!-- Right chart (Pie chart for PTB and EPTB incidence) -->
                            <div class="chart-container" style="width: 280px; height: 280px; margin: auto;">
                                <canvas id="incidenceChart"></canvas>
                            </div>
                        </div>
                    </div>



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
    <!-- Monthly Patient Data Bar Chart -->
    <!-- <script>
    fetch('api/patient_data.php')
        .then(response => response.json())
        .then(data => {
            const months = data.map(item => {
                const [year, month] = item.month.split('-');
                const date = new Date(year, month - 1);
                return date.toLocaleString('default', { month: 'short' }) + ' ' + year;
            });
            const tbCounts = data.map(item => item.tb_count);
            const ptbCounts = data.map(item => item.ptb_count);

            const ctx = document.getElementById('patientChart').getContext('2d');

            // Gradient for EPTB Patients
            const gradientEPTB = ctx.createLinearGradient(0, 0, 0, 400);
            gradientEPTB.addColorStop(0, 'rgba(50, 115, 220, 1)');
            gradientEPTB.addColorStop(1, 'rgba(50, 115, 220, 0.3)');

            // Gradient for PTB Patients
            const gradientPTB = ctx.createLinearGradient(0, 0, 0, 400);
            gradientPTB.addColorStop(0, 'rgba(255, 165, 0, 1)');
            gradientPTB.addColorStop(1, 'rgba(255, 165, 0, 0.3)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                            label: 'EPTB Patients',
                            data: tbCounts,
                            backgroundColor: gradientEPTB,
                            borderColor: 'rgba(50, 115, 220, 1)',
                            borderRadius: 8,
                            borderWidth: 1
                        },
                        {
                            label: 'PTB Patients',
                            data: ptbCounts,
                            backgroundColor: gradientPTB,
                            borderColor: 'rgba(255, 165, 0, 1)',
                            borderRadius: 8,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e0e0e0' }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: '#333' }
                        }
                    },
                    layout: { padding: 20 },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                }
            });
        });
</script> -->


    <!-- Include the canvas for the pie chart -->
    <!-- Include the Chart.js library and the ChartDataLabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>



    <script>
    fetch('api/patient_data.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('incidenceChart').getContext('2d');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['PTB', 'EPTB'],
                    datasets: [{
                        data: [data.ptb_percentage, data
                            .eptb_percentage
                        ], // PTB and EPTB percentages
                        backgroundColor: ['#FF4500', '#00BFFF'], // Red for PTB and Blue for EPTB
                        borderColor: ['#FF4500', '#00BFFF'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                color: '#333'
                            }
                        },
                        datalabels: {
                            color: '#fff', // Set the text color
                            font: {
                                weight: 'bold',
                                size: 16
                            },
                            formatter: (value, ctx) => {
                                // Return the percentage value inside the pie chart
                                return value + '%';
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const percentage = tooltipItem.raw;
                                    return percentage + '%';
                                }
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Enable the ChartDataLabels plugin
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    </script>



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('incidenceChartbhw').getContext('2d');

        // PHP-generated data embedded in JavaScript
        const ptb_percentage = <?php echo json_encode(round($ptb_percentage, 1)); ?>;
        const eptb_percentage = <?php echo json_encode(round($eptb_percentage, 1)); ?>;

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['PTB', 'EPTB'],
                datasets: [{
                    data: [ptb_percentage, eptb_percentage], // PTB and EPTB percentages
                    backgroundColor: ['#FF4500', '#00BFFF'], // Red for PTB and Blue for EPTB
                    borderColor: ['#FF4500', '#00BFFF'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#333'
                        }
                    },
                    datalabels: {
                        color: '#fff', // Set the text color
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value, ctx) => {
                            return value + '%'; // Return the percentage value inside the pie chart
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const percentage = tooltipItem.raw;
                                return percentage + '%';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Enable the ChartDataLabels plugin
        });
    });
    </script>

    <!-- Treatment and Patient Count by Address -->
    <script>
    fetch('api/pc.php')
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const treatmentCounts = data.map(item => item.treatment_count);
            const patientCounts = data.map(item => item.patient_count);

            const ctx = document.getElementById('patientCharts').getContext('2d');

            // Gradient for Treatment Count
            const treatmentGradient = ctx.createLinearGradient(0, 0, 0, 400);
            treatmentGradient.addColorStop(0, '#020bf5');
            treatmentGradient.addColorStop(1, 'rgba(54, 162, 235, 0.3)');

            // Gradient for Patient Count
            const patientGradient = ctx.createLinearGradient(0, 0, 0, 400);
            patientGradient.addColorStop(0, '#16db0f');
            patientGradient.addColorStop(1, 'rgba(75, 192, 192, 0.3)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                            label: 'Treatment Count',
                            data: treatmentCounts,
                            backgroundColor: treatmentGradient,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderRadius: 8,
                            borderWidth: 1
                        },
                        {
                            label: 'Patient Count',
                            data: patientCounts,
                            backgroundColor: patientGradient,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderRadius: 8,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e0e0e0'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#333'
                            }
                        }
                    },
                    layout: {
                        padding: 20
                    },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>

    <!-- Patient Count by Address
<script>
    fetch('api/brgy.php')
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const patientCounts = data.map(item => item.patient_count);

            const ctx = document.getElementById('patientCharts1').getContext('2d');

            // Gradient for Patient Count by Address
            const patientGradient = ctx.createLinearGradient(0, 0, 0, 400);
            patientGradient.addColorStop(0, 'rgba(255, 99, 132, 1)');
            patientGradient.addColorStop(1, 'rgba(255, 99, 132, 0.3)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                        label: 'Patient Count by Address',
                        data: patientCounts,
                        backgroundColor: patientGradient,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderRadius: 8,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e0e0e0' }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: '#333' }
                        }
                    },
                    layout: { padding: 20 },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script> -->


    <!-- Include Chart.js and the ChartDataLabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <!-- Patient Count by Address -->
    <!-- <script>
    fetch('api/brgy.php')
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const patientCounts = data.map(item => Number(item.patient_count)); // Ensure patient_count is numeric

            // Calculate the total count of patients
            const totalPatients = patientCounts.reduce((acc, count) => acc + count, 0);

            console.log("Total Patients:", totalPatients); // Debugging: Check total patients value

            const ctx = document.getElementById('patientCharts1').getContext('2d');

            // Gradient for Patient Count by Address
            const patientGradient = ctx.createLinearGradient(0, 0, 0, 400);
            patientGradient.addColorStop(0, 'rgba(255, 99, 132, 1)');
            patientGradient.addColorStop(1, 'rgba(255, 99, 132, 0.3)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                        label: 'Patient Count by Address',
                        data: patientCounts,
                        backgroundColor: patientGradient,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderRadius: 8,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e0e0e0' }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: '#333' }
                        },
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            formatter: (value, context) => {
                                // Calculate percentage
                                if (totalPatients > 0) {
                                    const percentage = ((value / totalPatients) * 100).toFixed(1);
                                    return percentage + '%';
                                } else {
                                    return '0%'; // Handle case where totalPatients is 0
                                }
                            },
                            color: '#FF6384',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    layout: { padding: 20 },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ensure we use the DataLabels plugin
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
 -->
 



 <script>
    fetch('api/brgy.php')
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const patientCounts = data.map(item => Number(item.patient_count)); // Ensure patient_count is numeric

            // Calculate the total count of patients
            const totalPatients = patientCounts.reduce((acc, count) => acc + count, 0);

            const ctx = document.getElementById('patientCharts1').getContext('2d');

            // Define gradient colors similar to your second image
            const gradientColors = [
                ['rgba(255, 99, 132, 1)', 'rgba(255, 99, 132, 0.3)'], // Red
                ['rgba(255, 165, 0, 1)', 'rgba(255, 165, 0, 0.3)'],   // Orange
                ['rgba(255, 206, 86, 1)', 'rgba(255, 206, 86, 0.3)'], // Yellow
                ['rgba(75, 192, 192, 1)', 'rgba(75, 192, 192, 0.3)'], // Green
                ['rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.3)'], // Blue
                ['rgba(153, 102, 255, 1)', 'rgba(153, 102, 255, 0.3)'] // Purple
            ];

            // Create individual gradients for each bar
            const gradientFills = addresses.map((_, index) => {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                const color = gradientColors[index % gradientColors.length]; // Cycle through gradientColors
                gradient.addColorStop(0, color[0]);
                gradient.addColorStop(1, color[1]);
                return gradient;
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                        label: 'BARANGAY CASE RATE PERCENTAGE', 
                        data: patientCounts,
                        backgroundColor: gradientFills, // Use gradient fills
                        borderColor: gradientFills.map(gradient => gradient[0]), // Use solid color for the border
                        borderRadius: 8,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e0e0e0' }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: { color: '#333' }
                        },
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            formatter: (value, context) => {
                                // Calculate percentage
                                if (totalPatients > 0) {
                                    const percentage = ((value / totalPatients) * 100).toFixed(1);
                                    return percentage + '%';
                                } else {
                                    return '0%'; // Handle case where totalPatients is 0
                                }
                            },
                            color: '#FF6384',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    layout: { padding: 20 },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ensure we use the DataLabels plugin
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

<!-- <script>
    fetch('api/brgy.php')
        .then(response => response.json())
        .then(data => {
            const addresses = data.map(item => item.address);
            const patientCounts = data.map(item => Number(item.patient_count)); // Ensure patient_count is numeric

            // Calculate the total count of patients
            const totalPatients = patientCounts.reduce((acc, count) => acc + count, 0);

            const ctx = document.getElementById('patientCharts1').getContext('2d');

            // Define gradient colors
            const gradientColors = [
                ['rgba(255, 99, 132, 1)', 'rgba(255, 99, 132, 0.3)'], // Red
                ['rgba(255, 165, 0, 1)', 'rgba(255, 165, 0, 0.3)'],   // Orange
                ['rgba(255, 206, 86, 1)', 'rgba(255, 206, 86, 0.3)'], // Yellow
                ['rgba(75, 192, 192, 1)', 'rgba(75, 192, 192, 0.3)'], // Green
                ['rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.3)'], // Blue
                ['rgba(153, 102, 255, 1)', 'rgba(153, 102, 255, 0.3)'] // Purple
            ];

            // Create individual gradients for each bar
            const gradientFills = addresses.map((_, index) => {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                const color = gradientColors[index % gradientColors.length]; // Cycle through gradientColors
                gradient.addColorStop(0, color[0]);
                gradient.addColorStop(1, color[1]);
                return gradient;
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: addresses,
                    datasets: [{
                        label: 'Patient Count by Address', 
                        data: patientCounts,
                        backgroundColor: gradientFills, // Use gradient fills
                        borderColor: gradientColors.map(colors => colors[0]), // Use solid color for the border
                        borderRadius: 8,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e0e0e0' }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top', // Position legend at the top
                            labels: {
                                font: {
                                    size: 14, // Adjust font size of the legend
                                    weight: 'bold'
                                },
                                padding: 10, // Reduce padding around the label to offset it
                                color: '#FF6384' // Adjust color of the label
                            }
                        },
                        datalabels: {
                            align: 'end', // Aligns label at the end (top) of the bar
                            anchor: 'end', // Anchors label to the top
                            offset: 5, // Adjust to move the label higher above the bar
                            formatter: (value, context) => {
                                if (totalPatients > 0) {
                                    const percentage = ((value / totalPatients) * 100).toFixed(1);
                                    return percentage + '%';
                                } else {
                                    return '0%'; // Handle case where totalPatients is 0
                                }
                            },
                            color: '#FF6384',
                            font: {
                                size: 14, // Increase size for visibility
                                weight: 'bold'
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 0, // Reduce padding to remove extra space above the chart
                            bottom: 10 // Add a bit of padding below the chart if needed
                        }
                    },
                    elements: {
                        bar: {
                            borderRadius: 20, // Rounded bars
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ensure we use the DataLabels plugin
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

<style>#patientCharts1 {
    margin-top: 0px; /* Set margin above chart to 0 */
    padding-top: 0px; /* Set padding inside chart container to 0 */
}
</style> -->

</body>

</html>
