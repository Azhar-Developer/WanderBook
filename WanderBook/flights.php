<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'database.php';

// Retrieve unique departure and destination lists
$sql = "SELECT DISTINCT `dep` FROM `flights` ORDER BY `dep`";
$result = $conn->query($sql);
$sql2 = "SELECT DISTINCT `dest` FROM `flights` ORDER BY `dest`";
$result2 = $conn->query($sql2);

$departureLocation = isset($_POST['departure']) ? trim($_POST['departure']) : '';
$destinationLocation = isset($_POST['destination']) ? trim($_POST['destination']) : '';

// Retrieve matching flights or popular routes
if (!empty($departureLocation) && !empty($destinationLocation)) {
    $sql3 = "SELECT * FROM flights WHERE dep = '$departureLocation' AND dest = '$destinationLocation'";
} elseif (!empty($departureLocation)) {
    $sql3 = "SELECT * FROM flights WHERE dep = '$departureLocation'";
} elseif (!empty($destinationLocation)) {
    $sql3 = "SELECT * FROM flights WHERE dest = '$destinationLocation'";
} else {
    $sql3 = "SELECT * FROM flights ORDER BY id ASC LIMIT 8";
}

$result3 = $conn->query($sql3);
$count = 0;
$from = array(); $to = array(); $id = array();
$departureDate = array(); $departureTime = array();
$arrivalDate = array(); $arrivalTime = array();
$airline = array(); $duration = array(); $price = array();

if ($result3) {
    while ($row3 = $result3->fetch_assoc()) {
        $from[$count]          = $row3['dep'];
        $id[$count]            = $row3['id'];
        $to[$count]            = $row3['dest'];
        $departureDate[$count] = $row3['departure_date'];
        $departureTime[$count] = $row3['departure_time'];
        $arrivalDate[$count]   = $row3['arrival_date'];
        $arrivalTime[$count]   = $row3['arrival_time'];
        $airline[$count]       = $row3['airline'];
        $duration[$count]      = $row3['duration'];
        $price[$count]         = $row3['price'];
        $count++;
    }
}

include 'header.php';
?>

<style>
/* ─── 2026 Boarding-Pass Ticket System ─────────────────────────────────────── */

/* Search Hub */
.wb-flight-search-hub {
  background: rgba(250,246,238,0.72);
  backdrop-filter: blur(18px) saturate(1.5);
  -webkit-backdrop-filter: blur(18px) saturate(1.5);
  border: 1.5px solid rgba(104,23,41,0.22);
  border-radius: 20px;
  box-shadow: 0 8px 40px rgba(104,23,41,0.12), 0 2px 0 rgba(255,255,255,0.6) inset;
}

/* ── Ticket Wrapper ────────────────────────────────────────────────── */
.wb-ticket-wrap {
  perspective: 1000px;
  margin-bottom: 32px;
}

.wb-ticket {
  display: flex;
  border-radius: 20px;
  overflow: visible;
  position: relative;
  filter: drop-shadow(0 16px 40px rgba(104,23,41,0.18)) drop-shadow(0 4px 8px rgba(0,0,0,0.08));
  transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), filter 0.35s ease;
}
.wb-ticket:hover {
  transform: translateY(-6px) scale(1.012);
  filter: drop-shadow(0 28px 55px rgba(104,23,41,0.26)) drop-shadow(0 6px 12px rgba(0,0,0,0.10));
}

