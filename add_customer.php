<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Customer</title>
</head>
<body>
  <h1>Add New Customer</h1>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required><br><br>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="cellNum">Cell Number:</label>
    <input type="text" id="cellNum" name="cellNum" required><br><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required><br><br>

    <label for="street">Street:</label>
    <input type="text" id="street" name="street" required><br><br>

    <label for="zip">ZIP Code:</label>
    <input type="text" id="zip" name="zip" required><br><br>

    <input type="submit" value="Add Customer">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your own database connection details
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

    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $cellNum = $_POST['cellNum'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];

    // Check if customer already exists
    $sql = "SELECT email FROM customerAccount WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $message = "Customer already exists.";
    } else {
      // Insert new customer with $5.00 credit
      $sql = "INSERT INTO customerAccount (creditAmount, email, firstName, lastName, cellNum, city, street, zip)
              VALUES (5.00, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssisss", $email, $firstName, $lastName, $cellNum, $city, $street, $zip);

      if ($stmt->execute()) {
        $message = "New customer added successfully.";
      } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    $stmt->close();
    $conn->close();
  }
  ?>

  <!-- Display message after processing form -->
  <?php if (!empty($message)) : ?>
  <div style="margin-top: 20px;">
    <strong><?php echo $message; ?></strong>
  </div>
  <?php endif; ?>

</body>
</html>