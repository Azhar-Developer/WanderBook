<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'database.php';

$id = isset($_GET['destination']) ? intval($_GET['destination']) : 1;

// Retrieve flight data
$queryfl = "SELECT * FROM flights WHERE id = '$id'";
$resultfl = $conn->query($queryfl);
$from = '';
$to = '';
$departureDate = '';
$departureTime = '';
$arrivalDate = '';
$arrivalTime = '';
$airline = '';
$duration = '';
$price = 0;

if ($resultfl && $resultfl->num_rows > 0) {
    $rowfl = $resultfl->fetch_assoc();
    $from = $rowfl['dep'];
    $to = $rowfl['dest'];
    $departureDate = $rowfl['departure_date'];
    $departureTime = $rowfl['departure_time'];
    $arrivalDate = $rowfl['arrival_date'];
    $arrivalTime = $rowfl['arrival_time'];
    $airline = $rowfl['airline'];
    $duration = $rowfl['duration'];
    $price = floatval($rowfl['price']);
}

$fbresult = false;
$invid = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['first'])) {
    $first = $conn->real_escape_string($_POST['first']);
    $last = $conn->real_escape_string($_POST['last']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $address = $conn->real_escape_string($_POST['address']);
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $paymentMethod = $conn->real_escape_string($_POST['paymentMethod']);
    $ccname = $conn->real_escape_string($_POST['ccname']);
    $ccnumber = $conn->real_escape_string($_POST['ccnumber']);
    $ccexpiration = $conn->real_escape_string($_POST['ccexpiration']);
    $ccv = $conn->real_escape_string($_POST['ccv']);
    $cell = $conn->real_escape_string($_POST['cell']);
    $time = date('Y-m-d');

    $amount = (($price * $adults) + (($price / 2) * $children));
    $sertax = $amount * 0.20;
    $total = $sertax + $amount;
    $rand = rand(100, 500);
    $gor = $rand + $id;
    $orderid = "ORDTMS" . $gor;
    $invid = "TMSINV" . $gor . $id;

    $fbquery = "INSERT INTO `flightbook` (`dep`, `dest`, `departure_date`, `departure_time`, `airline`, `fare`, `sertax`, `total`, `orderid`, `invoiceid`, `invoicedate`, `first`, `last`, `username`, `address`, `email`, `cell`, `adultno`, `childno`, `paytype`, `ccname`, `ccnumber`, `ccexpiration`, `ccv`)
                VALUES ('$from','$to','$departureDate','$departureTime', '$airline', '$price', '$sertax', '$total', '$orderid', '$invid', '$time', '$first', '$last', '$username', '$address', '$email', '$cell', '$adults', '$children', '$paymentMethod', '$ccname', '$ccnumber', '$ccexpiration', '$ccv')";
    $fbresult = $conn->query($fbquery);
}

include 'header.php';
?>

<style>
  /* Explicit Dark Letter Styling for Book Flight Form & Cards */
  .wb-flight-form-wrap {
    color: #1a1012 !important;
  }
  
  .wb-flight-card {
    background: var(--wb-cream-light) !important;
    border: 2px solid var(--wb-burgundy-main) !important;
    border-radius: var(--wb-radius-md) !important;
    box-shadow: var(--wb-shadow-card) !important;
    color: #1a1012 !important;
  }

  .wb-flight-card .card-header {
    background: #FAF6EE !important;
    border-bottom: 2px solid var(--wb-burgundy-main) !important;
    padding: 16px 22px !important;
  }

  .wb-flight-card h1, 
  .wb-flight-card h2, 
  .wb-flight-card h3, 
  .wb-flight-card h4, 
  .wb-flight-card h5, 
  .wb-flight-card h6 {
    color: #470D1A !important;
    font-weight: 800 !important;
  }

  .wb-flight-card p, 
  .wb-flight-card span, 
  .wb-flight-card li,
  .wb-flight-card div {
    color: #241618 !important;
    font-size: 14.5px;
  }

  .wb-flight-card strong, 
  .wb-flight-card b {
    color: #12090b !important;
    font-weight: 700 !important;
  }

  /* Booking Form Labels - High Contrast Dark Burgundy/Charcoal */
  .wb-flight-card label,
  .wb-dark-label {
    color: #1e1013 !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    letter-spacing: 0.3px;
    margin-bottom: 6px;
    display: inline-block;
  }

  /* Booking Form Inputs - Jet Dark Typed Text on Pure Crisp White */
  .wb-flight-card .form-control,
  .wb-flight-card input[type="text"],
  .wb-flight-card input[type="email"],
  .wb-flight-card input[type="password"],
  .wb-flight-card select.custom-select,
  .wb-flight-card .custom-select {
    color: #11080a !important;
    background-color: #FFFFFF !important;
    border: 1.5px solid #681729 !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    padding: 11px 15px !important;
    height: auto !important;
    line-height: 1.5;
  }

  .wb-flight-card .form-control:focus,
  .wb-flight-card .custom-select:focus {
    color: #000000 !important;
    background-color: #FFFFFF !important;
    border-color: #8C223A !important;
    box-shadow: 0 0 0 3.5px rgba(104, 23, 41, 0.22) !important;
    outline: none !important;
  }

  .wb-flight-card .form-control::placeholder {
    color: #5c4e51 !important;
    font-weight: 500 !important;
    opacity: 1 !important;
  }

  .wb-flight-card small.text-muted {
    color: #4a3c3e !important;
    font-weight: 600 !important;
  }

  .wb-flight-card .input-group-text {
    background-color: #F4EFE6 !important;
    border: 1.5px solid #681729 !important;
    color: #681729 !important;
    font-weight: 800 !important;
  }

  .wb-flight-card .custom-control-label {
    color: #1e1013 !important;
    font-weight: 600 !important;
    cursor: pointer;
  }

  .wb-flight-card hr {
    border-top: 1.5px solid rgba(104, 23, 41, 0.18) !important;
  }
</style>

<!-- 3D Booking Header -->
<section class="py-4" style="background: radial-gradient(circle at 50% 30%, rgba(137, 154, 136, 0.3) 0%, transparent 60%);">
  <div class="container text-center">
    <div class="wb-badge-pill mb-2">
      <i class="fas fa-ticket-alt mr-1"></i> Flight Reservation Portal
    </div>
    <h1 class="wb-title-3d display-4" style="font-size: 2.4rem;">Complete Flight Reservation</h1>
    <p class="wb-subtitle lead mb-0">Secure your seat with real-time electronic ticketing and VIP passenger services</p>
    <div class="wb-divider-burgundy"></div>
  </div>
</section>

<main class="container py-4 wb-flight-form-wrap">

  <?php if ($fbresult): ?>
    <!-- Success Invoice Card -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="wb-flight-card p-5 text-center my-4">
          <div class="mb-3">
            <i class="fas fa-check-circle fa-4x" style="color: #28a745;"></i>
          </div>
          <h2 class="mb-2" style="color: var(--wb-burgundy-deep); font-weight: 800;">Reservation Confirmed!</h2>
          <p class="lead mb-4" style="color: #241618;">
            Thank you, <strong><?php echo htmlspecialchars($first . ' ' . $last); ?></strong>. Your flight booking has been confirmed.
          </p>
          <div class="p-3 mb-4 rounded d-inline-block" style="background: #FFFFFF; border: 1.5px solid var(--wb-burgundy-main);">
            <span class="d-block small text-uppercase" style="color: #6d5f5c; font-weight: 700;">Invoice Reference</span>
            <strong style="color: var(--wb-burgundy-main); font-size: 20px;"><?php echo htmlspecialchars($invid); ?></strong>
          </div>
          <div>
            <a href="flightinvoice.php?invid=<?php echo urlencode($invid); ?>" class="btn wb-btn-burgundy px-4 py-2">
              <i class="fas fa-file-invoice mr-1"></i> View Electronic Ticket &amp; Invoice
            </a>
            <a href="flights.php" class="btn wb-btn-outline px-4 py-2 ml-2">
              <i class="fas fa-search mr-1"></i> Book Another Flight
            </a>
          </div>
        </div>
      </div>
    </div>

  <?php else: ?>

    <!-- Flight Itinerary Overview Banner -->
    <div class="wb-flight-card mb-4">
      <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
        <div>
          <span class="badge" style="background: var(--wb-burgundy-main); color: var(--wb-cream-light); font-size: 13px; font-weight: 700; border-radius: var(--wb-radius-pill); padding: 5px 14px;">
            <i class="fas fa-plane mr-1"></i> <?php echo htmlspecialchars($airline); ?>
          </span>
          <span class="badge" style="background:#e8d399; color:#523b05; font-size:12px; font-weight:800; border-radius:var(--wb-radius-pill); padding:5px 12px; margin-left:6px;">
            <i class="fas fa-certificate mr-1" style="color:#b8860b;"></i> 2026 Season Ticket
          </span>
          <span class="ml-2 font-weight-bold" style="color: var(--wb-burgundy-deep); font-size: 17px;">
            <?php echo htmlspecialchars($from); ?> &rarr; <?php echo htmlspecialchars($to); ?>
          </span>
        </div>
        <div>
          <span class="wb-price-tag" style="font-size: 1.6rem;">$<?php echo htmlspecialchars($price); ?></span>
          <small style="color: #3b2a2d; font-weight: 600;"> / seat</small>
        </div>
      </div>

      <?php
        $rawDep = str_replace('2023', '2026', $departureDate);
        $tsDep = strtotime($rawDep);
        $displayDep = $tsDep ? date('D, d M 2026', $tsDep) : $rawDep;
        $rawArr = str_replace('2023', '2026', $arrivalDate);
        $tsArr = strtotime($rawArr);
        $displayArr = $tsArr ? date('D, d M 2026', $tsArr) : $rawArr;
      ?>

      <div class="card-body p-4">
        <div class="row text-center text-md-left">
          <div class="col-md-3 mb-3 mb-md-0">
            <span class="small font-weight-bold text-uppercase d-block" style="color: #59474a;">Departure Airport</span>
            <strong style="color: #12090b; font-size: 17px;"><?php echo htmlspecialchars($from); ?></strong>
            <div class="small mt-1"><i class="far fa-calendar-alt text-burgundy mr-1"></i> <?php echo htmlspecialchars($displayDep); ?></div>
            <div class="small"><i class="far fa-clock text-burgundy mr-1"></i> <?php echo htmlspecialchars($departureTime); ?></div>
          </div>

          <div class="col-md-3 mb-3 mb-md-0 text-center">
            <span class="badge badge-light px-3 py-1 mb-2" style="border: 1.5px solid var(--wb-burgundy-main); color: var(--wb-burgundy-main); font-weight: 700;">
              <i class="far fa-clock mr-1"></i> <?php echo htmlspecialchars($duration); ?>
            </span>
            <div class="d-flex align-items-center justify-content-center">
              <div style="height: 2px; flex-grow: 1; background: var(--wb-burgundy-main);"></div>
              <i class="fas fa-plane mx-2" style="color: var(--wb-burgundy-main); font-size: 18px; transform: rotate(45deg);"></i>
              <div style="height: 2px; flex-grow: 1; background: var(--wb-burgundy-main);"></div>
            </div>
            <small style="color: #28a745; font-weight: 700;"><i class="fas fa-check-circle mr-1"></i> Direct Route</small>
          </div>

          <div class="col-md-3 mb-3 mb-md-0">
            <span class="small font-weight-bold text-uppercase d-block" style="color: #59474a;">Arrival Airport</span>
            <strong style="color: #12090b; font-size: 17px;"><?php echo htmlspecialchars($to); ?></strong>
            <div class="small mt-1"><i class="far fa-calendar-alt text-burgundy mr-1"></i> <?php echo htmlspecialchars($displayArr); ?></div>
            <div class="small"><i class="far fa-clock text-burgundy mr-1"></i> <?php echo htmlspecialchars($arrivalTime); ?></div>
          </div>

          <div class="col-md-3 text-center text-md-right">
            <span class="small font-weight-bold text-uppercase d-block" style="color: #59474a;">Class</span>
            <strong style="color: var(--wb-burgundy-main); font-size: 16px;"><i class="fas fa-star mr-1"></i> Premium Economy</strong>
            <div class="small mt-2" style="color: #28a745; font-weight: 700;">
              <i class="fas fa-suitcase mr-1"></i> 27kg Luggage Included
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Booking & Passenger Form Row -->
    <div class="row">
      <!-- Passenger & Payment Form (8 Columns) -->
      <div class="col-lg-8 mb-4">
        <div class="wb-flight-card p-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="mb-0" style="color: var(--wb-burgundy-deep); font-size: 1.5rem;">
              <i class="fas fa-user-check mr-2 text-burgundy"></i> Passenger &amp; Payment Details
            </h3>
            <span class="badge badge-success px-3 py-1 font-weight-bold">SSL 256-Bit Encrypted</span>
          </div>
          <hr>

          <form method="POST" action="">
            <!-- Passenger Name Row -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="firstName"><i class="fas fa-user mr-1 text-burgundy"></i> First Name *</label>
                <input type="text" class="form-control" id="firstName" name="first" placeholder="e.g. Alexander" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="lastName"><i class="fas fa-user mr-1 text-burgundy"></i> Last Name *</label>
                <input type="text" class="form-control" id="lastName" name="last" placeholder="e.g. Vance" required>
              </div>
            </div>

            <!-- Account & Contact Info -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="username"><i class="fas fa-at mr-1 text-burgundy"></i> Username / WanderBook ID *</label>
                <input type="text" class="form-control" id="username" name="username" 
                       value="<?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : ''; ?>" 
                       placeholder="e.g. alex_vance" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="email"><i class="fas fa-envelope mr-1 text-burgundy"></i> Email Address *</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="e.g. alex@example.com" required>
              </div>
            </div>

            <!-- Phone & Address -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="cell"><i class="fas fa-phone mr-1 text-burgundy"></i> Mobile Phone Number *</label>
                <input type="text" class="form-control" id="cell" name="cell" placeholder="e.g. +1 (555) 019-2834" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="address"><i class="fas fa-map-marker-alt mr-1 text-burgundy"></i> Residential Address *</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="e.g. 742 Evergreen Terrace, Springfield" required>
              </div>
            </div>

            <hr>

            <!-- Passenger Count -->
            <h4 class="mt-4 mb-3" style="color: var(--wb-burgundy-deep); font-size: 1.25rem;">
              <i class="fas fa-users mr-2 text-burgundy"></i> Traveling Party
            </h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="adults"><i class="fas fa-male mr-1 text-burgundy"></i> Adults (Age 12+) *</label>
                <select class="custom-select" name="adults" id="adults" required>
                  <option value="1" selected>1 Adult</option>
                  <option value="2">2 Adults</option>
                  <option value="3">3 Adults</option>
                  <option value="4">4 Adults</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="children"><i class="fas fa-child mr-1 text-burgundy"></i> Children (Age 2-11)</label>
                <select class="custom-select" name="children" id="children">
                  <option value="0" selected>0 Children</option>
                  <option value="1">1 Child</option>
                  <option value="2">2 Children</option>
                  <option value="3">3 Children</option>
                </select>
              </div>
            </div>

            <hr>

            <!-- Payment Methods -->
            <h4 class="mt-4 mb-3" style="color: var(--wb-burgundy-deep); font-size: 1.25rem;">
              <i class="fas fa-credit-card mr-2 text-burgundy"></i> Payment Method
            </h4>
            <div class="d-flex align-items-center mb-4">
              <div class="custom-control custom-radio mr-4">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="Credit card" checked required>
                <label class="custom-control-label" for="credit">
                  <i class="fab fa-cc-visa mr-1"></i> Credit Card
                </label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" value="Debit card" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">
                  <i class="fab fa-cc-mastercard mr-1"></i> Debit Card
                </label>
              </div>
            </div>

            <!-- Card Information -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="cc-name"><i class="fas fa-id-card mr-1 text-burgundy"></i> Name on Card *</label>
                <input type="text" class="form-control" id="cc-name" name="ccname" placeholder="Full name as printed on card" required>
                <small class="text-muted">Exact name printed on front of card</small>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="cc-number"><i class="fas fa-credit-card mr-1 text-burgundy"></i> Card Number *</label>
                <input type="text" class="form-control" id="cc-number" name="ccnumber" placeholder="4532 &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; 8921" required>
                <small class="text-muted">16-digit card number without spaces</small>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="cc-expiration"><i class="far fa-calendar-alt mr-1 text-burgundy"></i> Expiration Date *</label>
                <input type="text" class="form-control" id="cc-expiration" name="ccexpiration" placeholder="MM/26+" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="wb-dark-label" for="ccv"><i class="fas fa-lock mr-1 text-burgundy"></i> CVV Security Code *</label>
                <input type="password" class="form-control" id="ccv" name="ccv" placeholder="3 digits on back" maxlength="4" required>
              </div>
            </div>

            <!-- Terms agreement -->
            <div class="custom-control custom-checkbox my-4">
              <input class="custom-control-input" id="agree" required type="checkbox" checked>
              <label class="custom-control-label" for="agree">
                I agree to the <strong>WanderBook Flight Booking Terms, Conditions &amp; Carrier Policies</strong>.
              </label>
            </div>

            <!-- Submit Button -->
            <button class="btn wb-btn-burgundy btn-block py-3" type="submit" style="font-size: 17px; font-weight: 800;">
              <i class="fas fa-check-circle mr-2"></i> Confirm Flight Reservation &amp; Generate Ticket
            </button>
          </form>

        </div>
      </div>

      <!-- Right Column: Flight Summary & Perks (4 Columns) -->
      <div class="col-lg-4 mb-4">
        <!-- Flight Visual Card -->
        <div class="wb-flight-card mb-4 overflow-hidden">
          <img src="assets/img/flbg.jpg" class="img-fluid w-100" alt="Flight Aircraft" 
               style="height: 180px; object-fit: cover;"
               onerror="this.src='https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=600&q=80'">
          <div class="p-3">
            <h5 class="mb-2" style="color: var(--wb-burgundy-deep); font-weight: 800;"><?php echo htmlspecialchars($airline); ?> Flagship</h5>
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success mr-2">Confirmed Flight</span>
              <span class="small font-weight-bold" style="color: #470D1A;"><?php echo htmlspecialchars($from); ?> &bull; <?php echo htmlspecialchars($to); ?></span>
            </div>
            <ul class="list-unstyled mb-0 small" style="color: #241618;">
              <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> High-Speed In-Flight Wi-Fi Included</li>
              <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Complimentary Chef-Curated Meals</li>
              <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> 24-Hour Cancellation Guarantee</li>
              <li><i class="fas fa-check text-success mr-2"></i> Priority Boarding Pass &amp; QR Check-in</li>
            </ul>
          </div>
        </div>

        <!-- Baggage Allowance Box -->
        <div class="wb-flight-card p-3 mb-4">
          <h5 class="mb-2" style="color: var(--wb-burgundy-deep); font-size: 16px;">
            <i class="fas fa-suitcase-rolling mr-2 text-burgundy"></i> Baggage Allowance
          </h5>
          <div class="d-flex justify-content-between align-items-center mb-2 pb-2" style="border-bottom: 1px dashed rgba(104, 23, 41, 0.2);">
            <span style="font-weight: 600;"><i class="fas fa-briefcase mr-1 text-burgundy"></i> Cabin Baggage</span>
            <strong style="color: #12090b;">7 kg (1 Piece)</strong>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <span style="font-weight: 600;"><i class="fas fa-suitcase mr-1 text-burgundy"></i> Checked Baggage</span>
            <strong style="color: #12090b;">20 kg (1 Piece)</strong>
          </div>
        </div>

        <!-- Need Help Box -->
        <div class="wb-flight-card p-3 text-center" style="background: rgba(104, 23, 41, 0.08) !important;">
          <i class="fas fa-headset fa-2x mb-2 text-burgundy"></i>
          <h5 class="mb-1" style="color: var(--wb-burgundy-deep); font-size: 16px;">Need Booking Assistance?</h5>
          <p class="small mb-2" style="color: #473a3d;">Our WanderBook concierge team is available 24/7 to help you.</p>
          <a href="tel:+18005550199" class="btn wb-btn-outline-sm btn-block">
            <i class="fas fa-phone mr-1"></i> Call Concierge: 1-800-WANDER
          </a>
        </div>
      </div>
    </div>

  <?php endif; ?>

</main>

<?php
include 'footer.php';
?>
