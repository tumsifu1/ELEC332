<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELEC332 Project</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>ELEC332 Project</h1>
    <div id="imageGallery">
      <img src="image1.jpg" alt="Image 1">
      <img src="image2.jpg" alt="Image 2">
      <img src="image3.jpg" alt="Image 3">
      <img src="image4.jpg" alt="Image 4">
    </div>
    <div style="text-align: center; margin-top: 20px;">
      <a href="list_orders.php" class="btn">List Orders</a>
      <a href="add_customer.php" class="btn">Add Customer</a>
      <a href="orders_summary.php" class="btn">Orders Summary</a>
      <a href="employee_schedule.php" class="btn">Employee Schedule</a>
    </div>
  </div>

  <style>
    #imageGallery {
      position: relative;
      width: 100%;
      height: 400px;
    }

    #imageGallery img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    #imageGallery img.active {
      opacity: 1;
    }
  </style>

  <script>
    // Set the index of the current image
    let currentImageIndex = 0;

    // Get the image gallery element
    const imageGallery = document.getElementById("imageGallery");

    // Get all the images in the gallery
    const images = imageGallery.getElementsByTagName("img");

    // Show the first image
    images[0].classList.add("active");

    // Start the timer to rotate the images
    setInterval(function() {
      // Hide the current image
      images[currentImageIndex].classList.remove("active");

      // Increment the index of the current image
      currentImageIndex++;

      // If we've gone past the last image, start over at the beginning
      if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
      }

      // Show the next image
      images[currentImageIndex].classList.add("active");
    }, 5000);
  </script>
</body>
</html>
