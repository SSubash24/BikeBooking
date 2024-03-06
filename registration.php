<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
         body { 
            font-family: Arial, sans-serif; 
            background-color:rgb(155, 10, 222) ;
            margin: 0;
            padding: 0;
        }
        .container { 
            max-width: 400px; 
            margin: 0 auto; 
            padding: 20px;
            border: 1px solid #ccc;
            background-color: rgb(10, 190, 222);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><center>Bike Registration page</center></h2>
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
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Perform simple form validation (you should add more robust validation)
            $errors = [];
            if (empty($name)) {
                $errors[] = "username is required";
            }
            if (empty($email)) {
                $errors[] = "Email is required";
            }
            if (empty($password)) {
                $errors[] = "Password is required";
            }elseif (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters";
            }

            if (empty($errors)) {
                $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
                if (mysqli_query($conn, $sql)) {
                    echo '<p class="success">Registration successful!</p>';
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

        <form method="post">
            <div class="form-group">
                <label for="name">Username</label><br>
                <input type="text" name="name" id="name" required placeholder="Enter the username">
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" required placeholder="Enter the email id">
            </div>
            <div class="form-group">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required placeholder="Enter the password">
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        <div class="center">
            <a href="booking.php">Go to Bike Booking</a>
        </div>
        <script>
        function validateForm() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.value.length < 6) {
                alert('Password must be at least 6 characters');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
    </div>
</body>
</html>
