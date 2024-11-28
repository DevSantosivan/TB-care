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
$query = mysqli_query($con, "SELECT * FROM february WHERE log_id = '$log_id'");

// Check if the query was successful and if patient exists
if($query && mysqli_num_rows($query) > 0) {
    // Fetch patient data
    $patient_data = mysqli_fetch_assoc($query);
} else {
    // Handle case where patient is not found
    echo 'Patient not found.';
    exit; // Terminate script execution
}

if (isset($_POST['d1'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $update_query = mysqli_query($con, "UPDATE february SET i1=1 WHERE log_id = '$log_id'");
    if ($update_query) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert"> Successfully updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m1'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $update_query = mysqli_query($con, "UPDATE february SET i1=2 WHERE log_id = '$log_id'");
    if ($update_query) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d2'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i2=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m2'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i2=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d3'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i3=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m3'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i3=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d4'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i4=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m4'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i4=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d5'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i5=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m5'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i5=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d6'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i6=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m6'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i6=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d7'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i7=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m7'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i7=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d8'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i8=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m8'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i8=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d9'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i9=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m9'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i9=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d10'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i10=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m10'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i10=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d11'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i11=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert"> Successfully updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m11'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i11=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d12'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i12=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m12'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i12=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d13'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i13=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m13'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i13=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d14'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i14=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m14'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i14=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d15'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i15=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m15'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i15=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d16'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i16=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m16'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i16=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d17'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i17=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m17'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i17=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d18'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i18=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m18'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i18=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d19'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i19=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m19'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i19=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d20'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i20=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m20'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i20=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d21'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i21=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert"> Successfully updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m21'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i21=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d22'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i22=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m22'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);

    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i22=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d23'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i23=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m23'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i23=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d24'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i24=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m24'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i24=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d25'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i25=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m25'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i25=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d26'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i26=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m26'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i26=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d27'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i27=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m27'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i27=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d28'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i28=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m28'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i28=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d29'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i29=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m29'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i29=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d30'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i30=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m30'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i30=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['d31'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i31=1 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
    }
}elseif (isset($_POST['m31'])) {
    if (mysqli_connect_errno()) {
        $status = "Database connection failed: " . mysqli_connect_error();
        exit;
    }
    $log_id = mysqli_real_escape_string($con, $_POST['log_id']);
    $updatemonitoringQuery = mysqli_query($con, "UPDATE february SET i31=2 WHERE log_id = '$log_id'");
    if ($updatemonitoringQuery) {
        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                    Successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                   </div>';
    } else {
        $status = "Error updating the monitoring.";
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
                        <center>                    
                        <h4 class="mb-0"> MEDICATION MONITORING</h4>
                        </center>
                        <br>
                    </div>

                    <div class="card card-statistics h-100">
                        <br>
                        <center><h1> <b>FEBRUARY</h1></center>
                        <div class="content ">
                            <?php echo $status; ?>
                            <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">                            
                                <div class="user-details">
                                    <table width="98%" class="sub-table scrolldown add-doc-form-container" border="2">                                      
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>1</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d1" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m1" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i1']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i1']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i1']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>2</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d2" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m2" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i2']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i2']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i2']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>3</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d3" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m3" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i3']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i3']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i3']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>4</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d4" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m4" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i4']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i4']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i4']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>5</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d5" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m5" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i5']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i5']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i5']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>                                                                                                                                 
                                        </center>                                            
                                        </tr>
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>6</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d6" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m6" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i6']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i6']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i6']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>7</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d7" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m7" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i7']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i7']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i7']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>8</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d8" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m8" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i8']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i8']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i8']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>9</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d9" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m9" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i9']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i9']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i9']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>10</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d10" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m10" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i10']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i10']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i10']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>                                                                                                                                 
                                        </center>                                            
                                        </tr>
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>11</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d11" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m11" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i11']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i11']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i11']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>12</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d12" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m12" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i12']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i12']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i12']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>13</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d13" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m13" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i13']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i13']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i13']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>14</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d14" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m14" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i14']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i14']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i14']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>15</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d15" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m15" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i15']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i15']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i15']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>                                                                                                                                 
                                        </center>                                            
                                        </tr>
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>16</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d16" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m16" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i16']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i16']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i16']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>17</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d17" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m17" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i17']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i17']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i17']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>18</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d18" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m18" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i18']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i18']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i18']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>19</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d19" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m19" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i19']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i19']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i19']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>20</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d20" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m20" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i20']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i20']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i20']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>                                                                                                                                 
                                        </center>                                            
                                        </tr>                                                                                                                                                              
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>21</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d21" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m21" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i21']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i21']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i21']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>22</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d22" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m22" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i22']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i22']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i22']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>23</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d23" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m23" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i23']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i23']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i23']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>24</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d24" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m24" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i24']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i24']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i24']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>25</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d25" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m25" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i25']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i25']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i25']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>                                                                                                                                 
                                        </center>                                            
                                        </tr>
                                        <tr><center>                                                          
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>26</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d26" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m26" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i26']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i26']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i26']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>27</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d27" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m27" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i27']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i27']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i27']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>28</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d28" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m28" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i28']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i28']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i28']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                            <td class="label-td" style="text-align:center"  width="10%">
                                                <center>
                                                    <div class="input-box">
                                                        <span class="details"><h1><b>29</h1></span>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Status
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="color:blue">
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>" />
                                                                    <button name="d29" type="submit" class="dropdown-item">Done</button>
                                                                    <button name="m29" type="submit" class="dropdown-item">Missed</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if(htmlspecialchars($patient_data['i29']==0)){
                                                                echo $stat = "<span class='badge badge-info'>Not yet Recorded </span>";
                                                            }elseif(htmlspecialchars($patient_data['i29']==1)){
                                                                echo $stat = "<span class='badge badge-success'>Done </span>";
                                                            }elseif(htmlspecialchars($patient_data['i29']==2)){
                                                                echo $stat = "<span class='badge badge-warning'>Missed </span>";
                                                            }
                                                        ?>  
                                                    </div>
                                                </center>                                            
                                            </td>
                                                                                                                                                                                                               
                                        </center>                                            
                                        </tr>
                                    </table>  
                                </div>                       
                            </form>


                        </div>
                    </div>




                    <!--=================================
 wrapper -->

                    <!-- main content wrapper end-->
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
    <input type="hidden" id="action_u" name="log_id" /> <!-- Using log_id here -->
</form>

<script>
function submitForm(action_id, log_id) {
    document.getElementById('action_a').value = action_id;
    document.getElementById('action_u').value = log_id;  // Using log_id as expected
    document.getElementById('action_form').submit();
}
</script>



                    <?php include('extension/footer.php'); ?>
                </div>

            </div>
        </div>
    </div>

    <!--=================================
 footer -->

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
</body>

</html>
