<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

jsAlert('로그아웃 되었습니다.');
jsLocationReplace('/member/login.php');
?>
