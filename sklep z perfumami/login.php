<?php
include 'db.php';
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows == 0){
  echo "Błędna nazwa użytkownika lub hasło";
  exit;
}
$stmt->bind_result($hash);
$stmt->fetch();
if(password_verify($password, $hash)){
  echo "Zalogowano";
} else {
  echo "Błędna nazwa użytkownika lub hasło";
}
$stmt->close();
$conn->close();
?>
