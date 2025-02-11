<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if (!isLogined()) {
    jsAlert("로그인 후 이용해주세요.");
    jsHistoryBack();
}

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

if (empty($id)) {
    jsAlert("삭제할 ID를 입력해주세요.");
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
    jsAlert('삭제 권한이 없습니다.');
    jsHistoryBack();
}

// 게시글 삭제
$sql = "DELETE FROM article WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

jsAlert('글이 삭제되었습니다.');
jsLocationReplace('/article/list.php');
?>
