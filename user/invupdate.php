<?php
// Include necessary extensions and session check
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php'); 
$userid = $_SESSION['userid'];
$status = '';

// Check if the log_id is provided via GET or POST
if (isset($_GET['log_id'])) {
    $log_id = $_GET['log_id'];
} elseif (isset($_POST['log_id'])) {
    $log_id = $_POST['log_id'];
} else {
    // Handle case where log ID is not provided
    $status = 'Item ID not provided.';
    exit; // Terminate script execution
}

// Fetch inventory item information from the database based on the log ID
$query = mysqli_query($con, "SELECT * FROM inventory WHERE log_id = '$log_id'");

// Check if the query was successful and if the item exists
if ($query && mysqli_num_rows($query) > 0) {
    // Fetch item data
    $inv_data = mysqli_fetch_assoc($query);
} else {
    // Handle case where the item is not found
    $status = 'Item not found.';
    exit; // Terminate script execution
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Retrieve and sanitize form inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $total = mysqli_real_escape_string($con, $_POST['total']);
    $log_id = $_POST['log_id']; // Hidden input to pass log_id

    // Update query for the `inventory` table
    $updateQuery = "UPDATE inventory SET name = '$name', total = '$total' WHERE log_id = '$log_id'";

    // Execute the update query
    if (mysqli_query($con, $updateQuery)) {
        // Success message stored in $status
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated item in inventory.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <meta http-equiv="refresh" content="2; url=inv">
                  </div>';
    } else {
        // Error message if the query fails
        $status = '<div class="alert alert-danger" role="alert">
                    Error updating item.
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
                                    <!-- <li class="breadcrumb-item"><a href="/" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">PATIENT UPDATE INFO</li> -->
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
            <span class="details">Medicine Name</span>
            <!-- Corrected input name from 'firstname' to 'name' -->
            <input type="text" name="name" value="<?php echo htmlspecialchars($inv_data['name']); ?>" required>
        </div>
        <div class="input-box">
            <span class="details">Total</span>
            <!-- Corrected input name from 'lastname' to 'total' -->
            <input type="text" name="total" value="<?php echo htmlspecialchars($inv_data['total']); ?>" required>
        </div>
    </div>

    <!-- Hidden field to pass log_id -->
    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>">

    <div class="twelve wide column" align="center">
        <button type="submit" name="update" class="button ml-15" style="padding: 5px 10px !important;">UPDATE ITEM</button>
    </div>
</form>

<!-- Display the status message if available -->



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
