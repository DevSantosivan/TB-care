<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$status = '';
$teacher_id = $_SESSION['userid'];

$status = '';

if(isset($_POST['action_a'])){
    $u = mysqli_real_escape_string($con, $_POST['action_u']);
    
    if($_POST['action_a'] == 'delete'){
        // Delete user from users table
        $delete_user_query = mysqli_query($con, "DELETE FROM users WHERE user_id='$u'");
        if($delete_user_query) {
            // Send email notification
            $user_email_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$u'");
            $user_row = mysqli_fetch_assoc($user_email_query);
            $user_email = $user_row['user_name'];
 
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                $subject = 'Account Deleted';
                $message = 'Your account has been deleted. If you have any questions, please contact support.';
                send_email_notification($user_email, $subject, $message);
            }
            
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User deleted successfully. Email notification sent.
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
    } elseif($_POST['action_a'] == 'approved'){
        // Approve user
        $update_query = mysqli_query($con, "UPDATE users SET is_active=1 WHERE user_id='$u'");
        if($update_query) {
            // Check if user's username is an email address
            $user_email_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$u'");
            $user_row = mysqli_fetch_assoc($user_email_query);
            $user_email = $user_row['user_name'];
            
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                // If the username is an email address, send email notification
                $subject = 'Account Approved';
                $message = 'Congratulations! Your account has been approved. You can now log in and access your account.';
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
    }elseif($_POST['action_a'] == 'declined'){
        // Approve user
        $update_query = mysqli_query($con, "UPDATE users SET is_active=2 WHERE user_id='$u'");
        if($update_query) {
            // Check if user's username is an email address
            $user_email_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_id='$u'");
            $user_row = mysqli_fetch_assoc($user_email_query);
            $user_email = $user_row['user_name'];
            
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                // If the username is an email address, send email notification
                $subject = 'Account Declined';
                $message = 'Your account has been Declined. If you have any questions, please contact support.';
                if (send_email_notification($user_email, $subject, $message)) {
                    // Email sent successfully
                    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                    User Declined  
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
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_notification($to, $subject, $message) {
    // Configure your SMTP settings here
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = '587'; // or 465 for SSL
    $smtp_username = 'tbcare926@gmail.com';
    $smtp_password = 'wsmjeyfpnewlrezu';
    // Load PHPMailer library
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    // Create a PHPMailer object
    $mail = new PHPMailer();

    // Enable SMTP
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = 'tls'; // or 'ssl' for SSL
    $mail->Port       = $smtp_port;

    // Set From, To, Subject, and Body
    $mail->setFrom($smtp_username, 'TB-CARE');
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
    width: 100px;
    height: 100px;
    border-radius: 40%;
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
    right: 10px;
}

.patient-actions {
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

.status-approved {
    color: green;
    font-weight: bold;
}

.status-pending {
    color: red;
    font-weight: bold;
}


.status-declined {
    color: orangered;
    text-shadow:
        1px 1px 0 #000,
        -1px -1px 0 #000,
        1px -1px 0 #000,
        -1px 1px 0 #000;
    /* Black stroke effect */
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
                                <h4 class="mb-0">BHW LIST</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">


                                    <!-- <li class="breadcrumb-item"><a href="#" class="default-color"><button
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

                    <div class="grid-container">

                        <?php
 
// Define the mapping function for status search
function getStatusValue($status) {
    if (strtolower($status) === 'approved') {
        return 1;
    } elseif (strtolower($status) === 'pending') {
        return 0;
    } elseif (strtolower($status) === 'declined') {
        return 2;
    }
    return -1; // Invalid status
}

$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$i = 1;

// Check if the search query matches a status
$statusValue = getStatusValue($searchQuery);

// If the status is valid, include it in the query
if ($statusValue >= 0) {
    // Add an additional condition to ensure `is_active` is either 0 or 1, and exclude 2
    $query = mysqli_query($con, "SELECT * FROM users WHERE (full_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') AND is_active IN (0, 1) AND user_rank != 'superadmin'");
} else {
    // Exclude users with is_active = 2 and filter by search query and user rank
    $query = mysqli_query($con, "SELECT * FROM users WHERE (full_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') AND is_active IN (0, 1) AND user_rank != 'superadmin'");
}

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['user_id'];
        $full_name = $row['full_name'];
        $is_active = $row['is_active'];
        $user_name = $row['user_name'];
        $picture = $row['picture'];
        $comment_count = $row['comment_count'];
        $bray = $row['bray'];

        if ($is_active == 0) {
            $status = "pending";
        } elseif ($is_active == 1) {
            $status = "approved";
        } elseif ($is_active == 2) {
            $status = "declined";
        } else {
            $status = "unknown"; // Optional: Handle unexpected values
        }
        ?>

                        <div class="grid-item">
                            <img src="<?php echo htmlspecialchars($picture); ?>" alt="User Picture"
                                class="user-picture">
                            <div class="user-info">
                                <p style="color: blue; font-weight: bold;"><?php echo htmlspecialchars($user_name); ?>
                                </p>
                                <p style="color: blue; font-weight: bold;"><?php echo htmlspecialchars($bray); ?>
                                </p>
                                <p>BHW</p>
                                <p
                                    class="<?php echo $status === 'approved' ? 'status-approved' : ($status === 'pending' ? 'status-pending' : 'status-declined'); ?>">
                                    <?php echo htmlspecialchars($status); ?>
                                </p>
                            </div>
                            <div class="patient-action">
                                <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php if ($is_active == 0) { ?>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="submitForm('approved', '<?php echo $id; ?>')">Approve</a>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="submitForm('declined', '<?php echo $id; ?>')">Decline</a>
                                    <?php } elseif ($is_active == 1 || $is_active == 2) { ?>
                                    <!-- <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="openModal('<?php echo $id; ?>')">Delete</a> -->
                                    <form method="post" action="chat.php">
                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                                        <button type="submit" class="btn btn-primary btn-sm">CHAT NOW</button>
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="patient-actions">
                                <?php
                // Fetch the comment count for the current user in the loop
                $comment_count_query = mysqli_query($con, "SELECT comment_count FROM users WHERE user_id = '$id'");

                // Check if query was successful
                if ($comment_count_query) {
                    $row = mysqli_fetch_assoc($comment_count_query);
                    $comment_count = $row['comment_count'];

                    // Display the badge if there are new comments
                    if ($comment_count > 0) {
                        echo '<span class="badge badge-danger">' . $comment_count . '</span>';
                    }
                }
                ?>
                            </div>
                        </div>

                        <?php
    }
} else {
    echo '<p>No records found.</p>';
}
?>





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
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
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




                    </div>


                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
