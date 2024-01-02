<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the input (you may want to add more validation)
    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {
        // Perform authentication against the database
        $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, login successful
            echo "<script>alert('Login Successfull');window.location.href='index.html'</script>";
            // You may want to fetch and use user details here
            $userDetails = $result->fetch_assoc();
        } else {
            // No matching user found
            echo "Invalid email or password.";
        }
    }
}

// Close the database connection
$conn->close();
?>
