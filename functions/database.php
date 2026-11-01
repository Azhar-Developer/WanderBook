<?php
/*
 * Copyright (c) 2024. All rights reserved by Woliul Hasan. Fork me on https://github.com/woliul
 */

mysqli_report(MYSQLI_REPORT_OFF);

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "gypsy";
$epassword = "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    $conn = new mysqli($servername, $username, $epassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

