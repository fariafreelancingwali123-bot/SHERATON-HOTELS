<?php
$servername = "localhost";
$username = "u1fkgwiwpmjub";
$password = "mp8cjl5322br";
$dbname = "dbng3lhmczoipr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$destination = $_GET['destination'];
$checkin = $_GET['checkin'];
$checkout = $_GET['checkout'];

// Query to get hotels based on destination
$sql = "SELECT * FROM Hotels WHERE location LIKE '%$destination%'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Listings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Hotel Listings</h1>
</header>

<div class="hotel-listing">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="hotel">
            <img src="<?= $row['image']; ?>" alt="Hotel Image">
            <h2><?= $row['name']; ?></h2>
            <p><?= $row['description']; ?></p>
            <p>Rating: <?= $row['rating']; ?>/5</p>
            <a href="booking.php?hotel_id=<?= $row['id']; ?>">Book Now</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
