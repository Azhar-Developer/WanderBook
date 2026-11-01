<?php
/*
 * Copyright (c) 2026 WanderBook. All rights reserved.
 */
?>
<!-- WanderBook 3D Master Footer -->
<footer class="wb-footer">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4 mb-4 mb-lg-0 text-center text-lg-left">
        <a href="index.php" class="wb-footer-brand d-inline-block">
          <img src="assets/img/logo/wanderbook-logo.svg" alt="WanderBook" style="height: 44px; width: auto;">
        </a>
        <p class="wb-cream-muted small mt-2 mb-0" style="color: var(--wb-cream-gold);">
          Curated Journeys &bull; 3D Spatial Travel Management.<br>
          Transforming worldwide exploration with spatial elegance.
        </p>
      </div>

      <div class="col-lg-4 mb-4 mb-lg-0 text-center">
        <ul class="list-inline mb-2">
          <li class="list-inline-item mx-2"><a href="index.php">Explore</a></li>
          <li class="list-inline-item mx-2">&bull;</li>
          <li class="list-inline-item mx-2"><a href="flights.php">Flights</a></li>
          <li class="list-inline-item mx-2">&bull;</li>
          <li class="list-inline-item mx-2"><a href="hotels.php">Hotels</a></li>
          <li class="list-inline-item mx-2">&bull;</li>
          <li class="list-inline-item mx-2"><a href="offer.php">Deals</a></li>
          <li class="list-inline-item mx-2">&bull;</li>
          <li class="list-inline-item mx-2"><a href="meet-the-team.php">Meet The Team</a></li>
        </ul>
        <div class="small" style="color: var(--wb-cream-muted);">
          <i class="fas fa-shield-alt text-burgundy mr-1"></i> Secure Global Reservations &bull; 24/7 Concierge Support
        </div>
      </div>

      <div class="col-lg-4 text-center text-lg-right">
        <div class="wb-architect-box d-inline-block text-left p-2 rounded" style="background: rgba(104, 23, 41, 0.25); border: 1.5px solid var(--wb-burgundy-main);">
          <small class="d-block" style="color: var(--wb-cream-gold); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Project Architect</small>
          <strong style="color: var(--wb-cream-light);">Azharudeen A</strong>
          <span class="wb-architect-pill">ID: 35125018</span>
        </div>
      </div>
    </div>

    <div class="wb-footer-credit text-center">
      <p class="mb-0">
        &copy; <?php echo date('Y'); ?> <strong>WanderBook</strong>. Designed &amp; Developed with 3D Spatial Architecture by 
        <span class="badge" style="background: var(--wb-burgundy-main); color: var(--wb-cream-light); font-size: 13px; border: 1px solid var(--wb-burgundy-light);">Azharudeen A (ID: 35125018)</span>.
        All rights reserved.
      </p>
    </div>
  </div>
</footer>

