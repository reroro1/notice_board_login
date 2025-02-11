<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$conn = getDatabaseConnection();

$loginId = htmlspecialchars($_REQUEST['loginId'], ENT_QUOTES, 'UTF-8');
$plainLoginPw = $_REQUEST['loginPw'];

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

$hashedLoginPw = $memberInfo['loginPw'];

if (!password_verify($plainLoginPw, $hashedLoginPw)) {
    jsAlert("비밀번호가 일치하지 않습니다.");
    jsHistoryBack();
}

// 최신 비밀번호 해싱 방식으로 자동 업그레이드
if (password_needs_rehash($hashedLoginPw, PASSWORD_DEFAULT)) {
    $newHashedPw = password_hash($plainLoginPw, PASSWORD_DEFAULT);
    $sql = "UPDATE member SET loginPw = ? WHERE loginId = ?";
    $stmt = $conn->prepare($sql);
    $
