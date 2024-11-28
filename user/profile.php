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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Retrieve and sanitize form inputs
    $med2 = mysqli_real_escape_string($con, $_POST['med2']);
    $log_id = $_POST['log_id'];

    // Fetch the current values of med1, med, medin, and intense
    $currentDataQuery = mysqli_query($con, "SELECT med1, med, medin, intense FROM patient WHERE log_id = '$log_id'");
    $currentData = mysqli_fetch_assoc($currentDataQuery);

    $med1 = $currentData['med1']; // Total treatment (no changes)
    $med = $currentData['med']; // Maintenance days left
    $medin = $currentData['medin']; // Progress (completed days)
    $intense = $currentData['intense']; // Intensive days left

    // Increment medin by 1 (to track progress)
    $newMedin = $medin + 1;

    // Decrement intense if it's greater than 0
    if ($intense > 0) {
        $newIntense = $intense - 1; // Decrement intense
        $newMed = $med; // No change to med yet
    } else {
        // Once intense reaches 0, start decrementing med
        $newIntense = 0; // Intense stays at 0
        $newMed = $med - 1; // Start decrementing med
    }

    // Update query to update medin, intense, and med accordingly
    $updateQuery = "UPDATE patient SET 
        med2 = '$med2', 
        medin = '$newMedin', 
        intense = '$newIntense', 
        med = '$newMed'
        WHERE log_id = '$log_id'";

    // Execute the update query
    if (mysqli_query($con, $updateQuery)) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
           Medicated status updated successfully.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">×</span>
           </button>
            <meta http-equiv="refresh" content="0; url=profile.php?log_id=' . urlencode($log_id) . '">
          </div>';
    } else {
        echo '<script>
                alert("Error updating patient information.");
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

    <title><?php include('extension/title.php'); ?></title>

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
/* Profile Section */
.profile-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    gap: 10px;
}

