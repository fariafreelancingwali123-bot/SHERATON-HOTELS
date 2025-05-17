<?php
$conn = mysqli_connect("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbng3lhmczoipr");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$location = isset($_GET['location']) ? trim($_GET['location']) : '';

if ($location == '') {
    die("Please enter a location.");
}

$stmt = $conn->prepare("SELECT * FROM hotels WHERE LOWER(location) LIKE LOWER(?)");
$searchTerm = "%" . $location . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Listings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Hotel Listings for "<?php echo htmlspecialchars($location); ?>"</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="hotel-card">
                <img src="<?php echo $row['image']; ?>" width="200">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <strong>Rs <?php echo $row['price']; ?>/night</strong><br>
                <a href="book.php?id=<?php echo $row['id']; ?>">Book Now</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hotels found in this location.</p>
    <?php endif; ?>
</body>
</html>
