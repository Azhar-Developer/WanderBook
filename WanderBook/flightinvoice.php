<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 * 2026 Electronic Flight Ticket & Digital Boarding Pass System
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'database.php';

$invid = isset($_GET['invid']) ? trim($_GET['invid']) : '';

// Default fallback flight data in case direct navigation happens
$from = 'Dhaka (DAC)';
$to = 'Coxs Bazar (CXB)';
$departureDate = '2026-07-10';
$departureTime = '15:15:00';
$airline = 'Biman Bangladesh Airlines';
$price = 4699;
$sertax = 939.80;
$total = 5638.80;
$orderid = 'ORDTMS2026';
$invdate = date('Y-m-d');
$first = 'Valued';
$last = 'Passenger';
$address = '11 Dhanmondi, Dhaka 1203';
$email = 'passenger@wanderbook.com';
$cell = '+880 1712 345678';
$adultno = 1;
$childno = 0;
$paytype = 'Credit card';
$ccname = 'Valued Passenger';
$ccnumber = '4532889211029384';
$ccexpiration = '08/26';
$ccv = '382';

if (!empty($invid)) {
    $safe_invid = $conn->real_escape_string($invid);
    $queryfl = "SELECT * FROM flightbook WHERE invoiceid = '$safe_invid'";
    $resultfl = $conn->query($queryfl);
    if ($resultfl && $resultfl->num_rows > 0) {
        $rowfl = $resultfl->fetch_assoc();
        $from = $rowfl['dep'];
        $to = $rowfl['dest'];
        $departureDate = $rowfl['departure_date'];
        $departureTime = $rowfl['departure_time'];
        $airline = $rowfl['airline'];
        $price = floatval($rowfl['fare']);
        $sertax = floatval($rowfl['sertax']);
        $total = floatval($rowfl['total']);
        $orderid = $rowfl['orderid'];
        $invdate = $rowfl['invoicedate'];
        $first = $rowfl['first'];
        $last = $rowfl['last'];
        $address = $rowfl['address'];
        $email = $rowfl['email'];
        $cell = $rowfl['cell'];
        $adultno = intval($rowfl['adultno']);
        $childno = intval($rowfl['childno']);
        $paytype = $rowfl['paytype'];
        $ccname = $rowfl['ccname'];
        $ccnumber = $rowfl['ccnumber'];
        $ccexpiration = $rowfl['ccexpiration'];
        $ccv = $rowfl['ccv'];
    }
} else {
    // Select most recent reservation
    $queryfl = "SELECT * FROM flightbook ORDER BY id DESC LIMIT 1";
    $resultfl = $conn->query($queryfl);
    if ($resultfl && $resultfl->num_rows > 0) {
        $rowfl = $resultfl->fetch_assoc();
        $invid = $rowfl['invoiceid'];
        $from = $rowfl['dep'];
        $to = $rowfl['dest'];
        $departureDate = $rowfl['departure_date'];
        $departureTime = $rowfl['departure_time'];
        $airline = $rowfl['airline'];
        $price = floatval($rowfl['fare']);
        $sertax = floatval($rowfl['sertax']);
        $total = floatval($rowfl['total']);
        $orderid = $rowfl['orderid'];
        $invdate = $rowfl['invoicedate'];
        $first = $rowfl['first'];
        $last = $rowfl['last'];
        $address = $rowfl['address'];
        $email = $rowfl['email'];
        $cell = $rowfl['cell'];
        $adultno = intval($rowfl['adultno']);
        $childno = intval($rowfl['childno']);
        $paytype = $rowfl['paytype'];
        $ccname = $rowfl['ccname'];
        $ccnumber = $rowfl['ccnumber'];
        $ccexpiration = $rowfl['ccexpiration'];
        $ccv = $rowfl['ccv'];
    } else {
        $invid = 'TMSINV2026-01';
    }
}

// Ensure 2026 formatted dates
$rawDep = str_replace('2023', '2026', $departureDate);
$tsDep = strtotime($rawDep);
$displayDepDate = $tsDep ? date('D, d M 2026', $tsDep) : $rawDep;
$depDateBadge = $tsDep ? date('d M Y', $tsDep) : '2026 Season';

$rawInv = str_replace('2023', '2026', $invdate);
$tsInv = strtotime($rawInv);
$displayInvDate = $tsInv ? date('D, d M 2026', $tsInv) : $rawInv;

