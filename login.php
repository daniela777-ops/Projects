<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Blueprint - Log In</title>
</head>
<body>

<div class="auth-wrap">
  <div class="auth-box">
    <div class="auth-logo">B</div>
    <h1>Welcome back</h1>
    <p>Design your life.</p>

    <?php if(isset($_GET['error'])) { ?>
      <div class="auth-error"><?php echo $_GET['error']; ?></div>
    <?php } ?>

    <?php if(isset($_GET['success'])) { ?>
      <div class="auth-success"><?php echo $_GET['success']; ?></div>
    <?php } ?>

    <form action="login_process.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Log In</button>
    </form>

    <div class="auth-switch">Don't have an account? <a href="signup.php">Sign up</a></div>
  </div>
</div>

</body>
</html>