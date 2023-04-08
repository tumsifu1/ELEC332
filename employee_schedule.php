<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Employee Schedule</title>
</head>
<body>
  <div class="container">
    <h1>Employee Schedule</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restaurantDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employee'])) {
      $employeeID = $_POST['employee'];

      $sql = "SELECT firstName, lastName FROM employee WHERE ID = $employeeID";
      $result = $conn->query($sql);
      $employee = $result->fetch_assoc();

      echo "<h2>Schedule for {$employee['firstName']} {$employee['lastName']} (Monday to Friday):</h2>";

      $sql = "SELECT shiftDay, startTime, endTime FROM shift WHERE employeeID = $employeeID AND DAYOFWEEK(shiftDay) >= 2 AND DAYOFWEEK(shiftDay) <= 6 ORDER BY shiftDay";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Date</th><th>Start Time</th><th>End Time</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['shiftDay']}</td><td>{$row['startTime']}</td><td>{$row['endTime']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No schedule available.";
      }
    }

    // Fetch all employees
    $sql = "SELECT ID, firstName, lastName FROM employee";
    $result = $conn->query($sql);

    $conn->close();
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="employee">Choose an employee:</label>
      <select name="employee" id="employee" required>
        <option value="">Select an employee</option>
        <?php
        while ($row = $result->fetch_assoc()) {
          echo "<option value='{$row['ID']}'>{$row['firstName']} {$row['lastName']}</option>";
        }
        ?>
      </select>
      <input type="submit" value="Show Schedule">
    </form>

    <a href="restaurant.php" class="btn">Back to Home</a>
  </div>
</body>
</html>
