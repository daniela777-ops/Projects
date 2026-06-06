<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$board_id = $_POST['board_id'];
$section_name = $_POST['section_name'];

mysqli_query($conn, "INSERT INTO sections (board_id, name) VALUES ('$board_id', '$section_name')");

header('Location: index.php');
exit();
?>