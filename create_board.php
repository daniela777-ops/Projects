<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$user_id = $_SESSION['user_id'];
$board_name = $_POST['board_name'];

mysqli_query($conn, "INSERT INTO boards (user_id, name) VALUES ('$user_id', '$board_name')");

header('Location: index.php');
exit();
?>