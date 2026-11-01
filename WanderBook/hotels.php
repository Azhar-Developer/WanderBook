<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'database.php';

// Execute the SQL query for location filter
$sql = "SELECT DISTINCT `location` FROM `hotel` ORDER BY `location`";
$result = $conn->query($sql);

$dest = isset($_POST['dest']) ? trim($_POST['dest']) : '';

if (!empty($dest)) {
    $sql3 = "SELECT * FROM hotel WHERE location = '$dest'";
} else {
    $sql3 = "SELECT * FROM hotel ORDER BY id ASC LIMIT 8";
}

$result3 = $conn->query($sql3);
$count = 0;
$name = array();
$desc = array();
$rating = array();
$location = array();
$img = array();
$price = array();

if ($result3) {
    while ($row3 = $result3->fetch_assoc()) {
        $name[$count] = $row3['name'];
        $desc[$count] = $row3['description'];
        $rating[$count] = $row3['rating'];
        $location[$count] = $row3['location'];
        $img[$count] = $row3['image'];
        $price[$count] = $row3['price'];
        $count++;
    }
}

include 'header.php';
?>

<!-- 3D Hotels Header -->
<section class="py-5" style="background: radial-gradient(circle at 50% 30%, rgba(137, 154, 136, 0.3) 0%, transparent 60%);">
  <div class="container text-center">
    <div class="wb-badge-pill mb-3">
      <i class="fas fa-gem mr-1"></i> Heritage &amp; Luxury Stays
    </div>
    <h1 class="wb-title-3d display-4">Discover Sanctuary Stays</h1>
    <p class="wb-subtitle lead mb-4">Hand-selected boutique hotels, villas, and suites offering spatial peace and curated luxury</p>

    <!-- Hotel Search Hub -->
    <div class="wb-search-hub-3d p-4" style="max-width: 680px;">
      <form action="hotels.php" method="POST" class="m-0">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" style="background: transparent; border: none; color: var(--wb-burgundy-main); font-size: 20px;">
              <i class="fas fa-map-marked-alt"></i>
            </span>
          </div>
          <input class="form-control wb-search-input" name="dest" list="destinationList"
                 placeholder="Enter destination (e.g. Paris, Bali, Rome, Tokyo)..." value="<?php echo htmlspecialchars($dest); ?>" autocomplete="off">
          <datalist id="destinationList">
            <?php 
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($row['location']) . '">';
              }
            }
            ?>
          </datalist>
          <div class="input-group-append">
            <button class="btn wb-btn-burgundy" type="submit">
              <i class="fas fa-search mr-1"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>

  </div>
</section>

<!-- Hotel Results Listing -->
<main class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <span class="wb-kicker-tag text-uppercase">Accommodations</span>
      <h2 class="wb-section-subhead">
        <?php if (!empty($dest)): ?>
          Best Hotels in <?php echo htmlspecialchars($dest); ?> (<?php echo $count; ?> Found)
        <?php else: ?>
          Featured Global Luxury Stays
        <?php endif; ?>
      </h2>
    </div>
    <span class="wb-badge-pill">
      <i class="fas fa-award mr-1"></i> Vetted by WanderBook
    </span>
  </div>

  <?php if ($count === 0): ?>
    <div class="wb-card-3d p-5 text-center my-4">
      <i class="fas fa-hotel text-burgundy fa-3x mb-3"></i>
      <h3 style="color: var(--wb-burgundy-deep);">No hotels found in "<?php echo htmlspecialchars($dest); ?>"</h3>
      <p style="color: #6d5f5c;">Try exploring Paris, Rome, Bali, or other popular destinations.</p>
      <a href="hotels.php" class="btn wb-btn-burgundy mt-2">View All Hotels</a>
    </div>
  <?php else: ?>

    <div class="row">
      <?php for ($i = 0; $i < $count; $i++): ?>
        <div class="col-lg-6 mb-4">
          <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
            <div class="row no-gutters h-100">
              <!-- Hotel Image -->
              <div class="col-md-5">
                <div class="wb-card-img-wrap h-100" style="min-height: 220px;">
                  <img src="assets/img/<?php echo htmlspecialchars($img[$i]); ?>" class="wb-card-img" alt="<?php echo htmlspecialchars($name[$i]); ?>"
                       onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80'">
                  <span class="wb-tag-burgundy">
                    <i class="fas fa-star mr-1"></i> <?php echo htmlspecialchars($rating[$i]); ?>.0
                  </span>
                </div>
              </div>

              <!-- Hotel Details -->
              <div class="col-md-7 d-flex flex-column p-4">
                <div class="flex-grow-1">
                  <span class="small font-weight-bold" style="color: var(--wb-burgundy-light); letter-spacing: 1px; text-transform: uppercase;">
                    <i class="fas fa-map-pin mr-1"></i> <?php echo htmlspecialchars($location[$i]); ?>
                  </span>
                  <h4 class="wb-card-title mt-1 mb-2"><?php echo htmlspecialchars($name[$i]); ?></h4>
                  
                  <!-- Star Rating Visual -->
                  <div class="mb-2 text-warning small">
                    <?php 
                    $stars = (int)$rating[$i];
                    for ($s = 0; $s < 5; $s++) {
                      echo ($s < $stars) ? '<i class="fas fa-star mr-1"></i>' : '<i class="far fa-star mr-1 text-muted"></i>';
                    }
                    ?>
                  </div>

                  <p class="wb-card-text small mb-3">
                    <?php 
                    $excerpt = htmlspecialchars($desc[$i]);
                    echo (strlen($excerpt) > 110) ? substr($excerpt, 0, 110) . '...' : $excerpt;
                    ?>
                  </p>

                  <div class="d-flex align-items-center mb-2 small" style="color: #28a745; font-weight: 600;">
                    <i class="fas fa-check-circle mr-1"></i> Free Cancellation &bull; No Prepayment
                  </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
                  <div>
                    <span class="wb-price-tag">$<?php echo htmlspecialchars($price[$i]); ?></span>
                    <small style="color: #6d5f5c;"> / night</small>
                  </div>
                  <a href="hoteldetails.php?destination=<?php echo urlencode($name[$i]); ?>" class="btn wb-btn-burgundy-sm">
                    View Room <i class="fas fa-chevron-right ml-1"></i>
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>

  <?php endif; ?>
</main>

<?php
include 'footer.php';
?>
