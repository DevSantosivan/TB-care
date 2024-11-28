<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php'); 
$userid = $_SESSION['userid'];
$status = '';
// Check if the log_id is provided via GET or POST
if(isset($_GET['log_id'])) {
    $log_id = $_GET['log_id'];
} elseif (isset($_POST['log_id'])) {
    $log_id = $_POST['log_id'];
} else {
    // Handle case where log ID is not provided
    echo 'Patient ID not provided.';
    exit; // Terminate script execution
}

// Fetch patient information from the database based on the log ID
$query = mysqli_query($con, "SELECT * FROM patient WHERE log_id = '$log_id'");

// Check if the query was successful and if patient exists
if($query && mysqli_num_rows($query) > 0) {
    // Fetch patient data
    $patient_data = mysqli_fetch_assoc($query);
} else {
    // Handle case where patient is not found
    echo 'Patient not found.';
    exit; // Terminate script execution
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Retrieve and sanitize form inputs
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $diagnosis = mysqli_real_escape_string($con, $_POST['diagnosis']);
    $dateofbirth = mysqli_real_escape_string($con, $_POST['dateofbirth']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $patientstatus = mysqli_real_escape_string($con, $_POST['patientstatus']);
    $tb_type = mysqli_real_escape_string($con, $_POST['tb_type']);
    $log_id = $_POST['log_id'];

    $updateQuery = "UPDATE patient SET 
        firstname = '$firstname', 
        lastname = '$lastname', 
        tb_type = '$tb_type', 
        dateofbirth = '$dateofbirth', 
        address = '$address', 
        date = '$date', 
        contact = '$contact',
         patientstatus = '$patientstatus',
        uname = '$uname'";

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
            $updateQuery .= ", picture = '$pictureUploadFile'";
        } else {
            echo '<script>
                    alert("Error uploading the picture.");
                  </script>';
            exit;
        }
    }

    // Check if a document was uploaded
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        // Define allowed document types
        $allowedDocumentExtensions = array('pdf');
        $documentExtension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);

        // Check if the document extension is allowed
        if (!in_array(strtolower($documentExtension), $allowedDocumentExtensions)) {
            echo '<script>
                    alert("Only PDF files are allowed.");
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
            $updateQuery .= ", files = '$documentUploadFile'";
        } else {
            echo '<script>
                    alert("Error uploading the document.");
                  </script>';
            exit;
        }
    }

    // Complete the update query
    $updateQuery .= " WHERE log_id = '$log_id'";

    // Execute the update query
    if (mysqli_query($con, $updateQuery)) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
        Successfully edit patient and uploaded document.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
       </button>
       <meta http-equiv="refresh" content="2; url=apatient">
      </div>';
    } else {
        echo '<script>
                alert("Error updating patient information.");
              </script>';
    }
}
?>

<?php
// Assuming you have an active database connection in $con
$query = "SELECT barangay_id, barangay_name FROM barangay";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error fetching barangay list: " . mysqli_error($con);
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
    <title><?php include('extension/title.php'); ?> | Create Reseller</title>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/davidstyles.css" />
