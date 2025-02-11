<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

// 닉네임이 입력되지 않았을 경우 기본값 설정
$nickname = $_REQUEST['nickname'] ?? '';

if ( empty($nickname) ) {
    jsAlert("닉네임을 입력해주세요.");
    jsHistoryBack();
}

$conn = getDatabaseConnection(); // DB 연결 함수 (사용하는 DB 커넥션 함수에 맞게 수정)

// 1. 로그인 아이디 중복 체크
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

// 2. 닉네임 중복 체크
$sql = "SELECT COUNT(*) FROM member WHERE nickname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nickname);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    jsAlert("이미 사용중인 닉네임 입니다.");
    jsHistoryBack();
}

// 3. 비밀번호 해싱
$plainLoginPw = $_REQUEST['loginPw'];
$hashedLoginPw = password_hash($plainLoginPw, PASSWORD_DEFAULT);

// 4. 회원가입 정보 저장
$sql = "INSERT INTO member (regDate, loginId, loginPw, nickname) VALUES (NOW(), ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_REQUEST['loginId'], $hashedLoginPw, $nickname);
$stmt->execute();
$stmt->close();

jsAlert('가입이 완료되었습니다.');
jsLocationReplace('/member/login.php');