/* Main Ticket Body */
.wb-ticket-main {
  flex: 1;
  background: linear-gradient(135deg, #FAF6EE 0%, #F4EFE6 55%, #EDE8DE 100%);
  border-radius: 20px 0 0 20px;
  padding: 0;
  position: relative;
  overflow: hidden;
  border: 1.5px solid rgba(104,23,41,0.2);
  border-right: none;
}

/* Airline stripe accent */
.wb-ticket-main::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 5px;
  background: linear-gradient(90deg, #681729 0%, #8C223A 40%, #B5324F 70%, #681729 100%);
  border-radius: 20px 0 0 0;
}

/* Subtle diagonal watermark */
.wb-ticket-main::after {
  content: 'WANDERBOOK';
  position: absolute;
  bottom: 18px; right: 24px;
  font-size: 64px;
  font-weight: 900;
  letter-spacing: 6px;
  color: rgba(104,23,41,0.045);
  font-family: 'Cinzel', serif;
  pointer-events: none;
  user-select: none;
  white-space: nowrap;
}

/* Ticket Stub (Right Side) */
.wb-ticket-stub {
  width: 160px;
  flex-shrink: 0;
  background: linear-gradient(160deg, #681729 0%, #4a0f1c 100%);
  border-radius: 0 20px 20px 0;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 24px 16px;
  gap: 12px;
  border: 1.5px solid rgba(104,23,41,0.35);
  border-left: none;
  overflow: hidden;
}

/* Stub top decoration */
.wb-ticket-stub::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 5px;
  background: linear-gradient(90deg, #8C223A, #FAF6EE44, #8C223A);
}

/* Perforation / tear line between main & stub */
.wb-ticket-perforation {
  width: 28px;
  flex-shrink: 0;
  position: relative;
  background: transparent;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  overflow: hidden;
}

/* Semi-circle cutouts top & bottom */
.wb-ticket-perforation::before,
.wb-ticket-perforation::after {
  content: '';
  width: 28px;
  height: 14px;
  background: #758674;           /* matches page bg colour */
  position: absolute;
  z-index: 10;
  border: 1.5px solid rgba(104,23,41,0.15);
}
.wb-ticket-perforation::before {
  top: -1px;
  border-radius: 0 0 14px 14px;
  border-top: none;
}
.wb-ticket-perforation::after {
  bottom: -1px;
  border-radius: 14px 14px 0 0;
  border-bottom: none;
}

/* Dashed vertical line */
.wb-perf-line {
  position: absolute;
  top: 12px; bottom: 12px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  border-left: 2.5px dashed rgba(104,23,41,0.25);
  z-index: 5;
}

/* ── Ticket Header ────────────────────────────────────────────── */
.wb-ticket-header {
  padding: 22px 28px 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px dashed rgba(104,23,41,0.18);
}

.wb-airline-name {
  font-family: 'Cinzel', serif;
  font-size: 15px;
  font-weight: 700;
  color: #681729;
  letter-spacing: 1.5px;
  text-transform: uppercase;
}

.wb-ticket-class-badge {
  background: linear-gradient(135deg, #681729, #8C223A);
  color: #FAF6EE;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.2px;
  padding: 4px 12px;
  border-radius: 30px;
  text-transform: uppercase;
}

.wb-ticket-season-badge {
  background: linear-gradient(135deg, rgba(212,175,55,0.2), rgba(212,175,55,0.35));
  border: 1px solid rgba(212,175,55,0.6);
  color: #523b05;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 0.8px;
  padding: 3px 10px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  text-transform: uppercase;
}

.wb-ticket-status {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(40,167,69,0.12);
  border: 1px solid rgba(40,167,69,0.35);
  color: #1a6b30;
  font-size: 11.5px;
  font-weight: 700;
  padding: 4px 11px;
  border-radius: 20px;
  letter-spacing: 0.5px;
}

.wb-ticket-status .status-dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: #28a745;
  animation: pulse-green 1.8s ease-in-out infinite;
}

@keyframes pulse-green {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.4; transform: scale(1.5); }
}

/* ── Route Section ───────────────────────────────────────────── */
.wb-ticket-route {
  padding: 20px 28px 18px;
  display: flex;
  align-items: center;
  gap: 0;
}

.wb-airport-block {
  min-width: 120px;
}

.wb-airport-code {
  font-family: 'Cinzel', serif;
  font-size: 38px;
  font-weight: 900;
  color: #470D1A;
  line-height: 1;
  letter-spacing: -1px;
}

.wb-airport-city {
  font-size: 12px;
  color: #7a5c62;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-top: 4px;
}

.wb-airport-time {
  font-size: 20px;
  font-weight: 800;
  color: #2d1018;
  margin-top: 6px;
}

.wb-airport-date {
  font-size: 11.5px;
  color: #8a6a6e;
  font-weight: 600;
  margin-top: 2px;
}

/* Flight Path Visual */
.wb-flight-path {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  padding: 0 16px;
  position: relative;
}

.wb-flight-path-line {
  display: flex;
  align-items: center;
  width: 100%;
  gap: 0;
  position: relative;
}

.wb-path-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  border: 2px solid #681729;
  background: #FAF6EE;
  flex-shrink: 0;
}

