<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
include_once 'database.php';

$registeredMsg = '';
$errorMsg = '';

if (isset($_POST['btn-signup'])) {
    $fname = $conn->real_escape_string($_POST['fname']);
    $uname = $conn->real_escape_string($_POST['uname']);
    $email = $conn->real_escape_string($_POST['email']);
    $upass = md5($conn->real_escape_string($_POST['pass']));

    $check = $conn->query("SELECT id FROM users WHERE username = '$uname' OR email = '$email'");
    if ($check && $check->num_rows > 0) {
        $errorMsg = "An account with that username or email already exists.";
    } else {
        if ($conn->query("INSERT INTO `users` (`name`, `username`, `email`, `password`) VALUES('$fname', '$uname','$email','$upass')")) {
            $registeredMsg = "Account created successfully! You can now sign in.";
        } else {
            $errorMsg = "Error while creating your account: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up &bull; WanderBook 3D</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/library/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 15px;
    }
    .wb-auth-card {
      background: var(--wb-cream-light);
      border: 2.5px solid var(--wb-burgundy-main);
      border-radius: var(--wb-radius-lg);
      padding: 40px 35px;
      box-shadow: 0 25px 60px rgba(35, 12, 18, 0.35);
      max-width: 460px;
      width: 100%;
      position: relative;
    }
    .wb-auth-input {
      background: #FFFFFF;
      border: 1.5px solid rgba(104, 23, 41, 0.3);
      color: var(--wb-burgundy-deep);
      border-radius: var(--wb-radius-sm);
      padding: 12px 16px;
      font-size: 15px;
      font-weight: 500;
      margin-bottom: 16px;
      transition: all 0.25s ease;
    }
    .wb-auth-input:focus {
      border-color: var(--wb-burgundy-main);
      box-shadow: 0 0 0 3px rgba(104, 23, 41, 0.15);
      outline: none;
    }
    .wb-auth-label {
      color: var(--wb-burgundy-deep);
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-bottom: 6px;
      display: block;
    }
  </style>
</head>
<body class="wb-body">

<div class="wb-auth-card">
  <div class="text-center mb-4">
    <a href="index.php">
      <img src="assets/img/logo/wanderbook-logo.svg" alt="WanderBook" style="height: 50px; width: auto;" class="mb-2">
    </a>
    <h2 class="mt-2 mb-1" style="color: var(--wb-burgundy-deep); font-weight: 800; font-size: 1.8rem;">Join WanderBook</h2>
    <p class="small mb-0" style="color: #6d5f5c;">Create an account to unlock tailored 3D travel itineraries</p>
  </div>

  <?php if (!empty($registeredMsg)): ?>
    <div class="alert alert-success py-2 small text-center" style="border: 1px solid #28a745;">
      <i class="fas fa-check-circle mr-1"></i> <?php echo htmlspecialchars($registeredMsg); ?>
      <div class="mt-1"><a href="sign.php" style="color: #155724; font-weight: 700; text-decoration: underline;">Proceed to Sign In &rarr;</a></div>
    </div>
  <?php endif; ?>

  <?php if (!empty($errorMsg)): ?>
    <div class="alert alert-danger py-2 small text-center" style="border: 1px solid #dc3545;">
      <i class="fas fa-exclamation-triangle mr-1"></i> <?php echo htmlspecialchars($errorMsg); ?>
    </div>
  <?php endif; ?>

  <form action="" method="POST">
    <div class="form-group mb-2">
      <label class="wb-auth-label" for="fname"><i class="fas fa-id-card mr-1 text-burgundy"></i> Full Name</label>
      <input type="text" id="fname" name="fname" class="form-control wb-auth-input" placeholder="e.g. John Doe" required autofocus>
    </div>

    <div class="form-group mb-2">
      <label class="wb-auth-label" for="uname"><i class="fas fa-user mr-1 text-burgundy"></i> Choose Username</label>
      <input type="text" id="uname" name="uname" class="form-control wb-auth-input" placeholder="e.g. voyager" required>
    </div>

    <div class="form-group mb-2">
      <label class="wb-auth-label" for="email"><i class="fas fa-envelope mr-1 text-burgundy"></i> Email Address</label>
      <input type="email" id="email" name="email" class="form-control wb-auth-input" placeholder="e.g. name@example.com" required>
    </div>

    <div class="form-group mb-4">
      <label class="wb-auth-label" for="pass"><i class="fas fa-lock mr-1 text-burgundy"></i> Create Password</label>
      <input type="password" id="pass" name="pass" class="form-control wb-auth-input" placeholder="••••••••" required>
    </div>

    <button type="submit" name="btn-signup" class="btn wb-btn-burgundy btn-block py-2 mb-3">
      <i class="fas fa-user-plus mr-1"></i> Create WanderBook Account
    </button>
  </form>

  <div class="text-center mt-3 pt-3" style="border-top: 1px solid rgba(104, 23, 41, 0.15);">
    <p class="mb-2 small" style="color: #4a3e3c;">
      Already have an account? <a href="sign.php" style="color: var(--wb-burgundy-main); font-weight: 700; text-decoration: underline;">Sign In</a>
    </p>
    <a href="index.php" class="small" style="color: #7d706c;">
      <i class="fas fa-arrow-left mr-1"></i> Return to Explore
    </a>
  </div>
</div>

</body>
</html>
