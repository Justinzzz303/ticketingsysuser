<?php include('../USERPG/includes/header.php') ?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $role = 'member';

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) {
        $errors[] = "Please enter a valid phone number";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        // Registration successful, insert into database
        $conn = new mysqli('localhost', 'root', '', 'ts');
        if ($conn->connect_error) {
            die('Connection Failed:' . $con->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO user(username, email, phone, password, gender, role) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $email, $phone, $password, $gender, $role);
            $stmt->execute();
            echo '<strong>Registration successful!!</strong>';
            $stmt->close();
            $conn->close();
            header("refresh:2;url=index.php"); // Redirect after 2 seconds
            exit(); // Ensure that no other code is executed after the redirect
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        *{
            margin: 0;
            padding: 0; 
        }

        .box{
            display: flex;
            width: 100vw;
            height: 100vh;
        }

        .boundaries{
            width: 15%;
            height: 100vh;
            background-color:black;
        }

        .btop{
            width: 100%;
            height: 20%;
            background-image: url(../USERPG/pic/ts-logo.png);
            background-repeat: no-repeat;
            background-size: 80%;
            background-position: center;
        }

        .bbottom{
            width: 100%;
            height: 560px;
            color:white;
            text-align: center;
        }

        h1{
            font-size: 48px;
            color: #333;
            animation: animate 4s linear infinite;
        }

        h1:nth-child(1){
            animation-delay: 0s;
        }

        h1:nth-child(2){
            animation-delay: 0.4s;
        }

        h1:nth-child(4){
            animation-delay: 1.2s;
        }

        h1:nth-child(5){
            animation-delay: 1.6s;
        }

        h1:nth-child(6){
            animation-delay: 2s;
        }
        h1:nth-child(7){
            animation-delay: 2.4s;
        }

        h1:nth-child(8){
            animation-delay: 2.8s;
        }

        h1:nth-child(9){
            animation-delay: 3.2s;
        }

        h1:nth-child(10){
            animation-delay: 3.6s;
        }

        @keyframes animate{
            0%,80%{
                color:#333;
                text-shadow: none;
            }
            100%{
                color: #fff;
                text-shadow: 0 0  10px #fff,
                             0 0  20px #fff,
                             0 0  40px #fff,
                             0 0  80px #fff,
                             0 0  120px #fff,
                             0 0  160px #fff,
            }
        }

        .smallbox{
            height: 100vh;
            width: 85%;
            display: flex;        
        }

        .left{
            width: 60%;
            height: 100%;
            background-image: url(../USERPG/pic/loginback.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 10px 0 0 10px;
        }

        .right{
            width: 40%;
            height: 100%;
            background-color:black;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rbox{
            width: 600px;
            height: 600px;
        }

        .register{
            width: 100%;
            height: 60px;
            color: white;
            text-align: center;
            line-height: 60px;
            font-size: 48px;
        }

        .user{
            text-align: center;
            margin-top: 15px;
            border-radius: 5px;
            height: 60px;
            line-height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
       
        .email{
            text-align: center;
            border-radius: 5px;
            height: 60px;
            line-height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone{
            text-align: center;
            border-radius: 5px;
            height: 60px;
            line-height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .password{
            text-align: center;
            border-radius: 5px;
            height: 60px;
            line-height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirmpassword{
            text-align: center;
            border-radius: 5px;
            height: 60px;
            line-height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .same{
            text-align: center;
            border-radius: 5px;
            width: 270px;
            height: 30px;
            box-sizing: border-box;
        }

        .user .logo{
            height: 30px;
            width: 40px;
            background-image: url(../pic/user2.png);
            background-size: contain;
            background-repeat: no-repeat;
        }

        .email .logo{
            height: 30px;
            width: 40px;
            margin-left: 1%;
            background-image: url(../pic/email.png);
            background-size: 85%;
            background-repeat: no-repeat;
        }

        .phone .logo{
            height: 30px;
            width: 40px;
            margin-left: 1%;
            background-image: url(../pic/phone.png);
            background-size: contain;
            background-repeat: no-repeat;
        }

        .password .logo{
            height: 30px;
            width: 40px;
            background-image: url(../pic/lock.png);
            background-size: 85%;
            background-repeat: no-repeat;
        }

        .confirmpassword .logo{
            height: 30px;
            width: 40px;
            background-image: url(../pic/lock.png);
            background-size: 85%;
            background-repeat: no-repeat;
        }

        .gg{
            width: 100%;
            height: 30px;
            display: flex;
            justify-content: center;
            color: white;
            font-size: 18px;
            margin-top: 20px;
        }

        .gender{
            display: flex;
            justify-content: space-between;
            width: 280px;
            height: 30px;
            line-height: 30px;
        }

        .registerbutton{
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: center;
        }

        .registerbutton input{
            width: 200px;
            height: 60px;
            border-radius: 10px;
            color: black;
            margin-top: 20px;
            font-size: 16px;
        }
        .login{
            width: 100%;
            height: 30px;
            display: flex;
            justify-content: center;
            color: white;
            font-size: 18px;
            margin-top: 40px;
        }
        a{
            text-decoration: none;
            color: white;
        }

        a:hover{
            border-bottom: 1px solid white;
        }

        .user input{
            background-image: url(../pic/user2.png);
        }

        input[type=radio]{
            accent-color: blue;
            margin-right: .4em;
        }

        input[type=text]::placeholder{
            padding-left: 10px;
        }

        input[type=email]::placeholder{
            padding-left: 10px;
        }

        input[type=number]::placeholder{
            padding-left: 10px;
        }

        input[type=password]::placeholder{
            padding-left: 10px;
        }
    </style>
</head>
<body>

<div class="box">

    <div class="boundaries">

        <div class="btop"></div>

        <div class="bbottom">
            <h1>T</h1>
            <h1>S</h1>
            <br>
            <h1>S</h1>
            <h1>O</h1>
            <h1>C</h1>
            <h1>I</h1>
            <h1>E</h1>
            <h1>T</h1>
            <h1>Y</h1>   
        </div>
    </div>

    <div class="smallbox">

        <div class="left"></div>

        <div class="right">

            <div class="rbox">
                <form action="" method="post">

                    <div class="register">
                        <h2>Registration</h2>
                    </div>

                    <div class="user">
                        <input type="text" class="same" name="username" placeholder="Username" required>
                        <div class="logo"></div>
                    </div>
                    <div class="email">
                        <input type="email" class="same" name="email" placeholder="Email" required>
                        <div class="logo"></div>
                    </div>
                    <div class="phone">
                        <input type="text" class="same" name="phone" placeholder="Phone" pattern="[0-9]{10,11}" title="Please enter a valid 10 or 11-digit phone number" required>
                        <div class="logo"></div>
                    </div>
                    <div class="password">
                        <input type="password" class="same" name="password" placeholder="Password" required>
                        <div class="logo"></div>
                    </div>
                    <div class="confirmpassword">
                        <input type="password" class="same" minlenght="8" name="confirm_password" placeholder="Confirm password" required>
                        <div class="logo"></div>
                    </div>

                    <div class="gg">
                        <div class="gender">
                            <input type="radio" name="gender" value="Male" required>Male
                            <input type="radio" name="gender" value="Female" required>Female

                        </div>
                    </div>
                    <div class="registerbutton">
                        <input type="submit" value="Register">
                    </div>

                    <div class="login">
                        <p>Already have an account? <a href="login.php">Login here.</a></p>
                    </div>
                </form>
            </div>
        </div>   
    </div>   
</div>      

</body>
<footer>
<?php include('../USERPG/includes/footer.php') ?>
</footer>
</html>
