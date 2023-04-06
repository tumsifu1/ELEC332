<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>List Orders</title>
</head>
<body>
  <div class="container">
    <h1>List Orders</h1>
    <form method="post">
      <label for="date">Enter date:</label>
      <input type="date" name="date" id="date" required>
      <button type="submit" name="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $date = $_POST['date'];

        // Connect to the database
        $host = 'localhost';
        $db_name = 'restaurantDB';
        $db_user = 'root';
        $db_pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $db_user, $db_pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        // Fetch and display the relevant order information
        $sql = "SELECT o.ID, o.totalPrice, o.tip, c.email, c.firstName, c.lastName
        FROM orders o
        JOIN customerPlaces cp ON o.ID = cp.customerEmail
        JOIN customeraccount c ON cp.customerEmail = c.email
        WHERE cp.timePlace = :date";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['date' => $date]);

        $orders = $stmt->fetchAll();

        if (count($orders) > 0) {
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Total Price</th><th>Tip</th><th>Customer Email</th><th>First Name</th><th>Last Name</th></tr>";
            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . $order['ID'] . "</td>";
                echo "<td>" . $order['totalPrice'] . "</td>";
                echo "<td>" . $order['tip'] . "</td>";
                echo "<td>" . $order['email'] . "</td>";
                echo "<td>" . $order['firstName'] . "</td>";
                echo "<td>" . $order['lastName'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No orders found for the specified date.</p>";
        }
    }
    ?>

    <a href="restaurant.php" class="btn">Back to Home</a>
  </div>
</body>
</html>
