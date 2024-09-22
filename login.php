<?php include('../USERPG/includes/header1.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="../ADMINPG/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
 
    <div class="login-design">
        <div class="login-left">
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
        <div class="login-right">
            <div class="music-box">
                <div class="music-box-up">
                    <div class="music-box-up-left">
                        <div class="music-box-pic"></div>
                    </div>
                    <div class="music-box-up-right">
                        <form action="login2.php" method="post">
                            <div class="music-box-login">
                                <h2>Login</h2>
                                <?php if(isset($_GET['error'])) { ?>
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>    
                                <div class="user-id">
                                    <input type="text" placeholder="Username" name="username" class="same">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </div>
                                <div class="password">
                                    <input type="password" placeholder="Password" name="password" id="password" class="same">
                                    <i class="fa fa-lock" aria-hidden="true" style="height: 16px; width: 16px;"></i>
                                </div>
                                <div class="button">
                                    <button type="submit">LOGIN</button>
                                </div>
                               <div class="register">
                                    <p>Don't have an account yet? <a href="register.php">Create an account</a></p>
                               </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="music-box-down">
                    <div class="music-box-down-playlist">
                        <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span><i class="fa fa-play" aria-hidden="true"></i></span>
                        <span><i class="fa fa-minus" aria-hidden="true"></i></span>
                        <span>2.17</span>
                        <span><input type="range"></span>
                        <span>3.15</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
<?php include('../USERPG/includes/footer.php') ?>
</footer>
</html>
