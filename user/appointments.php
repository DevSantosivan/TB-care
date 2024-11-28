<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$status = '';
$teacher_id = $_SESSION['userid'];

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
    }elseif ($_POST['action_a'] == 'visit') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);
    
        // Get the current date
        $currentDate = date('Y-m-d'); // Adjust the format as needed
    
        // Prepare the SQL query
        $query = mysqli_prepare($con, "UPDATE patient SET lastvisit = ? WHERE log_id = ?");
        mysqli_stmt_bind_param($query, "ss", $currentDate, $u);
        $result = mysqli_stmt_execute($query);
    
        if ($result) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                             Visit updated successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                             <meta http-equiv="refresh" content="2; url=patientrecord">
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Visit update failed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }
    elseif($_POST['action_a'] == 'review'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET student_type='pendingpre-school' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Students] Review successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Students] Aprroved failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif ($_POST['action_a'] == 'deletes') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);
    
        // Fetch the filename associated with the log_id
        $filename_query = mysqli_prepare($con, "SELECT file_name FROM fullpaper WHERE log_id = ?");
        mysqli_stmt_bind_param($filename_query, "s", $u);
        mysqli_stmt_execute($filename_query);
        $filename_result = mysqli_stmt_get_result($filename_query);
        $filename_row = mysqli_fetch_assoc($filename_result);
    
        if ($filename_row) {
            $filename = $filename_row['file_name'];
    
            // Delete the file from the fullpaper1 folder
            $file_path = "fullpaper1/$filename";
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Delete the record from the fullpaper table
            $delete_query = mysqli_prepare($con, "DELETE FROM fullpaper WHERE log_id = ?");
            mysqli_stmt_bind_param($delete_query, "s", $u);
            $delete_result = mysqli_stmt_execute($delete_query);
    
            if ($delete_result) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Delete successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                [User] Delete failure
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Record not found
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif ($_POST['action_a'] == 'delete') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);
    
        // Fetch the filename associated with the log_id
        $filename_query = mysqli_prepare($con, "SELECT picture FROM patient WHERE log_id = ?");
        mysqli_stmt_bind_param($filename_query, "s", $u);
        mysqli_stmt_execute($filename_query);
        $filename_result = mysqli_stmt_get_result($filename_query);
        $filename_row = mysqli_fetch_assoc($filename_result);
    
        if ($filename_row) {
            $filename = $filename_row['picture'];
    
            // Delete the file from the img/picture folder
            $file_path = "img/picture/$filename";
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Delete the record from the patient table
            $delete_query = mysqli_prepare($con, "DELETE FROM patient WHERE log_id = ?");
            mysqli_stmt_bind_param($delete_query, "s", $u);
            $delete_result = mysqli_stmt_execute($delete_query);
    
            if ($delete_result) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User deleted successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            User deletion failed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
            }
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Record not found
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
// Retrieve the search query if it exists
$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('m');

