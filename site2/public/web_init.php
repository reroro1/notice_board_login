<?php
// 프로젝트 폴더/web_init.php

// 세션 시작
session_start();

define('DB_HOST', 'localhost');
define('DB_ID', 'root');
define('DB_PW', '');
define('DB_NAME', 'a3');

$dbConn = mysqli_connect(DB_HOST, DB_ID, DB_PW, DB_NAME) or die('DB CONNECTION ERROR');

require_once __DIR__ . '/lib.php';

// DB 연결