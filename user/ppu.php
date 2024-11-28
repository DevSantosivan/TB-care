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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
    // Retrieve and sanitize form inputs
    $med2 = mysqli_real_escape_string($con, $_POST['med2']);
  
    // Update query to set med2 to 0 for all patients
    $updateQuery = "UPDATE patient SET med2 = '$med2'";

    // Execute the update query
    if (mysqli_query($con, $updateQuery)) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
            Medicated status updated successfully for all patients.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <meta http-equiv="refresh" content=0; url=ppu">
        </div>';
        echo $status;
    } else {
        echo '<script>
                alert("Error updating patient information.");
              </script>';
    }
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
<?php
// Connect to your database
include('extension/connect.php');

$status = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time'])) {
    // Get the submitted time from the form
    $set_time = mysqli_real_escape_string($con, $_POST['set_time']);
    
    // Update the record where log_id = 1
    $updateQuery = "UPDATE time SET hours = '$set_time' WHERE log_id = 1";
    
    if (mysqli_query($con, $updateQuery)) {
        $status = "<div class='alert alert-success'>Time set to: $set_time</div>";
    } else {
        $status = "<div class='alert alert-danger'>Error setting time.</div>";
    }
}

// Fetch and display the current time from the database
$query = "SELECT hours FROM time WHERE log_id = 1";
$result = mysqli_query($con, $query);
$current_time = mysqli_fetch_assoc($result)['hours']; // Fetch current time for display
?>

<?php
// Connect to your database
include('extension/connect.php');

// Fetch the scheduled time for log_id = 1
$query = "SELECT TIME_FORMAT(hours, '%H:%i') as hours FROM time WHERE log_id = 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Store the time as a PHP variable
$scheduledTime = $row['hours']; // e.g., '14:28'
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

