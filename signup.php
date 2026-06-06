<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Blueprint - Sign Up</title>
</head>
<body>

<div class="auth-wrap">
  <div class="auth-box">
    <div class="auth-logo">B</div>
    <h1>Join Blueprint</h1>
    <p>Design your life.</p>

    <?php if(isset($_GET['error'])) { ?>
      <div class="auth-error"><?php echo $_GET['error']; ?></div>
    <?php } ?>

    <form action="signup_process.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Create Account</button>
    </form>

    <div class="auth-switch">Already have an account? <a href="login.php">Log in</a></div>
  </div>
</div>

</body>
</html>