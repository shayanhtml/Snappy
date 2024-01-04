<!-- Header.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php

include 'session-file.php';
include 'classes/User.php';
include 'classes/Post.php';
include 'classes/Message.php';

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} elseif ($userLoggedIn == 'admin') {
    header("Location: admin_home.php");
} else {
    header("Location: register.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link allfiles -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script>
        // < style src = "assets/js/jquery-3.5.1.min.js" > </style> 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>Snappy</title>

</head>

<style>
    i:hover {
        color: black;
        opacity: 1;
    }

    i {
        font-size: 22px;
        color: black;
        opacity: 0.6;
    }
</style>
    

    <div class="header_bar">

        <div class="left">
            <a href="index.php"><img src="images/logo.png" alt="O" style="height: 40px; width: 40px;">
            </a>
            <h1 class="animate__animated animate__heartBeat animate__infinite animate__slow">Snappy</h1>
        </div>


        <nav class=".right">

            <div class="header-icons">

                <a href="index.php"> <i class="fa-solid fa-house"></i></a>
                <a href="messages.php"><i class="fa-solid fa-envelope"></i></i></a>
                <a href="request.php"> <i class="fa-solid fa-user-plus"></i></a>
                <a href="logout.php"> <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                <div class="profile-image-box">
                    <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>
                </div>
            </div>

            <?php
            $message_obj = new Message($con, $userLoggedIn);
            $num_msg = $message_obj->getUnreadNumber();
            if ($num_msg > 0) {
                echo "
                    <div class='notification_count' style='background: red; height: 20px; width: 20px; border-radius: 50%; color: white;    display:flex; justify-content:center; align-items:center;  position: relative; margin: -30px 0px 0px 60px;'>". $num_msg ."</span></div>"; }
            ?>
        </nav>

    </div>