.patient-actions {
    position: absolute;
    top: 12px;
    right: 10px;
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

.form-space {
    width: 10px;
    /* Adjust the width as needed for the desired space */
    display: inline-block;
}
</style>

<style>
/* Base styles for the medication status messages */
.medication-status {
    padding: 3px;
    border-radius: 5px;
    font-weight: bold;
    color: #fff;
    text-align: center;
    width: fit-content;
    margin: 5px 0;
    font-size: 10px;
}

/* Style for the "Need Medication" status */
.red-status {
    background-color: #f44336;
    /* Red background */
    border: 2px solid #d32f2f;
    /* Darker red border */
}

/* Style for the "Done Medication" status */
.green-status {
    background-color: #4caf50;
    /* Green background */
    border: 2px solid #388e3c;
    /* Darker green border */
}

/* Optional: Hover effect */
.medication-status:hover {
    opacity: 0.8;
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
                                <h4 class="mb-0" style="color:white">PATIENT PROGRESS UPDATE</h4>
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
                    <?php if ($user_rank == 'superadmin') { ?>
                    <div align="left">
                        <form method="post" action="">
                            <input type="time" id="set_time" name="set_time"
                                value="<?php echo isset($current_time) ? $current_time : ''; ?>" required>
                            <!-- Time input with current time displayed -->

                            <button type="submit" name="time" class="btn btn-primary btn-sm">Set Time</button>
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="med2" value="0">
                            <button type="submit" name="reset" style="color:skyblue"></button>
                        </form>


                    </div>
                    <?php } ?>
                    <div align="right">

                        <form method="GET" action="">
                            <input type="text" name="search" placeholder="Search by name..."
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit">Search</button>
                        </form>
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
        $y = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$userid'");
        $t = mysqli_fetch_array($y);
        $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
        $query = mysqli_query($con, 
            "SELECT * FROM patient 
             WHERE uname = '$uname' 
             AND progress < 99
             AND treatment = 1
             AND med >= 1
             AND (firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%')");
    } elseif ($user_rank == 'superadmin') {
        $query = mysqli_query($con, 
            "SELECT * FROM patient 
             WHERE progress < 99
             AND treatment = 1
              AND med >= 1
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
            $med1 = $row['med1']; // Fetch med1 value
            $med2 = $row['med2'];
            $med3 = $row['med3'];
            $medin = $row['medin']; // Fetch med2 value

            ?>
                        <div class="grid-item">
                            <img src="<?php echo htmlspecialchars($picture); ?>" alt="User Picture"
                                class="user-picture">
                            <div class="user-info">
                                <h4><?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></h4>
                                <p><img src="https://img.sikatpinoy.net/images/2024/07/30/11590282.png"
                                        alt="Dashboard Image" height="15" width="15">
                                    <?php echo htmlspecialchars($email); ?></p>
                                <?php if ($user_rank == 'superadmin') { ?>
                                <p style="color:blue"><b>BHW: <?php echo htmlspecialchars($uname); ?></b></p>
                                <?php } ?>
                                <form method="post" action="profile">
                                    <input type="hidden" name="log_id"
                                        value="<?php echo htmlspecialchars($row['log_id']); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">SEE PROGRESS</button>
                                </form>
                            </div>
                            <div class="patient-action">
                                <img src="https://img.sikatpinoy.net/images/2024/07/26/image013b308c941114b1.png"
                                    alt="Dashboard Image" height="25" width="25">
                            </div>
                            <div class="patient-actions" id="status-<?php echo $row['log_id']; ?>">
                                <div
                                    class="medication-status <?php echo $med2 == '1' ? 'green-status' : 'red-status'; ?>">
                                    <?php echo $med2 == '1' ? 'Done Medication' : 'Need Medication'; ?>
                                </div>
                            </div>




                            <?php if ($medin == 30) { ?>
                            <script>
                            setTimeout(function() {
                                alert(
                                    "Congrats!  This patient <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?> has completed 1 month of medication."
                                );
                            }, 1000);
                            </script>
                            <?php } elseif ($medin == 60) { ?>
                            <script>
                            setTimeout(function() {
                                alert("Congrats! This patient has completed 2 months of medication.");
                            }, 1000);
                            </script>
                            <?php } elseif ($medin == 90) { ?>
                            <script>
                            setTimeout(function() {
                                alert("Congrats! This patient has completed 3 months of medication.");
                            }, 1000);
                            </script>
                            <?php } elseif ($med1 == 0) { ?>
                            <p style="color: red; font-weight: bold;">This is already Done Medicated</p>
                            <?php } ?>
                        </div>
                        <?php
        }
    } else {
        echo '<p>No records found.</p>';
    }
    ?>
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
    <script>
    // Function to check the current time and auto-click the button when the set time is reached
    function autoSubmitAtSetTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();

        // Get the scheduled time from PHP (from the database)
        const scheduledTime = "<?php echo $scheduledTime; ?>"; // e.g., '14:28'
        const [scheduledHour, scheduledMinute] = scheduledTime.split(':').map(Number);

        // Check if the current time matches the scheduled time
        if (hours === scheduledHour && minutes === scheduledMinute) {
            document.querySelector('button[name="reset"]').click(); // Auto-click the button

            // Refresh the page after clicking the button
            setTimeout(function() {
                window.location.href = "http://localhost/user/ppu"; // URL to refresh the page
            }, 1000); // Delay refresh by 1 second to ensure button click is processed

            clearInterval(checkTimeInterval); // Stop checking after the first trigger
        }
    }

    // Set an interval to check the time every minute
    const checkTimeInterval = setInterval(autoSubmitAtSetTime, 60000); // 60000 ms = 1 minute
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
    // Function to fetch updated med2 status from the server
    function fetchMedicationStatus() {
        // Perform an AJAX call to fetch updated patient data
        $.ajax({
            url: 'fetch_medication_status.php', // Your PHP file to fetch the med2 status
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Loop through the response and update the respective patient status
                response.forEach(function(patient) {
                    var patientId = patient.log_id;
                    var med2 = patient.med2;
                    var statusContainer = $('#status-' + patientId);

                    // Update the status dynamically based on the med2 value
                    if (med2 == '1') {
                        statusContainer.html(
                            '<div class="medication-status green-status">Done Medication</div>');
                    } else {
                        statusContainer.html(
                            '<div class="medication-status red-status">Need Medication</div>');
                    }
                });
            },
            error: function(error) {
                console.log("Error fetching data: ", error);
            }
        });
    }

    // Call the function every 2 seconds
    setInterval(fetchMedicationStatus, 2000);
    </script>



</body>

</html>
