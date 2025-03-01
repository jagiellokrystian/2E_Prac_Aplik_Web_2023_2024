<?php
include 'db.php';
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0){
  echo "Nazwa użytkownika się powtarza";
  exit;
}
$stmt->close();
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("ss", $username, $hash);
$stmt->execute();
echo "Rejestracja udana";
$stmt->close();
$conn->close();
?>
