<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$sql = "
SELECT *
FROM member
WHERE loginId = '{$_REQUEST['loginId']}'
";

$memberInfo = getRow($sql);

if ( empty($memberInfo) ) {
    jsAlert("존재하지 않는 아이디입니다.");
    jsHistoryBack();
}

// 사용자가 폼에 입력한 평문 비밀번호
$plainLoginPw = $_REQUEST['loginPw'];  

// DB에서 가져온 해시된 비밀번호
$hashedLoginPw = $memberInfo['loginPw'];

// password_verify()로 검증
if ( password_verify($plainLoginPw, $hashedLoginPw) === false ) {
    jsAlert("비밀번호가 일치하지 않습니다.");
    jsHistoryBack();
}

// 비밀번호도 일치하면 로그인 세션 저장
$_SESSION['loginedMemberInfo'] = $memberInfo;

jsAlert('로그인 되었습니다.');
jsLocationReplace('/article/list.php');
