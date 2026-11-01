<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'header.php';
?>

<!-- 3D Exclusive Deals Header -->
<section class="py-5" style="background: radial-gradient(circle at 50% 30%, rgba(137, 154, 136, 0.3) 0%, transparent 60%);">
  <div class="container text-center">
    <div class="wb-badge-pill mb-3">
      <i class="fas fa-gem mr-1"></i> WanderBook Privileges
    </div>
    <h1 class="wb-title-3d display-4">Curated Travel Deals</h1>
    <p class="wb-subtitle lead mb-0">Exclusive seasonal expeditions, luxury resort escapes, and complete journey packages</p>
    <div class="wb-divider-burgundy"></div>
  </div>
</section>

<main class="container py-4">

  <!-- Featured Holiday Packages -->
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <span class="wb-kicker-tag text-uppercase">Signature Getaways</span>
      <h2 class="wb-section-subhead">All-Inclusive Travel Packages</h2>
    </div>
    <span class="wb-badge-pill">
      <i class="fas fa-percent mr-1"></i> Up to 45% Off
    </span>
  </div>

  <div class="row mb-5">
    <!-- Deal 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/bali.jpg" class="wb-card-img" alt="Bali Paradise"
               onerror="this.src='https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-tag mr-1"></i> 35% OFF</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <span class="small font-weight-bold" style="color: var(--wb-burgundy-light); letter-spacing: 1px;">7 DAYS / 6 NIGHTS</span>
          <h4 class="wb-card-title mt-1">Bali Serenity Villa + Flights</h4>
          <p class="wb-card-text flex-grow-1">Private infinity plunge pool villa in Ubud, breakfast overlooking misty jungles, roundtrip flights, and VIP airport escort.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$850</span>
              <small style="color: #6d5f5c;"> / person</small>
            </div>
            <a href="dest.php?destination=Bali" class="btn wb-btn-burgundy-sm">Book Deal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Deal 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/cancun.jpg" class="wb-card-img" alt="Cancun Beach"
               onerror="this.src='https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-cocktail mr-1"></i> All-Inclusive</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <span class="small font-weight-bold" style="color: var(--wb-burgundy-light); letter-spacing: 1px;">5 DAYS / 4 NIGHTS</span>
          <h4 class="wb-card-title mt-1">Cancún Caribbean 5-Star Haven</h4>
          <p class="wb-card-text flex-grow-1">Pure oceanfront luxury with unlimited international dining, watersports, tequila tasting, and sunset catamaran tours.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$1,120</span>
              <small style="color: #6d5f5c;"> / person</small>
            </div>
            <a href="dest.php?destination=Cancun" class="btn wb-btn-burgundy-sm">Book Deal</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Deal 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/europe.jpg" class="wb-card-img" alt="European Cruise"
               onerror="this.src='https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy"><i class="fas fa-ship mr-1"></i> Cruise Deal</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <span class="small font-weight-bold" style="color: var(--wb-burgundy-light); letter-spacing: 1px;">10 DAYS / 9 NIGHTS</span>
          <h4 class="wb-card-title mt-1">Rhine &amp; Danube Luxury Cruise</h4>
          <p class="wb-card-text flex-grow-1">Panoramic glass-balcony staterooms, world-heritage excursions in Vienna and Budapest, and gourmet sommelier dinners.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$1,450</span>
              <small style="color: #6d5f5c;"> / person</small>
            </div>
            <a href="dest.php?destination=Europe" class="btn wb-btn-burgundy-sm">Book Deal</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Luxury Room Offers -->
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <span class="wb-kicker-tag text-uppercase">Boutique Accommodations</span>
      <h2 class="wb-section-subhead">Featured Suite Privileges</h2>
    </div>
    <a href="hotels.php" class="btn wb-btn-outline-sm">Explore All Hotels</a>
  </div>

  <div class="row">
    <!-- Room 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/montmartre.jpg" class="wb-card-img" alt="Classic Paris Room"
               onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Parisian Suite</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <h4 class="wb-card-title">Classic Montmartre Bedroom</h4>
          <p class="wb-card-text flex-grow-1">Hand-carved French oak furnishings, private espresso bar, marble bathroom, and views over Parisian rooftops.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$150</span>
              <small style="color: #6d5f5c;"> / night</small>
            </div>
            <a href="hotels.php" class="btn wb-btn-burgundy-sm">Reserve</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Room 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/eiffel_tower.jpg" class="wb-card-img" alt="Premium View Room"
               onerror="this.src='https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Eiffel View</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <h4 class="wb-card-title">Grand Horizon Terrace Suite</h4>
          <p class="wb-card-text flex-grow-1">Private glass balcony facing the Eiffel Tower, king featherbed, butler service, and complimentary champagne.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$230</span>
              <small style="color: #6d5f5c;"> / night</small>
            </div>
            <a href="hotels.php" class="btn wb-btn-burgundy-sm">Reserve</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Room 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="wb-card-3d h-100 d-flex flex-column" data-tilt>
        <div class="wb-card-img-wrap">
          <img src="assets/img/louvre_museum.jpg" class="wb-card-img" alt="Family Suite"
               onerror="this.src='https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=600&q=80'">
          <span class="wb-tag-burgundy">Royal Heritage</span>
        </div>
        <div class="card-body wb-card-body d-flex flex-column flex-grow-1">
          <h4 class="wb-card-title">Palais Royal Heritage Apartment</h4>
          <p class="wb-card-text flex-grow-1">Two-bedroom master suite with spacious living salon, curator art collection, and walk-in rain showers.</p>
          <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1.5px solid rgba(104, 23, 41, 0.12);">
            <div>
              <span class="wb-price-tag">$310</span>
              <small style="color: #6d5f5c;"> / night</small>
            </div>
            <a href="hotels.php" class="btn wb-btn-burgundy-sm">Reserve</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php
include 'footer.php';
?>
