<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
$conn = mysqli_connect('localhost', 'root', '', 'blueprint');
$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Blueprint</title>

  </head>
  <body>
    <div class="profile-cover"></div>

    <div class="profile-section-wrap">

    <div class="profile-header">
        <div class="profile-pic-wrap" onclick="document.getElementById('pic-input').click()">
  <img src="<?php echo $user['profile_pic'] ?? 'Default_pfp.jpg'; ?>" 
       alt="Profile Picture" class="profile-pic">
</div>
<form action="upload_pic.php" method="POST" enctype="multipart/form-data">
  <input type="file" id="pic-input" name="profile_pic" accept="image/*" 
         onchange="this.form.submit()" style="display:none">
</form>
        <h1><?php echo $user['username']; ?></h1>
        <p>running on tea, gym, vibes, and faith</p>
    </div>
    <div class="profile-stats">
        <div>
            <strong>354</strong> Followers
        </div>
        <div>
            <strong>134</strong> Following
        </div>
    </div>
    <div class="profile-actions">
        <button>Follow</button>
        <button>Message</button>
        <button onclick="window.location.href='logout.php'" class="btn-logout">Log Out</button>
    </div>

    <div class="tabs-bar">
      <div class="tab active" onclick="switchTab('boards')">Boards</div>
      <div class="tab" onclick="switchTab('saved')">Saved</div>
    </div>

 <div id="tab-boards" class="tab-content active">
  <div class="create-board-form">
  <form action="create_board.php" method="POST">
    <input type="text" name="board_name" placeholder="New board name..." required>
    <button type="submit">+ Create Board</button>
  </form>
</div>
  <div class="boards-list">

<?php
$boards_result = mysqli_query($conn, "SELECT * FROM boards WHERE user_id='$user_id'");

while ($board = mysqli_fetch_assoc($boards_result)) {
  $board_id = $board['board_id'];
  $board_name = $board['NAME'];
  
  $sections_result = mysqli_query($conn, "SELECT * FROM sections WHERE board_id='$board_id'");
  $section_count = mysqli_num_rows($sections_result);
  
  echo '
  <div class="board-row">
    <div class="board-header" onclick="toggleBoard(\'board_' . $board_id . '\')">
      <div class="board-thumb"></div>
      <div class="board-info">
        <div class="board-name">' . $board_name . '</div>
        <div class="board-count">' . $section_count . ' sections</div>
      </div>
      <span>▾</span>
    </div>
    <div class="board-expanded" id="board_' . $board_id . '">';

  while ($section = mysqli_fetch_assoc($sections_result)) {
    $section_id = $section['section_id'];
    
    echo '<div class="section-item">' . $section['NAME'];
    
    $sub_result = mysqli_query($conn, "SELECT * FROM subsections WHERE section_id='$section_id'");
    while ($sub = mysqli_fetch_assoc($sub_result)) {
      echo '<div class="subsection">↳ ' . $sub['NAME'] . '</div>';
    }
    
    echo '
      <form action="create_subsection.php" method="POST" class="add-section-form">
        <input type="hidden" name="section_id" value="' . $section_id . '">
        <input type="text" name="subsection_name" placeholder="Add sub-section...">
        <button type="submit">+</button>
      </form>
    </div>';
  }

  echo '
      <form action="create_section.php" method="POST" class="add-section-form">
        <input type="hidden" name="board_id" value="' . $board_id . '">
        <input type="text" name="section_name" placeholder="Add section...">
        <button type="submit">+</button>
      </form>
    </div>
  </div>';
}
?>

</div>

<div id="tab-saved" class="tab-content">
  <p>Nothing saved yet.</p>
</div>
</div>

    </div>
    

        <!--Navigaton bar-->
    <ul class="navUl">
        <li><a class="active" href="./index.php">👤Profile</a></li>
        <li><a href="./feed.php">🏠Home</a></li>
        <li><a href="./search.html">🔍Search</a></li>
        <li><a href="./inbox.html">📤Inbox</a></li>
    </ul>

   <script src="script.js"></script>
  </body>
   







</html>