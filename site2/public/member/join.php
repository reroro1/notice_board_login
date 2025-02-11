<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

$nickname = htmlspecialchars($_REQUEST['nickname'], ENT_QUOTES, 'UTF-8');

if (empty($nickname)) {
    jsAlert("닉네임을 입력해주세요.");
    jsHistoryBack();
}

$conn = getDatabaseConnection();

$sql = "SELECT COUNT(*) FROM member WHERE loginId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_REQUEST['loginId']);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    jsAlert("이미 사용중인 로그인 아이디 입니다.");
    jsHistoryBack();
}

$plainLoginPw = $_REQUEST['loginPw'];
$hashedLoginPw = password_hash($plainLoginPw, PASSWORD_DEFAULT);

$sql = "INSERT INTO member (regDate, loginId, loginPw, nickname) VALUES (NOW(), ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_REQUEST['loginId'], $hashedLoginPw, $nickname);
$stmt->execute();
$stmt->close();

jsAlert('가입이 완료되었습니다.');
jsLocationReplace('/member/login.php');
?>
