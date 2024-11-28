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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Get values from form
    $intense = (int)$_POST['intense'];
    $med = (int)$_POST['med'];
    $medguide = (int)$_POST['medguide'];
    $medicine_log_id = (int)$_POST['medicine']; // Medicine log_id from inventory
    $log_id = (int)$_POST['log_id']; // Patient's log_id

    // Calculate total medicines needed
    $total_medicines_needed = $medguide * ($intense + $med);

    // Fetch the selected medicine from the inventory
    $medicine_query = mysqli_query($con, "SELECT total, name FROM inventory WHERE log_id = '$medicine_log_id'");
    $medicine_data = mysqli_fetch_assoc($medicine_query);
    
    if ($medicine_data && $medicine_data['total'] >= $total_medicines_needed) {
        // Update inventory (subtract the total_medicines_needed from total)
        $new_total = $medicine_data['total'] - $total_medicines_needed;

        // Update the inventory table
        $update_inventory_query = "UPDATE inventory SET total = '$new_total', remain = '$new_total' WHERE log_id = '$medicine_log_id'";
        if (mysqli_query($con, $update_inventory_query)) {
            // Success message for inventory update
            $status .= "<div class='alert alert-success'>Inventory updated successfully! {$total_medicines_needed} {$medicine_data['name']} medicines were deducted from stock.</div>";

            // Get the name of the medicine from $medicine_data['name'] and update the patient's treatment details in the patient table
            $medicine_name = $medicine_data['name'];
            $update_patient_query = "UPDATE patient 
                                     SET med1 = '".($intense + $med)."', 
                                         intense = '$intense', 
                                         med = '$med', 
                                         medicine_name = '$medicine_name',  
                                         medguide = '$medguide', 
                                         med2 = '0', 
                                          medin = '0',
                                         treatment = '1'
                                     WHERE log_id = '$log_id'";
            if (mysqli_query($con, $update_patient_query)) {
                // Success message for patient update
                $status .= "<div class='alert alert-success'>Patient's treatment details updated successfully!</div>";

                // Optionally store medicine usage in patient_medicines table
                $insert_patient_medicine_query = "INSERT INTO patient_medicines (patient_id, medicine_log_id, quantity) 
                                                  VALUES ('$log_id', '$medicine_log_id', '$total_medicines_needed')";
                mysqli_query($con, $insert_patient_medicine_query);

            } else {
                // Error message for patient update
                $status .= "<div class='alert alert-danger'>Error updating patient's treatment details.</div>";
            }

        } else {
            // Error message for inventory update
            $status .= "<div class='alert alert-danger'>Error updating medicine in inventory.</div>";
        }

    } else {
        // Error message if not enough stock
        $status .= "<div class='alert alert-danger'>Not enough stock available for the selected medicine.</div>";
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
    <title><?php include('extension/title.php'); ?> | Add Threatment</title>

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
    height: 200px;
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
                                <img src="<?php echo htmlspecialchars($patient_data['picture']); ?>" alt="User Picture"
                                    class="user-picture">
                                <div class="user-info">
                                    <h1
                                        style="font-size: 30px; font-weight: bold; color: #a10a92; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); letter-spacing: 2px; text-transform: uppercase;">
                                        <?php echo htmlspecialchars($patient_data['firstname']); ?>
                                        <?php echo htmlspecialchars($patient_data['lastname']); ?>
                                    </h1>
                                    <form method="post" action="">

<div class="form-group">
    <label for="intense">Intensive Days Treatment</label>
    <input id="intense" name="intense" type="number" value="0" required oninput="calculateMedicines()">
</div>

<div class="form-group">
    <label for="med">Maintenance Days Treatment</label>
    <input id="med" name="med" type="number" value="0" required oninput="calculateMedicines()">
</div>

<div class="form-group">
    <label for="medguide">Medicine Guide</label>
    <input type="number" id="medguide" name="medguide" value="1" required oninput="calculateMedicines()"> 
    Times a Day
</div>

<div class="form-group">
    <label for="medicine">Select Medicine</label>
    <select name="medicine" id="medicine" required>
        <?php
        $query = mysqli_query($con, "SELECT log_id, name, total FROM inventory WHERE total > 0");
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<option value='" . $row['log_id'] . "'>" . $row['name'] . " (Available: " . $row['total'] . ")</option>";
            }
        } else {
            echo "<option value=''>No medicines available</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="medicine_amount">Number of Medicines</label>
    <input type="number" id="medicine_amount" name="medicine_amount" value="" readonly>
</div>

<!-- Hidden fields to calculate treatment details -->
<input id="med1" name="med1" type="hidden" value=""> 

<input type="hidden" name="log_id" value="<?php echo htmlspecialchars($log_id); ?>">

<button type="submit" name="update" class="btn btn-primary">SUBMIT Treatment</button>

</form>

<script>
function calculateMedicines() {
    // Get values from the form
    var intenseValue = parseInt(document.getElementById('intense').value) || 0;
    var medValue = parseInt(document.getElementById('med').value) || 0;
    var medguideValue = parseInt(document.getElementById('medguide').value) || 1;

    // Calculate the total number of medicines
    var totalMedicines = (intenseValue + medValue) * medguideValue;

    // Update the Number of Medicines field
    document.getElementById('medicine_amount').value = totalMedicines;

    // Set med1 value (sum of intensive and maintenance days)
    document.getElementById('med1').value = intenseValue + medValue;
}

// Call calculateMedicines initially to set the default value
calculateMedicines();
</script>




                                </div>
                                <div class="chart-container">
                                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image2ef05744bf65557a.png"
                                        height="200px" width="300px">

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


        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext(
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
