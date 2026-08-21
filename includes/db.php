<?php
$host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: '';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'sun_sea_restaurant';

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

if (!$conn) {
    error_log('DB connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    exit('Database connection failed.');
}
mysqli_set_charset($conn, 'utf8mb4');
?>
