<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('extension/connect.php');

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function username_check($user_name) {
    global $con;

    // Check if the username is in email format
    if (!is_valid_email($user_name)) {
        return false;
    }

    $query = mysqli_query($con, "SELECT * FROM users WHERE user_name='$user_name'");
    if (mysqli_num_rows($query) > 0) {
        return false; // Username already exists
    } else {
        return true; // Username is available
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

$status = ''; 
if (isset($_POST['register'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($con, $_POST['username']);
    $user_pass = mysqli_real_escape_string($con, $_POST['password']);
    $re_pass = mysqli_real_escape_string($con, $_POST['re_password']);
    $bray = mysqli_real_escape_string($con, $_POST['bray']);
    $picture = $_FILES['picture'];
    $auth_pass = md5($user_pass);

    // Check if passwords match
    if ($user_pass !== $re_pass) {
        $status = '<div class="alert alert-warning">Passwords do not match.</div>';
    } else {
        $kwery = mysqli_query($con, "SELECT maintenance FROM admin");
        $rows_kwery = mysqli_fetch_array($kwery);
        $maintenance_mode = $rows_kwery['maintenance'];

        if ($maintenance_mode == 0) {
            if (is_valid_email($user_name)) { // Check if the username follows email format
                if ($user_pass != '') {
                    if (username_check($user_name)) {
                        // Upload picture
                        $target_dir = "uploads/pictures/";
                        $imageFileType = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
                        $target_file = $target_dir . time() . '.' . $imageFileType;
                        $uploadOk = 1;

                        // Check if image file is a actual image or fake image
                        $check = getimagesize($picture["tmp_name"]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $status = '<div class="alert alert-warning">File is not an image.</div>';
                            $uploadOk = 0;
                        }

                        // Check if file already exists (not necessary with timestamp-based naming)
                        // Check file size
                        if ($picture["size"] > 500000) {
                            $status = '<div class="alert alert-warning">Sorry, your file is too large.</div>';
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif") {
                            $status = '<div class="alert alert-warning">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $status .= '<div class="alert alert-danger">Sorry, your file was not uploaded.</div>';
                        } else {
                            if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                                // Insert user data into the database
                                $query = mysqli_query($con, "INSERT INTO users(`full_name`, `user_name`, `user_pass`, `user_encryptedPass`, `bray`, `user_status`, `picture`) VALUES ('$full_name', '$user_name', '$user_pass', '$auth_pass', '$bray', 'notsubmitted', '$target_file')");

                                if ($query) {
                                    // Send email notification
                                    $subject = 'Registration Confirmation';
                                    $message = 'Thank you for registering on our website. Your account is waiting for approval.';
                                    if (send_email_notification($user_name, $subject, $message)) {
                                        // Email sent successfully
                                        $status = '<div class="alert alert-success">Registration successful! An email has been sent to your email address.</div>';
                                    } else {
                                        // Failed to send email
                                        $status = '<div class="alert alert-warning">Registration successful, but failed to send confirmation email.</div>';
                                    }
                                } else {
                                    $status = '<div class="alert alert-danger">Registration failed. Please try again later.</div>';
                                }
                            } else {
                                $status .= '<div class="alert alert-danger">Sorry, there was an error uploading your file.</div>';
                            }
                        }
                    } else {
                        $status = '<div class="alert alert-warning">Username already exists. Please choose a different username.</div>';
                    }
                } else {
                    $status = '<div class="alert alert-warning">Please enter a password.</div>';
                }
            } else {
                $status = '<div class="alert alert-warning">Invalid email format.</div>';
            }
        } else {
            $status = '<div class="alert alert-warning">The website is currently under maintenance. Registration is not allowed.</div>';
        }
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Register - TB DOTS</title>
</head>
<body>
    <div class="login-container">
        <h2>Create Your Account</h2>
        <p>Enter your details below</p>
        
        <small style="color:red"><?php echo $status; ?></small>  
        <form method="post" enctype="multipart/form-data">
            <div class="input-group"> 
                <span class="input-icon">
                    <img src="/img/username-icon.png" alt="Full Name Icon">
                </span>
                <input type="text" id="full_name" name="full_name" placeholder="Full Name" required>
            </div>

            
            <div class="input-group">
                <span class="input-icon">
                    <img src="data:image/png;base64,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" alt="Barangay Icon">
                </span>
    
    <select name="bray" required>
        <option value="" disabled selected>Select your barangay</option>
        <?php
        // Populate the dropdown options with barangays from the database
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['barangay_name'] . "'>" . $row['barangay_name'] . "</option>";
        }
        ?>
    </select>
</div>





            <div class="input-group"> 
                <span class="input-icon">
                    <img src="data:image/png;base64,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" alt="Email Icon">
                </span>
                <input type="email" id="username" name="username" placeholder="Email" required>
            </div>

            <div class="input-group"> 
                <span class="input-icon">
                    <img src="/img/password-icon.png" alt="Password Icon">
                </span>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group"> 
                <span class="input-icon">
                    <img src="/img/password-icon.png" alt="Re-enter Password Icon">
                </span>
                <input type="password" id="re_password" name="re_password" placeholder="Re-enter Password" required>
            </div>

            <div class="input-group"> 
                <span class="input-icon">
                    <img src="data:image/png;base64,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" alt="Profile Picture Icon">
                </span>
                <input type="file" id="picture" name="picture" required>
            </div>

            <div class="actions">
                <button type="submit" name="register" class="login-button">Create Account</button>
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
