<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bike Booking</title>
  <style>
    body {
      background-image: url("S:\SEM V\Web lab\exp 1\b.jpg");
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: rgb(10, 190, 222);
    }

    /* Add the rest of the CSS styles... */

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <h1>Bike Booking</h1>
  </header>

  <main>
    <div class="container">
      <div class="content">
        <h2>Bike Booking Form</h2>
        <!-- Bike Booking Form -->
        <form action="book_bike.php" method="post">
          <label for="name">Name:</label>
          <input type="text" name="name" required><br>

          <label for="email">Email:</label>
          <input type="email" name="email" required><br>

          <label for="phone">Phone:</label>
          <input type="tel" name="phone" required><br>

          <label for="bike_type">Bike Type:</label>
          <select name="bike_type" required>
            <option value="mountain_bike">Mountain Bike</option>
            <option value="road_bike">Road Bike</option>
            <option value="city_bike">City Bike</option>
            <option value="electric_bike">Electric Bike</option>
          </select><br>

          <input type="submit" value="Book Bike">
        </form>
      </div>

      <!-- Features section ... -->

    </div>
  </main>

  <!-- Footer -->
  <footer>
    <!-- Footer content here -->
  </footer>
</body>
</html>
