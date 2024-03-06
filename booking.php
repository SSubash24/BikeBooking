<!DOCTYPE html>
<html>
<head>
    <title>Bike Booking Page</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url("/subuuuu/1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    box-sizing: border-box;
}
        .container { 
            max-width: 400px; 
            margin: 50px auto; 
            padding: 20px;
            border: 1px solid #ccc;
            background-color: rgb(10, 190, 222);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        .form-group label { 
            display: block; 
            font-weight: bold; 
        }
        .form-group input { 
            width: 100%; 
            padding: 10px; 
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group .error { 
            color: red; 
            margin-top: 5px;
        }
        .success { 
            color: green; 
            font-weight: bold; 
        }
        .center {
            text-align: center;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><center>Bike Booking Page</center></h2>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "registration";

        // Establish database connection
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $bikeName = $_POST["bike_name"];
            $duration = $_POST["duration"];

            // Perform simple form validation (you should add more robust validation)
            $errors = [];
            if (!preg_match("/^[a-zA-Z ]+$/", $bikeName)) {
                $errors[] = "Bike name should contain only letters and spaces";
            }
            if (!ctype_digit($duration)) {
                $errors[] = "Duration should contain only numbers";
            }

            if (empty($errors)) {
                // Perform database insertion here
                $sql = "INSERT INTO bookings (bike_name, duration) VALUES ('$bikeName', $duration)";
                if (mysqli_query($conn, $sql)) {
                    echo '<p class="success">Booking successful!</p>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                foreach ($errors as $error) {
                    echo '<p class="error">' . $error . '</p>';
                }
            }
        }

        mysqli_close($conn);
        ?>

        <form method="post" onsubmit="return validateForm()"><center>
            <!-- ... Existing form fields ... -->
            <div class="form-group">
                <label for="bike_name">Bike Name</label><br>
                <input type="text" name="bike_name" id="bike_name" required placeholder="Enter the bike name">
            </div>
            <div class="form-group">
                <label for="duration">Duration (in hours)</label><br>
                <input type="number" name="duration" id="duration" required placeholder="Enter the duration">
            </div>
            <div class="form-group">
                <input type="submit" value="Book Now">
            </div></center>
        </form>

        <script>
            function validateForm() {
                var bikeNameInput = document.getElementById('bike_name');
                var durationInput = document.getElementById('duration');

                if (!/^[a-zA-Z ]+$/.test(bikeNameInput.value)) {
                    alert('Bike name should contain only letters and spaces');
                    return false; // Prevent form submission
                }

                if (!/^\d+$/.test(durationInput.value)) {
                    alert('Duration should contain only numbers');
                    return false; // Prevent form submission
                }

                return true; // Allow form submission
            }
        </script>
    </div>
</body>
</html>
