<?php
$conn = mysqli_connect("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbng3lhmczoipr");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM hotels LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        input, button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .hotel-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .hotel-card {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            width: 300px;
            border-radius: 10px;
        }

        .hotel-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .hotel-card h3 {
            margin: 10px 0 5px;
        }

        .hotel-card p {
            font-size: 14px;
            color: #555;
        }

        .hotel-card strong {
            color: #000;
        }

        .hotel-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .hotel-card a:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <h1>Welcome to Sheraton-style Hotel Booking</h1>

    <form action="search.php" method="GET">
        <input type="text" name="location" placeholder="Enter location" required>
        <input type="date" name="checkin">
        <input type="date" name="checkout">
        <button type="submit">Search Hotels</button>
    </form>

    <h2>Featured Hotels</h2>
    <div class="hotel-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="hotel-card">
                <img src="<?php echo $row['image']; ?>" alt="Hotel Image">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <strong>Rs <?php echo $row['price']; ?>/night</strong><br>
                <a href="book.php?id=<?php echo $row['id']; ?>">Book Now</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