.wb-path-seg {
  flex: 1;
  height: 2px;
  background: linear-gradient(90deg, #681729, rgba(104,23,41,0.3));
  position: relative;
}
.wb-path-seg.right {
  background: linear-gradient(90deg, rgba(104,23,41,0.3), #681729);
}

.wb-plane-icon {
  font-size: 20px;
  color: #681729;
  animation: fly-wobble 3s ease-in-out infinite;
  flex-shrink: 0;
  margin: 0 4px;
  transform: rotate(0deg);
}

@keyframes fly-wobble {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-4px) rotate(3deg); }
}

.wb-duration-chip {
  background: rgba(104,23,41,0.08);
  border: 1px solid rgba(104,23,41,0.2);
  color: #681729;
  font-size: 11.5px;
  font-weight: 700;
  padding: 3px 12px;
  border-radius: 20px;
  letter-spacing: 0.5px;
  white-space: nowrap;
}

.wb-nonstop-tag {
  font-size: 10.5px;
  color: #1a6b30;
  font-weight: 700;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 4px;
}

/* ── Ticket Footer Meta ──────────────────────────────────────── */
.wb-ticket-meta {
  padding: 12px 28px 20px;
  border-top: 1px dashed rgba(104,23,41,0.15);
  display: flex;
  align-items: center;
  gap: 24px;
  flex-wrap: wrap;
}