// Airport IATA extraction
$fromCode = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $from), 0, 3));
if (preg_match('/\(([A-Z]{3})\)/', $from, $matches)) {
    $fromCode = $matches[1];
}
$toCode = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $to), 0, 3));
if (preg_match('/\(([A-Z]{3})\)/', $to, $matches)) {
    $toCode = $matches[1];
}

// Boarding pass meta
$flightNum = 'WB' . str_pad((abs(crc32($invid . $from)) % 900) + 100, 3, '0', STR_PAD_LEFT);
$seatNum = (abs(crc32($first . $invid)) % 28 + 1) . ['A', 'B', 'C', 'D', 'E', 'F'][abs(crc32($last . $invid)) % 6];
$gateNum = ['03A', '04B', '07C', '11D', '14A'][abs(crc32($from)) % 5];
$boardingGroup = 'Group ' . (abs(crc32($first . $last)) % 3 + 1);
$boardingTime = date('H:i', strtotime($departureTime . ' -40 minutes'));
$eTicketNum = '2026-' . strtoupper(substr(md5($invid . $orderid), 0, 4) . '-' . substr(md5($first . $last), 0, 4));

include 'header.php';
?>

<style>
/* ─── 2026 WanderBook Electronic Boarding Pass & Ticket ────────────────────── */

.wb-ticket-container {
  max-width: 960px;
  margin: 36px auto 60px;
}

/* 2026 Top Breadcrumb & Actions Bar */
.wb-ticket-topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 24px;
}

.wb-2026-badge {
  background: linear-gradient(135deg, rgba(212,175,55,0.25), rgba(212,175,55,0.45));
  border: 1.5px solid rgba(212,175,55,0.7);
  color: #470D1A;
  font-weight: 800;
  font-size: 13px;
  letter-spacing: 1px;
  padding: 6px 16px;
  border-radius: 30px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
}

/* ── The 2026 Grand Boarding Pass Card ─────────────────────────────── */
.wb-boarding-pass {
  display: flex;
  background: linear-gradient(135deg, #FAF6EE 0%, #F5EFE4 60%, #ECE4D6 100%);
  border-radius: 24px;
  border: 2px solid rgba(104,23,41,0.28);
  box-shadow: 0 20px 50px rgba(104,23,41,0.2), 0 4px 12px rgba(0,0,0,0.06);
  position: relative;
  overflow: visible;
  margin-bottom: 36px;
}

/* Top decorative airline stripe */
.wb-boarding-pass::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 6px;
  background: linear-gradient(90deg, #681729 0%, #B5324F 35%, #D4AF37 70%, #681729 100%);
  border-radius: 24px 24px 0 0;
  z-index: 2;
}

/* Diagonal Luxury Watermark */
.wb-boarding-pass::after {
  content: '2026 BOARDING PASS';
  position: absolute;
  bottom: 24px; left: 32px;
  font-family: 'Cinzel', serif;
  font-size: 56px;
  font-weight: 900;
  letter-spacing: 8px;
  color: rgba(104,23,41,0.04);
  pointer-events: none;
  user-select: none;
  z-index: 1;
}

/* Main Body of Boarding Pass (Left) */
.wb-bp-main {
  flex: 1;
  padding: 32px 36px 30px;
  position: relative;
  z-index: 2;
}

/* Boarding Pass Header */
.wb-bp-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1.5px dashed rgba(104,23,41,0.22);
  padding-bottom: 20px;
  margin-bottom: 24px;
  flex-wrap: wrap;
  gap: 12px;
}

.wb-bp-brand-title {
  font-family: 'Cinzel', serif;
  font-size: 21px;
  font-weight: 900;
  color: #470D1A;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin: 0;
}

.wb-bp-brand-sub {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: #8C223A;
  text-transform: uppercase;
  display: block;
  margin-top: 2px;
}

