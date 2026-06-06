<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$user_id = $_SESSION['user_id'];

if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === 0) {
  $file = $_FILES['post_image'];
  
  $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
  if (!in_array($file['type'], $allowed_types)) {
    header('Location: feed.php?error=Only images allowed');
    exit();
  }
  
  if ($file['size'] > 5 * 1024 * 1024) {
    header('Location: feed.php?error=Image too large');
    exit();
  }
  
  $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
  $new_filename = uniqid() . '.' . $extension;
  $destination = 'uploads/' . $new_filename;
  
  if (move_uploaded_file($file['tmp_name'], $destination)) {
    mysqli_query($conn, "INSERT INTO posts (user_id, image) VALUES ('$user_id', '$destination')");
    header('Location: feed.php');
    exit();
  }
}

header('Location: feed.php?error=Upload failed');
exit();
?>