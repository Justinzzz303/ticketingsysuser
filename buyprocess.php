<?php 
require_once('../USERPG/includes/helper.php');
session_start();

// Check if user is logged in
if(isset($_SESSION['uid']) && isset($_SESSION['username'])) {
    // User is logged in
    $userId = $_SESSION['uid'];

    // Check if form data is received
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $eventId = $_POST['eventId'];
        $quantity = $_POST['quantity'];

        // Validate input
        if(!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity < 1) {
            // Invalid quantity
            echo "Invalid quantity.";
            exit();
        }

        // Fetch event details from the database based on the event ID
        $sql = "SELECT eid, ename, eprice, eqty FROM event WHERE eid = $eventId";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            $eid = $event['eid'];
            $eventName = $event['ename'];
            $eventPrice = $event['eprice'];
            $availableTickets = $event['eqty'];

            // Check if requested quantity is available
            if($quantity > $availableTickets) {
                echo "Sorry, only $availableTickets tickets are available for $eventName.";
                exit();
            }
         
            
            // Calculate total price
            $totalPrice = $quantity * $eventPrice;
            $bstatus='completed';
            $stm=$conn->prepare("insert into booking(userID,eventID,bstatus,bqty,btotalprice)
            values(?,?,?,?,?)");
            $stm->bind_param("iisis",$userId,$eventId,$bstatus,$quantity,$totalPrice);
            $stm->execute();  
            // Update database (reduce available tickets)
            $newAvailableTickets = $availableTickets - $quantity;
            $updateSql = "UPDATE event SET eqty = '$newAvailableTickets' WHERE eid ='$eid'";
            $updateResult = $conn->query($updateSql);

            if (!$updateResult) {
                die("Query Failed: " . $conn->error);
            } else {
                // Redirect to a relevant page
                echo '<strong>Booking successful!!</strong>';
                header("refresh:2;url=index.php"); // Redirect after 2 seconds
                exit();
            }
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
