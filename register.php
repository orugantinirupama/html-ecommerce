<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $re_enter_password = $_POST["re_enter_password"];

    // Perform basic validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if ($password != $re_enter_password) {
        $errors[] = "Passwords do not match";
    }

    // If there are no errors, insert data into the database
    if (empty($errors)) {
        // Replace these database connection parameters with your own
        $host = "localhost";
        $username = "root";
        $db_password = ""; // Change this to your actual database password
        $database = "ecommerce";

        // Create a database connection
        $conn = new mysqli($host, $username, $db_password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform the insertion query without hashing the password
        $sql = "INSERT INTO register (`name`, email, `password`) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful');window.location.href='http://localhost/ecommerce/login.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // If there are errors, display them
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