</head>

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

        <div class="container-fluid" style="background-color:skyblue;">
            <div class="row">
                <?php include('extension/sidenav.php'); ?>

                <!-- main content wrapper start-->

                <div class="content-wrapper" style="background-color:skyblue;">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> TB-CARE</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <li class="breadcrumb-item"><a href="/" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">PATIENT UPDATE INFO</li>
                                </ol>
                            </div>
                        </div>
                    </div>




                    <div class="container">

                        <div class="content ">
                            <?php echo $status; ?>
                            <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">First Name</span>
                                        <input type="text" name="firstname"
                                            value="<?php echo htmlspecialchars($patient_data['firstname']); ?>"
                                            required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Last Name</span>
                                        <input type="text" name="lastname"
                                            value="<?php echo htmlspecialchars($patient_data['lastname']); ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="diagnostic">Diagnostic</span>
                                        <select name="tb_type" required>
                                            <option value="" disabled selected>SELECT TB TYPE</option>
                                            <option value="eptb">EPTB</option>
                                            <option value="ptb">PTB</option>
                                        </select>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Birthday</span>
                                        <input type="date" name="dateofbirth"
                                            value="<?php echo htmlspecialchars($patient_data['dateofbirth']); ?>"
                                            required>
                                    </div>

                                    <div class="input-box">
                                        <span class="details">Barangay</span>
                                        <select name="address" required>
                                            <option value="" disabled selected>Select your barangay</option>
                                            <?php
        // Populate the dropdown options with barangays from the database
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['barangay_name'] . "'>" . $row['barangay_name'] . "</option>";
        }
        ?>
                                        </select>
                                    </div>

                                    <div class="input-box">
                                        <span class="details">Date</span>
                                        <input type="date" name="date"
                                            value="<?php echo htmlspecialchars($patient_data['date']); ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Contact</span>
                                        <input type="text" name="contact"
                                            value="<?php echo htmlspecialchars($patient_data['contact']); ?>" required>
                                    </div>




                                    <?php if($user_rank == 'normal' ){ ?>
                                    <div class="input-box">
                                        <span class="details">BHW</span>
                                        <input type="text" name="uname"
                                            value="<?php echo htmlspecialchars($patient_data['uname']); ?>" readonly>
                                    </div>
                                    <?php } ?>
                                    <?php if($user_rank == 'superadmin') { ?>
                                    <div class="input-box">
                                        <span class="details">BHW</span>
                                        <select name="uname" required>
                                            <option value="" disabled selected>SELECT BHW</option>
                                            <?php
    // Modify query to fetch user_name and barangay_name
    $result1 = mysqli_query($con, "SELECT user_name, bray FROM users WHERE is_active = 1");

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            // Show both user_name and barangay_name in the dropdown
            echo "<option value='" . htmlspecialchars($row['user_name']) . "'>" . htmlspecialchars($row['user_name']) . " - " . htmlspecialchars($row['bray']) . "</option>";
        }
    } else {
        echo "<option value='' disabled>No users found</option>";
    }
    ?>
                                        </select>

                                    </div>
                                    <?php } ?>












                                    <div class="input-box">
                                        <span class="details">Picture</span>
                                        <input type="file" name="picture" id="picture" accept="image/*"
                                            onchange="previewImage(event)">
                                        <img id="picturePreview"
                                            src="<?php echo htmlspecialchars($patient_data['picture']); ?>"
                                            alt="Image Preview" style="max-width: 200px; margin-top: 10px;">
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Document (PDF only)</span>
                                        <input type="file" name="document" accept=".pdf">
                                        <iframe id="pdfViewers"
                                            src="<?php echo htmlspecialchars($patient_data['files']); ?>"
                                            style="width: 100%; height: 200px;" frameborder="0"></iframe>
                                    </div>

                                    <input type="hidden" name="log_id"
                                        value="<?php echo htmlspecialchars($patient_data['log_id']); ?>">
                                </div>

                                <br>
                                <select name="patientstatus" required>
                                    <option value="" disabled selected>SELECT PATIENT TYPE</option>
                                    <option value="1">NEW PATIENTS</option>
                                    <option value="2">RETURNE PATIENTS</option>
                                    <option value="3">RELAPSE PATIENTS</option>
                                </select><br>

                                <div class="twelve wide column" align="center">
                                    <button type="submit" name="update" class="button ml-15"
                                        style="padding: 5px 10px !important;"> UPDATE PATIENT</button>
                                </div>
                            </form>


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


    <script>
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
    </script>
    <!--=================================
 jquery -->

    <!-- Bootstrap and jQuery libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    <script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        //alert("Copied the text: " + copyText.value);
    }
    </script>
    <script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('picturePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>



</body>

</html>
