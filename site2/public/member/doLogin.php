<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$conn = getDatabaseConnection(); // DB 연결 함수

// 사용자 입력값을 XSS 방어 처리
$loginId = htmlspecialchars($_REQUEST['loginId'], ENT_QUOTES, 'UTF-8');

$sql = "SELECT * FROM member WHERE loginId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loginId);
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

// 비밀번호 자동 업그레이드 (선택적 적용)
if (password_needs_rehash($hashedLoginPw, PASSWORD_DEFAULT)) {
    $newHashedPw = password_hash($plainLoginPw, PASSWORD_DEFAULT);
    $sql = "UPDATE member SET loginPw = ? WHERE loginId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newHashedPw, $loginId);
    $stmt->execute();
    $stmt->close();
}

// 로그인 성공 -> 세션 저장
$_SESSION['loginedMemberInfo'] = $memberInfo;

jsAlert('로그인 되었습니다.');
jsLocationReplace('/article/list.php');
?>
