<?php
include('extension/connect.php');
?>
<?php
    
    if (!isset($_SESSION['userid'])) {

    }else{
        header("location:dashboard");
    }
?>
<?php
$status = '';
if (isset($_POST['login'])) {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_pass = mysqli_real_escape_string($con, $_POST['user_pass']);

    if ($user_name != '' && $user_pass != '') {
        $query = mysqli_query($con, "SELECT * FROM users WHERE user_name='$user_name' AND user_pass='$user_pass' AND (user_rank!='normal' OR user_rank!='export')");
        $num_rows = mysqli_num_rows($query);

        if ($num_rows > 0) {
            session_start();
            $_SESSION['id'] = session_id();
            $qry = mysqli_fetch_array($query);
            $user_id = $qry['user_id'];
            $_SESSION['userid'] = $user_id;
            $_SESSION['login_type'] = "users";

            echo "<script>window.location.href = 'dashboard';</script>";
        } else {
            $status = '<div class="alert alert-warning">Login Failed: Invalid username or password</div>';
        }
    } else {
        $status = '<p class="mt-20 mb-0 text-danger">Please fill out all forms</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login - TB DOTS</title>
</head>
<body>
    <div class="login-container">
        <h2>Sign in to TB DOTS.</h2>
        <p>Enter your details below</p>
        
        <small style="color:red"><?php echo $status; ?></small>  
        <form method="post">
        <div class="input-group"> 
    <span class="input-icon">
        <img src="/img/username-icon.png" alt="Username Icon">
    </span>
    <input type="text" id="user_name" name="user_name" placeholder="Username" required>
</div>

            <div class="input-group">
                <span class="input-icon">
                    <img src="/img/password-icon.png" alt="Password Icon">
                </span>
                <input type="password" id="user_pass" name="user_pass" placeholder="Password" required>
            </div>
            <div class="actions">
                <a href="#" class="forgot-password">Forgot Password?</a>
                <button type="submit" name="login" class="login-button">Log in</button>
            </div>
        </form>
        <!-- <div class="social-login">
            <p>Sign in with Social Account</p>
            <button class="social-button facebook">Log in with Facebook</button>
            <button class="social-button google">Sign in with Google</button>
        </div> -->
        <a href="register.php" class="create-account">Create new Account</a>
    </div>
</body>
</html>
