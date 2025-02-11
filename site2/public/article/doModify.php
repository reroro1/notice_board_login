<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if (!isLogined()) {
    jsAlert("로그인 후 이용해주세요.");
    jsHistoryBack();
}

$id = $_REQUEST['id'] ?? '';
$title = $_REQUEST['title'] ?? '';
$body = $_REQUEST['body'] ?? '';

if (empty($id) || empty($title) || empty($body)) {
    jsAlert("모든 필드를 입력해주세요.");
    jsHistoryBack();
}

$loginedMemberInfo = $_SESSION['loginedMemberInfo'];

$conn = getDatabaseConnection();

// 게시글 작성자 확인
$sql = "SELECT memberId FROM article WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($articleMemberId);
$stmt->fetch();
$stmt->close();

if ($articleMemberId != $loginedMemberInfo['id']) {
    jsAlert('수정 권한이 없습니다.');
    jsHistoryBack();
}

// 게시글 수정
$sql = "UPDATE article SET title = ?, body = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $title, $body, $id);
$stmt->execute();
$stmt->close();

jsAlert('글이 수정되었습니다.');
jsLocationReplace('/article/detail.php?id=' . $id);
?>
