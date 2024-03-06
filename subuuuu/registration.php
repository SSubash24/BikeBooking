<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: 0 auto; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; font-size: 16px; }
        .form-group .error { color: red; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
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
                $errors[] = "Name is required";
            }
            if (empty($email)) {
                $errors[] = "Email is required";
            }
            if (empty($password)) {
                $errors[] = "Password is required";
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
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>