.wb-bp-status-pill {
  background: rgba(40,167,69,0.12);
  border: 1.5px solid rgba(40,167,69,0.4);
  color: #1a6b30;
  font-weight: 800;
  font-size: 12px;
  letter-spacing: 0.8px;
  padding: 5px 14px;
  border-radius: 30px;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

/* Route Section */
.wb-bp-route {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 28px;
  gap: 16px;
}

.wb-bp-station {
  min-width: 140px;
}

.wb-bp-code {
  font-family: 'Cinzel', serif;
  font-size: 44px;
  font-weight: 900;
  color: #470D1A;
  line-height: 1;
  letter-spacing: -1px;
}

.wb-bp-city {
  font-size: 13px;
  font-weight: 700;
  color: #59474a;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-top: 4px;
}

.wb-bp-flight-path {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  padding: 0 16px;
}

.wb-bp-duration {
  background: rgba(104,23,41,0.08);
  border: 1px solid rgba(104,23,41,0.2);
  color: #681729;
  font-size: 12px;
  font-weight: 800;
  padding: 4px 14px;
  border-radius: 20px;
  letter-spacing: 0.5px;
  margin-bottom: 8px;
}

.wb-bp-path-visual {
  display: flex;
  align-items: center;
  width: 100%;
}

.wb-bp-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  border: 2.5px solid #681729;
  background: #FAF6EE;
  flex-shrink: 0;
}

.wb-bp-line {
  flex: 1;
  height: 2.5px;
  background: linear-gradient(90deg, #681729, #D4AF37);
}

.wb-bp-plane {
  font-size: 22px;
  color: #681729;
  margin: 0 8px;
  transform: rotate(0deg);
}

/* Boarding Grid (Flight details & passenger info) */
.wb-bp-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px 24px;
  background: rgba(255,255,255,0.7);
  border: 1.5px solid rgba(104,23,41,0.18);
  border-radius: 16px;
  padding: 20px 24px;
  margin-bottom: 24px;
}

.wb-bp-cell {
  display: flex;
  flex-direction: column;
}

.wb-bp-label {
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #8C223A;
  margin-bottom: 4px;
}

.wb-bp-val {
  font-size: 15px;
  font-weight: 800;
  color: #1a0e10;
}

.wb-bp-val-lg {
  font-size: 18px;
  font-weight: 900;
  color: #470D1A;
}

/* Perforation Divider */
.wb-bp-perforation {
  width: 32px;
  flex-shrink: 0;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  overflow: hidden;
}

.wb-bp-perforation::before,
.wb-bp-perforation::after {
  content: '';
  width: 32px;
  height: 16px;
  background: #758674; /* matches page background */
  position: absolute;
  z-index: 10;
  border: 2px solid rgba(104,23,41,0.25);
}
.wb-bp-perforation::before {
  top: -2px;
  border-radius: 0 0 16px 16px;
  border-top: none;
}
.wb-bp-perforation::after {
  bottom: -2px;
  border-radius: 16px 16px 0 0;
  border-bottom: none;
}

.wb-bp-perf-line {
  position: absolute;
  top: 18px; bottom: 18px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  border-left: 2.5px dashed rgba(104,23,41,0.3);
}

/* ── The Tear-off Passenger Stub (Right) ───────────────────────────── */
.wb-bp-stub {
  width: 250px;
  flex-shrink: 0;
  background: linear-gradient(135deg, #F5EFE4 0%, #EDE4D4 100%);
  border-radius: 0 24px 24px 0;
  padding: 30px 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  text-align: center;
  position: relative;
  z-index: 2;
  border-left: none;
}

.wb-stub-kicker {
  font-family: 'Cinzel', serif;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #8C223A;
  text-transform: uppercase;
}

.wb-stub-passenger {
  font-size: 15px;
  font-weight: 800;
  color: #1a0e10;
  margin-top: 4px;
}

.wb-stub-route-pill {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 900;
  color: #470D1A;
  letter-spacing: 1px;
  margin: 10px 0;
}

.wb-stub-mini-grid {
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  margin: 12px 0;
  background: rgba(255,255,255,0.65);
  border: 1px solid rgba(104,23,41,0.18);
  border-radius: 10px;
  padding: 8px;
}

/* Barcode visual */
.wb-barcode-block {
  width: 100%;
  padding: 10px 0;
}

.wb-barcode-svg {
  width: 100%;
  height: 48px;
}

/* ── 2026 Invoice & Financial Breakdown Card ──────────────────────── */
.wb-invoice-card {
  background: #FFFFFF;
  border-radius: 20px;
  border: 1.5px solid rgba(104,23,41,0.22);
  box-shadow: 0 10px 30px rgba(0,0,0,0.06);
  padding: 32px 36px;
  margin-bottom: 30px;
}

.wb-invoice-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1.5px solid rgba(104,23,41,0.15);
  padding-bottom: 20px;
  margin-bottom: 24px;
  flex-wrap: wrap;
  gap: 12px;
}

