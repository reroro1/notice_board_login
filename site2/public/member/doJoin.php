<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if ( isset($_REQUEST['nickname']) == false ) {
    $_REQUEST['nickname'] = '';
}

if ( empty($_REQUEST['nickname']) ) {
    jsAlert("닉네임을 입력해주세요.");
    jsHistoryBack();    
}

$sql = "
SELECT COUNT(*)
FROM member
WHERE loginId = '{$_REQUEST['loginId']}'
";

if ( getRowValue($sql) > 0 ) {
    jsAlert("이미 사용중인 로그인 아이디 입니다.");
    jsHistoryBack();
}

$sql = "
SELECT COUNT(*)
FROM member
WHERE nickname = '{$_REQUEST['nickname']}'
";

if ( getRowValue($sql) > 0 ) {
    jsAlert("이미 사용중인 닉네임 입니다.");
    jsHistoryBack();
}

$sql = "
INSERT INTO member
SET regDate = NOW(),
loginId = '{$_REQUEST['loginId']}',
loginPw = '{$_REQUEST['loginPw']}',
nickname = '{$_REQUEST['nickname']}'
";

execute($sql);

jsAlert('가입이 완료 되었습니다.');
jsLocationReplace('/member/login.php');