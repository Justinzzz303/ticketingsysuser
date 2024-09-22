<?php require_once('../USERPG/includes/helper.php'); ?>
<?php include('../USERPG/includes/header.php') ?>
<?php 


// Fetch events from the database
$sql = 'SELECT ename, edescription, eid FROM event';
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    echo "Error fetching events: " . mysqli_error($conn);
    exit();
}

// Fetch all events
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the result and close the connection
mysqli_free_result($result);
mysqli_close($conn);
?>

<body>
    
   
    <div class="top-screen">
        <div class="top-screen-left">
            <h1>Join the Movement. Shape the Moment. Be Ts Society</h1>
            <div class="top-screen-left-button"><a href="register.php">Join Us Now</a></div>
        </div>
        <div class="top-screen-right">
            <img class="image-slide-in" src="../ADMINPG/pic/ts2.png" height="600px">
        </div>
    </div>

    <div class="about"> <a name="aboutus"></a>
        <div class="about-left"></div>
        <div class="about-right">
            <h1>Introduction TS Society</h1>
            <p>Welcome to Ts Society, an unprecedented innovative association where the zeal for sports and the passion for travel converge into one community. 
                At Ts Society, we are more than just a club; we are a collective dedicated to offering our members unparalleled experiences and adventures.</p>
            <p>Our philosophy is rooted in a simple yet powerful belief: deepening the understanding of self-challenge through sports and broadening the perception of the world through travel. 
                At Ts Society, you will discover a range of meticulously designed activities aimed at fostering personal growth, teamwork, and cultural exchange.</p>
            <p>Joining Ts Society grants you unique opportunities to explore every corner of the globe with individuals who share a love for athleticism and exploration. 
                Whether you seek thrilling adventures or aim to challenge yourself in athletic pursuits, Ts Society welcomes you with open arms.</p>
            <p>We are here waiting for you to embark on a journey where every heartbeat is filled with purpose, and every trip leaves an indelible mark. 
                Ts Society — the perfect amalgamation of sports and travel, initiating your extraordinary journey.</p>
        </div>
    </div>

    <div class="join-us">
        <h1>Benefits Of Joining Us</h1>
        <div class="join-us-benefits">
            <div class="join-us-benefits-box">
                <div class="box-left1"></div>
                <div class="box-right">
                    <h2>Unleash Adventure</h2>
                    <p>Step into a world where every activity is an adventure waiting to be unleashed.</p>
                </div>
            </div>

            <div class="join-us-benefits-box">
                <div class="box-left2"></div>
                <div class="box-right">
                    <h2>Expand Horizons</h2>
                    <p>Join us and broaden your horizons through immersive travel and sports experiences.</p>
                </div>
            </div>

            <div class="join-us-benefits-box">
                <div class="box-left3"></div>
                <div class="box-right">
                    <h2>Community Spirit</h2>
                    <p>Become a part of our vibrant community, fostering connections that last a lifetime.</p>
                </div>
            </div>

            <div class="join-us-benefits-box">
                <div class="box-left4"></div>
                <div class="box-right">
                    <h2>Personal Growth</h2>
                    <p>Grow with every challenge and triumph with the support of the Ts Society family.</p>
                </div>
            </div>
        </div>   
    </div>

    <div class="ticket"> <a name="ticket"></a>
        <h1>SHOP/BUY TICKET</h1>
        <div class="ticket-event">
            <?php foreach($events as $event): ?>
                <div class="ticket-event-box">
                    <div class="ticket-event-box-left1"></div>
                    <div class="ticket-event-box-right">
                        <div class="ticket-box-right-up">
                            <h3><?php echo htmlspecialchars($event['ename']); ?></h3>
                            <?php foreach(explode('.', $event['edescription']) as $edes): ?>
                                <p><?php echo htmlspecialchars($edes); ?></p>
                            <?php endforeach; ?>
                            <div class="ticket-box-right-down">
                                <button class="buy"><a href="buy.php?editid=<?php echo $event['eid'] ?>">Buy</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>    
    </div>

</body>
<footer>
    <?php include('../ADMINPG/includes/footer.php'); ?>
</footer>
