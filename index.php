<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexstyles.css">
    <title>TB - CARE</title>
</head>
<body>
    <div class="container">
        <div class="left-section" id="left-section">
            <img src="/img/doctor-illustration.png" alt="Doctor Illustration">
        </div>
        <div class="right-section">
            <div class="logo">
                <img src="/img/tb-care-logo.png" alt="TB Care Logo">
            </div>
            <h1>TB - CARE</h1>
            <!-- <select class="user-select" id="userSelect" onchange="showButtons()">
                <option value="" disabled selected>Select User Type</option>
                <option value="bhw">BHW</option>
                <option value="admin">Admin</option>
            </select> -->
            <div>
            <a href="user/login" class="btn">
    <img src="/img/login-icon.png" alt="Log in Icon">
    Log in
</a>

                <a href="user/register" class="btn">
                    <img src="/img/create-account-icon.png" alt="Create Account Icon">
                    Create account
                </a>
            </div>
        </div>
    </div>
    <script>
        function showButtons() {
            document.getElementById('buttons').style.display = 'flex';
            document.getElementById('userSelect').style.display = 'none';
        }
    </script>
</body>
</html>
