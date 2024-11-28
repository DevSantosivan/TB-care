<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$status = '';

// Fetch the current user's username
$y = mysqli_query($con, "SELECT user_name FROM users WHERE user_id = '$userid'");
$t = mysqli_fetch_array($y);

// Check if the user_id is provided via GET or POST
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} elseif (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
} elseif (isset($_POST['action_u'])) {
    $user_id = $_POST['action_u'];
} else {
    echo 'User ID not provided.';
    exit; // Terminate script execution
}

// Prepare the statement to fetch user information
$stmt = $con->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful and if user exists
if ($result && $result->num_rows > 0) {
    // Fetch user data
    $users_data = $result->fetch_assoc();
} else {
    echo 'User not found.';
    exit; // Terminate script execution
}

// Handle POST request for comments
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_a'])) {
    if ($_POST['action_a'] == 'comment1') {
        $u = $_POST['action_u'];
        $customMessage = $_POST['customMessage'];
        $currentDateTime = date('Y-m-d H:i:s');

        // Retrieve the existing comment
        $existingComment = $users_data['comment'] ?? ''; // Handle null case

        // Format the current date and time
        $dateTime = new DateTime();
        $formattedDateTime = $dateTime->format('M j, Y g:i A');

        // Append the new custom message to the existing comment
        $newComment = $existingComment . "<br>[" . htmlspecialchars($t['user_name']) . "] [" . $formattedDateTime . "] " . htmlspecialchars($customMessage);

        // Prepare the statement to update the comment
        $stmt = $con->prepare("UPDATE users SET comment = ? WHERE user_id = ?");
        $stmt->bind_param('si', $newComment, $u);

        if ($stmt->execute()) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            Message sent 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                             
                        </div>';
        } else {
            $status = 'Comment submission failure';
        }
    } else {
        $status = 'Invalid action';
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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
    flex-direction: row;
    /* Default to row layout for larger screens */
    align-items: center;
    position: relative;
}

.user-picture {
    width: 250px;
    height: 250px;
    border-radius: 10%;
    margin-right: 20px;
}

.user-info {
    flex-grow: 1;
    text-align: left;

}


.user-info p {
    font-size: 0.875rem;
    margin: 2px 0;
}

.user-info h1 {
    font-size: 1.875rem;
    margin: 2px 0;
    top: 1px;
}

.chart-container {
    width: 250px;
    height: 250px;
}

@media (max-width: 768px) {
    .grid-item {
        flex-direction: column;
        /* Switch to column layout for smaller screens */
        align-items: center;
    }

    .user-picture {
        width: 150px;
        height: 150px;
        margin-bottom: 15px;
    }

    .user-info {
        text-align: center;
        margin-bottom: 15px;

    }

    .chart-container {
        width: 100%;
        /* Full width for chart on mobile */
        height: 150px;
        /* Adjust height for mobile */
        margin-top: 15px;
    }
}
</style>

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


                        </div>
                    </div>




                    <div class="container">

                        <div class="content ">
                            <?php echo $status; ?>



                            <div class="grid-item">
                                <img src="<?php echo htmlspecialchars($users_data['picture']); ?>" alt="User Picture"
                                    class="user-picture">
                                <div class="user-info">
                                    <h1
                                        style="font-size: 30px; font-weight: bold; color: #a10a92; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); letter-spacing: 2px; text-transform: uppercase;">
                                        <?php echo htmlspecialchars($users_data['full_name']); ?>
                                    </h1>
                                    <p style="font-size: 18px; margin: 10px 0; line-height: 1.5;">
                                        <span style="color: #109404; font-weight: bold;">Message:</span>
                                        <!-- Use `echo` directly to render HTML content -->
                                        <?php echo $users_data['comment']; ?>

                                    </p>

                                </div>
                            </div>

                            <form method="post" action="chat">
                                <textarea name="customMessage" id="customMessage" rows="4" cols="50"
                                    placeholder="Type your custom message"></textarea>
                                <input type="hidden" name="action_a" value="comment1">
                                <input type="hidden" name="user_id"
                                    value="<?php echo htmlspecialchars($users_data['user_id']); ?>">
                                <input type="hidden" name="action_u" value="<?php echo htmlspecialchars($user_id); ?>">
                                <!-- Correct variable name -->
                                <button type="submit" class="btn">Send Message</button>
                            </form>

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
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>')
                .getContext(
                    '2d');
            var progress = <?php echo $patient_data['progress']; ?>;

            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Progress', 'Remaining'],
                    datasets: [{
                        data: [progress, 100 - progress],
                        backgroundColor: ['#4caf50', '#e0e0e0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var dataset = tooltipItem.dataset;
                                    var currentValue = dataset.data[tooltipItem.dataIndex];
                                    return currentValue + '%';
                                }
                            }
                        },
                        legend: {
                            display: false // Hide legend if you prefer
                        },
                        datalabels: {
                            formatter: (value, context) => {
                                let percent = Math.round(value / 100 * 100);
                                return `${percent}%`;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 16
                            }
                        }
                    }
                }
            });
        });
        </script>





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