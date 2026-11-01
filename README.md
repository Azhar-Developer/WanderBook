# WanderBook: Travel Management System

![WanderBook Logo](https://github.com/woliul/gypsy-tms/blob/main/WanderBook/assets/img/logo/wanderbook-logo.svg)

## Overview

**WanderBook** is a modern, full-featured Travel Management System (TMS) built with PHP and MySQL. It automates itinerary creation, booking, and expense tracking while providing real-time updates and personalized recommendations. WanderBook features a stunning 2026-era UI with 3D visual elements, glassmorphism cards, animated boarding-pass style flight tickets, and a deep-burgundy + cream beige design system.

## Features

### User Features
- **User Registration & Login** — Secure account creation and access.
- **Flight Search & Booking** — Search flights with live route visualization and digital boarding-pass style ticket cards.
- **Hotel Search & Booking** — Browse and book premium hotels.
- **Destinations Explorer** — Discover top travel destinations worldwide.
- **Exclusive Offers** — View curated travel deals and promotions.
- **Review & Rating System** — Provide feedback on services used.
- **Flight & Hotel Invoices** — Download booking confirmations.

### Administrator Features
- **Admin Dashboard** — Centralized interface for managing system operations.
- **User Management** — Administer user accounts and profiles.
- **Booking Management** — Oversee all flight and hotel bookings.
- **Content Management** — Update flights, accommodations, and offers.
- **Reporting & Analytics** — Generate performance reports.

## Design System
- 🎨 **Background:** Muted Sage Gray `#758674`
- 🍦 **Surfaces:** Warm Cream Beige `#FAF6EE` / `#F4EFE6`
- 🟥 **Accents:** Deep Burgundy `#681729` / `#8C223A`
- ✨ **3D Elements:** Three.js globe, tilt cards, animated boarding pass tickets
- 🔤 **Fonts:** Cinzel (headings) + Plus Jakarta Sans (body)

## Team

| Name | Student ID |
|------|------------|
| **Azharudeen A** | 35125018 |

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/woliul/gypsy-tms.git
   cd gypsy-tms
   ```

2. **Setup local server:**
   - Install [XAMPP](https://www.apachefriends.org/index.html) or use the PHP built-in dev server.
   - Place the project in the `htdocs` directory for XAMPP.

3. **Database Configuration:**
   - Create a MySQL database named `gypsy`.
   - Import the provided `WanderBook/SQL/gypsy.sql` file into the database.

4. **Configure Database Connection:**
   - Update `WanderBook/database.php` with your credentials:
     ```php
     $host    = "localhost";
     $user    = "root";
     $pass    = "your_password";
     $dbname  = "gypsy";
     ```

5. **Start Local Server:**
   - Using PHP built-in server:
     ```bash
     php -S localhost:8000 -t "path/to/project"
     ```
   - Then visit: `http://localhost:8000`

## Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3, JavaScript, Bootstrap 4 |
| 3D / Animation | Three.js, VanillaTilt.js |
| Icons | Font Awesome 6 |
| Fonts | Google Fonts (Cinzel, Plus Jakarta Sans) |
| Backend | PHP 8.2 |
| Database | MySQL / MariaDB |

## Troubleshooting

- **Database Connection Issues** — Ensure `WanderBook/database.php` is correctly configured.
- **Missing PHP Extensions** — Enable `mysqli`, `pdo_mysql`, `mbstring`, `curl` in `php.ini`.
- **Permissions Problems** — Verify file and directory permissions on your server.

For further assistance raise an issue on GitHub.

## License

© 2026 WanderBook. All rights reserved.
