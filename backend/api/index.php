<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');
include "../config.php";
require_once "Auth.php";
require_once "Category.php";
require_once "Product.php";


mysqli_close($conn);
