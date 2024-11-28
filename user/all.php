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
    }elseif($_POST['action_a'] == 'review'){
    
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
if (isset($_POST['upload'])) {
    // Check if a picture was uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // Define allowed picture types
        $allowedPictureExtensions = array('png', 'jpg');
        $pictureExtension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        
        // Check if the picture extension is allowed
        if (!in_array(strtolower($pictureExtension), $allowedPictureExtensions)) {
            echo '<script>
                    alert("Only PNG and JPG images are allowed.");
                    window.location.reload();
                  </script>';
            exit;
        }

        // Generate a unique filename for the picture
        $timestamp = date('YmdHis');
        $uniquePictureFilename = $timestamp . '.' . $pictureExtension;
        $pictureUploadDir = 'img/picture/';
        $pictureUploadFile = $pictureUploadDir . $uniquePictureFilename;

        // Move the uploaded picture
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $pictureUploadFile)) {
            // Check if a document was uploaded
            if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                // Define allowed document types
                $allowedDocumentExtensions = array('pdf');
                $documentExtension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
                
                // Check if the document extension is allowed
                if (!in_array(strtolower($documentExtension), $allowedDocumentExtensions)) {
                    echo '<script>
                            alert("Only PDF, DOC, and DOCX files are allowed.");
                            window.location.reload();
                          </script>';
                    exit;
                }

                // Generate a unique filename for the document
                $uniqueDocumentFilename = $timestamp . '.' . $documentExtension;
                $documentUploadDir = 'uploads/documents/';
                $documentUploadFile = $documentUploadDir . $uniqueDocumentFilename;

                
                // Move the uploaded document
                if (move_uploaded_file($_FILES['document']['tmp_name'], $documentUploadFile)) {
                    // Retrieve and sanitize form inputs
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
                    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
                    $diagnosis = mysqli_real_escape_string($con, $_POST['diagnosis']);
                    $dateofbirth = mysqli_real_escape_string($con, $_POST['dateofbirth']);
                    $address = mysqli_real_escape_string($con, $_POST['address']);
                    $date = mysqli_real_escape_string($con, $_POST['date']);
                    $contact = mysqli_real_escape_string($con, $_POST['contact']);
                    $uname = mysqli_real_escape_string($con, $_POST['uname']);
                    $tb_type = mysqli_real_escape_string($con, $_POST['tb_type']);
                    $patientstatus = mysqli_real_escape_string($con, $_POST['patientstatus']);

                    // Insert data into the patient table
                    $insertPatientQuery = "INSERT INTO patient (date, email, firstname, lastname, diagnosis, dateofbirth, address, contact, appointmentdate, appointmenthours, appointmentstatus, files, picture, uname, tb_type, patientstatus)
                                           VALUES ('$date', '$email', '$firstname', '$lastname', '$diagnosis', '$dateofbirth', '$address', '$contact', NULL, NULL, '0', '$documentUploadFile', '$pictureUploadFile', '$uname', '$tb_type', '$patientstatus')";
                    mysqli_query($con, $insertPatientQuery);

                    $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                 Successfully added patient and uploaded document.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <meta http-equiv="refresh" content="2; url=patient">
                               </div>';
                } else {
                    echo '<script>
                            alert("Error uploading the document.");
                          </script>';
                    exit;
                }
            }
        } else {
            echo '<script>
                    alert("Error uploading the picture.");
                  </script>';
            exit;
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

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/davidstyles.css" />

    <link rel="stylesheet" type="text/css" href="/assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    

</head>

<style>
  .toolbar {
    display: flex;
    align-items: center;
    /* background-color: #b8e1fc; Background color similar to your design */
    padding: 5px;
    border-radius: 10px; 
    margin-bottom: 5px;
    

}

.toolbar-button {
    background-color: white; /* Button background */
    border: none; /* No border */
    color: #555; /* Icon color */
    padding: 10px;
    margin-right: 10px; /* Space between buttons */
    border-radius: 5px; /* Rounded button */
    cursor: pointer;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for depth */
}

.toolbar-button:hover {
    background-color: #e0f0ff; /* Lighten on hover */
}

.toolbar-button i {
    font-size: 16px; /* Icon size */
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
                               <!-- Example navigation bar structure -->
                               <div class="toolbar">
    <button class="toolbar-button">
        <i class="fa fa-bars"></i>
    </button>
    <button class="toolbar-button">
        <i class="fa fa-th"></i>
    </button>
    <button class="toolbar-button">
        <i class="fa fa-calendar"></i>
    </button>
    <!-- Add more buttons as needed -->
</div>


                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">


                                    <!-- <li class="breadcrumb-item"><a href="#" class="default-color"><button
                                                data-toggle="modal" data-target="#pdfModal"> <img
                                                    src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png"
                                                    alt="Dashboard Image" height="20" width="20"> ADD PATIENT</button>
                                        </a></li> -->

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
                                                    <th>Picture</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Diagnosis</th>
                                                    <th>Birthday</th>
                                                    <th>Address</th>
                                                    <th>Date</th>
                                                    <th>File</th>
                                                    <th>Contact</th>
                                                    <?php if($user_rank == 'superadmin' ){ ?>
                                                    <th>BHW</th>
                                                    <?php } ?>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

$rank_check = mysqli_query($con,"select user_rank from users where user_id='$userid'");
$myrank = mysqli_fetch_array($rank_check);
$user_rank = $myrank['user_rank'];

if ($user_rank == 'normal') {
    $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
    $query = mysqli_query($con, "SELECT * FROM patient WHERE uname = '$uname'");
} elseif ($user_rank == 'superadmin') {
    $query = mysqli_query($con, "SELECT * FROM patient");
} else {
    // Handle other ranks or an unknown rank if necessary
    // For example, you could set a default query or show an error message
    echo "Unknown user rank.";
    exit;
}
                            
        $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
       // $query = mysqli_query($con, "SELECT * FROM patient WHERE uname = '$uname'");
        if (!$query) {
            echo "Query error: " . mysqli_error($con);
        } elseif (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['log_id'];
                $date = $row['date']; // Ensure this column exists and is used correctly
                $formattedDate = date('M d, Y', strtotime($date));
                $picture = $row['picture']; // Ensure this column exists and contains the file path
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $diagnosis = $row['diagnosis'];
                $dateofbirth = $row['dateofbirth'];
                $address = $row['address'];
                $files = $row['files'];                                                                                           
                $contact = $row['contact'];
                $uname = $row['uname'];
                $progress = $row['progress'];
                
                

                // You might have additional variables or columns, so adjust accordingly
        ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?php echo htmlspecialchars($picture); ?>"
                                                            alt="Picture"
                                                            style="width:30px; height: 30px; border-radius: 50%; object-fit: cover;">
                                                    </td>

                                                    <td><?php echo htmlspecialchars($firstname); ?></td>
                                                    <td><?php echo htmlspecialchars($lastname); ?></td>
                                                    <td><?php echo htmlspecialchars($diagnosis); ?></td>
                                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($dateofbirth))); ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($address); ?></td>
                                                    <td><?php echo $formattedDate; ?></td>




                                                    <td style="color: blue">
                                                        <button type="button" class="btn btn-info"
                                                            onclick="openCombinedModal('<?php echo $files; ?>')">View
                                                            PDF</button>


                                                    </td>


                                                    <td>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-toggle="modal" data-target="#contactModal"
                                                            onclick="showContact('<?php echo htmlspecialchars($contact); ?>')">
                                                            <img src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                                                alt="Dashboard Image" height="20" width="20">

                                                        </a>

                                                    </td>
                                                    <?php if($user_rank == 'superadmin' ){ ?>
                                                    <td>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-toggle="modal" data-target="#unameModal"
                                                            onclick="showUname('<?php echo htmlspecialchars($uname); ?>')">
                                                            <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                                                alt="Dashboard Image" height="20" width="20">

                                                        </a>

                                                    </td>

                                                    <?php } ?>
                                                    <td>

                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                                role="button" id="dropdownMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuLink" style="color:blue">



                                                                <form method="post" action="addtreat">
                                                                    <input type="hidden" name="log_id"
                                                                        value="<?php echo $row['log_id']; ?>">

                                                                    <button type="submit" class="dropdown-item"><img
                                                                            src="https://img.sikatpinoy.net/images/2024/08/04/add_13110429.png"
                                                                            alt="Dashboard Image" height="20" width="20"
                                                                            style="filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(100%) contrast(100%);">Treatment</button>

                                                                </form>



                                                                <form method="post" action="addappointment">
                                                                    <input type="hidden" name="log_id"
                                                                        value="<?php echo $row['log_id']; ?>">
                                                                    <button type="submit" class="dropdown-item"><img
                                                                            src="https://img.sikatpinoy.net/images/2024/08/04/add_13110429.png"
                                                                            alt="Dashboard Image" height="20" width="20"
                                                                            style="filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(100%) contrast(100%);">Appointment</button>
                                                                </form>



                                                                <!-- Button to trigger modal -->
                                                                <form method="post" action="patientupdate">
                                                                    <input type="hidden" name="log_id"
                                                                        value="<?php echo $row['log_id']; ?>">
                                                                    <button type="submit" class="dropdown-item"><img
                                                                            src="https://img.sikatpinoy.net/images/2024/07/30/image.png"
                                                                            alt="Dashboard Image" height="20" width="20"
                                                                            style="filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(100%) contrast(100%);">Update</button>
                                                                </form>

                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    onclick="openModal('<?php echo $id; ?>')"><img
                                                                        src="https://img.sikatpinoy.net/images/2024/07/26/image5da641141cf8481a.png"
                                                                        alt="Dashboard Image" height="20"
                                                                        width="20">Delete</a>
                                                            </div>


                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
            }
        } else {
            echo '<tr><td colspan="9">No records found.</td></tr>';
        }
        ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>










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


                    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel"> <img
                                            src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                            alt="Dashboard Image" height="35" width="35"> Contact</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="contactDetails"></p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                    function showContact(contact) {
                        document.getElementById('contactDetails').innerText = contact;
                    }
                    </script>







                    <div class="modal fade" id="unameModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel"> <img
                                            src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                            alt="Dashboard Image" height="35" width="35"> BHW</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="unameDetails"></p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                    function showUname(uname) {
                        document.getElementById('unameDetails').innerText = uname;
                    }
                    </script>



















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
                                        <span class="details">Baranggay</span>
                                        <input type="text" name="address" placeholder="Baranggay" required>
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
                                        <span class="details">Contact</span>
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Patient Picture</span>
                                        <input type="file" name="picture" accept="image/png, image/jpeg" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Upload Document</span>
                                        <input type="file" name="document"
                                            accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                            required>
                                    </div>
                                    <input type="hidden" name="uname" value="<?php echo $t['user_name']; ?>">
                                </div>
                                <select name="tb_type" required>
                                    <option value="" disabled selected>SELECT TB TYPE</option>
                                    <option value="eptb">EPTB</option>
                                    <option value="ptb">PTB</option>
                                </select>
                                <br>
                                <select name="patientstatus" required>
                                    <option value="" disabled selected>SELECT PATIENT TYPE</option>
                                    <option value="1">NEW PATIENTS</option>
                                    <option value="2">RETURNE PATIENTS</option>
                                    <option value="3">RELAPSE PATIENTS</option>
                                </select>


                                <div class="twelve wide column">
                                    <button type="submit" name="upload" class="button ml-15"
                                        style="padding: 5px 10px !important;">Add Now</button>
                                </div>


                            </form>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <!-- Combined Modal -->
    <div class="modal fade" id="combinedModal" tabindex="-1" role="dialog" aria-labelledby="combinedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="combinedModalLabel">Password and File Viewer</h5>
                    <a href="#" id="customClose" class="btn btn-secondary">Close</a>
                </div>
                <div class="modal-body">
                    <!-- Password Form -->
                    <div id="passwordFormDiv">
                        <form id="passwordForm">
                            <div class="form-group">
                                <label for="userPassword">Password: Need Retype Password to show Submit Button</label>
                                <input type="password" class="form-control" id="userPassword" name="userPassword"
                                    required>
                            </div>
                            <button type="submit" id="submitButton" class="btn btn-primary"
                                style="display: none;">Submit</button>
                        </form>
                    </div>



                    <!-- PDF Viewer -->
                    <div id="pdfViewerDiv" style="display: none;">
                        <iframe id="pdfViewers" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal for viewing files -->
    <!-- <div class="modal fade" id="pdfModals" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabels"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabels">File Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewers" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap and jQuery libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- <script>
    function openPDFViewers(files) {
        // Path to your PDF files directory
        var pdfPath = '';

        // URL of the PDF file
        var pdfUrl = pdfPath + files;

        // Set the source of the iframe
        var iframe = document.getElementById('pdfViewers');
        iframe.src = pdfUrl;

        // Show the modal
        $('#pdfModals').modal('show');
    }
    </script> -->
    <script>
    var filePath = '';

    // Function to set file path for PDF
    function setFilePath(path) {
        filePath = path;
    }

    // Handle form submission for password check
    document.getElementById('passwordForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var userPassword = document.getElementById('userPassword').value;

        // AJAX request to check password
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_password.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText.trim() === 'success') {
                    // Switch to PDF Viewer
                    document.getElementById('passwordFormDiv').style.display = 'none';
                    document.getElementById('pdfViewerDiv').style.display = 'block';

                    // Set the source of the iframe
                    document.getElementById('pdfViewers').src = filePath;
                } else {
                    alert('Incorrect password.');
                    document.getElementById('userPassword').value = ''; // Clear the password field
                }
            }
        };
        xhr.send('user_pass=' + encodeURIComponent(userPassword));
    });

    // Function to open the combined modal with PDF content
    function openCombinedModal(files) {
        setFilePath(files);

        // Show the password modal first
        $('#combinedModal').modal('show');

        // Reset the modal content to show the password form
        document.getElementById('passwordFormDiv').style.display = 'block';
        document.getElementById('pdfViewerDiv').style.display = 'none';
    }

    // Reset the password field and modal content when the modal is hidden
    $('#combinedModal').on('hide.bs.modal', function() {
        document.getElementById('passwordForm').reset(); // Clear the form fields
        document.getElementById('passwordFormDiv').style.display = 'block'; // Show password form
        document.getElementById('pdfViewerDiv').style.display = 'none'; // Hide PDF viewer
    });
    document.getElementById('customClose').addEventListener('click', function(e) {
        e.preventDefault();
        $('#combinedModal').modal('hide');
    });

    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('userPassword');
        var submitButton = document.getElementById('submitButton');
        var timeoutId = null;
        var form = document.getElementById('passwordForm');

        // Show the submit button when the user starts typing
        passwordInput.addEventListener('input', function() {
            // Clear any existing timer
            if (timeoutId !== null) {
                clearTimeout(timeoutId);
            }

            // Show the submit button
            submitButton.style.display = 'block';

            // Start a new timer to hide the submit button after 2 seconds
            timeoutId = setTimeout(function() {
                submitButton.style.display = 'none';
            }, 5000); // 2000 milliseconds = 2 seconds
        });

        // Prevent form submission when pressing Enter key
        form.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });

        // Hide the submit button if the form is submitted
        form.addEventListener('submit', function(event) {
            // Prevent the form submission if the button is not visible
            if (submitButton.style.display === 'none') {
                event.preventDefault();
            } else {
                if (timeoutId !== null) {
                    clearTimeout(timeoutId);
                }
                submitButton.style.display = 'none';
            }
        });
    });
    </script>



    <!-- <script>
    function openFileViewers(files) {
        // Path to your PDF and DOCX files directory
        var filePath = '';
        var fileUrl = filePath + files;

        var fileExtension = files.split('.').pop().toLowerCase();
        var viewerUrl = '';

        if (fileExtension === 'pdf') {
            viewerUrl = fileUrl;
        } else if (fileExtension === 'docx') {
            viewerUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent(fileUrl);
        } else {
            alert('Unsupported file type.');
            return;
        }

        // Set the source of the iframe
        var iframe = document.getElementById('fileViewerS');
        iframe.src = viewerUrl;

        // Show the modal
        $('#fileModals').modal('show');
    }
    </script> -->

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
        fetch(`http://localhost/user/fullpaper1/fullpaperapi.php?action=getFileInformation&uname=${uname}`)
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

    <script>
    function openEditModal(id) {
        // Use AJAX to fetch the data based on the ID
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_patient.php?id=' + id, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                // Populate the form fields in the modal
                document.querySelector('input[name="firstname"]').value = data.firstname;
                document.querySelector('input[name="lastname"]').value = data.lastname;
                document.querySelector('input[name="diagnosis"]').value = data.diagnosis;
                document.querySelector('input[name="dateofbirth"]').value = data.dateofbirth;
                document.querySelector('input[name="address"]').value = data.address;
                document.querySelector('input[name="date"]').value = data.date;
                document.querySelector('input[name="contact"]').value = data.contact;
                document.querySelector('img').src = data.picture; // Display current picture
                document.querySelector('input[name="log_id"]').value = data.log_id;

                // Show the modal
                $('#pdfModalss').modal('show');
            } else {
                alert('Error fetching data');
            }
        };
        xhr.send();
    }
    </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toolbar-button');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Example action - replace with your desired functionality
                alert('Button clicked!');
            });
        });
    });
</script>


</body>

</html>
