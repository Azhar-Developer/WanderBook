<?php
/*
 * Copyright (c) 2024. All rights reserved by Woliul Hasan. Fork me on https://github.com/woliul
 */

$dbFilePath = __DIR__ . "/database.php";
if (!file_exists($dbFilePath)) {
    $dbFilePath = dirname(__DIR__) . "/functions/database.php";
}

include_once $dbFilePath;
