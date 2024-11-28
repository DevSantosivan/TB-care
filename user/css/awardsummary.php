 
<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_summary') {
    include('extension/connect.php'); // Include your database connection

    $summary_id = mysqli_real_escape_string($con, $_POST['summary_id']);

    // Perform the deletion query
    $query = mysqli_query($con, "DELETE FROM summary WHERE summary_id = '$summary_id'");

    if ($query) {
        // Deletion successful
        echo json_encode(array('success' => true, 'message' => 'Summary has been successfully deleted.'));
    } else {
        // Deletion failed
        echo json_encode(array('success' => false, 'message' => 'Error deleting summary.'));
    }
} else {
    // Handle invalid or missing parameters
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}
?>

<?php
if(isset($_POST['register_summary'])){
    include('extension/connect.php'); // Include your database connection

    // Sanitize and retrieve form data
    $title_of_paper = isset($_POST['title_of_paper']) ? mysqli_real_escape_string($con, $_POST['title_of_paper']) : '';
    $campus = isset($_POST['campus']) ? mysqli_real_escape_string($con, $_POST['campus']) : '';
    $college_unit = isset($_POST['college_unit']) ? mysqli_real_escape_string($con, $_POST['college_unit']) : '';
    $cluster = isset($_POST['cluster']) ? mysqli_real_escape_string($con, $_POST['cluster']) : '';
    $authors = isset($_POST['authors']) ? mysqli_real_escape_string($con, $_POST['authors']) : '';
    $started = isset($_POST['started']) ? mysqli_real_escape_string($con, $_POST['started']) : '';
    $completed = isset($_POST['completed']) ? mysqli_real_escape_string($con, $_POST['completed']) : '';
    $title_of_forum = isset($_POST['title_of_forum']) ? mysqli_real_escape_string($con, $_POST['title_of_forum']) : '';
    $venue = isset($_POST['venue']) ? mysqli_real_escape_string($con, $_POST['venue']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';
    $type_of_presentation = isset($_POST['type_of_presentation']) ? mysqli_real_escape_string($con, $_POST['type_of_presentation']) : '';

    // Insert the data into the 'summary' table
    $query = mysqli_query($con, "INSERT INTO summary (Title_of_Paper, Campus, College_Unit, Cluster, Authors, Started, Completed, Title_of_Forum, Venue, Date, Type_of_Presentation) VALUES ('$title_of_paper', '$campus', '$college_unit', '$cluster', '$authors', '$started', '$completed', '$title_of_forum', '$venue', '$date', '$type_of_presentation')");

    if ($query) {
        echo '<script>
            alert("Summary information has been successfully added.");
            window.location.href = "summary.php"; // Redirect back to the form
        </script>';
    } else {
        echo '<script>
            alert("Error adding summary information.");
            window.location.href = "summary.php"; // Redirect back to the form
        </script>';
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
<title><?php include('extension/title.php'); ?> | View Summary</title>
    
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
      
.btn-primary {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

/* Style for the Modal */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 110;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
  padding-top: 60px; /* Place content 60px from the top */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 5% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Close Button */
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
                <h4 class="mb-0"> Summary list</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="default-color"><button id="openModalBtn" class="btn btn-primary">Add Item</button> </a></li>
               
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
            <th>Title of Paper</th>
            <th>Campus</th>
            <th>College Unit</th>
            <th>Cluster</th>
            <th>Authors</th>
            <th>Started</th>
            <th>Completed</th>
            <th>Title of Forum</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Type of Presentation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($con, "SELECT * FROM summary");

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $title_of_paper = $row['Title_of_Paper'];
                $campus = $row['Campus'];
                $college_unit = $row['College_Unit'];
                $cluster = $row['Cluster'];
                $authors = $row['Authors'];
                $started = $row['Started'];
                $completed = $row['Completed'];
                $title_of_forum = $row['Title_of_Forum'];
                $venue = $row['Venue'];
                $date = $row['Date'];
                $type_of_presentation = $row['Type_of_Presentation'];
                ?>
                <tr>
                    <td><?php echo $title_of_paper; ?></td>
                    <td><?php echo $campus; ?></td>
                    <td><?php echo $college_unit; ?></td>
                    <td><?php echo $cluster; ?></td>
                    <td><?php echo $authors; ?></td>
                    <td><?php echo $started; ?></td>
                    <td><?php echo $completed; ?></td>
                    <td><?php echo $title_of_forum; ?></td>
                    <td><?php echo $venue; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $type_of_presentation; ?></td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="action" value="delete_summary">
                            <input type="hidden" name="summary_id" value="<?php echo $row['summary_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this summary?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="12">Error fetching summary list.</td></tr>';
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
  






<!-- Modal -->
<div id="formModal" class="modal" >
  <div class="modal-content">
    <span class="close" id="closeModalBtn">&times;</span>
    <!-- Your Form Goes Here -->
    <form method="POST" action="" class="ui grid form" >
     
    
    <div class="row field">
        <label class="twelve wide column" for="title_of_paper">Title of Paper</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea type="text" id="title_of_paper" name="title_of_paper" placeholder="Title of Paper" rows="1" required></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="campus">Campus</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="campus" name="campus" placeholder="Campus" rows="1"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="college_unit">College Unit</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="college_unit" name="college_unit" placeholder="College Unit" rows="1"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="cluster">Cluster</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="cluster" name="cluster" placeholder="Cluster" rows="1"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="authors">Authors</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="authors" name="authors" placeholder="Authors" rows="4"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
    <label class="twelve wide column" for="started">Started</label>
    <div class="twelve wide column">
        <div class="ui input">
            <input type="date" id="started" name="started" required>
        </div>
    </div>
</div>

<div class="row field">
    <label class="twelve wide column" for="completed">Completed</label>
    <div class="twelve wide column">
        <div class="ui input">
            <input type="date" id="completed" name="completed" required>
        </div>
    </div>
</div>


    <div class="row field">
        <label class="twelve wide column" for="title_of_forum">Title of Forum</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="title_of_forum" name="title_of_forum" placeholder="Title of Forum" rows="1"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="venue">Venue</label>
        <div class="twelve wide column">
            <div class="ui input">
                <textarea id="venue" name="venue" placeholder="Venue" rows="1"></textarea><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="date">Date</label>
        <div class="twelve wide column">
            <div class="ui input">
                <input type="date" id="date" name="date"><br>
            </div>
        </div>
    </div>

    <div class="row field">
        <label class="twelve wide column" for="type_of_presentation">Type of Presentation</label>
        <div class="twelve wide column">
            <div class="ui input">
                <select id="type_of_presentation" name="type_of_presentation">
                    <option value="national">National</option>
                    <option value="international">International</option>
                </select>
            </div>
        </div>
    </div>

  
      <div class="row">
        <label class="twelve wide column"></label>
        <div class="twelve wide column">
          <button type="submit" name="register_summary" class="btn btn-primary ml-15">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>








<!-- JavaScript to handle modal visibility -->
<script>
  // Get the modal
  var modal = document.getElementById('formModal');

  // Get the button that opens the modal
  var openBtn = document.getElementById('openModalBtn');

  // Get the <span> element that closes the modal
  var closeBtn = document.getElementById('closeModalBtn');

  // When the user clicks the button, open the modal
  openBtn.onclick = function() {
    modal.style.display = 'block';
  }

  // When the user clicks on <span> (x), close the modal
  closeBtn.onclick = function() {
    modal.style.display = 'none';
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  }
</script>


</body>
</html>