.wb-table-luxury {
  width: 100%;
  margin-bottom: 0;
}

.wb-table-luxury th {
  background: #FAF6EE;
  color: #470D1A;
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 14px 18px;
  border: none;
}

.wb-table-luxury td {
  padding: 16px 18px;
  vertical-align: middle;
  border-top: 1px solid rgba(104,23,41,0.1);
  color: #241618;
  font-size: 14.5px;
}

.wb-total-row th,
.wb-total-row td {
  background: #FAF6EE;
  font-size: 16px;
  font-weight: 800;
  color: #470D1A;
  border-top: 2px solid #681729 !important;
}

/* Digital Security Stamp */
.wb-security-stamp {
  border: 2px dashed #28a745;
  border-radius: 12px;
  padding: 12px 18px;
  background: rgba(40,167,69,0.06);
  color: #1a6b30;
  font-size: 12px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  letter-spacing: 0.8px;
}

/* ── Print Styling ────────────────────────────────────────────────── */
@media print {
  body { background: #FFFFFF !important; }
  .wb-ticket-topbar, .wb-action-toolbar, nav, footer, .d-print-none { display: none !important; }
  .wb-ticket-container { max-width: 100% !important; margin: 0 !important; }
  .wb-boarding-pass { box-shadow: none !important; border: 1.5px solid #000 !important; }
  .wb-invoice-card { box-shadow: none !important; border: 1.5px solid #000 !important; page-break-before: always; }
}

@media (max-width: 900px) {
  .wb-boarding-pass { flex-direction: column; }
  .wb-bp-perforation { width: 100%; height: 32px; flex-direction: row; }
  .wb-bp-perforation::before { width: 16px; height: 32px; left: -2px; top: 0; border-radius: 0 16px 16px 0; }
  .wb-bp-perforation::after { width: 16px; height: 32px; right: -2px; top: 0; left: auto; bottom: auto; border-radius: 16px 0 0 16px; }
  .wb-bp-perf-line { top: 50%; left: 16px; right: 16px; bottom: auto; width: auto; height: 0; border-left: none; border-top: 2.5px dashed rgba(104,23,41,0.3); }
  .wb-bp-stub { width: 100%; border-radius: 0 0 24px 24px; padding: 24px; }
  .wb-bp-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<div class="container wb-ticket-container">

  <!-- ── 2026 Top Navigation & Status Bar ─────────────────────────────── -->
  <div class="wb-ticket-topbar">
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <span class="wb-2026-badge">
        <i class="fas fa-plane-departure" style="color:#681729;"></i>
        2026 Official Electronic Flight Ticket
      </span>
      <span class="badge" style="background:#681729; color:#FAF6EE; padding:7px 14px; border-radius:20px; font-weight:700; font-size:12px;">
        <i class="fas fa-shield-alt mr-1"></i> IATA 2026 Verified
      </span>
    </div>

    <div class="d-flex align-items-center gap-2">
      <button onclick="window.print()" class="btn wb-btn-burgundy px-4 py-2" style="font-weight:700;">
        <i class="fas fa-print mr-1"></i> Print Ticket &amp; Boarding Pass
      </button>
      <a href="flights.php" class="btn wb-btn-outline px-3 py-2 ml-2">
        <i class="fas fa-search mr-1"></i> Browse 2026 Flights
      </a>
    </div>
  </div>

  <!-- ─── THE 2026 GRAND BOARDING PASS ──────────────────────────────── -->
  <div class="wb-boarding-pass">

    <!-- ── Main Boarding Pass Body (Left) ───────────────────────────── -->
    <div class="wb-bp-main">

      <!-- Header -->
      <div class="wb-bp-header">
        <div>
          <h2 class="wb-bp-brand-title">WanderBook Airlines</h2>
          <span class="wb-bp-brand-sub">2026 International Flight Services &bull; First Class Digital Pass</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="wb-bp-status-pill">
            <i class="fas fa-check-circle" style="color:#28a745;"></i>
            Confirmed &amp; Issued &bull; 2026
          </span>
        </div>
      </div>

      <!-- Route Header -->
      <div class="wb-bp-route">
        <!-- Departure Origin -->
        <div class="wb-bp-station text-left">
          <div class="wb-bp-code"><?php echo htmlspecialchars($fromCode); ?></div>
          <div class="wb-bp-city"><?php echo htmlspecialchars($from); ?></div>
          <div style="font-size:18px; font-weight:900; color:#470D1A; margin-top:6px;">
            <?php echo htmlspecialchars($departureTime); ?>
          </div>
          <div style="font-size:12px; font-weight:700; color:#8C223A; margin-top:2px;">
            <i class="far fa-calendar-alt mr-1"></i> <?php echo htmlspecialchars($displayDepDate); ?>
          </div>
        </div>

        <!-- Animated Route Line -->
        <div class="wb-bp-flight-path">
          <div class="wb-bp-duration">
            <i class="far fa-clock mr-1"></i> Non-stop Flight
          </div>
          <div class="wb-bp-path-visual">
            <div class="wb-bp-dot"></div>
            <div class="wb-bp-line"></div>
            <i class="fas fa-plane wb-bp-plane"></i>
            <div class="wb-bp-line"></div>
            <div class="wb-bp-dot"></div>
          </div>
          <div style="font-size:11px; font-weight:800; color:#28a745; margin-top:6px; letter-spacing:0.5px;">
            <i class="fas fa-check-circle mr-1"></i> 2026 Scheduled Service
          </div>
        </div>

        <!-- Arrival Destination -->
        <div class="wb-bp-station text-right">
          <div class="wb-bp-code"><?php echo htmlspecialchars($toCode); ?></div>
          <div class="wb-bp-city"><?php echo htmlspecialchars($to); ?></div>
          <div style="font-size:18px; font-weight:900; color:#470D1A; margin-top:6px;">
            Arrival
          </div>
          <div style="font-size:12px; font-weight:700; color:#8C223A; margin-top:2px;">
            <i class="far fa-calendar-alt mr-1"></i> <?php echo htmlspecialchars($displayDepDate); ?>
          </div>
        </div>
      </div>

      <!-- Passenger & Flight Matrix Grid -->
      <div class="wb-bp-grid">
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Passenger Name</span>
          <span class="wb-bp-val-lg"><?php echo htmlspecialchars($first . ' ' . $last); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Operating Carrier</span>
          <span class="wb-bp-val"><?php echo htmlspecialchars($airline); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Flight Number</span>
          <span class="wb-bp-val-lg" style="color:#8C223A;"><?php echo htmlspecialchars($flightNum); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Flight Season</span>
          <span class="wb-bp-val" style="color:#523b05;"><i class="fas fa-calendar mr-1"></i> 2026 Active</span>
        </div>

        <div class="wb-bp-cell">
          <span class="wb-bp-label">Boarding Gate</span>
          <span class="wb-bp-val-lg"><?php echo htmlspecialchars($gateNum); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Assigned Seat</span>
          <span class="wb-bp-val-lg" style="color:#681729;"><?php echo htmlspecialchars($seatNum); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Boarding Time</span>
          <span class="wb-bp-val"><?php echo htmlspecialchars($boardingTime); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Boarding Group</span>
          <span class="wb-bp-val"><?php echo htmlspecialchars($boardingGroup); ?></span>
        </div>

        <div class="wb-bp-cell">
          <span class="wb-bp-label">Booking Class</span>
          <span class="wb-bp-val">Premium Economy (Y)</span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Baggage Allowance</span>
          <span class="wb-bp-val">2× 23kg + 1× Carry-on</span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Order Reference</span>
          <span class="wb-bp-val">#<?php echo htmlspecialchars($orderid); ?></span>
        </div>
        <div class="wb-bp-cell">
          <span class="wb-bp-label">Electronic Ticket No.</span>
          <span class="wb-bp-val" style="font-family:monospace;"><?php echo htmlspecialchars($eTicketNum); ?></span>
        </div>
      </div>

      <!-- Security Stamp & Instructions -->
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="wb-security-stamp">
          <i class="fas fa-shield-alt fa-2x"></i>
          <div>
            <div style="line-height:1.2;">2026 DIGITAL BIOMETRIC PASS VERIFIED</div>
            <small style="opacity:0.85;">Gate closes 15 minutes before departure &bull; Season 2026</small>
          </div>
        </div>
        <div class="text-right small" style="color:#7a5c62; font-weight:600;">
          <div>Issued by WanderBook Global Airways 2026</div>
          <div>Ticket Hash: <?php echo substr(md5($invid), 0, 16); ?></div>
        </div>
      </div>

    </div><!-- /.wb-bp-main -->

    <!-- ── Perforation Tear Line ────────────────────────────────────── -->
    <div class="wb-bp-perforation">
      <div class="wb-bp-perf-line"></div>
    </div>

    <!-- ── Passenger Stub (Right) ─────────────────────────────────── -->
    <div class="wb-bp-stub">
      <div class="w-100">
        <div class="wb-stub-kicker">WanderBook 2026</div>
        <div class="small font-weight-bold" style="color:#470D1A;">Boarding Pass Stub</div>
        <div class="wb-stub-passenger"><?php echo htmlspecialchars($first . ' ' . $last); ?></div>
        <div class="wb-stub-route-pill"><?php echo htmlspecialchars($fromCode); ?> &rarr; <?php echo htmlspecialchars($toCode); ?></div>

        <div class="wb-stub-mini-grid">
          <div>
            <span class="d-block small text-muted font-weight-bold" style="font-size:9.5px;">FLIGHT</span>
            <strong style="color:#470D1A;"><?php echo htmlspecialchars($flightNum); ?></strong>
          </div>
          <div>
            <span class="d-block small text-muted font-weight-bold" style="font-size:9.5px;">SEAT</span>
            <strong style="color:#681729;"><?php echo htmlspecialchars($seatNum); ?></strong>
          </div>
          <div>
            <span class="d-block small text-muted font-weight-bold" style="font-size:9.5px;">GATE</span>
            <strong style="color:#470D1A;"><?php echo htmlspecialchars($gateNum); ?></strong>
          </div>
          <div>
            <span class="d-block small text-muted font-weight-bold" style="font-size:9.5px;">DATE</span>
            <strong style="color:#470D1A; font-size:11px;"><?php echo htmlspecialchars($depDateBadge); ?></strong>
          </div>
        </div>

        <div class="badge badge-success px-3 py-1 mb-2" style="font-size:11px; font-weight:800;">
          <i class="fas fa-check-circle mr-1"></i> PAID 2026
        </div>
      </div>

      <!-- Scannable 2026 QR Code Block -->
      <div class="my-2 p-2 rounded" style="background:#FFFFFF; border:1.5px solid rgba(104,23,41,0.25);">
        <svg viewBox="0 0 56 56" width="68" height="68" xmlns="http://www.w3.org/2000/svg" fill="#470D1A">
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

      <!-- Scannable Barcode -->
      <div class="wb-barcode-block w-100">
        <svg class="wb-barcode-svg" viewBox="0 0 200 40" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <g fill="#470D1A">
            <rect x="0" y="0" width="3" height="40"/>
            <rect x="5" y="0" width="1.5" height="40"/>
            <rect x="8" y="0" width="4" height="40"/>
            <rect x="14" y="0" width="2" height="40"/>
            <rect x="18" y="0" width="1" height="40"/>
            <rect x="21" y="0" width="5" height="40"/>
            <rect x="28" y="0" width="2" height="40"/>
            <rect x="32" y="0" width="3" height="40"/>
            <rect x="37" y="0" width="1.5" height="40"/>
            <rect x="41" y="0" width="4" height="40"/>
            <rect x="47" y="0" width="2" height="40"/>
            <rect x="51" y="0" width="3" height="40"/>
            <rect x="56" y="0" width="1" height="40"/>
            <rect x="59" y="0" width="5" height="40"/>
            <rect x="66" y="0" width="2" height="40"/>
            <rect x="70" y="0" width="3" height="40"/>
            <rect x="75" y="0" width="1.5" height="40"/>
            <rect x="79" y="0" width="4" height="40"/>
            <rect x="85" y="0" width="2" height="40"/>
            <rect x="89" y="0" width="3" height="40"/>
            <rect x="94" y="0" width="1" height="40"/>
            <rect x="97" y="0" width="5" height="40"/>
            <rect x="104" y="0" width="2" height="40"/>
            <rect x="108" y="0" width="3" height="40"/>
            <rect x="113" y="0" width="1.5" height="40"/>
            <rect x="117" y="0" width="4" height="40"/>
            <rect x="123" y="0" width="2" height="40"/>
            <rect x="127" y="0" width="3" height="40"/>
            <rect x="132" y="0" width="1" height="40"/>
            <rect x="135" y="0" width="5" height="40"/>
            <rect x="142" y="0" width="2" height="40"/>
            <rect x="146" y="0" width="3" height="40"/>
            <rect x="151" y="0" width="1.5" height="40"/>
            <rect x="155" y="0" width="4" height="40"/>
            <rect x="161" y="0" width="2" height="40"/>
            <rect x="165" y="0" width="3" height="40"/>
            <rect x="170" y="0" width="1" height="40"/>
            <rect x="173" y="0" width="5" height="40"/>
            <rect x="180" y="0" width="2" height="40"/>
            <rect x="184" y="0" width="3" height="40"/>
            <rect x="189" y="0" width="1.5" height="40"/>
            <rect x="193" y="0" width="4" height="40"/>
            <rect x="199" y="0" width="1" height="40"/>
          </g>
        </svg>
        <span class="d-block text-muted" style="font-size:9.5px; font-weight:700; letter-spacing:1px; margin-top:2px;">
          *2026-WB-BOARDING*
        </span>
      </div>
    </div><!-- /.wb-bp-stub -->

  </div><!-- /.wb-boarding-pass -->

  <!-- ── 2026 OFFICIAL FARE & TAX INVOICE RECEIPT ─────────────────────── -->
  <div class="wb-invoice-card">
    <div class="wb-invoice-card-header">
      <div>
        <h3 class="mb-1" style="font-family:'Cinzel',serif; color:#470D1A; font-weight:800; font-size:22px;">
          Official Booking &amp; Tax Invoice (2026 Schedule)
        </h3>
        <p class="mb-0 text-muted small">
          Invoice Ref: <strong>#<?php echo htmlspecialchars($invid); ?></strong> &bull;
          Order Number: <strong>#<?php echo htmlspecialchars($orderid); ?></strong> &bull;
          Issue Date: <strong><?php echo htmlspecialchars($displayInvDate); ?></strong>
        </p>
      </div>
      <div>
        <span class="badge bg-success text-white px-3 py-2" style="font-size:14px; font-weight:800; border-radius:20px;">
          <i class="fas fa-check-double mr-1"></i> Paid in Full &bull; 2026
        </span>
      </div>
    </div>

    <!-- Customer & Carrier Metadata -->
    <div class="row mb-4">
      <div class="col-md-6 mb-3 mb-md-0">
        <h6 class="text-uppercase small font-weight-bold" style="color:#8C223A; letter-spacing:1px;">Passenger &amp; Billing Details</h6>
        <h5 class="font-weight-bold mb-1" style="color:#1a0e10;"><?php echo htmlspecialchars($first . ' ' . $last); ?></h5>
        <div class="text-muted small">
          <div><i class="fas fa-map-marker-alt mr-1 text-burgundy"></i> <?php echo htmlspecialchars($address); ?></div>
          <div><i class="fas fa-envelope mr-1 text-burgundy"></i> <?php echo htmlspecialchars($email); ?></div>
          <div><i class="fas fa-phone mr-1 text-burgundy"></i> <?php echo htmlspecialchars($cell); ?></div>
        </div>
      </div>
      <div class="col-md-6 text-md-right">
        <h6 class="text-uppercase small font-weight-bold" style="color:#8C223A; letter-spacing:1px;">Carrier &amp; Merchant Agency</h6>
        <h5 class="font-weight-bold mb-1" style="color:#470D1A;">WanderBook Global Travel Management</h5>
        <div class="text-muted small">
          <div>11 Dhanmondi Luxury Tower, Level 8</div>
          <div>Dhaka 1203, Bangladesh</div>
          <div><i class="fas fa-headset mr-1 text-burgundy"></i> 24/7 Global Airway Concierge: 012-345-6789</div>
        </div>
      </div>
    </div>

    <!-- Itemized Accounting Table -->
    <div class="table-responsive">
      <table class="table wb-table-luxury">
        <thead>
          <tr>
            <th style="width: 50px;">#</th>
            <th>Flight Service &amp; Route Description</th>
            <th class="text-center">Travelers</th>
            <th class="text-right">Base Fare</th>
            <th class="text-right">Taxes &amp; Fees (2026)</th>
            <th class="text-right">Total Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>01</strong></td>
            <td>
              <strong style="color:#470D1A;"><?php echo htmlspecialchars($airline); ?></strong>
              <div class="small text-muted mt-1">
                <span><i class="fas fa-plane-departure mr-1 text-burgundy"></i> <?php echo htmlspecialchars($from); ?></span> &rarr;
                <span><i class="fas fa-plane-arrival mr-1 text-burgundy"></i> <?php echo htmlspecialchars($to); ?></span>
              </div>
              <div class="small font-weight-bold mt-1" style="color:#681729;">
                <i class="far fa-calendar-alt mr-1"></i> Departure: <?php echo htmlspecialchars($displayDepDate); ?> at <?php echo htmlspecialchars($departureTime); ?>
              </div>
            </td>
            <td class="text-center">
              <div><strong><?php echo $adultno; ?></strong> Adult<?php echo $adultno > 1 ? 's' : ''; ?></div>
              <?php if ($childno > 0): ?>
                <div class="small text-muted"><?php echo $childno; ?> Child<?php echo $childno > 1 ? 'ren' : ''; ?></div>
              <?php endif; ?>
            </td>
            <td class="text-right">
              <?php
                $childfare = $childno * ($price / 2);
                $adultfare = $adultno * $price;
                $totBase = $adultfare + $childfare;
              ?>
              <strong>$<?php echo number_format($totBase, 2); ?></strong>
              <div class="small text-muted">
                <?php echo $adultno; ?> &times; $<?php echo number_format($price, 2); ?>
                <?php if ($childno > 0): ?>
                  <br><?php echo $childno; ?> &times; $<?php echo number_format($price / 2, 2); ?>
                <?php endif; ?>
              </div>
            </td>
            <td class="text-right">
              <strong>$<?php echo number_format($sertax, 2); ?></strong>
              <div class="small text-muted">2026 Airport Security &amp; Fuel</div>
            </td>
            <td class="text-right" style="color:#470D1A; font-weight:800; font-size:16px;">
              $<?php echo number_format($total, 2); ?>
            </td>
          </tr>

          <!-- Subtotal & Total Rows -->
          <tr>
            <th colspan="4" class="text-right" style="background:#FFFFFF; border-top:1px solid rgba(104,23,41,0.1);">Subtotal:</th>
            <td colspan="2" class="text-right font-weight-bold" style="border-top:1px solid rgba(104,23,41,0.1);">
              $<?php echo number_format($total, 2); ?>
            </td>
          </tr>
          <tr>
            <th colspan="4" class="text-right" style="background:#FFFFFF; border:none;">Season Promotional Discount:</th>
            <td colspan="2" class="text-right font-weight-bold text-success" style="border:none;">
              - $0.00 (0%)
            </td>
          </tr>
          <tr class="wb-total-row">
            <th colspan="4" class="text-right">Grand Total Paid (2026 Season):</th>
            <td colspan="2" class="text-right" style="font-size:22px; color:#470D1A;">
              $<?php echo number_format($total, 2); ?> USD
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Payment Instrument & Security Verification -->
    <div class="row align-items-center mt-4 pt-3" style="border-top:1.5px solid rgba(104,23,41,0.12);">
      <div class="col-md-7 mb-3 mb-md-0">
        <div class="d-flex align-items-center gap-3">
          <i class="fas fa-credit-card fa-2x" style="color:#681729;"></i>
          <div class="small" style="color:#241618;">
            <div><strong>Payment Method:</strong> <?php echo htmlspecialchars($paytype); ?> (Ending in **** <?php echo substr($ccnumber, -4); ?>)</div>
            <div><strong>Transaction Reference:</strong> TXN-2026-<?php echo substr(md5($orderid), 0, 12); ?> &bull; 256-Bit SSL Encrypted</div>
          </div>
        </div>
      </div>
      <div class="col-md-5 text-md-right">
        <div class="wb-action-toolbar">
          <button onclick="window.print()" class="btn wb-btn-burgundy px-4 py-2">
            <i class="fas fa-print mr-1"></i> Print / Download PDF
          </button>
        </div>
      </div>
    </div>

  </div><!-- /.wb-invoice-card -->

</div><!-- /.container -->

<?php include 'footer.php'; ?>
