<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "testdb";

// 1. Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// 3. Get User Input
$user = $_POST['username'];
$pass = $_POST['password'];

// 4. SAFE SQL QUERY (Parameterized)
// We use? placeholders instead of variables
$stmt = $conn->prepare("SELECT * FROM users WHERE username =? AND password =?");

// 5. Bind Parameters
// "ss" means we are binding two strings (user, pass)
$stmt->bind_param("ss", $user, $pass);

// 6. Execute Query
$stmt->execute();
$result = $stmt->get_result();

// 7. Check Login
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2 style='color:green'> Login Successful!</h2>";
    echo "<p>Logged in as: ". $row['username']. "</p>";
} else {
    echo "<h2>Invalid Login</h2>";
    echo "<p>The database searched for a user literally named: <strong>". htmlspecialchars($user). "</strong></p>";
}

$stmt->close();
$conn->close();
?>