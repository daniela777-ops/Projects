<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$section_id = $_POST['section_id'];
$subsection_name = $_POST['subsection_name'];

mysqli_query($conn, "INSERT INTO subsections (section_id, name) VALUES ('$section_id', '$subsection_name')");

header('Location: index.php');
exit();
?>