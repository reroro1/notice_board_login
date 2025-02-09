<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$sql = "
SELECT *
FROM member
WHERE loginId = '{$_REQUEST['loginId']}'
AND loginPw = '{$_REQUEST['loginPw']}'
";

$memberInfo = getRow($sql);

if ( empty($memberInfo) ) {
    jsAlert("일치하는 회원이 없습니다.");
    jsHistoryBack();
}

$_SESSION['loginedMemberInfo'] = $memberInfo;

jsAlert('로그인 되었습니다.');
jsLocationReplace('/article/list.php');