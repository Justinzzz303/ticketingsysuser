<?php require_once('../USERPG/includes/helper.php');?>
            
 
<?php
            
           require_once('../USERPG/includes/header1.php'); 
           ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
</head>
<body>
  
    <div class="ticket">
        <a name="booking"></a>
        <h1>MY BOOKINGS</h1>
        <div class="ticket-event">
            <?php
          
            // Check if user is logged in
            if(isset($_SESSION['uid']) && isset($_SESSION['username'])) {
                // Get user ID from session
                $uid = $_SESSION['uid'];

                // SQL query to fetch bookings of the logged-in user
                $sql = "SELECT bid, ename, eprice, edate, bqty, bstatus, btotalprice
                        FROM user
                        JOIN booking ON user.uid = booking.userID
                        JOIN event ON event.eid = booking.eventID
                        WHERE booking.userID = $uid";

                // Execute query
                $result = mysqli_query($conn, $sql);

                // Check if there are bookings
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="ticket-event-box">
                            <div class="ticket-event-box-left1"></div>
                            <div class="ticket-event-box-right">
                                <div class="ticket-box-right-up">
                                    <h1><?php echo htmlspecialchars($row['ename']); ?></h1>
                                    <p>Event Price: <?php echo htmlspecialchars($row['eprice']); ?></p>
                                    <p>Event Date: <?php echo htmlspecialchars($row['edate']); ?></p>
                                    <p>Purchased Quantity: <?php echo htmlspecialchars($row['bqty']); ?></p>
                                    <p>Total Price: $<?php echo htmlspecialchars($row['btotalprice']); ?></p>
                                    <p>Status: <?php echo htmlspecialchars($row['bstatus']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No Record";
                }

                // Free result and close connection
                mysqli_free_result($result);
                mysqli_close($conn);
            } else {
                echo "Please log in to view your bookings.";
            }
            ?>
        </div>
    </div>

    <?php require_once('../ADMINPG/includes/footer.php'); ?>
</body>
</html>
