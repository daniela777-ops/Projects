<?php
session_start();

// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'blueprint');

if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check passwords match
if ($password !== $confirm_password) {
  header('Location: signup.php?error=Passwords do not match');
  exit();
}

// Check password length
if (strlen($password) < 6) {
  header('Location: signup.php?error=Password must be at least 6 characters');
  exit();
}

// Hash the password (never store plain text passwords!)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
  header('Location: signup.php?error=Email already registered');
  exit();
}

// Check if username already exists
$check2 = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($check2) > 0) {
  header('Location: signup.php?error=Username already taken');
  exit();
}

// Insert new user
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
  // Success! Redirect to login
  header('Location: login.php?success=Account created! Please log in');
  exit();
} else {
  header('Location: signup.php?error=Something went wrong, please try again');
  exit();
}

mysqli_close($conn);
?>