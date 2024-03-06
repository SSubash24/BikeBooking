<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: rgb(10, 190, 222);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: #fff;
        }
        .delete-btn {
            background-color: #f44336;
            color: #fff;
        }
        .edit-btn:hover, .delete-btn:hover {
            opacity: 0.8;
        }
        .add-user-form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .add-user-form input[type="text"],
        .add-user-form input[type="email"],
        .add-user-form input[type="password"] {
            width: 200px;
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .add-user-form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .add-user-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    </style>
</head>
<body>
    <h2>Admin Panel</h2>

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

    // Function to fetch all users from the database
    function getAllUsers($conn) {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $users;
    }

    // Function to display all users in a table
    function displayUsers($users) {
        echo '<table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>';
        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>
                    <a href="admin.php?edit=' . $user['id'] . '">Edit</a>
                    <a href="admin.php?delete=' . $user['id'] . '">Delete</a>
                </td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    // Display all users
    $users = getAllUsers($conn);

    // Edit user
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            die("User not found.");
        }

        if (isset($_POST['update_user'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Perform validation here (e.g., check if user exists, validate input, etc.)

            // Update user in the database
            $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                header('Location: admin.php'); // Redirect to refresh the page
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Display edit form
        echo '<h3>Edit User</h3>';
        echo '<form method="post">';
        echo '<input type="text" name="name" value="' . $user['name'] . '" placeholder="Username" required>';
        echo '<input type="email" name="email" value="' . $user['email'] . '" placeholder="Email" required>';
        echo '<input type="password" name="password" value="' . $user['password'] . '" placeholder="Password" required>';
        echo '<input type="submit" name="update_user" value="Update User">';
        echo '</form>';
    }

    // Delete user
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM users WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: admin.php'); // Redirect to refresh the page
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    displayUsers($users);

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Add a form to add new users -->
    <h3><center>Add New User</center></h3>
    <form method="post"><center>
        <input type="text" name="name" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" name="add_user" value="Add User"></center>
    </form>

</body>
</html>
