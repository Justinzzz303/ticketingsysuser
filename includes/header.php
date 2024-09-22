<?php 
// Start the session
session_start();

// Include database connection
require_once('../USERPG/includes/helper.php');

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // User is logged in
    $logged_in = true;
    $username = $_SESSION['username'];

    $uid = $_SESSION['uid']; // Assuming you store user ID in session
    $sql = "SELECT * FROM user WHERE uid = $uid";
    $result = mysqli_query($conn, $sql);
    // Check if user exists
    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // Redirect with an error message if user not found
        $_SESSION['error'] = "User not found.";
        header("Location: index.php");
        exit();
    }
} else {
    // User is not logged in
    $logged_in = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../USERPG/css/home.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <title>HOME</title>
</head>
<body>
<div class="nav">
    <div class="nav-pic"></div>
    <div class="nav-option">
        <?php if($logged_in): ?>
            <a href="index.php">HOME</a>
            <a href="index.php#aboutus">ABOUT US</a>
            <a href="index.php#ticket">TICKET</a>
        </div>
        <div class="dropdown">
            <button class="dropbtn" style="text-transform: uppercase;"><?php echo $user['username']?></button>
            <div class="dropdown-content">
                <a href="my-profile.php">MY PROFILE</a>
                <a href="my-booking.php">MY BOOKING</a>
                <a href="logout.php">LOG OUT</a>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php">HOME</a>
        <a href="index.php#aboutus">ABOUT US</a>
        <a href="index.php#ticket">TICKET</a>
        <a href="login.php">LOGIN</a>
    <?php endif; ?>
    </div>
</div>
</body>
</html>
