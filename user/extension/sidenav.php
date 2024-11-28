<?php
    $rank_check = mysqli_query($con,"select user_rank from users where user_id='$userid'");
    $myrank = mysqli_fetch_array($rank_check);
    $user_rank = $myrank['user_rank'];

    $rank_checks = mysqli_query($con,"select user_status from users where user_id='$userid'");
    $mystatus = mysqli_fetch_array($rank_checks);
    $user_status = $mystatus['user_status'];
?>
<?php

// Get today's date
$today = date('Y-m-d');

// Query to count appointments with status 1 for new appointments (today)
$query_new_appointment = mysqli_query($con, 
    "SELECT COUNT(*) as count FROM patient 
     WHERE appointmentstatus = 1 
     AND appointmentdate = '$today'"
);

$new_appointment_count = 0;
if ($query_new_appointment) {
    $row = mysqli_fetch_assoc($query_new_appointment);
    $new_appointment_count = $row['count'];
} else {
    echo "Error: " . mysqli_error($con);
}



// Query to count appointments with status 2 for rescheduled appointments (today)
$query_rescheduled_appointment = mysqli_query($con, 
    "SELECT COUNT(*) as count FROM patient 
     WHERE appointmentstatus = 2 
     AND appointmentdate = '$today'"
);

$rescheduled_appointment_count = 0;
if ($query_rescheduled_appointment) {
    $row = mysqli_fetch_assoc($query_rescheduled_appointment);
    $rescheduled_appointment_count = $row['count'];
} else {
    echo "Error: " . mysqli_error($con);
}
?>

<?php
// Define the desired is_active status (e.g., 1 for another specific user status)
$is_active_status = 0;

// Query to count users with the specified is_active status and normal rank
$total_users_query = mysqli_query($con, "SELECT COUNT(*) AS total_users FROM users WHERE is_active = $is_active_status AND user_rank='normal'");

// Check if query was successful
if ($total_users_query) {
    // Fetch the total count
    $row = mysqli_fetch_assoc($total_users_query);
    $total_users_count = $row['total_users'];
 
}
?>
<?php
// Query to check if any medicine is low in stock (below 100)
$comment_countQuery = mysqli_query($con, "SELECT COUNT(*) as comment_count FROM users WHERE comment_count > 0");
$comment_countResult = mysqli_fetch_assoc($comment_countQuery);
$comment_count = $comment_countResult['comment_count'];
?>

<?php
// Query to check if any medicine is low in stock (below 100)
$lowStockQuery = mysqli_query($con, "SELECT COUNT(*) as lowStockCount FROM inventory WHERE total < 100");
$lowStockResult = mysqli_fetch_assoc($lowStockQuery);
$lowStockCount = $lowStockResult['lowStockCount'];
?>

<?php
// Get today's date
$today = date('Y-m-d');

// Query to count appointments with status 1, 2, or 3 that match today's date
$query_count = mysqli_query($con, 
    "SELECT COUNT(*) as count FROM patient 
     WHERE appointmentstatus IN (1, 2, 3) 
     AND appointmentdate = '$today'"
);

$appointment_count = 0;
if ($query_count) {
    $row = mysqli_fetch_assoc($query_count);
    $appointment_count = $row['count']; // The appointment count for today
} else {
    echo "Error: " . mysqli_error($con);
}

?>




<!-- Left Sidebar start-->

