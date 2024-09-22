<?php 
require_once('../USERPG/includes/helper.php');
session_start();

// Check if user is logged in
if(isset($_SESSION['uid']) && isset($_SESSION['username'])) {
    // User is logged in
    $userId = $_SESSION['uid'];
    $username = $_SESSION['username'];

    // Check if event ID is provided
    if(isset($_GET['editid'])) {
        $eventId = $_GET['editid'];

        // Fetch event details from the database based on the event ID
        $sql = "SELECT eid,ename, edescription, eqty,eprice FROM event WHERE eid =  $eventId ";
        $stmt = $conn->prepare($sql);
    
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            $eventName = $event['ename'];
            $eventDescription = $event['edescription'];
            $eventqty=$event['eqty'];
            $eventPrice = $event['eprice'];

            // Display event details and provide form for purchasing tickets
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <style>
        *{
            margin: 0;
            padding: 0;
        }

        body{
            background-color: black;
        }

        .header{
            width: 100vw;
            height: 100px;
            background-image: url(../pic/ts-logo.png);
            background-repeat: no-repeat;
            background-size: 8%;
            margin-bottom: 10px;
            color: white;
        }

       
        @font-face {
    font-family: 'Pixel'; 
    src:url('../press_start_2p/PressStart2P.ttf') format('truetype'); 
    }

    .bigbox{
        width: 100vw;
        height: 600px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .smallbox{
        width: 450px;
        height: 500px;
        border-radius: 10px;
        border: 3px solid white;
        border-image: linear-gradient(45deg,#ff5f6d,#ffc371,#ff7e5f,#c56cf0,#6a82fb,#48c6ef)1 stretch;
        animation: buycolor 3s infinite linear;
    }

    @keyframes buycolor {
    from{
        filter: hue-rotate(0deg);
    }
    to{
        filter: hue-rotate(360deg);
    }
}

    .buyticket{
        height: 60px;
        color: white;
        font-size: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
    }


    hr{
        border-image: linear-gradient(45deg,#ff5f6d,#ffc371,#ff7e5f,#c56cf0,#6a82fb,#48c6ef)1 stretch;
        animation: buycolor 3s infinite linear;
    }

    .title{
        color: white;
        font-size: 28px;
        margin-left: 10px;
        margin-top: 10px;
    }
    .introduction{
        color: white;
        font-size: 18px;
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .remaining{
        color: white;
        font-size: 18px;
        margin-left: 10px;
        margin-top: 20px;
    }

    .add{
        color: white;
        margin-left: 10px;
    }
    a{
        color: white;
    }
.qty{
    margin-top: 20px;
}

    
    .notnow{
        margin-top: 30px;
        text-align: center;
        text-decoration: underline;
    }


    </style>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Buy Tickets - <?php echo $eventName; ?></title>
                <link rel="stylesheet" href="../USERPG/css/style.css">
            </head>
<body>
<div class="header"></div>
<div class="bigbox">
    <div class="smallbox">
    <div class="buyticket">Buy Tickets</div><hr>
              
                <div class="title">Event name:<br><h2><?php echo $eventName; ?></h2></div>
                <div class="introduction"><h1><h1>Introduction:</h1><?php echo $eventDescription; ?></div><hr>
                <div class="remaining">Ticket Remaining: <?php echo $eventqty; ?>
                <div class="remaining">Price: $<?php echo $eventPrice; ?>
                </div>
             
                    <form action="buyprocess.php" method="post">
                        <input type="hidden" name="eventId" value="<?php echo $eventId; ?>">
                        <div class="qty"><label for="quantity">Quantity:</label></div>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                        <button type="button"  onclick="increaseQuantity()">+</button>
                        <button type="button"  onclick="decreaseQuantity()">-</button>
                        <button type="submit">Buy</button>
                    </form>
                    <div class="notnow"><a href="index.php">buy later , not now ? press me back to home</a></div>

                </div>
                <script>
                    function increaseQuantity() {
                        var quantityInput = document.getElementById('quantity');
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                    }

                    function decreaseQuantity() {
                        var quantityInput = document.getElementById('quantity');
                        if(parseInt(quantityInput.value) > 1) {
                            quantityInput.value = parseInt(quantityInput.value) - 1;
                        }
                    }
                </script>
            </body>
            </html>
            <?php
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Event ID not provided.";
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
