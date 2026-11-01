<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- WanderBook 3D Navigation -->
<body class="wb-body">
<header class="wb-header-wrapper sticky-top">
  <nav class="navbar navbar-expand-lg wb-navbar">
    <div class="container">
      <a class="navbar-brand wb-brand" href="index.php">
        <img src="assets/img/logo/wanderbook-logo.svg" alt="WanderBook Logo" class="wb-logo-img">
      </a>
      <button class="navbar-toggler wb-toggler" type="button" data-toggle="collapse" data-target="#wbNavbarNav"
              aria-controls="wbNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="wb-toggler-icon"><i class="fas fa-bars"></i></span>
      </button>
      
      <div class="collapse navbar-collapse" id="wbNavbarNav">
        <ul class="navbar-nav mx-auto wb-nav-links">
          <li class="nav-item">
            <a class="nav-link wb-nav-item" href="index.php">
              <i class="fas fa-compass mr-1"></i> Explore
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link wb-nav-item" href="flights.php">
              <i class="fas fa-plane-departure mr-1"></i> Flights
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link wb-nav-item" href="hotels.php">
              <i class="fas fa-hotel mr-1"></i> Hotels
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link wb-nav-item" href="offer.php">
              <i class="fas fa-gem mr-1"></i> Deals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link wb-nav-item wb-nav-highlight" href="meet-the-team.php">
              <i class="fas fa-user-astronaut mr-1"></i> Meet The Team
            </a>
          </li>
        </ul>

        <div class="wb-auth-actions d-flex align-items-center">
          <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
            <span class="wb-user-tag mr-3">
              <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['user']); ?>
            </span>
            <a href="sign.php?logout=1" class="btn wb-btn-outline-sm">
              <i class="fas fa-sign-out-alt"></i> Exit
            </a>
          <?php else: ?>
            <a href="sign.php" class="btn wb-btn-outline mr-2">
              <i class="fas fa-key mr-1"></i> Sign In
            </a>
            <a href="reg.php" class="btn wb-btn-burgundy">
              <i class="fas fa-paper-plane mr-1"></i> Join
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
