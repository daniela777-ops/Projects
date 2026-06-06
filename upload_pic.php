<?php
session_start();

// Must be logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$user_id = $_SESSION['user_id'];

// Check a file was actually uploaded
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
  
  $file = $_FILES['profile_pic'];
  
  // Check it's an image
  $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
  if (!in_array($file['type'], $allowed_types)) {
    header('Location: index.php?error=Only images allowed');
    exit();
  }
  
  // Check file size (max 5MB)
  if ($file['size'] > 5 * 1024 * 1024) {
    header('Location: index.php?error=Image too large');
    exit();
  }
  
  // Give it a unique name
  $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
  $new_filename = uniqid() . '.' . $extension;
  $destination = 'uploads/' . $new_filename;
  
  // Move from temp to permanent folder
  if (move_uploaded_file($file['tmp_name'], $destination)) {
    // Save path to database
    mysqli_query($conn, "UPDATE users SET profile_pic='$destination' WHERE user_id='$user_id'");
    header('Location: index.php');
    exit();
  }
}

header('Location: index.php?error=Upload failed');
exit();
?>