.wb-meta-item {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.wb-meta-label {
  font-size: 10px;
  color: #9a7a7e;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

.wb-meta-value {
  font-size: 13.5px;
  font-weight: 700;
  color: #2d1018;
}

/* ── Stub Elements ───────────────────────────────────────────── */
.wb-stub-price {
  font-family: 'Cinzel', serif;
  font-size: 26px;
  font-weight: 900;
  color: #FAF6EE;
  line-height: 1;
  text-align: center;
}

.wb-stub-price-label {
  font-size: 10px;
  color: rgba(250,246,238,0.6);
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 600;
  text-align: center;
}

/* QR Code placeholder */
.wb-qr-block {
  width: 72px;
  height: 72px;
  background: #FAF6EE;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.wb-qr-svg {
  width: 56px;
  height: 56px;
  opacity: 0.85;
}

.wb-stub-select-btn {
  display: block;
  width: 100%;
  background: linear-gradient(135deg, #FAF6EE, #F4EFE6);
  color: #681729;
  font-size: 12px;
  font-weight: 800;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  text-align: center;
  padding: 10px 8px;
  border-radius: 12px;
  text-decoration: none;
  border: 2px solid rgba(250,246,238,0.4);
  transition: all 0.25s ease;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.wb-stub-select-btn:hover {
  background: linear-gradient(135deg, #FFFFFF, #FAF6EE);
  transform: scale(1.05);
  text-decoration: none;
  color: #470D1A;
  box-shadow: 0 6px 18px rgba(0,0,0,0.3);
}

.wb-stub-divider {
  width: 80%;
  height: 1px;
  background: rgba(250,246,238,0.2);
}

/* ── Tags / Amenities Row ─────────────────────────────────────── */
.wb-amenity-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  padding: 0 28px 16px;
}

.wb-amenity-tag {
  font-size: 11px;
  font-weight: 600;
  color: #681729;
  background: rgba(104,23,41,0.07);
  border: 1px solid rgba(104,23,41,0.15);
  padding: 3px 10px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  letter-spacing: 0.3px;
}

/* ── Empty State ─────────────────────────────────────────────── */
.wb-empty-state {
  background: rgba(250,246,238,0.7);
  backdrop-filter: blur(12px);
  border: 1.5px dashed rgba(104,23,41,0.25);
  border-radius: 20px;
  padding: 60px 40px;
  text-align: center;
}

/* ── Search Input ─────────────────────────────────────────────── */
.wb-search-input-2026 {
  background: rgba(255,255,255,0.85) !important;
  border: 1.5px solid rgba(104,23,41,0.25) !important;
  border-radius: 12px !important;
  color: #2d1018 !important;
  font-weight: 600 !important;
  font-size: 15px !important;
  padding: 13px 16px !important;
  height: auto !important;
  transition: border-color 0.2s, box-shadow 0.2s !important;
}
.wb-search-input-2026:focus {
  border-color: #681729 !important;
  box-shadow: 0 0 0 3.5px rgba(104,23,41,0.15) !important;
  outline: none !important;
  background: #FFFFFF !important;
}
.wb-search-input-2026::placeholder { color: #9a7275 !important; font-weight: 500 !important; }

/* ── Responsive ──────────────────────────────────────────────── */
@media (max-width: 767px) {
  .wb-ticket { flex-direction: column; }
  .wb-ticket-main { border-radius: 20px 20px 0 0; border-right: 1.5px solid rgba(104,23,41,0.2); border-bottom: none; }
  .wb-ticket-perforation { width: 100%; height: 28px; flex-direction: row; }
  .wb-ticket-perforation::before { width: 14px; height: 28px; left: -1px; top: 0; border-radius: 0 14px 14px 0; border-top: 1.5px solid rgba(104,23,41,0.15); border-left: none; }
  .wb-ticket-perforation::after { width: 14px; height: 28px; right: -1px; top: 0; left: auto; bottom: auto; border-radius: 14px 0 0 14px; border-bottom: 1.5px solid rgba(104,23,41,0.15); border-right: none; }
  .wb-perf-line { top: 50%; left: 12px; right: 12px; bottom: auto; width: auto; height: 0; transform: translateY(-50%); border-left: none; border-top: 2.5px dashed rgba(104,23,41,0.25); }
  .wb-ticket-stub { width: 100%; border-radius: 0 0 20px 20px; flex-direction: row; padding: 18px 24px; justify-content: space-between; border-left: 1.5px solid rgba(104,23,41,0.35); border-top: none; }
  .wb-ticket-stub::before { top: 0; left: 0; right: 0; height: 5px; width: auto; background: linear-gradient(90deg, #8C223A, #FAF6EE44, #8C223A); }
  .wb-airport-code { font-size: 28px; }
  .wb-ticket-route { flex-wrap: wrap; gap: 12px; }
}
</style>

<!-- ─── 2026 Flight Search Hero ─────────────────────────────────────────── -->
<section class="py-5" style="background: radial-gradient(circle at 50% 30%, rgba(137,154,136,0.3) 0%, transparent 60%);">
  <div class="container text-center">
    <div class="wb-badge-pill mb-3">
      <i class="fas fa-plane-departure mr-1"></i> Global Flight Network 2026
    </div>
    <h1 class="wb-title-3d display-4">Search Premium Flights</h1>
    <p class="wb-subtitle lead mb-5">Real-time scheduling across premier international airways with next-gen digital boarding passes</p>

    <!-- Search Hub -->
    <div class="wb-flight-search-hub p-4 mx-auto" style="max-width:880px;">
      <form action="flights.php" method="POST" class="m-0">
        <div class="form-row align-items-end">
          <!-- Departure -->
          <div class="col-md-5 mb-3 mb-md-0">
            <label class="text-left d-block" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#681729;margin-bottom:6px;">
              <i class="fas fa-plane-departure mr-1"></i> Departure
            </label>
            <input class="form-control wb-search-input-2026" name="departure" list="depList"
                   placeholder="City or Airport" value="<?php echo htmlspecialchars($departureLocation); ?>" autocomplete="off">
            <datalist id="depList">
              <?php if ($result && $result->num_rows > 0) { while ($row = $result->fetch_assoc()) { echo '<option value="' . htmlspecialchars($row['dep']) . '">'; } } ?>
            </datalist>
          </div>

          <!-- Swap Icon -->
          <div class="col-md-2 mb-3 mb-md-0 d-flex align-items-end justify-content-center" style="padding-bottom:4px;">
            <div style="width:40px;height:40px;border-radius:50%;background:rgba(104,23,41,0.09);border:1.5px solid rgba(104,23,41,0.25);display:flex;align-items:center;justify-content:center;color:#681729;font-size:16px;">
              <i class="fas fa-exchange-alt"></i>
            </div>
          </div>

          <!-- Destination -->
          <div class="col-md-5 mb-3 mb-md-0">
            <label class="text-left d-block" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#681729;margin-bottom:6px;">
              <i class="fas fa-plane-arrival mr-1"></i> Destination
            </label>
            <input class="form-control wb-search-input-2026" name="destination" list="destList"
                   placeholder="City or Airport" value="<?php echo htmlspecialchars($destinationLocation); ?>" autocomplete="off">
            <datalist id="destList">
              <?php if ($result2 && $result2->num_rows > 0) { while ($row2 = $result2->fetch_assoc()) { echo '<option value="' . htmlspecialchars($row2['dest']) . '">'; } } ?>
            </datalist>
          </div>
        </div>

        <div class="text-center mt-4 pt-3" style="border-top:1.5px solid rgba(104,23,41,0.1);">
          <button type="submit" class="btn wb-btn-burgundy px-5 py-2" style="font-size:15px;letter-spacing:0.5px;">
            <i class="fas fa-search mr-2"></i> Search Available Flights
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- ─── Flight Results ──────────────────────────────────────────────────── -->
<main class="container py-5">

  <!-- Section Header -->
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <span class="wb-kicker-tag text-uppercase">
        <?php echo $count; ?> Flight<?php echo $count !== 1 ? 's' : ''; ?> Available
      </span>
      <h2 class="wb-section-subhead mt-1 mb-0">
        <?php if (!empty($departureLocation) || !empty($destinationLocation)): ?>
          Matching Routes <?php if(!empty($departureLocation)) echo '— ' . htmlspecialchars($departureLocation); if(!empty($destinationLocation)) echo ' → ' . htmlspecialchars($destinationLocation); ?>
        <?php else: ?>
          Featured Global Routes
        <?php endif; ?>
      </h2>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <span class="wb-badge-pill"><i class="fas fa-shield-alt mr-1"></i> Secure Booking</span>
      <span class="wb-badge-pill"><i class="fas fa-tag mr-1"></i> Best Price Guarantee</span>
    </div>
  </div>

  <?php if ($count === 0): ?>
    <div class="wb-empty-state">
      <i class="fas fa-plane-slash fa-3x mb-4" style="color:rgba(104,23,41,0.4);"></i>
      <h3 style="color:#470D1A;font-family:'Cinzel',serif;">No Flights Found</h3>
      <p style="color:#7a5c62;max-width:400px;margin:10px auto 24px;">
        No direct flights match your query. Try different cities or browse our featured routes.
      </p>
      <a href="flights.php" class="btn wb-btn-burgundy">
        <i class="fas fa-redo mr-1"></i> Browse All Flights
      </a>
    </div>

  <?php else: ?>
    <?php for ($i = 0; $i < $count; $i++):
      // Derive short IATA-style codes (first 3 chars uppercase)
      $fromCode = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $from[$i]), 0, 3));
      $toCode   = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $to[$i]), 0, 3));
      // Flight number stub
      $flightNum = 'WB' . str_pad(($id[$i] * 37 + 100) % 900 + 100, 3, '0', STR_PAD_LEFT);
      // Ensure 2026 formatted dates
      $rawDep = str_replace('2023', '2026', $departureDate[$i]);
      $rawArr = str_replace('2023', '2026', $arrivalDate[$i]);
      $tsDep = strtotime($rawDep);
      $displayDepDate = $tsDep ? date('D, d M 2026', $tsDep) : $rawDep;
      $tsArr = strtotime($rawArr);
      $displayArrDate = $tsArr ? date('D, d M 2026', $tsArr) : $rawArr;

      // Amenity set (cycle through some)
      $amenitySets = [
        ['<i class="fas fa-wifi"></i> Wi-Fi', '<i class="fas fa-utensils"></i> Meals', '<i class="fas fa-tv"></i> IFE', '<i class="fas fa-plug"></i> USB Power'],
        ['<i class="fas fa-wifi"></i> Wi-Fi', '<i class="fas fa-suitcase-rolling"></i> 23kg Baggage', '<i class="fas fa-couch"></i> Extra Legroom'],
        ['<i class="fas fa-coffee"></i> Snacks', '<i class="fas fa-suitcase-rolling"></i> 20kg Baggage', '<i class="fas fa-plug"></i> USB Power', '<i class="fas fa-tv"></i> IFE'],
      ];
      $amenities = $amenitySets[$i % count($amenitySets)];
    ?>

    <div class="wb-ticket-wrap">
      <div class="wb-ticket">

        <!-- ── Main Ticket Body ─────────────────────────────────── -->
        <div class="wb-ticket-main">

          <!-- Ticket Header -->
          <div class="wb-ticket-header">
            <div class="d-flex align-items-center gap-3 flex-wrap" style="gap:12px;">
              <span class="wb-airline-name">
                <i class="fas fa-plane mr-1" style="font-size:12px;"></i>
                <?php echo htmlspecialchars($airline[$i]); ?>
              </span>
              <span class="wb-ticket-class-badge">Economy</span>
              <span class="wb-ticket-season-badge"><i class="fas fa-certificate mr-1" style="color:#b8860b;"></i> 2026 Schedule</span>
              <span style="font-size:12px;color:#9a7a7e;font-weight:600;letter-spacing:0.5px;">
                Flight <?php echo $flightNum; ?>
              </span>
            </div>
            <div class="d-flex align-items-center" style="gap:8px;">
              <span class="wb-ticket-status">
                <span class="status-dot"></span>
                On Schedule · 2026
              </span>
            </div>
          </div>

          <!-- Route Section -->
          <div class="wb-ticket-route">
            <!-- Departure Airport -->
            <div class="wb-airport-block text-left">
              <div class="wb-airport-code"><?php echo $fromCode; ?></div>
              <div class="wb-airport-city"><?php echo htmlspecialchars($from[$i]); ?></div>
              <div class="wb-airport-time"><?php echo htmlspecialchars($departureTime[$i]); ?></div>
              <div class="wb-airport-date">
                <i class="far fa-calendar-alt mr-1" style="font-size:10px;"></i>
                <?php echo htmlspecialchars($displayDepDate); ?>
              </div>
            </div>

            <!-- Animated Flight Path -->
            <div class="wb-flight-path">
              <div class="wb-duration-chip">
                <i class="far fa-clock mr-1"></i> <?php echo htmlspecialchars($duration[$i]); ?>
              </div>
              <div class="wb-flight-path-line">
                <div class="wb-path-dot"></div>
                <div class="wb-path-seg"></div>
                <i class="fas fa-plane wb-plane-icon"></i>
                <div class="wb-path-seg right"></div>
                <div class="wb-path-dot"></div>
              </div>
              <div class="wb-nonstop-tag">
                <i class="fas fa-check-circle" style="color:#28a745;"></i>
                Non-stop · Direct
              </div>
            </div>

            <!-- Arrival Airport -->
            <div class="wb-airport-block text-right">
              <div class="wb-airport-code"><?php echo $toCode; ?></div>
              <div class="wb-airport-city"><?php echo htmlspecialchars($to[$i]); ?></div>
              <div class="wb-airport-time"><?php echo htmlspecialchars($arrivalTime[$i]); ?></div>
              <div class="wb-airport-date">
                <i class="far fa-calendar-alt mr-1" style="font-size:10px;"></i>
                <?php echo htmlspecialchars($displayArrDate); ?>
              </div>
            </div>
          </div>

          <!-- Amenity Tags -->
          <div class="wb-amenity-tags">
            <?php foreach ($amenities as $tag): ?>
              <span class="wb-amenity-tag"><?php echo $tag; ?></span>
            <?php endforeach; ?>
          </div>

          <!-- Ticket Footer Meta -->
          <div class="wb-ticket-meta">
            <div class="wb-meta-item">
              <span class="wb-meta-label"><i class="fas fa-ticket-alt mr-1"></i> Booking Class</span>
              <span class="wb-meta-value">Economy · Y</span>
            </div>
            <div class="wb-meta-item">
              <span class="wb-meta-label"><i class="fas fa-suitcase-rolling mr-1"></i> Baggage</span>
              <span class="wb-meta-value">1× Carry-on</span>
            </div>
            <div class="wb-meta-item">
              <span class="wb-meta-label"><i class="fas fa-undo mr-1"></i> Refund Policy</span>
              <span class="wb-meta-value">Flexible</span>
            </div>
            <div class="wb-meta-item">
              <span class="wb-meta-label"><i class="fas fa-route mr-1"></i> Route</span>
              <span class="wb-meta-value"><?php echo $fromCode; ?> — <?php echo $toCode; ?></span>
            </div>
            <div class="wb-meta-item">
              <span class="wb-meta-label"><i class="fas fa-calendar-check mr-1"></i> Validity</span>
              <span class="wb-meta-value">2026 Season Schedule</span>
            </div>
          </div>

        </div><!-- /.wb-ticket-main -->

        <!-- ── Perforation Tear Line ───────────────────────────── -->
        <div class="wb-ticket-perforation">
          <div class="wb-perf-line"></div>
        </div>

        <!-- ── Ticket Stub ─────────────────────────────────────── -->
        <div class="wb-ticket-stub">

          <!-- Price -->
          <div>
            <div class="wb-stub-price-label">From</div>
            <div class="wb-stub-price">$<?php echo htmlspecialchars($price[$i]); ?></div>
            <div class="wb-stub-price-label" style="margin-top:2px;">per passenger</div>
          </div>

          <div class="wb-stub-divider"></div>

          <!-- 2026 Digital Pass Badge -->
          <div style="font-size:9.5px;font-weight:800;letter-spacing:1px;color:#FAF6EE;background:rgba(104,23,41,0.55);border:1px solid rgba(250,246,238,0.3);border-radius:6px;padding:3px 8px;text-align:center;">
            <i class="fas fa-plane-departure mr-1"></i> 2026 PASS
          </div>

          <!-- QR Code -->
          <div class="wb-qr-block">
            <svg class="wb-qr-svg" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" fill="#470D1A">
              <!-- QR decorative pattern -->
              <rect x="2" y="2" width="20" height="20" rx="2" fill="none" stroke="#470D1A" stroke-width="2"/>
              <rect x="6" y="6" width="12" height="12" rx="1"/>
              <rect x="34" y="2" width="20" height="20" rx="2" fill="none" stroke="#470D1A" stroke-width="2"/>
              <rect x="38" y="6" width="12" height="12" rx="1"/>
              <rect x="2" y="34" width="20" height="20" rx="2" fill="none" stroke="#470D1A" stroke-width="2"/>
              <rect x="6" y="38" width="12" height="12" rx="1"/>
              <rect x="26" y="26" width="4" height="4"/>
              <rect x="32" y="26" width="4" height="4"/>
              <rect x="38" y="26" width="4" height="4"/>
              <rect x="44" y="26" width="4" height="4"/>
              <rect x="26" y="32" width="4" height="4"/>
              <rect x="32" y="32" width="4" height="4"/>
              <rect x="44" y="32" width="4" height="4"/>
              <rect x="26" y="38" width="4" height="4"/>
              <rect x="38" y="38" width="4" height="4"/>
              <rect x="44" y="38" width="4" height="4"/>
              <rect x="26" y="44" width="4" height="4"/>
              <rect x="32" y="44" width="4" height="4"/>
              <rect x="38" y="44" width="4" height="4"/>
            </svg>
          </div>

          <div class="wb-stub-divider"></div>

          <!-- CTA Button -->
          <a href="flightbooking.php?destination=<?php echo urlencode($id[$i]); ?>" class="wb-stub-select-btn">
            <i class="fas fa-ticket-alt d-block mb-1" style="font-size:16px;"></i>
            Book Now
          </a>

        </div><!-- /.wb-ticket-stub -->

      </div><!-- /.wb-ticket -->
    </div><!-- /.wb-ticket-wrap -->

    <?php endfor; ?>
  <?php endif; ?>

</main>

<?php include 'footer.php'; ?>
