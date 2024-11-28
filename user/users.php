<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
 $status = '';
?>


<?php
if(!isset($_POST['action_a'])){
    
}else{
    if($_POST['action_a'] == 'update'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET user_rank='superadmin' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Update successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] update failure
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
    }elseif(isset($_POST['action_a']) && $_POST['action_a'] == 'aproved'){
        $u = mysqli_real_escape_string($con, $_POST['action_u']);
        
        $update_query = mysqli_query($con, "UPDATE users SET is_active=1 WHERE user_id='$u'");
        if($update_query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User approved successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
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
    <title><?php include('extension/title.php'); ?> | UserList</title>

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
</div>

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

        <div class="container-fluid">
            <div class="row">



                <?php include('extension/sidenav.php'); ?>




                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> All Users</h4>
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
                                                    <th>Username</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
$i = 1;
$query = mysqli_query($con, "SELECT * FROM users ");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['user_id'];
        $full_name = $row['full_name'];
        $is_active = $row['is_active'];
        $user_name = $row['user_name']; // Assuming 'is_active' field exists in the users table



        if ($is_active == 0) {
            // Redirect to the specified page
            $status = "pending";
        } else {
            // Output the subscription message directly
            $status = "approved";
        }
        ?>
                                                <tr>


                                                    <td><?php echo $user_name; ?></td>
                                                    <td
                                                        style="color: <?php echo $status === 'pending' ? 'red' : 'green'; ?>">
                                                        <?php echo $status; ?></td>
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
                                                                    onclick="submitForm('delete','<?php echo $id; ?>')">Delete</a><br>
                                                                <a class="btn"
                                                                    onclick="submitForm('update','<?php echo $id; ?>')">Make
                                                                    Admin</a>

                                                            </div>
                                                        </div>
                                                    </td>



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