.container {

    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-left {
    flex: 1;
}

.profile-right {
    flex: 2;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.user-picture {
    width: 300px;
    height: 300px;
    border-radius: 10%;
}

.info-box {
    background-color: #4faef8;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    text-align: center;
}

/* Treatment Section */
.treatment-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.treatment-box {
    background-color: #e0f7fa;
    border-radius: 10px;
    color: #000;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


.treatment-box1 {
    background-color: #e0f7fa;
    border-radius: 10px;
    color: #000;
    padding: 5px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.treatment-days {
    font-size: 48px;
    font-weight: bold;
    color: #5e35b1;
}

.treatment-label {
    font-size: 12px;
    font-weight: bold;
    color: #888;
}

/* Chart Section */
.chart-container {
    display: flex;
    justify-content: center;
    padding: 20px;
}

@media (max-width: 768px) {

    .profile-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        gap: 10px;
    }

    .container {

        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-left {
        flex: 1;
    }

    .profile-right {
        flex: 2;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .user-picture {
        width: 100px;
        height: 100px;
        border-radius: 10%;
    }

    .info-box {
        background-color: #4faef8;
        padding: 10px 20px;
        border-radius: 10px;
        color: #fff;
        font-weight: bold;
        font-size: 10px;
        text-align: center;
    }

    /* Treatment Section */
    .treatment-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 20px;
    }

    .treatment-box {
        background-color: #e0f7fa;
        border-radius: 10px;
        color: #000;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    .treatment-box1 {
        background-color: #e0f7fa;
        border-radius: 10px;
        color: #000;
        padding: 5px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .treatment-days {
        font-size: 48px;
        font-weight: bold;
        color: #5e35b1;
    }

    .treatment-label {
        font-size: 12px;
        font-weight: bold;
        color: #888;
    }

    /* Chart Section */
    .chart-container {
        display: flex;
        justify-content: center;
        padding: 20px;
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



                            <div class="profile-container">
                                <div class="profile-left">
                                    <img src="<?php echo htmlspecialchars($patient_data['picture']); ?>"
                                        alt="User Picture" class="user-picture">
                                </div>
                                <div class="profile-right">
                                    <div class="info-box"><?php echo htmlspecialchars($patient_data['firstname']); ?>
                                        <?php echo htmlspecialchars($patient_data['lastname']); ?></div>
                                    <div class="info-box"><?php echo htmlspecialchars($patient_data['diagnosis']); ?>
                                    </div>
                                    <div class="info-box">
                                        <?php echo date('F j, Y', strtotime($patient_data['dateofbirth'])); ?></div>
                                </div>
                            </div>

                            <div class="treatment-container">
                                <div class="treatment-box">
                                    <span
                                        class="treatment-days"><?php echo htmlspecialchars($patient_data['intense']); ?></span>
                                    <span class="treatment-label">Days Intensive</span>
                                </div>
                                <div class="treatment-box">
                                    <span
                                        class="treatment-days"><?php echo htmlspecialchars($patient_data['med']); ?></span>
                                    <span class="treatment-label">Days Maintenance</span>
                                </div>
                            </div>

                            <div class="treatment-box1">
                                <span
                                    class="treatment-days"><?php echo htmlspecialchars($patient_data['medguide']); ?></span>
                                <span class="treatment-label"> Capsol Per Day</span>
                            </div>

                            <div class="chart-container">
                                <!-- <canvas id="progressChart-<?php echo $patient_data['uname']; ?>"></canvas> -->

                                <canvas id="progressChart-<?php echo $patient_data['uname']; ?>" width="250"
                                    height="250"></canvas>

                            </div>

                            <div class="treatment-box">
                                <?php 
        // Ensure 'med1', 'medguide', and 'medin' exist in the array
        if (isset($patient_data['med1']) && isset($patient_data['medguide']) && isset($patient_data['medin'])) {
            $total_tablet = $patient_data['med1'] * $patient_data['medguide']; // Total tablets for entire treatment
            $completed_tablet = $patient_data['medin'] * $patient_data['medguide']; // Tablets for completed days
            $remaining_tablet = $total_tablet - $completed_tablet; // Remaining tablets

            // Ensure the remaining tablets do not go below zero
            if ($remaining_tablet < 0) {
                $remaining_tablet = 0;
            }
        } else {
            $total_tablet = 'N/A'; // Handle missing values
            $completed_tablet = 'N/A'; // Handle missing values
            $remaining_tablet = 'N/A'; // Handle missing values
        }
    ?>
                                <!-- Display remaining tablets -->
                                <span class="treatment-days"
                                    style="color:#c70683"><?php echo htmlspecialchars($remaining_tablet); ?></span>
                                <span class="treatment-label">Remaining Tablets</span>

                                <br><span class="treatment-label">
                                    <?php 
        // Calculate the remaining days by subtracting completed days (medin) from total days (med1)
        $completed_days = $patient_data['medin']; // Completed treatment days
        $total_days = $patient_data['med1']; // Total treatment days
        $remaining_days = $total_days - $completed_days; // Calculate remaining days

        // Display the message
        echo "Within the " . htmlspecialchars($total_days) . "-day treatment course, you've completed " . htmlspecialchars($completed_days) . " days so far.";

        // If treatment is complete, notify the user
        if ($completed_days >= $total_days) {
            echo "<br><span style='color:green; font-weight:bold;'>Treatment complete! No more tablets to take.</span>";
        }
    ?>
                                </span>
                            </div>

                            <br>

                            <center> <?php if ($patient_data['med1'] == 0) { ?>
                                <p style="color: red; font-weight: bold;">This is already Done Medicated</p>
                                <?php } elseif ($patient_data['med2'] == 0) { ?>
                                <form method="post" action="">
                                    <input type="hidden" name="log_id" value="<?php echo htmlspecialchars($log_id); ?>">
                                    <input type="hidden" name="med2" value="1">
                                    <!-- Set med2 to 1 when Medicated is clicked -->
                                    <button type="submit" name="update"
                                        class="btn btn-primary btn-sm">Medicated</button>
                                </form>


                                <?php } else { ?>
                                <p style="color: green; font-weight: bold;">Already Medicated Today</p>
                                <?php } ?>
                            </center>
                        </div>
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
    <!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext('2d');
    var med1 = <?php echo $patient_data['med1']; ?>; // Total treatment (100%)
    var medin = <?php echo $patient_data['medin']; ?>; // Completed treatment (progress)

    // Total treatment is 100% of med1
    var totalTreatment = med1;

    // Progress is based on medin (the number of completed days)
    var progressPercentage = (medin / totalTreatment) * 100;
    var remainingPercentage = 100 - progressPercentage;

    // Create the chart
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Progress', 'Complete'],
            datasets: [{
                data: [progressPercentage, remainingPercentage],
                backgroundColor: ['#4caf50', '#e0e0e0'] // Green for progress, grey for remaining
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', // Space in the middle
            plugins: {
                legend: {
                    display: true // Show legend
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var dataset = tooltipItem.dataset;
                            var currentValue = dataset.data[tooltipItem.dataIndex];
                            return currentValue.toFixed(2) + '%';
                        }
                    }
                }
            },
            animation: {
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                    ctx.font = "bold 30px Arial"; // Font styling
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var centerX = (chartInstance.chartArea.left + chartInstance.chartArea.right) / 2;
                    var centerY = (chartInstance.chartArea.top + chartInstance.chartArea.bottom) / 2;

                    // Display progress percentage inside the chart
                    ctx.fillText(progressPercentage.toFixed(0) + "%", centerX, centerY);
                }
            }
        }
    });
});
</script> -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext(
            '2d');
        var med1 = <?php echo $patient_data['med1']; ?>; // Total treatment (100%)
        var medin = <?php echo $patient_data['medin']; ?>; // Completed treatment (progress)

        // Total treatment is 100% of med1
        var totalTreatment = med1;

        // Progress is based on medin (the number of completed days)
        var progressPercentage = (medin / totalTreatment) * 100;
        var remainingPercentage = 100 - progressPercentage;

        // Check if progress is 100%
        var isComplete = progressPercentage >= 100;

        // Labels and colors
        var labels = isComplete ? ['Complete'] : ['Progress', 'Remaining'];
        var backgroundColors = isComplete ? ['#4caf50'] : ['#4caf50', '#e0e0e0']; // Full green when complete

        // Create the chart
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: isComplete ? [100] : [progressPercentage, remainingPercentage],
                    backgroundColor: backgroundColors // Green for progress, grey for remaining
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Space in the middle
                plugins: {
                    legend: {
                        display: true // Show legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var dataset = tooltipItem.dataset;
                                var currentValue = dataset.data[tooltipItem.dataIndex];
                                return currentValue.toFixed(2) + '%';
                            }
                        }
                    }
                },
                animation: {
                    onComplete: function() {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = "bold 15px Arial"; // Font styling
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        var centerX = (chartInstance.chartArea.left + chartInstance.chartArea
                            .right) / 2;
                        var centerY = (chartInstance.chartArea.top + chartInstance.chartArea
                            .bottom) / 2;

                        // Display progress percentage or "Complete" inside the chart
                        var displayText = isComplete ? "Complete" : progressPercentage.toFixed(0) +
                            "%";
                        ctx.fillText(displayText, centerX, centerY);
                    }
                }
            }
        });
    });
    </script>


    <!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext('2d');
    var med = <?php echo $patient_data['med']; ?>;
    var med1 = <?php echo $patient_data['med1']; ?>;

    // Calculate progress
    var progressPercentage = ((med - med1) / med) * 100;
    var remainingPercentage = 100 - progressPercentage;

    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Progress', 'Remaining'],
            datasets: [{
                data: [progressPercentage, remainingPercentage],
                backgroundColor: ['#4caf50', '#e0e0e0']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', // Create space in the middle
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var dataset = tooltipItem.dataset;
                            var currentValue = dataset.data[tooltipItem.dataIndex];
                            return currentValue.toFixed(2) + '%';
                        }
                    }
                }
            },
            animation: {
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                    ctx.font = "bold 30px Arial"; // Font styling
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var centerX = (chartInstance.chartArea.left + chartInstance.chartArea.right) / 2;
                    var centerY = (chartInstance.chartArea.top + chartInstance.chartArea.bottom) / 2;

                    // Display progress percentage inside the chart
                    ctx.fillText(progressPercentage.toFixed(0) + "%", centerX, centerY);
                }
            }
        }
    });
});

        </script> -->




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
