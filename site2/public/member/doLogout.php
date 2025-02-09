<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

session_destroy();

jsAlert('로그아웃 되었습니다.');
jsLocationReplace('/member/login.php');