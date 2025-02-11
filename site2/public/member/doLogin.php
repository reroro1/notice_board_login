<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$conn = getDatabaseConnection(); // DB 연결 함수

$sql = "SELECT * FROM member WHERE loginId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_REQUEST['loginId']);
$stmt->execute();
$result = $stmt->get_result();
$memberInfo = $result->fetch_assoc();
$stmt->close();

if (empty($memberInfo)) {
    jsAlert("존재하지 않는 아이디입니다.");
    jsHistoryBack();
}

// 비밀번호 검증
$plainLoginPw = $_REQUEST['loginPw'];
$hashedLoginPw = $memberInfo['loginPw'];

if (!password_verify($plainLoginPw, $hashedLoginPw)) {
    jsAlert("비밀번호가 일치하지 않습니다.");
    jsHistoryBack();
}

// 로그인 성공 -> 세션 저장
$_SESSION['loginedMemberInfo'] = $memberInfo;

jsAlert('로그인 되었습니다.');
jsLocationReplace('/article/list.php');
