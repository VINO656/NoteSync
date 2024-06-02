<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define getUserName() function
function getUserName($user_id) {
    global $conn;
    $sql = "SELECT username FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['username'];
    }
    return "Unknown User";
}
?>
