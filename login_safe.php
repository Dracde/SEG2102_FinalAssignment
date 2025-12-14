<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$user = $_POST['username'];
$pass = $_POST['password'];

// SAFE QUERY USING PARAMETERIZED STATEMENT
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Login Successful (SAFE)</h2>";
} else {
    echo "<h2>Invalid Login</h2>";
}

$stmt->close();
$conn->close();
?>
