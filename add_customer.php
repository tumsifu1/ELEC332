<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Replace with your own database connection details
  $servername = "localhost";
  $username = "username";
  $password = "password";
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Add Customer</title>
</head>
<body>
  <div class="container">
    <h1>Add Customer</h1>
    <?php
    if (!empty($message)) {
      echo "<p>" . $message . "</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="firstName">First Name:</label>
      <input type="text" name="firstName" id="firstName" required>
      <br>
      <label for="lastName">Last Name:</label>
      <input type="text" name="lastName" id="lastName" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <br>
      <label for="cellNum">Cell Number:</label>
      <input type="text" name="cellNum" id="cellNum" required>
      <br>
      <label for="city">City:</label>
      <input type="text" name="city" id="city" required>
      <br>
      <label for="street">Street:</label>
      <input type="text" name="street" id="street" required>
      <br>
      <label for="zip">Zip Code:</label>
      <input type="text" name="zip" id="zip" required>
      <br>
      <input type="submit" value="Add Customer">
    </form>
  </div>
</body>
</html>