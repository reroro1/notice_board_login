<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if ( isLogined() == false ) {
    jsAlert("로그인 후 이용해주세요.");
    jsHistoryBack();
}

if ( isset($_REQUEST['id']) == false ) {
    $_REQUEST['id'] = '';
}

if ( empty($_REQUEST['id']) ) {
    jsAlert("삭제할 ID를 입력해주세요.");
    jsHistoryBack();    
}

$loginedMemberInfo = $_SESSION['loginedMemberInfo'];

$sql = "
SELECT memberId
FROM article
WHERE id = '{$_REQUEST['id']}'
";
$articleMemberId = getRowValue($sql);

if ( $articleMemberId != $loginedMemberInfo['id'] ) {
    jsAlert('삭제 권한이 없습니다.');
    jsHistoryBack();
}

$sql = "
DELETE FROM article
WHERE id = '{$_REQUEST['id']}'
";

execute($sql);

jsAlert('글이 삭제되었습니다.');
jsLocationReplace('/article/list.php');