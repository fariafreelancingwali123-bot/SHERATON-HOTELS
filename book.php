<?php
$conn = mysqli_connect("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbng3lhmczoipr");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hotel_id = $_POST['hotel_id'];
  $name = $_POST['name'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];

  $sql = "INSERT INTO bookings (hotel_id, name, checkin, checkout)
          VALUES ('$hotel_id', '$name', '$checkin', '$checkout')";
  mysqli_query($conn, $sql);

  echo "<h2>Booking Confirmed!</h2>";
  exit;
}

$hotel_id = $_GET['id'];
$hotel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hotels WHERE id = $hotel_id"));
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book <?php echo $hotel['name']; ?></title>
</head>
<body>
  <h2>Book <?php echo $hotel['name']; ?></h2>
  <form method="POST">
    <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <label>Check-in:</label>
    <input type="date" name="checkin" required><br>
    <label>Check-out:</label>
    <input type="date" name="checkout" required><br>
    <button type="submit">Confirm Booking</button>
  </form>
</body>
</html>
