<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';

if ( isLogined() == false ) {
    jsAlert("로그인 후 이용해주세요.");
    jsHistoryBack();
}

if ( isset($_REQUEST['title']) == false ) {
    $_REQUEST['title'] = '';
}

if ( empty($_REQUEST['title']) ) {
    jsAlert("제목을 입력해주세요.");
    jsHistoryBack();    
}

$loginedMemberInfo = $_SESSION['loginedMemberInfo'];

$sql = "
INSERT INTO article
SET regDate = NOW(),
title = '{$_REQUEST['title']}',
body = '{$_REQUEST['body']}',
memberId = '{$loginedMemberInfo['id']}',
writer = '{$loginedMemberInfo['nickname']}'
";

execute($sql);

$newId = getLastInsertId();

jsAlert('글 작성이 되었습니다.');
jsLocationReplace('/article/detail.php?id=' . $newId);