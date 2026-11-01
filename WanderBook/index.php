<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'database.php';
include 'header.php';

$query = "SELECT * FROM `Locations` ORDER BY `name`";
$result = $conn->query($query);
?>

<!-- 3D Interactive Hero Section with Three.js Spatial Globe -->
<section class="wb-hero-3d">
  <!-- 3D WebGL Canvas Layer -->
  <div id="wb-three-canvas"></div>

  <!-- Hero Content Layer -->
  <div class="container wb-hero-content">
    <div class="wb-hero-kicker">
      <i class="fas fa-cube text-burgundy"></i> Spatial Travel Architecture
    </div>
    
    <h1 class="wb-hero-title">
      Curated Journeys.<br>
      <span>WanderBook 3D.</span>
    </h1>
    
    <p class="wb-hero-subtitle">
      Explore iconic global cities, book premier flights, and experience heritage sanctuaries through a tailored 3D spatial interface.
    </p>

    <!-- 3D Search Hub -->
    <div class="wb-search-hub-3d">
      <form class="search-bar m-0" action="dest.php" method="post">
        <div class="wb-search-input-group">
          <span class="wb-search-icon"><i class="fas fa-compass"></i></span>
          <input class="form-control wb-search-input" name="destination" list="datalistOptions" id="exampleDataList"
                 placeholder="Search city, country or landmark (e.g. Paris, Tokyo, Bali)..." autocomplete="off" required>
          <datalist id="datalistOptions">
            <?php 
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($row['name']) . '">';
              }
            }
            ?>
          </datalist>
          <button class="btn wb-search-btn" type="submit">
            <i class="fas fa-search mr-1"></i> Explore
          </button>
        </div>
      </form>
    </div>

    <!-- Quick Navigation Pills -->
    <div class="wb-quick-links">
      <a href="dest.php?destination=Paris" class="wb-quick-pill"><i class="fas fa-map-pin mr-1"></i> Paris</a>
      <a href="dest.php?destination=Tokyo" class="wb-quick-pill"><i class="fas fa-map-pin mr-1"></i> Tokyo</a>
      <a href="dest.php?destination=New+York" class="wb-quick-pill"><i class="fas fa-map-pin mr-1"></i> New York</a>
      <a href="flights.php" class="wb-quick-pill"><i class="fas fa-plane mr-1"></i> Flight Search</a>
      <a href="hotels.php" class="wb-quick-pill"><i class="fas fa-bed mr-1"></i> Luxury Hotels</a>
    </div>

  </div>
</section>

