<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blueprint - For You</title>
  </head>
  <body>
    <div class="feed-header">
      <span class="logo">Blueprint</span>
    </div>

    <div class="upload-post-form">
      <form action="upload_posts.php" method="POST" enctype="multipart/form-data">
        <label for="post-input" class="upload-label">+ Add Post</label>
        <input type="file" id="post-input" name="post_image" accept="image/*" 
               onchange="this.form.submit()" style="display:none">
      </form>
    </div>

    
      <div class="masonry">

<?php
$posts_result = mysqli_query($conn, "SELECT posts.*, users.username, users.profile_pic 
                                     FROM posts 
                                     JOIN users ON posts.user_id = users.user_id 
                                     ORDER BY posts.created_at DESC");

while ($post = mysqli_fetch_assoc($posts_result)) {
  $username = $post['username'];
  $image = $post['image'];
  
  echo '
  <div class="post">
    <img src="' . $image . '">
    <div class="post-overlay">
      <div class="post-user">
        <div class="post-avatar"></div>
        ' . $username . '
      </div>
      <button class="save-btn" onclick="toggleSave(this)">Save</button>
    </div>
  </div>';
}
?>

</div>
    

    <ul class="navUl">
      <li><a href="./index.php">👤Profile</a></li>
      <li><a href="./feed.php" class="active">🏠Home</a></li>
      <li><a href="./search.html">🔍Search</a></li>
      <li><a href="./inbox.html">📤Inbox</a></li>
    </ul>

    <script src="script.js"></script>
  </body>
</html>