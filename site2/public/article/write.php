<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/head.php';
?>

<div class="write-box con">

<form action="doWrite.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input name="title" type="text" placeholder="제목" maxlength="40" />
    <textarea name="body" placeholder="내용을 입력해주세요."></textarea>
    <input type="submit" value="글쓰기" />
</form>


</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/foot.php';
