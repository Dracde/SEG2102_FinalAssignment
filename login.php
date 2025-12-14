<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "testdb";

// CONNECT
$conn = new mysqli($servername, $username, $password, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET USER INPUT
$user = $_POST['username'];
$pass = $_POST['password'];

// ⚠️ VULNERABLE QUERY (for experiment)
$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Login Successful (VULNERABLE)</h2>";
} else {
    echo "<h2>Invalid Login</h2>";
}

$conn->close();
?>
