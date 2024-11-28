<?php
    $y = mysqli_query($con,"select user_name from users where user_id='$userid'");
    $t = mysqli_fetch_array($y);
    
    $b = mysqli_query($con,"select picture from users where user_id='$userid'");
    $a = mysqli_fetch_array($b);
   
    ?>
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row"
    style="background-image: url('https://img.sikatpinoy.net/images/2024/07/26/image6b7f07f1a5e79fae.png'); background-size: cover;">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="index">
            <h1 font-weight: 900; color: <?php include('extension/theme_text.php'); ?>;">
                <?php include('extension/title.php'); ?></h1>
        </a>
        <a class="navbar-brand brand-logo-mini" id="button-toggle"
            class="button-toggle-nav inline-block ml-20 pull-left"><img
                src="https://img.sikatpinoy.net/images/2024/07/26/image.png" alt=""></a>
    </div>
     
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
   <!-- #endregion -->
   <!-- <div class="notification" id="notificationToggle">
                        <span class="notification-icon">🔔</span>
                        <span class="notification-badge">3</span>
                    </div>
                    <button id="themeToggle" class="toggle-btn" onclick="toggleDarkMode()">🌙</button> -->
        
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <img src="<?php echo $a['picture']; ?>" alt="avatar">
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">

                            <span>WELCOME, <?php echo $t['user_name']; ?></span><br>

                        </div>
                    </div>
                </div>


                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="text-danger ti-unlock"></i>Logout</a>
            </div>
        </li>
    </ul>
</nav>
