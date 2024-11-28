<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$admin_data = data_records($con);
$fast_loading = fast_loading($con);
$fastpro_loading = fastpro_loading($con);
$userid = $_SESSION['userid'];
$search = $userid;

?>
 <?php 
$rank_check = mysqli_query($con,"select user_rank from users where user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

 $y = mysqli_query($con,"select user_name from users where user_id='$userid'");
    $t = mysqli_fetch_array($y);

     $e = mysqli_query($con,"select email from users where user_id='$userid'");
    $ee = mysqli_fetch_array($e);

     $a = mysqli_query($con,"select address from users where user_id='$userid'");
    $aa = mysqli_fetch_array($a);

    $f = mysqli_query($con,"select full_name from users where user_id='$userid'");
    $ff = mysqli_fetch_array($f);

    $c = mysqli_query($con,"select contact from users where user_id='$userid'");
    $cc = mysqli_fetch_array($c);
 ?>
 

 <?php
 $status = '';
if(isset($_POST['update'])){
  $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $address = mysqli_real_escape_string($con, $_POST['address']);
  $contact = mysqli_real_escape_string($con, $_POST['contact']);

  $kwery = mysqli_query($con, "SELECT maintenance FROM admin");
  $rows_kwery = mysqli_fetch_array($kwery);
  $maintenance_mode = $rows_kwery['maintenance'];

  if($maintenance_mode == 0) {
    if($full_name != '' && $email != '' && $address != '' && $contact != '') {
      $query = mysqli_query($con, "UPDATE users SET full_name='$full_name', email='$email', address='$address', contact='$contact' WHERE user_id='$userid'");
      
      if($query){
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Account updated successfully <meta http-equiv="refresh" content="2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
      } else {
        $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                    Account update failed
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
      }
    } else {
      $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                  Please fill out all forms
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>';
    }
  } else {
    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                Site maintenance ongoing <br>
                Try again later.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>';
  }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php include('extension/title.php'); ?> | Dashboard</title>
    
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/images/favicon.ico" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
</head>
<style type="text/css">
  .account-status {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f5f5f5;
}

.status-pending {
    color: red;
}

.status-approved {
    color: blue;
}

</style>
<body>

<div class="wrapper">

<!--=================================
 preloader -->
 
<div id="pre-loader">
    <img src="/assets/images/pre-loader/loader-01.svg" alt="">
</div>

<!--=================================
 preloader -->


<!--=================================
 header start-->
 
<?php include('extension/topnav.php'); ?>

<!--=================================
 header End-->

<!--=================================
 Main content -->



<?php
$user_id = $_SESSION['userid']; // Assuming 'userid' is the session key for the logged-in user

// Retrieve the user's form data from the database
$query = mysqli_query($con, "SELECT form FROM users WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($query);
$userFormData = json_decode($row['form'], true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && $_POST['user_id'] === $user_id) {
        // Retrieve form data from $_POST array
        $formData = $_POST;

        // Merge the user's changes into the existing form data
        $updatedFormArray = array_merge($userFormData, $formData);

        // Encode updated form data as JSON
        $jsonFormData = json_encode($updatedFormArray, JSON_PRETTY_PRINT);

        // Update the 'users' table to save the JSON data using prepared statement
        $updateQuery = mysqli_prepare($con, "UPDATE users SET form = ? WHERE user_id = ?");
        mysqli_stmt_bind_param($updateQuery, "si", $jsonFormData, $user_id);
        $updateResult = mysqli_stmt_execute($updateQuery);

        if ($updateResult) {
            $notification = '<div class="alert alert-success alert-dismissible" role="alert">
                                [Student] Data successfully saved
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
        } else {
            $notification = "Error updating form data for student with ID $user_id.";
        }
    }
}
?>
 
<div class="container-fluid">
  <div class="row">
    
    <?php include('extension/sidenav.php'); ?>
    
<!-- main content wrapper start-->

    <div class="content-wrapper">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
                <?php 
                $kwery = mysqli_query($con,"select maintenance from admin");
                $rows_kwery = mysqli_fetch_array($kwery);      
                $maintenance_mode = $rows_kwery['maintenance'];
                if($maintenance_mode == 1){ ?>
                <h4 class="mb-0">🔧 UNDER MAINTENANCE 🔧 </h4>
                <?php }else{ ?>
                <h4 class="mb-0"> Dashboard</h4>
                <?php } ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="index.html" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
        





  

  <div class="row">
        
  <!-- Display form data -->
<div class="col-xl-6 mb-30">
    <div class="card card-statistics mb-30">
        <div class="card-body">
            <h5 class="card-title">STUDENT REVIEW FORM</h5>

            <?php
            if (isset($notification)) {
                echo $notification;
            }
            ?>
            <?php echo $status; ?>
           <form method="post" action="" class="ui grid form" >
         <div class="row field">
                          <label class="twelve wide column" for="username"  >Username</label>
                          <div class="twelve wide column">
                            <div class="ui input"> 
                              <input type="text" aria-describedby="username"  id="user_name" value="<?php echo htmlspecialchars($t['user_name']); ?>"   autocomplete="off" required>
                            </div>
                          </div>
                        </div>

<div class="row field">
                          <label class="twelve wide column" for="full_name"  >Full Name</label>
                          <div class="twelve wide column">
                            <div class="ui input"> 
                              <input type="text" id="full_name" name="full_name" aria-describedby="full_name"  value="<?php echo htmlspecialchars($ff['full_name']); ?>"   autocomplete="off" required>
                            </div>
                          </div>
                        </div>


 <div class="row field">
                          <label class="twelve wide column" for="email"  >Email</label>
                          <div class="twelve wide column">
                            <div class="ui input"> 
                              <input type="email" id="email" name="email" aria-describedby="email"  value="<?php echo htmlspecialchars($ee['email']); ?>"   autocomplete="off" required>
                            </div>
                          </div>
                        </div>
    
     <div class="row field">
                          <label class="twelve wide column" for="address"  >Address</label>
                          <div class="twelve wide column">
                            <div class="ui input"> 
                              <input type="text" id="address" name="address" aria-describedby="address"  value="<?php echo htmlspecialchars($aa['address']); ?>"   autocomplete="off" required>
                            </div>
                          </div>
                        </div>

                         <div class="row field">
                          <label class="twelve wide column" for="contact"  >Contact Number</label>
                          <div class="twelve wide column">
                            <div class="ui input"> 
                              <input type="text" id="contact" name="contact" aria-describedby="contact"  value="<?php echo htmlspecialchars($cc['contact']); ?>"   autocomplete="off" required>
                            </div>
                          </div>
                        </div>
  


    <br><br>
    <input type="submit" name="update" value="update">
</form>

        </div>
    </div>
</div>

           <div class="col-xl-6 mb-30">
            <div class="card card-statistics mb-30">
                  <div class="card-body">
                    <div align="center">
                        <center>
    
</center> <br>
                    <img src="/img/logo.jpg" height="350" width="350">
                    </div>
                </div>
            </div>
     </div>

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
<script>var plugin_path = '/assets/js/';</script>

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

</body>
</html>
