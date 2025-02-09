<!-- 프로젝트 폴더/public/part/web_init.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인 및 로그아웃</title>
    <link rel="stylesheet" href="/assets/common.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/assets/common.js"></script>
</head>
<body>
    
    <div>
        <?php if ( isLogined() ) { ?>
        <a href="/member/doLogout.php">로그아웃</a>
        <a href="/article/write.php">글쓰기</a>
        <?php } else { ?>
        <a href="/member/join.php">회원가입</a>
        <a href="/member/login.php">로그인</a>
        <?php } ?>
        <a href="/article/list.php">글 리스트</a>
    </div>