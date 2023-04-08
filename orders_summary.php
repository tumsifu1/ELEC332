<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Orders Summary</title>
</head>
<body>
  <div class="container">
    <h1>Orders Summary</h1>
    <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restaurantDB";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query to retrieve orders summary
            $query = "SELECT datePlace AS order_date, COUNT(OrderID) AS order_count
                      FROM customerPlaces
                      GROUP BY datePlace
                      ORDER BY datePlace";

            $stmt = $conn->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<table>";
                echo "<tr><th>Date</th><th>Number of Orders</th></tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td>" . $row["order_count"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No orders found.</p>";
            }
        } catch(PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }

        $conn = null;
    ?>
    <a href="restaurant.php/" class="btn">Back to Home</a>
  </div>
</body>
</html>
