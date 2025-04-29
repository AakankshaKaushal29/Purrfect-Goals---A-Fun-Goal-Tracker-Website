<?php
// Connect to MySQL (case-sensitive DB name)
$conn = new mysqli("localhost", "root", "", "Purrfect_Goals");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the table
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "🎉 Registration successful! <a href='index.html'>Click here to login</a>";
} else {
    if ($conn->errno == 1062) {
        echo "⚠️ Username already exists. <a href='register.html'>Try again</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