<!-- Main Highlights Section -->
<main class="container py-5">
  
  <!-- Popular Cities Header -->
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <span class="wb-kicker-tag text-uppercase">Iconic Horizons</span>
      <h2 class="wb-section-subhead">Popular Global Destinations</h2>
    </div>
    <span class="wb-badge-pill d-none d-md-inline-block">
      <i class="fas fa-globe-americas mr-1"></i> Interactive 3D Perspective
    </span>
  </div>

  <!-- 3D Popular Cities Cards -->
  <div class="row mb-5">
    <!-- Paris -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/paris.jpg" class="wb-card-img" alt="Paris, France"
               onerror="this.src='https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-heart mr-1"></i> France</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">Paris, France</h5>
          <p class="wb-card-text flex-grow-1">Experience the romance, fine arts, haute cuisine, and haute horlogerie of the City of Light.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">From $420</span>
            <form action="dest.php" method="POST" class="m-0">
              <input type="hidden" name="destination" value="Paris">
              <button type="submit" class="btn wb-btn-burgundy-sm">
                Explore <i class="fas fa-arrow-right ml-1"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Tokyo -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/tokyo.jpg" class="wb-card-img" alt="Tokyo, Japan"
               onerror="this.src='https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-torii-gate mr-1"></i> Japan</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">Tokyo, Japan</h5>
          <p class="wb-card-text flex-grow-1">Discover hyper-modern neon skylines harmonized seamlessly with serene Shinto temples and Michelin-star culinary dining.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">From $680</span>
            <form action="dest.php" method="POST" class="m-0">
              <input type="hidden" name="destination" value="Tokyo">
              <button type="submit" class="btn wb-btn-burgundy-sm">
                Explore <i class="fas fa-arrow-right ml-1"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- New York -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/newyork.jpg" class="wb-card-img" alt="New York, USA"
               onerror="this.src='https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-city mr-1"></i> USA</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">New York City, USA</h5>
          <p class="wb-card-text flex-grow-1">Immerse yourself in Broadway premieres, iconic architectural marvels, and the world's most vibrant urban pulse.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">From $510</span>
            <form action="dest.php" method="POST" class="m-0">
              <input type="hidden" name="destination" value="New York City">
              <button type="submit" class="btn wb-btn-burgundy-sm">
                Explore <i class="fas fa-arrow-right ml-1"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 3D Feature Matrix Grid -->
  <div class="wb-features-grid">
    <div class="wb-feature-card">
      <div class="wb-feature-icon">
        <i class="fas fa-plane-departure"></i>
      </div>
      <h4 class="wb-feature-title">Global Flight Engine</h4>
      <p class="wb-feature-text">Real-time scheduling across tier-1 international carriers with seamless seat selection and direct ticketing.</p>
    </div>

    <div class="wb-feature-card">
      <div class="wb-feature-icon">
        <i class="fas fa-hotel"></i>
      </div>
      <h4 class="wb-feature-title">Boutique Sanctuaries</h4>
      <p class="wb-feature-text">Hand-verified luxury suites, seaside resorts, and private villas vetted for extraordinary comfort.</p>
    </div>

    <div class="wb-feature-card">
      <div class="wb-feature-icon">
        <i class="fas fa-layer-group"></i>
      </div>
      <h4 class="wb-feature-title">3D Spatial Interface</h4>
      <p class="wb-feature-text">Proprietary spatial web design by Azharudeen A, offering interactive 3D perspective cards and planetary orbits.</p>
    </div>

    <div class="wb-feature-card">
      <div class="wb-feature-icon">
        <i class="fas fa-user-shield"></i>
      </div>
      <h4 class="wb-feature-title">VIP Concierge Care</h4>
      <p class="wb-feature-text">Dedicated personal travel itineraries, automated flight disruption rebooking, and priority check-ins.</p>
    </div>
  </div>

  <!-- Top Deals Section -->
  <div class="d-flex align-items-center justify-content-between mb-4 mt-5">
    <div>
      <span class="wb-kicker-tag text-uppercase">Exclusive Packages</span>
      <h2 class="wb-section-subhead">Top Curated WanderBook Deals</h2>
    </div>
    <a href="offer.php" class="btn wb-btn-outline-sm">
      All Deals <i class="fas fa-arrow-right ml-1"></i>
    </a>
  </div>

  <div class="row">
    <!-- Bali Package -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/bali.jpg" class="wb-card-img" alt="Bali Package"
               onerror="this.src='https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-tag mr-1"></i> Special Package</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">Flight + Luxury Villa: Bali</h5>
          <p class="wb-card-text flex-grow-1">Bespoke 7-day tropical paradise escape with complimentary infinity pool suite and airport transfers.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$790 <small>/ person</small></span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Package</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Cancun Package -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/cancun.jpg" class="wb-card-img" alt="Cancun Package"
               onerror="this.src='https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-sun mr-1"></i> All-Inclusive</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">All-Inclusive Resort: Cancún</h5>
          <p class="wb-card-text flex-grow-1">Unwind along private Caribbean sands with unlimited gourmet dining and Mayan heritage catamaran cruise.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$980 <small>/ person</small></span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Package</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Europe Cruise Package -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/europe.jpg" class="wb-card-img" alt="Europe Tour"
               onerror="this.src='https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-ship mr-1"></i> River Cruise</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column">
          <h5 class="wb-card-title">European River Expedition</h5>
          <p class="wb-card-text flex-grow-1">Glide through the historic waterways of Amsterdam, Cologne, and Strasbourg in unmatched 5-star elegance.</p>
          <div class="d-flex align-items-center justify-content-between mt-3">
            <span class="wb-price-tag">$1,350 <small>/ person</small></span>
            <a href="offer.php" class="btn wb-btn-burgundy-sm">View Package</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Architect Signature Banner -->
  <div class="mt-5 p-4 rounded-lg text-center" style="background: rgba(91, 108, 90, 0.7); border: 2px solid var(--wb-burgundy-main); backdrop-filter: blur(8px);">
    <div class="d-md-flex align-items-center justify-content-between">
      <div class="text-md-left mb-3 mb-md-0">
        <span class="wb-kicker-tag text-uppercase">WanderBook Spatial Travel Initiative</span>
        <h4 class="mb-1" style="color: var(--wb-cream-light); font-weight: 800;">Architected by Azharudeen A</h4>
        <p class="mb-0 small" style="color: var(--wb-cream-gold);">Student / Engineer ID: <strong>35125018</strong> &bull; Custom 3D UI, MariaDB Architecture, &amp; PHP Engine</p>
      </div>
      <div>
        <a href="meet-the-team.php" class="btn wb-btn-burgundy">
          <i class="fas fa-user-astronaut mr-1"></i> View Architect Profile
        </a>
      </div>
    </div>
  </div>

</main>

<?php
include 'footer.php';
?>
