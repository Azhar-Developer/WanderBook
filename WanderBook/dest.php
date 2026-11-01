<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'database.php';
include_once 'functions.php';
include 'header.php';

$cityName = !empty($destination) ? $destination : 'Paris';
?>

<!-- 3D Destination Hero -->
<section class="py-5" style="background: radial-gradient(circle at 50% 30%, rgba(137, 154, 136, 0.3) 0%, transparent 60%);">
  <div class="container text-center">
    <div class="wb-badge-pill mb-3">
      <i class="fas fa-map-marked-alt mr-1"></i> Destination Odyssey
    </div>
    <h1 class="wb-title-3d display-4">Discover <?php echo htmlspecialchars($cityName); ?></h1>
    <p class="wb-subtitle lead mb-0">Explore iconic monuments, hidden heritage gems, and cultural marvels</p>
    <div class="wb-divider-burgundy"></div>
  </div>
</section>

<main class="container py-4">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <span class="wb-kicker-tag text-uppercase">Curated Attractions</span>
      <h2 class="wb-section-subhead">Popular Sites in <?php echo htmlspecialchars($cityName); ?> (<?php echo $count; ?> Found)</h2>
    </div>
    <span class="wb-badge-pill">
      <i class="fas fa-compass mr-1"></i> WanderBook Spatial Guide
    </span>
  </div>

  <?php if ($count === 0): ?>
    <div class="wb-card-3d p-5 text-center my-4">
      <i class="fas fa-landmark text-burgundy fa-3x mb-3"></i>
      <h3 style="color: var(--wb-burgundy-deep);">No attraction landmarks currently listed for "<?php echo htmlspecialchars($cityName); ?>"</h3>
      <p style="color: #6d5f5c;">Discover top monuments in Paris, Tokyo, New York, or Rome.</p>
      <a href="index.php" class="btn wb-btn-burgundy mt-2">Back to Explorer</a>
    </div>
  <?php else: ?>

    <div class="row mb-5">
      <?php for ($i = 0; $i < $count; $i++): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
            <div class="wb-card-img-wrap">
              <img src="assets/img/<?php echo htmlspecialchars($img[$i]); ?>" class="wb-card-img" alt="<?php echo htmlspecialchars($location[$i]); ?>"
                   onerror="this.src='https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=600&q=80'">
              <span class="wb-tag-burgundy">
                <i class="fas fa-landmark mr-1"></i> <?php echo !empty($type[$i]) ? htmlspecialchars($type[$i]) : 'Landmark'; ?>
              </span>
            </div>
            <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
              <h4 class="wb-card-title"><?php echo htmlspecialchars($location[$i]); ?></h4>
              <p class="wb-card-text flex-grow-1 small">
                <?php 
                $descText = htmlspecialchars($des[$i]);
                echo (strlen($descText) > 130) ? substr($descText, 0, 130) . '...' : $descText;
                ?>
              </p>

              <div class="mb-3 small" style="color: #6d5f5c;">
                <?php if (!empty($hour[$i])): ?>
                  <div><i class="far fa-clock mr-1 text-burgundy"></i> Hours: <strong><?php echo htmlspecialchars($hour[$i]); ?></strong></div>
                <?php endif; ?>
                <?php if (!empty($ticket[$i])): ?>
                  <div><i class="fas fa-ticket-alt mr-1 text-burgundy"></i> Ticket: <strong><?php echo htmlspecialchars($ticket[$i]); ?></strong></div>
                <?php endif; ?>
              </div>

              <div class="pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
                <a href="details.php?destination=<?php echo urlencode($location[$i]); ?>" class="btn wb-btn-burgundy-sm btn-block">
                  View Full Landmark Details <i class="fas fa-arrow-right ml-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>

  <?php endif; ?>

  <!-- Top Deals Row -->
  <div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <div>
      <span class="wb-kicker-tag text-uppercase">Expedition Deals</span>
      <h2 class="wb-section-subhead">Top Packages for Travelers</h2>
    </div>
    <a href="offer.php" class="btn wb-btn-outline-sm">All Packages</a>
  </div>

  <div class="row">
    <!-- Deal 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/bali.jpg" class="wb-card-img" alt="Bali Deal"
               onerror="this.src='https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Popular</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">Bali Villa + Flights</h5>
          <p class="wb-card-text flex-grow-1">Tropical sanctuary villa with luxury spa treatments and daily breakfast.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$850</span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Deal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Deal 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/cancun.jpg" class="wb-card-img" alt="Cancun Deal"
               onerror="this.src='https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Special</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">All-Inclusive Cancún</h5>
          <p class="wb-card-text flex-grow-1">Private beach, reef catamaran tour, and luxury resort amenities.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$1,120</span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Deal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Deal 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/europe.jpg" class="wb-card-img" alt="Europe Cruise"
               onerror="this.src='https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Top Pick</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">European River Odyssey</h5>
          <p class="wb-card-text flex-grow-1">Boutique high-speed rail and river cruise journeys through historic capitals.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$1,450</span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Deal</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php
include 'footer.php';
?>
