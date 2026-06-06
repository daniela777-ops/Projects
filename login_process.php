<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');

if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

// Find user by email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['PASSWORD'])) {
  // Password matches! Set session
  $_SESSION['user_id'] = $user['user_id'];
  $_SESSION['username'] = $user['username'];
  
  // Redirect to profile
  header('Location: index.php');
  exit();
} else {
  header('Location: login.php?error=Invalid email or password');
  exit();
}

mysqli_close($conn);
?>