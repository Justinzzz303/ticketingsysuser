<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
require_once('../USERPG/includes/helper.php');

// Retrieve user information from the database
$uid = $_SESSION['uid']; // Assuming you store user ID in session
$sql = "SELECT * FROM user WHERE uid = $uid";
$result = mysqli_query($conn, $sql);

// Check if user exists
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Redirect with an error message if user not found
    $_SESSION['error'] = "User not found.";
    header("Location: index.php");
    exit();
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve input from form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $oldpassword = $user['password'];

    // Basic form validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: editpassword.php");
        exit();
    }

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        header("Location: editpassword.php");
        exit();
    }

    // Check if current password matches the one in the database
    if ($current_password !== $oldpassword) {
        $_SESSION['error'] = "Incorrect current password.";
        header("Location: editpassword.php");
        exit();
    }
    if (strlen($new_password) < 8) {
       
        $_SESSION['error'] ="Password must be at least 8 characters long";
        header("Location: editpassword.php");
        exit();
    }

    // Update the password in the database
    $sql = "UPDATE user SET password ='$confirm_password' WHERE uid = $uid";
    $update_result = mysqli_query($conn, $sql);

    if ($update_result) {
        // Redirect with a success message if update successful
        $_SESSION['success'] = "Password updated successfully.";
        header("Location: my-profile.php");
        exit();
    } else {
        // Redirect with an error message if update failed
        $_SESSION['error'] = "Failed to update password.";
        header("Location: editpassword.php");
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../USERPG/css/editpassword.css" rel="stylesheet" type="text/css">
    <title>Change Password</title>



</head>
<body>

    <form method="post">

    <div class="header">
        <div class="hleft">
            <div class="back"><a href="index.php"> < BACK TO HOME</a></div>
        </div>
        <div class="hright"></div>
    </div>

<div class="panel">
        <div class="pleft">

            <div class="profile">
                <div class="content"><a href="my-profile.php">MY Profile</a></div>
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

                    <div class="error">
                        <?php 
                        // Display error message if present in session
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']); // Remove error message from session
                        }
                        ?>
                    </div>

                    <div class="text">Current Password:
                        <input type="password" id="current_password" name="current_password" placeholder="Current Password" required>
                    </div>
                    <div class="text">New Password:
                        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                    </div>
                    <div class="text">Confirm Password:
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="text">
                        <button type="submit">Confirm</button>
                    </div>

                </div>
            </div>
    
        </div>

    </form>

</body>
</html>
