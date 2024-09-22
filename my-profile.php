<?php require_once('../USERPG/includes/helper.php'); ?>

<?php 

// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection


// Retrieve user information from the database
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


// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../USERPG/css/profile.css" rel="stylesheet" type="text/css">
    <title>My Profile</title>
</head>

    <body>
 <div class="header">
        <div class="hleft">
            <div class="back"><a href="index.php"> < BACK TO HOME</a></div>
        </div>
        <div class="hright"></div>
    </div>

<div class="panel">
        <div class="pleft">

            <div class="profile">
                <div class="content"><a href="#">MY Profile</a></div>
            </div>
            <div class="profile">
                <div class="content"><a href="editmyprofile.php">Edit Profile</a></div>
            </div>
            <div class="profile">
                <div class="content"><a href="editpassword.php">Change Password</a></div>
            </div>

        </div>
        <div class="pright">
            <div class="righttop"></div>
            <div class="rightbottom">
            <div class="text">User Name : <?php echo strtoupper($user['username']); ?></div>
            <div class="text">Email     : <?php echo $user['email']; ?></div>
            <div class="text">Phone     : <?php echo $user['phone']; ?></div>
            <div class="text">Gender    : <?php echo $user['gender']; ?></div>
    </div>
        </div>

    </div>
    
    <!-- Display other user information as needed -->

    <!-- Add a link to edit profile -->

</body>
</html>

