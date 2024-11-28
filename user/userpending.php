<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
 
?>


<?php
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
    }elseif(isset($_POST['action_a']) && $_POST['action_a'] == 'delete'){
        $u = mysqli_real_escape_string($con, $_POST['action_u']);
        
        $delete_query = mysqli_query($con, "DELETE FROM users WHERE user_id='$u'");
        if($delete_query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User deleted successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Failed to delete user.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif(isset($_POST['action_a']) && $_POST['action_a'] == 'approved'){
    $u = mysqli_real_escape_string($con, $_POST['action_u']);
    
    // Update user's account status to approved
    $update_query = mysqli_query($con, "UPDATE users SET is_active=1 WHERE user_id='$u'");
    if($update_query) {
        // Check if user's username is an email address
        $user_email_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$u'");
        $user_row = mysqli_fetch_assoc($user_email_query);
        $user_email = $user_row['user_name'];
        
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            // If the username is an email address, send email notification
            $subject = 'Account Approved';
            $message = 'Your account has been approved. You can now log in and access your account.';
            if (send_email_notification($user_email, $subject, $message)) {
                // Email sent successfully
                $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                User approved successfully. Email notification sent.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            } else {
                // Failed to send email
                $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                User approved successfully, but failed to send email notification.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }
        } else {
            // Username is not an email address
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User approved successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } else {
        // Failed to update user's account status
        $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Failed to approve user.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>';
    }
}



    else{
        
    }
}


 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function send_email_notification($to, $subject, $message) {
    // Configure your SMTP settings here
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = '587'; // or 465 for SSL
    $smtp_username = 'frmmssite@gmail.com';
    $smtp_password = 'lcuwkyiaekjyhpzn';

//     // Load PHPMailer library
//     require '/home/frmmssit/public_html/PHPMailer/src/Exception.php';
//    require '/home/frmmssit/public_html/PHPMailer/src/PHPMailer.php';
//     require '/home/frmmssit/public_html/PHPMailer/src/SMTP.php';


    // Create a PHPMailer object


    // Load PHPMailer library
    require 'path/to/PHPMailer/src/Exception.php';
    require 'path/to/PHPMailer/src/PHPMailer.php';
    require 'path/to/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // Create a PHPMailer object
   // $mail = new PHPMailer();

    // Enable SMTP
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = 'tls'; // or 'ssl' for SSL
    $mail->Port       = $smtp_port;

    // Set From, To, Subject, and Body
    $mail->setFrom($smtp_username, 'Faculty Research Monitoring System');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Send the email
    if ($mail->send()) {
        return true;
    } else {
        return false;
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
    <title><?php include('extension/title.php'); ?> | Pending USer</title>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

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
    margin: 5% auto;
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

        <div class="container-fluid">
            <div class="row">
                <?php include('extension/sidenav.php'); ?>
                <!-- main content wrapper start-->

                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Pending Users</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">

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
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
 $i=1;
 $query = mysqli_query($con,"select * from users ");
 if(mysqli_num_rows($query)>0){
     while($row=mysqli_fetch_array($query)){
        $id = $row['user_id']; 
        $full_name = $row['full_name'];
        $is_active = $row['is_active']; // Assuming 'is_active' field exists in the users table
        
        ?>
                                                <tr>
                                                    <?php if ($is_active == 0): ?>
                                                    <td><?php echo $full_name; ?></td>
                                                    <td>Account Pending</td>
                                                    <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                                role="button" id="dropdownMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuLink">


                                                                <a class="btn"
                                                                    onclick="submitForm('approved','<?php echo $id; ?>')">Approve
                                                                    User</a><br>

                                                                <a class="btn"
                                                                    onclick="submitForm('delete','<?php echo $id; ?>')">Declined
                                                                    User</a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php else: ?>
                                                    <!-- #region 
                --> <?php endif; ?>


                                                </tr>
                                                <?php
    }
} else {
    echo '<tr><td colspan="1">Error fetching users list.</td></tr>';
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
                        <input type="hidden" id="action_a" name="action_a" />
                        <input type="hidden" id="action_u" name="action_u" />
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
    <script>
    var plugin_path = 'js/';
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

    <script src="/assets/alertifyjs/alertify.js"></script>

    <script>
    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        });
    });
    </script>



</body>

</html>
