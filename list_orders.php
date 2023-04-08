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
        $sql = "SELECT DISTINCT o.ID, o.totalPrice, o.tip, c.firstName as customerFirstName, c.lastName as customerLastName, GROUP_CONCAT(f.foodName SEPARATOR ', ') as items, CONCAT(d.firstName, ' ', d.lastName) as deliveryPerson
        FROM orders o
        JOIN customerPlaces cp ON o.ID = cp.orderID
        JOIN customerAccount c ON cp.customerEmail = c.email
        JOIN orderContains oc ON o.ID = oc.orderID
        JOIN foodItem f ON oc.foodName = f.foodName
        JOIN DeliveredBy db ON o.ID = db.orderID
        JOIN employee d ON db.employeeID = d.ID
        WHERE cp.datePlace = :date
        GROUP BY o.ID";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['date' => $date]);

        $orders = $stmt->fetchAll();

        if (count($orders) > 0) {
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Customer Name</th><th>Items Ordered</th><th>Total Price</th><th>Tip</th><th>Delivery Person</th></tr>";
            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . $order['ID'] . "</td>";
                echo "<td>" . $order['customerFirstName'] . " " . $order['customerLastName'] . "</td>";
                echo "<td>" . $order['items'] . "</td>";
                echo "<td>" . $order['totalPrice'] . "</td>";
                echo "<td>" . $order['tip'] . "</td>";
                echo "<td>" . $order['deliveryPerson'] . "</td>";
                echo "</tr>";
            }
                echo "</table>";
                } else {
                echo "<p>No orders found for the selected date.</p>";
                    }
    }
                ?>
                
    </div>
</body>
</html>
