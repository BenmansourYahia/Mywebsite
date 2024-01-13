<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Login successful";
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