<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <!-- menu item Dashboard-->
            <li>
                <span class="right-nav-text">
                    <div align="center">
                        <img src="https://img.sikatpinoy.net/images/2024/07/27/image.png" height="120" width="120">
                        <p style="color:white">Nurse. Francis Albert F. Galindo<br>
                            Head Nurse
                        </p>
                    </div>
                </span>
            </li>

            <?php if($user_rank == 'superadmin' ){ ?>

            <li>
                <a href="dashboard">
                    <img src="https://img.sikatpinoy.net/images/2024/07/25/image.png" alt="Dashboard Image" height="20"
                        width="20"> Dashboard
                </a>
            </li>



            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Patient"><img
                        src="https://img.sikatpinoy.net/images/2024/09/01/image.png" alt="Dashboard Image" height="20"
                        width="20">Patient record <div class="pull-right"><i class="ti-plus" style="color:black"></i>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <ul id="Patient" class="collapse">
                    <li>
                        <a href="alll">
                            <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png"
                                alt="Dashboard Image" height="20" width="20">
                            All

                        </a>
                    </li>

                    <li>
                        <a href="newpat">
                            <img src="https://img.sikatpinoy.net/images/2024/07/25/image3677a3c5e7aaff58.png"
                                alt="Dashboard Image" height="20" width="20">
                            New Patient
                        </a>
                    </li>
                    <li>
                        <a href="Returnee">
                            <img src="https://img.sikatpinoy.net/images/2024/07/26/image1f7196bb80c711a7.png"
                                alt="Dashboard Image" height="20" width="20">
                            Returnee
                        </a>
                    </li>
                    <li>
                        <a href="Relapse">
                            <img src="https://img.sikatpinoy.net/images/2024/07/26/imagef3b27e33f1ba47a1.png"
                                alt="Dashboard Image" height="20" width="20">
                            Relapse
                        </a>
                    </li>
                    <li>
                        <a href="ppu">
                            <img src="https://img.sikatpinoy.net/images/2024/07/26/image50519e181c3cf766.png"
                                alt="Dashboard Image" height="20" width="20">
                            Patient Treatment<br>
                            Progress Update
                        </a>
                    </li>
                    <li>
                        <a href="Complete">
                            <img src="https://img.sikatpinoy.net/images/2024/07/26/image013b308c941114b1.png"
                                alt="Dashboard Image" height="20" width="20">
                            Complete
                        </a>
                    </li>

                </ul>
            </li>
            <!-- <li>
                <a href="patientrecord">
                    <img src="https://img.sikatpinoy.net/images/2024/07/25/imagec7306153321acd42.png"
                        alt="Dashboard Image" height="25" width="25"
                        style="filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(100%) contrast(100%);">
                    Patient Record
                </a>
            </li> -->

           
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Appointment"><img
                        src="https://img.sikatpinoy.net/images/2024/07/25/imagef3ae707b1077bab2.png"
                        alt="Dashboard Image" height="20" width="20">Appointment <?php if($appointment_count > 0) { ?>
                            <span class="badge badge-danger"><?php echo $appointment_count; ?></span>
                            <?php } ?><div class="pull-right"><i
                            class="ti-plus" style="color:black"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="Appointment" class="collapse">
                    <li>
                        <a href="appointments">
                            <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png"
                                alt="Dashboard Image" height="20" width="20">
                            All

                        </a>
                    </li>

                    <li>
    <a href="newapp">
        <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png"
            alt="Dashboard Image" height="20" width="20">
        New Appointment 
        <?php if ($new_appointment_count > 0) { ?>
            <span class="badge badge-danger"><?php echo $new_appointment_count; ?></span>
        <?php } ?>
    </a>
</li>

<li>
    <a href="appointmentresched">
        <img src="https://img.sikatpinoy.net/images/2024/08/03/imaged2a91f0a251cc805.png"
            alt="Dashboard Image" height="20" width="20">
        Reschedule 
        <?php if ($rescheduled_appointment_count > 0) { ?>
            <span class="badge badge-danger"><?php echo $rescheduled_appointment_count; ?></span>
        <?php } ?>
    </a>
</li>
                    <li>
                        <a href="cancel">
                            <img src="https://img.sikatpinoy.net/images/2024/08/03/imaged7685df44de19caf.png"
                                alt="Dashboard Image" height="20" width="20">
                            Cancel
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="apatient">
                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png"
                        alt="Dashboard Image" height="20" width="20"> Add Patient
                </a>
            </li>
            <li>
                <a href="inv">
                    <img src="https://img.sikatpinoy.net/images/2024/09/01/image51c852a537c34b6a.png"
                        alt="Dashboard Image" height="20" width="20">
                    Inventory
                    <img src="https://img.sikatpinoy.net/images/2024/09/20/image-removebg-preview-4.png"
                        alt="Low Stock Icon" class="low-stock-icon" height="20" width="20"
                        style="margin-left: 5px; <?php echo $lowStockCount > 0 ? '' : 'display: none;'; ?>">
                </a>
            </li>
            <li>
                <a href="barangay">
                    <img src="data:image/png;base64,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"
                        alt="Dashboard Image" height="20" width="20">
                    Barangay List
                </a>
            </li>

            <?php } ?>
            <?php if($user_rank == 'normal' ){ ?>

            <li>
                <a href="dashboard">
                    <img src="https://img.sikatpinoy.net/images/2024/07/25/image.png" alt="Dashboard Image" height="20"
                        width="20"> Dashboard
                </a>
            </li>
            <li>
                <a href="ppu">
                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image50519e181c3cf766.png"
                        alt="Dashboard Image" height="20" width="20">
                    Patient Treatment<br>
                    Progress Update
                </a>
            </li>
            <li>
                <a href="Complete">
                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image013b308c941114b1.png"
                        alt="Dashboard Image" height="20" width="20">
                    Complete
                </a>
            </li>

            <li>
                <a href="apatient">
                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png"
                        alt="Dashboard Image" height="20" width="20"> Add Patient
                </a>
            </li>

            <?php } ?>
            <?php if($user_rank == 'superadmin' ){ ?>

            <!-- <li>
                <a href="userpending"><i class="ti-user"></i><span class="right-nav-text">BHW Pending </span></a>
            </li> -->

            <li>
                <a href="bhw">
                    <img src="https://img.sikatpinoy.net/images/2024/07/27/image.png" alt="Dashboard Image" height="20"
                        width="20">
                    <span class="right-nav-text"> All BHW </span>
                    <span class="badge badge-danger total-users-badge"><?php echo $total_users_count; ?></span>
                    <i class="fas fa-comments comment-icon"
                        style="color: red; font-size: 20px; margin-left: 10px; vertical-align: middle; <?php echo $comment_count > 0 ? '' : 'display: none;'; ?>"></i>
                </a>
            </li>



            <?php } ?>

            <li>
                <a href="medlist">
                    <img src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png"
                        alt="Dashboard Image" height="20" width="20"> Medication
                </a>
            </li>

            <?php if($user_rank == 'normal' ){ ?>
            <li>
                <a href="chat1"> <img src="https://img.sikatpinoy.net/images/2024/07/30/11590282.png"
                        alt="Dashboard Image" height="25" width="25"><span class="right-nav-text"> Chat Now</span></a>
            </li>

            <?php } ?>

            <!-- <li>
                <a href="change_password"><i class="ti-user"></i><span class="right-nav-text">Change Password</span></a>
            </li>

            <li>
                <a href="logout"><i class="text-danger ti-unlock"></i><span class="right-nav-text">LOGOUT</span></a>
            </li> -->
            <br> <br> <br> <br> <br> <br> <br><br><br><br>
            <?php if($user_rank == 'normal' ){ ?>

            <br> <br> <br> <br> <br> <br> <br><br><br><br>
            <?php } ?>

        </ul>


    </div>

</div>


<!-- Left Sidebar End-->
