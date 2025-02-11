<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if (!isLogined()) {
    jsAlert("로그인 후 이용해주세요.");
    jsHistoryBack();
}

// CSRF 검증
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    jsAlert("잘못된 요청입니다.");
    jsHistoryBack();
}

$title = $_REQUEST['title'] ?? '';
$body = $_REQUEST['body'] ?? '';

if (empty($title) || empty($body)) {
    jsAlert("모든 필드를 입력해주세요.");
    jsHistoryBack();
}

$loginedMemberInfo = $_SESSION['loginedMemberInfo'];

$conn = getDatabaseConnection();

$sql = "INSERT INTO article (regDate, title, body, memberId, writer) VALUES (NOW(), ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $title, $body, $loginedMemberInfo['id'], $loginedMemberInfo['nickname']);
$stmt->execute();
$newId = $stmt->insert_id;
$stmt->close();

jsAlert('글 작성이 되었습니다.');
jsLocationReplace('/article/detail.php?id=' . $newId);
?>
