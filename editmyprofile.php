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
require_once('../USERPG/includes/helper.php');

// Retrieve user information from the database
$uid = $_SESSION['uid']; // Assuming you store user ID in session
$sql = "SELECT * FROM user WHERE uid = $uid";
$result = mysqli_query($conn, $sql);

// Check if user exists
if(mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $username = $user['username'];
    $email = $user['email'];
    $phone = $user['phone'];
    $gender = $user['gender'];
} else {
    // Redirect with an error message if user not found
    $_SESSION['error'] = "User not found.";
    header("Location: index.php");
    exit();
}

// If the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated profile information from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    
    // Update the user's information in the database
    $sql = "UPDATE user SET username='$username', email='$email', phone='$phone', gender='$gender' WHERE uid=$uid";
    $update_result = mysqli_query($conn, $sql);
    
    if($update_result) {
        // Redirect with a success message if update successful
        $_SESSION['success'] = "Profile updated successfully.";
        header("Location: my-profile.php");
        exit();
    } else {
        // Redirect with an error message if update failed
        $_SESSION['error'] = "Failed to update profile.";
        header("Location: editmyprofile.php");
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
    <link href="../USERPG/css/editprofile.css" rel="stylesheet" type="text/css">
    <title>Edit Profile</title>
</head>
<body>
    <form action="" method="post">
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
                    <div class="text">User Name: <input type="text" name="username" value="<?php echo $username?>" required> </div>
                    <div class="text">Email    : <input type="email" name="email" value="<?php echo $email ?>" required></div>
                    <div class="text">Phone    : <input type="text" name="phone" value="<?php echo $phone ?>" pattern="[0-9]{10,11}" title="Please enter a valid 10 or 11-digit phone number" required></div>
                    <div class="text">Gender   :
                        <input type="radio" class="gg" name="gender" value="Male" <?php if($gender == 'Male') echo 'checked'; ?> required><span>Male</span>
                        <input type="radio" class="gg" name="gender" value="Female" <?php if($gender == 'Female') echo 'checked'; ?> required><span>Female</span>
                    </div>
                    <button type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
