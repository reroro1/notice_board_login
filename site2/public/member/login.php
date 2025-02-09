<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/head.php';
?>

<div class="login-box con">

<form action="doLogin.php" method="POST">
<input name="loginId" type="text" placeholder="로그인 아이디를 입력해주세요." maxlength="20" />
<input name="loginPw" type="password" placeholder="로그인 비번을 입력해주세요." maxlength="20" />
<input type="submit" value="로그인" />
</form>

</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/foot.php';