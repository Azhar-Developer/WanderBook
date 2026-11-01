<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */

include 'header.php';
?>

<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <span class="badge" style="background:linear-gradient(135deg, rgba(212,175,55,0.25), rgba(212,175,55,0.45)); border:1.5px solid rgba(212,175,55,0.7); color:#470D1A; font-weight:800; font-size:12px; letter-spacing:1px; padding:6px 14px; border-radius:30px;">
                <i class="fas fa-plane-departure mr-1"></i> 2026 Flight Search Results
            </span>
            <h2 class="mt-2 mb-0" style="font-family:'Cinzel',serif; color:#470D1A; font-weight:800;">
                Flight: Dhaka (DAC) to Cox's Bazar (CXB)
            </h2>
        </div>
        <div>
            <a href="flights.php" class="btn wb-btn-outline px-3 py-2">
                <i class="fas fa-arrow-left mr-1"></i> Back to 2026 Flight Network
            </a>
        </div>
    </div>

    <div class="card mb-4" style="background:#FAF6EE; border:2px solid rgba(104,23,41,0.25); border-radius:20px; box-shadow:0 12px 30px rgba(104,23,41,0.12); overflow:hidden;">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background:#FFFFFF; border-bottom:1.5px solid rgba(104,23,41,0.18); padding:18px 24px;">
            <div>
                <span class="badge" style="background:#681729; color:#FAF6EE; padding:6px 14px; border-radius:20px; font-weight:700;">
                    <i class="fas fa-plane mr-1"></i> Biman Bangladesh Airlines
                </span>
                <span class="badge ml-2" style="background:#e8d399; color:#523b05; padding:6px 14px; border-radius:20px; font-weight:800;">
                    <i class="fas fa-certificate mr-1" style="color:#b8860b;"></i> 2026 Schedule
                </span>
                <span class="ml-2 font-weight-bold" style="color:#470D1A; font-size:16px;">Flight WB-BG437</span>
            </div>
            <div>
                <span style="font-family:'Cinzel',serif; font-size:24px; font-weight:900; color:#470D1A;">BDT 4,699</span>
                <small class="text-muted font-weight-bold"> / seat</small>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row align-items-center text-center text-md-left">
                <div class="col-md-4 mb-3 mb-md-0">
                    <span class="small font-weight-bold text-uppercase d-block" style="color:#8C223A; letter-spacing:0.8px;">
                        <i class="fas fa-plane-departure mr-1"></i> Departure
                    </span>
                    <strong style="font-size:22px; color:#12090b;">Dhaka (DAC)</strong>
                    <div class="font-weight-bold mt-1" style="color:#470D1A; font-size:16px;">15:15</div>
                    <div class="small" style="color:#681729; font-weight:700;">
                        <i class="far fa-calendar-alt mr-1"></i> Fri, 10 Jul 2026
                    </div>
                </div>

                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <span class="badge px-3 py-1 mb-2" style="background:rgba(104,23,41,0.08); border:1px solid rgba(104,23,41,0.25); color:#681729; font-weight:700;">
                        <i class="far fa-clock mr-1"></i> 1 hour 15 minutes
                    </span>
                    <div class="d-flex align-items-center justify-content-center">
                        <div style="height:2px; flex-grow:1; background:#681729;"></div>
                        <i class="fas fa-plane mx-2" style="color:#681729; font-size:18px;"></i>
                        <div style="height:2px; flex-grow:1; background:#681729;"></div>
                    </div>
                    <small style="color:#28a745; font-weight:800;"><i class="fas fa-check-circle mr-1"></i> Direct Route &bull; 2026</small>
                </div>

                <div class="col-md-4 mb-3 mb-md-0 text-md-right">
                    <span class="small font-weight-bold text-uppercase d-block" style="color:#8C223A; letter-spacing:0.8px;">
                        <i class="fas fa-plane-arrival mr-1"></i> Arrival
                    </span>
                    <strong style="font-size:22px; color:#12090b;">Cox's Bazar (CXB)</strong>
                    <div class="font-weight-bold mt-1" style="color:#470D1A; font-size:16px;">16:30</div>
                    <div class="small" style="color:#681729; font-weight:700;">
                        <i class="far fa-calendar-alt mr-1"></i> Fri, 10 Jul 2026
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-2" style="background:#FFFFFF; border-top:1.5px solid rgba(104,23,41,0.15); padding:16px 24px;">
            <a aria-controls="flightDetails1" aria-expanded="false" class="btn wb-btn-outline px-3 py-2 collapsed" data-target="#flightDetails1" data-toggle="collapse" href="#">
                <i class="fas fa-info-circle mr-1"></i> View Ticket Specs &amp; Baggage
            </a>
            <a href="flightbooking.php?destination=1" class="btn wb-btn-burgundy px-4 py-2">
                <i class="fas fa-ticket-alt mr-1"></i> Book 2026 Flight Ticket
            </a>
        </div>

        <div class="collapse" id="flightDetails1">
            <div class="card-body p-4" style="background:rgba(255,255,255,0.7); border-top:1px dashed rgba(104,23,41,0.2);">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded" style="background:#FAF6EE; border:1px solid rgba(104,23,41,0.18);">
                            <h6 class="font-weight-bold" style="color:#470D1A;"><i class="fas fa-plane mr-2 text-burgundy"></i> Flight Details</h6>
                            <p class="mb-1 small"><strong>Airline:</strong> Biman Bangladesh Airlines</p>
                            <p class="mb-1 small"><strong>Aircraft:</strong> Boeing 737-800 / DH8 NextGen</p>
                            <p class="mb-1 small"><strong>Schedule:</strong> 15:15 - 16:30, Fri, 10 Jul 2026</p>
                            <p class="mb-0 small"><strong>Class:</strong> Premium Economy &bull; Season 2026</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded" style="background:#FAF6EE; border:1px solid rgba(104,23,41,0.18);">
                            <h6 class="font-weight-bold" style="color:#470D1A;"><i class="fas fa-suitcase-rolling mr-2 text-burgundy"></i> Baggage &amp; Amenities</h6>
                            <p class="mb-1 small"><strong>Cabin Baggage:</strong> 7 kg Included</p>
                            <p class="mb-1 small"><strong>Checked Luggage:</strong> 20 kg Included</p>
                            <p class="mb-1 small"><strong>In-Flight:</strong> Snacks, USB Power &amp; Wi-Fi</p>
                            <p class="mb-0 small"><strong>Total Price:</strong> BDT 4,699 per passenger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