<!-- Standard Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- WanderBook 3D Interactive Engine (Three.js Earth Globe + 3D Card Tilt) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  
  // 1. Initialize Three.js 3D Globe Hero if canvas exists
  var canvasContainer = document.getElementById('wb-three-canvas');
  if (canvasContainer && typeof THREE !== 'undefined') {
    initThreeGlobe(canvasContainer);
  }

  function initThreeGlobe(container) {
    var scene = new THREE.Scene();
    
    // Camera
    var width = container.clientWidth || window.innerWidth;
    var height = container.clientHeight || 620;
    var camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
    camera.position.z = 220;

    // Renderer
    var renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    container.appendChild(renderer.domElement);

    // Group to hold globe and orbits
    var globeGroup = new THREE.Group();
    scene.add(globeGroup);

    // Deep Burgundy & Cream Theme Palette for Three.js
    var burgundyColor = 0x8A223B;
    var burgundyGlow = 0x681729;
    var creamColor = 0xFAF6EE;
    var goldColor = 0xE8DECA;
    var sageAtmosphere = 0x899A88;

    // 1. Inner Sphere (Soft atmospheric core)
    var sphereGeo = new THREE.SphereGeometry(65, 36, 36);
    var sphereMat = new THREE.MeshBasicMaterial({
      color: 0x4d5c4c,
      wireframe: true,
      transparent: true,
      opacity: 0.22
    });
    var sphere = new THREE.Mesh(sphereGeo, sphereMat);
    globeGroup.add(sphere);

    // 2. Outer Dot-Matrix / Longitude & Latitude Mesh
    var outerGeo = new THREE.SphereGeometry(68, 28, 28);
    var outerMat = new THREE.PointsMaterial({
      color: creamColor,
      size: 1.6,
      transparent: true,
      opacity: 0.65
    });
    var outerDots = new THREE.Points(outerGeo, outerMat);
    globeGroup.add(outerDots);

    // 3. Orbital Ring 1 (Burgundy glowing equator)
    var ringGeo = new THREE.RingGeometry(80, 82, 64);
    var ringMat = new THREE.MeshBasicMaterial({
      color: burgundyColor,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.55
    });
    var ring = new THREE.Mesh(ringGeo, ringMat);
    ring.rotation.x = Math.PI / 2.3;
    globeGroup.add(ring);

    // 4. Orbital Ring 2 (Tilted cream flight path)
    var ringGeo2 = new THREE.RingGeometry(88, 89.5, 64);
    var ringMat2 = new THREE.MeshBasicMaterial({
      color: goldColor,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.4
    });
    var ring2 = new THREE.Mesh(ringGeo2, ringMat2);
    ring2.rotation.x = Math.PI / 1.7;
    ring2.rotation.y = Math.PI / 4;
    globeGroup.add(ring2);

    // 5. Global Travel Waypoints & Flight Arcs
    var cityCoords = [
      { lat: 48.8566, lon: 2.3522 },    // Paris
      { lat: 35.6762, lon: 139.6503 },  // Tokyo
      { lat: 40.7128, lon: -74.0060 },  // New York
      { lat: -8.4095, lon: 115.1889 },  // Bali
      { lat: 51.5074, lon: -0.1278 },   // London
      { lat: 25.2048, lon: 55.2708 }    // Dubai
    ];

    function latLonToVector3(lat, lon, radius) {
      var phi = (90 - lat) * (Math.PI / 180);
      var theta = (lon + 180) * (Math.PI / 180);
      return new THREE.Vector3(
        -(radius * Math.sin(phi) * Math.cos(theta)),
        radius * Math.cos(phi),
        radius * Math.sin(phi) * Math.sin(theta)
      );
    }

    var nodesGroup = new THREE.Group();
    cityCoords.forEach(function(coord) {
      var pos = latLonToVector3(coord.lat, coord.lon, 68);
      
      // Node pin
      var nodeGeo = new THREE.SphereGeometry(2, 12, 12);
      var nodeMat = new THREE.MeshBasicMaterial({ color: burgundyColor });
      var nodeMesh = new THREE.Mesh(nodeGeo, nodeMat);
      nodeMesh.position.copy(pos);
      nodesGroup.add(nodeMesh);

      // Node halo
      var haloGeo = new THREE.RingGeometry(2.5, 3.8, 16);
      var haloMat = new THREE.MeshBasicMaterial({ color: creamColor, side: THREE.DoubleSide });
      var haloMesh = new THREE.Mesh(haloGeo, haloMat);
      haloMesh.position.copy(pos);
      haloMesh.lookAt(0, 0, 0);
      nodesGroup.add(haloMesh);
    });
    globeGroup.add(nodesGroup);

    // 6. Floating Star Particles in Sage Space
    var starsGeo = new THREE.BufferGeometry();
    var starCount = 350;
    var starPositions = new Float32Array(starCount * 3);
    for (var i = 0; i < starCount * 3; i += 3) {
      starPositions[i] = (Math.random() - 0.5) * 500;
      starPositions[i + 1] = (Math.random() - 0.5) * 350;
      starPositions[i + 2] = (Math.random() - 0.5) * 300;
    }
    starsGeo.setAttribute('position', new THREE.BufferAttribute(starPositions, 3));
    var starsMat = new THREE.PointsMaterial({
      color: creamColor,
      size: 1.2,
      transparent: true,
      opacity: 0.45
    });
    var starField = new THREE.Points(starsGeo, starsMat);
    scene.add(starField);

    // Mouse Interaction for 3D Tilt Orbit
    var mouseX = 0, mouseY = 0;
    var targetRotationX = 0, targetRotationY = 0;
    window.addEventListener('mousemove', function(e) {
      mouseX = (e.clientX - window.innerWidth / 2) * 0.0006;
      mouseY = (e.clientY - window.innerHeight / 2) * 0.0006;
    });

    // Handle Resize
    window.addEventListener('resize', function() {
      if (!container) return;
      var newW = container.clientWidth || window.innerWidth;
      var newH = container.clientHeight || 620;
      camera.aspect = newW / newH;
      camera.updateProjectionMatrix();
      renderer.setSize(newW, newH);
    });

    // Animation Loop
    function animate() {
      requestAnimationFrame(animate);
      
      // Auto continuous rotation + mouse tilt
      globeGroup.rotation.y += 0.004;
      globeGroup.rotation.x += (mouseY - globeGroup.rotation.x) * 0.05;
      globeGroup.rotation.z += (mouseX - globeGroup.rotation.z) * 0.05;

      ring.rotation.z += 0.006;
      ring2.rotation.z -= 0.004;
      starField.rotation.y += 0.0005;

      renderer.render(scene, camera);
    }
    animate();
  }

  // 2. Interactive 3D Card Tilt Engine
  var tiltCards = document.querySelectorAll('[data-tilt]');
  tiltCards.forEach(function(card) {
    card.addEventListener('mousemove', function(e) {
      var rect = card.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      var centerX = rect.width / 2;
      var centerY = rect.height / 2;
      var deltaX = (x - centerX) / centerX;
      var deltaY = (y - centerY) / centerY;

      var rotateX = deltaY * -12;
      var rotateY = deltaX * 12;

      card.style.transform = 'perspective(1000px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) scale3d(1.02, 1.02, 1.02)';
    });

    card.addEventListener('mouseleave', function() {
      card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
    });
  });

});
</script>

</body>
</html>