// Check user rank and set the appropriate query
$rank_check = mysqli_query($con, "SELECT user_rank FROM users WHERE user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

if ($user_rank == 'normal') {
    // Fetch the current user's username
    $t = mysqli_fetch_array(mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$userid'"));
    $uname = $t['user_name'];

    // Query to get total counts for each appointment status for the current month
    $totals_query = mysqli_query($con, 
        "SELECT 
            SUM(appointmentstatus = 1) AS new,
            SUM(appointmentstatus = 2) AS rescheduled,
            SUM(appointmentstatus = 3) AS canceled
         FROM patient 
         WHERE uname = '$uname' 
         AND YEAR(appointmentdate) = '$currentYear'
         AND MONTH(appointmentdate) = '$currentMonth'"
    );
} elseif ($user_rank == 'superadmin') {
    // Query to get total counts for each appointment status for the current month
    $totals_query = mysqli_query($con, 
        "SELECT 
            SUM(appointmentstatus = 1) AS new,
            SUM(appointmentstatus = 2) AS rescheduled,
            SUM(appointmentstatus = 3) AS canceled
         FROM patient
         WHERE YEAR(appointmentdate) = '$currentYear'
         AND MONTH(appointmentdate) = '$currentMonth'"
    );
} else {
    // Handle other ranks or an unknown rank if necessary
    echo "Unknown user rank.";
    exit;
}

// Check if the query was successful
if ($totals_query) {
    $totals = mysqli_fetch_array($totals_query);
} else {
    echo "Totals query error: " . mysqli_error($con);
    $totals = [
        'new' => 0,
        'rescheduled' => 0,
        'canceled' => 0
    ];
}
?>





<?php
if (isset($_POST['upload'])) {
    // Check if a file was uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // Define allowed file types
        $allowedExtensions = array('png', 'jpg');
        
        // Get the file extension of the uploaded file
        $fileExtension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        
        // Check if the file extension is in the list of allowed extensions
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            // File type not allowed
            echo '<script>
                    alert("Only PNG and JPG images are allowed.");
                    window.location.reload(); // Refresh the current page
                  </script>';
            exit; // Stop execution
        }

         // Generate a unique filename with timestamp
         $timestamp = date('YmdHis'); // Format: YYYYMMDDHHMMSS
         $uniqueFilename = $timestamp . '.' . $fileExtension;
         $uploadDir = 'img/picture/'; // Specify the directory where you want to save pictures
         $uploadFile = $uploadDir . $uniqueFilename;
        
        // Check if a file with the same name already exists in the specified directory
        if (file_exists($uploadFile)) {
            // File with the same name already exists, handle accordingly
            echo '<script>
                    alert("A file with the same name already exists.");
                    window.location.reload(); // Refresh the current page
                  </script>';
            exit; // Stop execution
        }
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            // File upload successful
            
            // Retrieve the form inputs (sanitize inputs to prevent SQL injection)
            $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($con, $_POST['firstname']) : '';
            $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($con, $_POST['lastname']) : '';
            $diagnosis = isset($_POST['diagnosis']) ? mysqli_real_escape_string($con, $_POST['diagnosis']) : '';
            $dateofbirth = isset($_POST['dateofbirth']) ? mysqli_real_escape_string($con, $_POST['dateofbirth']) : '';
            $address = isset($_POST['address']) ? mysqli_real_escape_string($con, $_POST['address']) : '';
            $date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';
            $contact = isset($_POST['contact']) ? mysqli_real_escape_string($con, $_POST['contact']) : '';
            $uname = isset($_POST['uname']) ? mysqli_real_escape_string($con, $_POST['uname']) : '';

            // Insert data into the database
            $insertQuery = "INSERT INTO patient (date, firstname, lastname, diagnosis, dateofbirth, address, contact, appointmentdate, appointmenthours, appointmentstatus, files, picture, uname)
                            VALUES ('$date', '$firstname', '$lastname', '$diagnosis', '$dateofbirth', '$address', '$contact', NULL, NULL, '0', NULL, '$uploadFile', '$uname')";
            mysqli_query($con, $insertQuery);

            $status = '<div class="alert alert-success alert-dismissible" role="alert">
             successfully Added Patient
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <meta http-equiv="refresh" content="2; url=patient">
        </div>'; 
        } else {
            // File upload failed
            echo '<script>
                    alert("Error uploading the picture.");
                     
                  </script>';
            exit; // Stop execution
        }
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
    <title><?php include('extension/title.php'); ?> | View User Document</title>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/davidstyles.css" />

    <link rel="stylesheet" type="text/css" href="/assets/alertifyjs/css/alertify.css">
</head>

<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
    padding: 20px;
}

.grid-item {
    background: #e0f7fa;
    border-radius: 10px;
    color: #000;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.user-picture {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-bottom: 15px;
}

.user-info {
    text-align: center;
}

.user-info h4 {
    font-size: 1.25rem;
    margin-bottom: 5px;
}

.user-info p {
    font-size: 0.875rem;
    margin: 2px 0;
}

.patient-action {
    position: absolute;
    top: 12px;
    left: 10px;
}

@media (max-width: 1200px) {
    .user-info h4 {
        font-size: 1.15rem;
    }

    .user-info p {
        font-size: 0.85rem;
    }
}

@media (max-width: 768px) {
    .user-info h4 {
        font-size: 1rem;
    }

    .user-info p {
        font-size: 0.75rem;
    }
}

