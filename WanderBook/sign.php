<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In &bull; WanderBook 3D</title>
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
      max-width: 440px;
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
      margin-bottom: 20px;
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
      <img src="assets/img/logo/wanderbook-logo.svg" alt="WanderBook" style="height: 52px; width: auto;" class="mb-2">
    </a>
    <h2 class="mt-2 mb-1" style="color: var(--wb-burgundy-deep); font-weight: 800; font-size: 1.8rem;">Welcome Back</h2>
    <p class="small mb-0" style="color: #6d5f5c;">Enter your credentials to access your WanderBook journeys</p>
  </div>

  <form action="signin.php" method="POST">
    <div class="form-group mb-3">
      <label class="wb-auth-label" for="username"><i class="fas fa-user mr-1 text-burgundy"></i> Username</label>
      <input type="text" id="username" name="username" class="form-control wb-auth-input" placeholder="e.g. explorer" required autofocus>
    </div>

    <div class="form-group mb-4">
      <label class="wb-auth-label" for="password"><i class="fas fa-lock mr-1 text-burgundy"></i> Password</label>
      <input type="password" id="password" name="password" class="form-control wb-auth-input" placeholder="••••••••" required>
    </div>

    <button type="submit" name="submit" class="btn wb-btn-burgundy btn-block py-2 mb-3">
      <i class="fas fa-sign-in-alt mr-1"></i> Sign In to WanderBook
    </button>
  </form>

  <div class="text-center mt-3 pt-3" style="border-top: 1px solid rgba(104, 23, 41, 0.15);">
    <p class="mb-2 small" style="color: #4a3e3c;">
      Don't have an account? <a href="reg.php" style="color: var(--wb-burgundy-main); font-weight: 700; text-decoration: underline;">Create Account</a>
    </p>
    <a href="index.php" class="small" style="color: #7d706c;">
      <i class="fas fa-arrow-left mr-1"></i> Return to Explore
    </a>
  </div>
</div>

</body>
</html>
