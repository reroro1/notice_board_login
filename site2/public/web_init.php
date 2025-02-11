<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_ID', 'root');
define('DB_PW', '');
define('DB_NAME', 'a3');

$dbConn = mysqli_connect(DB_HOST, DB_ID, DB_PW, DB_NAME) or die('DB CONNECTION ERROR');

require_once __DIR__ . '/lib.php';

// CSRF 토큰 생성
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
