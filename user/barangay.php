 
<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$admin_data = data_records($con);
$fast_loading = fast_loading($con);
$fastpro_loading = fastpro_loading($con);
$userid = $_SESSION['userid'];
$search = $userid;
$status = '';

if(!isset($_POST['action_a'])){
    
}else{
    if($_POST['action_a'] == 'password'){
        $newpass = rand(0,9999999);
        $authvpn = md5($newpass);
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET user_pass = '$newpass', user_encryptedPass = '$authvpn' WHERE user_id='$u'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Password] Reset successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Password] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'credits'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $qry = mysqli_query($con,"select user_credits from users where user_id='$u'");
        $row=mysqli_fetch_array($qry);
        $my_credits = $row['user_credits'];
        
        $descript = ''.$my_credits.' credit(s) have been reset by your upline';
        
        $query = mysqli_query($con,"UPDATE users SET user_credits = '0' WHERE user_id='$u'");
        if($query)
        {
            $update = mysqli_query($con,"insert into credit_log(`user_id`,`description`) values('$u','$descript')");
                if($update){
                    $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                    [Credit] Reset successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';    
                }else{
                    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                    [Credit] Reset failure
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                }
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Credit] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'block'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='1' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Block successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'unblock'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='0' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Unblock successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Unblock failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'delete'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        $chk_user = mysqli_query($con,"select * from users where user_id='$u'");
        $chk = mysqli_fetch_array($chk_user);
        $del_userid = $chk['user_id'];
        $del_username = $chk['user_name'];
        $del_password = $chk['user_pass'];
        $del_rank = $chk['user_rank'];
        
        $query = mysqli_query($con,"insert into delete_users(`user_id`,`user_name`,`user_pass`,`user_rank`) values('$del_userid','$del_username','$del_password','$del_rank')");
        if($query)
            {
                $qq = mysqli_query($con,"DELETE FROM users WHERE user_id='".$u."'");
                    if($qq){
                        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                    [User] Delete successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                    }else{
                        $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                        [User] Delete failure
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    }
            }else{
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                Something went wrong
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }
    }else{
        
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_barangay') {
    include('extension/connect.php'); // Include your database connection

    $barangay_id = mysqli_real_escape_string($con, $_POST['barangay_id']);

    // Perform the deletion query
    $query = mysqli_query($con, "DELETE FROM barangay WHERE barangay_id = '$barangay_id'");

    if ($query) {
        // Deletion successful
        echo json_encode(array('success' => true, 'message' => 'Barangay has been successfully deleted.'));
    } else {
        // Deletion failed
        echo json_encode(array('success' => false, 'message' => 'Error deleting barangay.'));
    }
} else {
    // Handle invalid or missing parameters
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}
?>

<?php
if(isset($_POST['register'])){
    include('extension/connect.php'); // Include your database connection

    // Sanitize and retrieve form data
    $barangay_name = isset($_POST['barangay_name']) ? mysqli_real_escape_string($con, $_POST['barangay_name']) : '';
    

    // Insert the data into the 'barangay' table
    $query = mysqli_query($con, "INSERT INTO barangay (barangay_name) VALUES ('$barangay_name')");

    if ($query) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
        [Baragay] Added successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    } else {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
       [Baragay] Delete successfully
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
<title><?php include('extension/title.php'); ?> | View Resellers</title>
    
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/images/favicon.ico" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css" />

<link rel="stylesheet" type="text/css" href="/assets/alertifyjs/css/alertify.css">
</head>
<style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            width: 60%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        /* Close button styles */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
<body>
<?php
     
    $rank_check = mysqli_query($con,"select user_rank from users where user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

    $que = mysqli_query($con,"select user_name from users where user_rank='teacher' and user_upline='$userid'");
    $reseller = mysqli_num_rows($que);
    
    
?>
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
 
<div class="container-fluid" style="background-color:skyblue;">
  <div class="row">
    <?php include('extension/sidenav.php'); ?>
<!-- main content wrapper start-->

    <div class="content-wrapper" style="background-color:skyblue;">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
                <h4 class="mb-0"> Barangay list</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="default-color"><button id="openModalBtn">Add Barangay</button> </a></li>
               
            </ol>
          </div>
        </div>
      </div>
    
 
        
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive">
                <?php echo $status; ?>
                    <table id="datatable" class="table table-striped table-bordered p-0">
    <thead>
        <tr>
            <th>Barangay Name</th>
          
            <th>Action</th>
             
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($con, "SELECT * FROM barangay");

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $barangay_name = $row['barangay_name'];
                $barangay_information = $row['barangay_information'];
                ?>
                <tr>
                    <td><?php echo $barangay_name; ?></td>
                   
                     <td>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="action" value="delete_barangay">
    <input type="hidden" name="barangay_id" value="<?php echo $row['barangay_id']; ?>">
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this barangay?')">Delete</button>
</form>
    </td>
                    
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="4">Error fetching barangay list.</td></tr>';
        }
        ?>
    </tbody>
</table>
        </div>
    </div>
</div>
</div>
        </div>
<!--=================================
 wrapper -->

<form method="post" id="action_form">
    <input type="hidden" id="action_a" name="action_a"/>
    <input type="hidden" id="action_u" name="action_u"/>
</form>
        
<script>
    function submitForm(action_id, user_id) {
      document.getElementById('action_a').value = action_id;
      document.getElementById('action_u').value = user_id;
      document.getElementById('action_form').submit();
    }
</script>
      
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
<script>var plugin_path = 'js/';</script>

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

<script src="/assets/alertifyjs/alertify.js"></script>

<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
  });
</script>
  
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
       
          <form method="POST" action="" class="ui grid form">
                        
                        <div class="row field">
                          <label class="twelve wide column" for="barangay_name">Barangay Name</label>
                          <div class="twelve wide column">
                            <div class="ui input">
                               <textarea type="text" id="barangay_name" name="barangay_name" placeholder="barangay name" rows="1" required></textarea><br>
 </div>
                          </div>
                        </div>
                        
                     
                        
                        
                        <div class="row">
                          <label class="twelve wide column"></label>
                          <div class="twelve wide column">
                            <button type="submit" name="register" class="btn btn-primary ml-15">SUBMIT</button>
                          </div>
                        </div>
                        
                    </form>


    </div>

</div>

<script>
    // Get the modal and buttons
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Function to open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Event listeners for the buttons
    openModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);

    // Close the modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            closeModal();
        }
    });
</script>


</body>
</html>
