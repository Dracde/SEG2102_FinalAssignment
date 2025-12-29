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
// In a real attack, these are the injection points
$user = $_POST['username'];
$pass = $_POST['password'];

// 4. VULNERABLE SQL QUERY
// We use SINGLE QUOTES in the SQL.
// This means payloads starting with ' will break the query.
$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";

// Optional: Print the query to screen so you can see the injection happening (Educational purpose)
echo "<p><strong>Executing SQL:</strong> ". htmlspecialchars($sql). "</p>";

// 5. Execute Query
$result = $conn->query($sql);

// 6. Check Login
if ($result && $result->num_rows > 0) {
    // Fetch the user data to show who we logged in as
    $row = $result->fetch_assoc();
    echo "<h2 style='color:red'> Login Successful!</h2>";
    echo "<p>Logged in as: <strong>". $row['username']. "</strong></p>";
} else {
    echo "<h2>Invalid Login</h2>";
    // Show error if query failed (helper for "Space Deletion" payload tests)
    if ($conn->error) {
        echo "<p>Database Error: ". $conn->error. "</p>";
    }
}

$conn->close();
?>