.modal-content {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-family: 'Arial', sans-serif;
}

.modal-header {
    border-bottom: 1px solid #ddd;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
}

.close {
    font-size: 1.5rem;
    color: #fff;
}

.modal-body {
    background-color: #54555c;
    padding: 2rem;
}

.modal-info {
    padding: 1rem;
    background-color: #206a87;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}

.modal-info p {
    margin-bottom: 1rem;
    font-size: 1rem;
    color: white;
}

.modal-info strong {
    color: greenyellow;
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
    background-color: #f9f9f9;
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
</style>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->


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
                                <h4 class="mb-0">ALL APPOINTMENTS</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">

                                    <!-- 
                                    <li class="breadcrumb-item"><a href="#" class="default-color"><button
                                                data-toggle="modal" data-target="#pdfModal"> <img
                                                    src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png"
                                                    alt="Dashboard Image" height="20" width="20">NEW</button>
                                        </a></li> -->

                                </ol>
                            </div>
                        </div>
                    </div>





                    <?php echo $status; ?>
                    <div align="right">
                        <form method="GET" action="">
                            <input type="text" name="search" placeholder="Search by name..."
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit">Search</button>
                        </form>
                    </div>





                    <br>
                    <div class="totals">
                        <div class="total-box">
                            <img src="https://img.sikatpinoy.net/images/2024/09/18/image-removebg-preview-2.png" alt="Icon"
                                class="box-icon">
                            <div class="box-content">
                                <small>Number of Appointments</small>
                                <h3 class="total-number">
                                    <?php echo htmlspecialchars($totals['new']); ?>
                                    <span class="month-text">This month</span>
                                </h3>
                            </div>
                        </div>
                        <div class="total-box">
                            <img src="https://img.sikatpinoy.net/images/2024/09/18/image-removebg-preview-1.png" alt="Icon"
                                class="box-icon">
                            <div class="box-content">
                                <small>Rescheduled Appointments</small>
                                <h3 class="total-number">
                                    <?php echo htmlspecialchars($totals['rescheduled']); ?>
                                    <span class="month-text">This month</span>
                                </h3>
                            </div>
                        </div>
                        <div class="total-box">
                            <img src="https://img.sikatpinoy.net/images/2024/08/03/imaged7685df44de19caf.png" alt="Icon"
                                class="box-icon">
                            <div class="box-content">
                                <small>Canceled Appointments</small>
                                <h3 class="total-number">
                                    <?php echo htmlspecialchars($totals['canceled']); ?>
                                    <span class="month-text">This month</span>
                                </h3>
                            </div>
                        </div>
                    </div>





                    <div class="grid-container">
                        <?php
// Retrieve the search query if it exists
$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Check user rank and set the appropriate query
$rank_check = mysqli_query($con, "SELECT user_rank FROM users WHERE user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

 

if ($user_rank == 'normal') {
    // Fetch the current user's username
    $t = mysqli_fetch_array(mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$userid'"));
    $uname = $t['user_name'];

    $query = mysqli_query($con, 
        "SELECT * FROM patient 
         WHERE uname = '$uname' 
         AND appointmentstatus IN (3, 1, 2)
         AND (firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%')");
} elseif ($user_rank == 'superadmin') {
    $query = mysqli_query($con, 
        "SELECT * FROM patient 
         WHERE appointmentstatus IN (3, 1, 2)
         AND (firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%')");
} else {
    // Handle other ranks or an unknown rank if necessary
    echo "Unknown user rank.";
    exit;
}

if (!$query) {
    echo "Query error: " . mysqli_error($con);
} elseif (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $appointmentstatus = $row['appointmentstatus'];
        $status_text = '';

        // Determine the status text based on the appointmentstatus value
        if ($appointmentstatus == 1) {
            $status_text = 'NEW APPOINTMENT';
        } elseif ($appointmentstatus == 2) {
            $status_text = 'RESCHEDULE';
        } elseif ($appointmentstatus == 3) {
            $status_text = 'CANCEL';
        }

        // Fetch patient details
        $id = $row['log_id'];
        $date = $row['date'];
        $formattedDate = date('M d, Y', strtotime($date));
        $picture = $row['picture'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $diagnosis = $row['diagnosis'];
        $dateofbirth = $row['dateofbirth'];
        $lastvisit = $row['lastvisit'];
        $address = $row['address'];
        $contact = $row['contact'];
        $uname = $row['uname'];
        $email = $row['email'];
        $appointmentstatus = $row['appointmentstatus'];
        $appointmentdate = $row['appointmentdate'];
        $appointmenthours = $row['appointmenthours'];
        $appointmentnotes = $row['appointmentnotes'];
        $doctors = $row['doctors'];

        
        
?>
                        <div class="grid-item">
                            <img src="<?php echo htmlspecialchars($picture); ?>" alt="User Picture"
                                class="user-picture">
                            <div class="user-info">
                                <h4><?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></h4>
                                <p><img src="https://img.sikatpinoy.net/images/2024/07/30/11590282.png"
                                        alt="Dashboard Image" height="15" width="15">
                                    <?php echo htmlspecialchars($email); ?></p>
                                <p>
                                    <?php echo htmlspecialchars($status_text); ?></p>
                                <?php if($user_rank == 'superadmin' ){ ?>
                                <p style="color:red"><b>BHW: <?php echo htmlspecialchars($uname); ?></b></p>
                                <?php } ?>

                                <a class="btn btn-primary btn-sm" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#details" data-contact="<?php echo htmlspecialchars($contact); ?>"
                                    data-status="<?php echo htmlspecialchars($status_text); ?>"
                                    data-appointmentdate="<?php echo htmlspecialchars($appointmentdate); ?>"
                                    data-appointmenthours="<?php echo htmlspecialchars($appointmenthours); ?>"
                                    data-appointmentnotes="<?php echo htmlspecialchars($appointmentnotes); ?>"
                                    data-doctors="<?php echo htmlspecialchars($doctors); ?>">
                                    VIEW DETAILS
                                </a>
                            </div>
                        </div>
                        <?php
    }
} else {
    echo '<p>No records found.</p>';
}
?>

                    </div>




                    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
                        aria-hidden="true">

                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="confirmModalLabel">
                                        <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png"
                                            alt="Dashboard Image" height="35" width="35"> APPOINTMENT DETAILLS
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-info">
                                        <p><strong>Contact:</strong> <span id="contact"></span></p>
                                        <p><strong>Status:</strong> <span id="status"></span></p>
                                        <p><strong>Appointment Date:</strong> <span id="appointmentdate"></span></p>
                                        <p><strong>Appointment Hours:</strong> <span id="appointmenthours"></span></p>
                                        <p><strong>Appointment Notes:</strong> <span id="appointmentnotes"></span></p>
                                        <p><strong>Assigned Doctors/BHW:</strong> <span id="doctors"></span></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                    function showContact(contact, status, appointmentdate, appointmenthours, appointmentnotes,
                        doctors) {
                        document.getElementById('contact').innerText = contact;
                        document.getElementById('status').innerText = status;
                        document.getElementById('appointmentdate').innerText = formatDate(appointmentdate);
                        document.getElementById('appointmenthours').innerText = appointmenthours;
                        document.getElementById('appointmentnotes').innerText = appointmentnotes;
                        document.getElementById('doctors').innerText = doctors;
                    }

                    function formatDate(dateString) {
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        const date = new Date(dateString);
                        return date.toLocaleDateString(undefined, options);
                    }

                    document.querySelectorAll('[data-toggle="modal"]').forEach(function(element) {
                        element.addEventListener('click', function() {
                            showContact(
                                this.getAttribute('data-contact'),
                                this.getAttribute('data-status'),
                                this.getAttribute('data-appointmentdate'),
                                this.getAttribute('data-appointmenthours'),
                                this.getAttribute('data-appointmentnotes'),
                                this.getAttribute('data-doctors')
                            );
                        });
                    });
                    </script>













                    <!-- Modal Structure -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>

                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this record? Type 'delete' to confirm.</p>
                                    <input type="text" id="confirmationInput" placeholder="Type 'delete'"
                                        class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmButton" class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                        var confirmButton = document.getElementById('confirmButton');
                        var confirmationInput = document.getElementById('confirmationInput');
                        var actionToPerform = '';
                        var idToDelete = '';

                        window.openModal = function(id) {
                            idToDelete = id;
                            confirmModal.show(); // Show the modal
                        }

                        confirmButton.addEventListener('click', function() {
                            if (confirmationInput.value === 'delete') {
                                submitForm('delete', idToDelete);
                                confirmModal.hide(); // Hide the modal
                            } else {
                                alert("Type 'delete' to confirm.");
                            }
                        });
                    });

                    function submitForm(action, id) {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = ''; // Replace with your actual action URL

                        var inputAction = document.createElement('input');
                        inputAction.type = 'hidden';
                        inputAction.name = 'action';
                        inputAction.value = action;
                        form.appendChild(inputAction);

                        var inputId = document.createElement('input');
                        inputId.type = 'hidden';
                        inputId.name = 'id';
                        inputId.value = id;
                        form.appendChild(inputId);

                        document.body.appendChild(form);
                        form.submit();
                    }
                    </script>







                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js">
                    </script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
                    </script>
                    <script>
                    function submitForm(action, id) {
                        // Add your form submission logic here
                        console.log(action, id);
                    }
                    </script>

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








    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">ADD PATIENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    <div class="container">

                        <div class="content ">
                            <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">First Name</span>
                                        <input type="text" name="firstname" placeholder="First Name" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Last Name</span>
                                        <input type="text" name="lastname" placeholder="Last Name" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Diagnosis</span>
                                        <input type="text" name="diagnosis" placeholder="Diagnosis" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Birthday</span>
                                        <input type="date" name="dateofbirth" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Address</span>
                                        <input type="text" name="address" placeholder="Address" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Date</span>
                                        <input type="date" name="date" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Contact</span>
                                        <input type="text" name="contact" placeholder="Contact" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Patient Picture</span>
                                        <input type="file" name="picture" accept="image/png, image/jpeg" required>
                                    </div>
                                    <input type="hidden" name="uname" value="<?php echo $t['user_name']; ?>">
                                </div>
                                <div class="button">
                                    <input type="submit" name="upload" value="ADD NOW">
                                </div>
                            </form>

                        </div>
                    </div>











                </div>
            </div>
        </div>
    </div>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function openPDFViewer(filename) {
        // Path to your PDF files directory
        var pdfPath = 'fullpaper1/';

        // URL of the PDF file
        var pdfUrl = pdfPath + filename;

        // Set the source of the iframe
        var iframe = document.getElementById('pdfViewer');
        iframe.src = pdfUrl;

        // Show the modal
        $('#pdfModal').modal('show');
    }
    </script>
    <!--=================================
 footer -->



    <!--=================================
 jquery -->

    <script>
    var notificationElement = document.getElementById('notification');
    if (notificationElement.innerHTML !== '') {
        setTimeout(function() {
            notificationElement.innerHTML = '';
        }, 5000); // Clear notification after 5 seconds
    }
    </script>
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

    <script>
    // Function to fetch file information from the server for a specific username or uname
    function fetchFileInformation(uname) {
        fetch(
                `http://localhost/user/fullpaper1/fullpaperapi.php?action=getFileInformation&uname=${uname}`)
            .then(response => response.json())
            .then(data => {
                const fileList = document.getElementById('fileList');
                fileList.innerHTML = ''; // Clear the previous content

                data.forEach(file => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td><div class="file-icon"> <img src="/img/word.png" alt="" height="50px" width="50px"> </div></td>
                    <td>${file.file_name}</td>
                    <td>${file.date_uploaded}</td>
                    <td>${file.type_of_files}</td>  
                    <td>${file.size} kb</td> 
                    <td>${file.comment}</td>
                `;
                    fileList.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching file information:', error);
            });
    }

    // Call the fetchFileInformation function with a specific username or uname
    const uname = '<?php echo $t['user_name']; ?>'; // Replace 'test' with the desired username or uname
    fetchFileInformation(uname);
    </script>





    <div id="myModal" class="modals">

        <!-- Modal content -->
        <div class="modal-contents">
            <span class="close" id="closeModalBtn">&times;</span>




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
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            closeModal();
        }
    });
    </script>


</body>

</html>