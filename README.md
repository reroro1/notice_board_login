# 코드에 대한 설명
PHP와 MySQL을 이용하여 회원제 게시판을 구현하였습니다.<br>
회원 가입, 로그인/로그아웃, 게시글 작성/수정/삭제/조회 등의 기능을 구현했습니다.
<br>
<br>
**개발환경**
<br>
XAMPP<br>
이 프로젝트는 XAMPP를 사용하여 로컬 개발 환경에서 진행되었습니다.<br>
XAMPP는 Apache, PHP, MySQL 등 웹 애플리케이션 개발에 필요한 요소들을 <br>
한 번에 설치하고 실행할 수 있도록 도와줍니다.<br>
<br>
SQLyog<br>
MySQL 데이터베이스 관리는 SQLyog를 사용하여 수행하였습니다.<br><br>

**공통 기능 라이브러리 (lib.php)**

**SQL 실행 및 결과 처리 함수**
</br>
</br>
execute($sql)
주어진 SQL 문을 실행합니다.</br>
</br>
getRows($sql), getRow($sql), getRowValue($sql) </br>
SQL 실행 결과를 배열 형태로 받아오거나 단일 행/값을 반환합니다.
</br>
</br>
**JavaScript 기반 알림 및 리다이렉션 함수**
</br>
</br>
jsAlert($msg)
자바스크립트를 사용하여 사용자에게 경고창(alert)을 띄웁니다.</br>
</br>
jsHistoryBack(), jsLocationReplace($url), jsLocationHref($url)</br>
브라우저의 이전 페이지로 이동하거나, 특정 URL로 강제 이동시키는 스크립트를 출력합니다.</br>
</br>
**세션 및 로그인 관련 함수**
</br>
</br>
isLogined()
세션 변수에서 로그인된 회원 정보를 확인하여 로그인 여부를 판단합니다.</br>
</br>
getLastInsertId()
마지막으로 삽입된 데이터의 ID 값을 반환합니다.</br>
</br>
**게시글 관련 기능 파일**
</br>
상세보기 (public/article/detail.php)</br>
요청받은 게시글 ID를 기준으로 article 테이블에서 데이터를 조회한 후,</br> 
해당 게시글의 ID, 작성일시, 제목, 내용 등을 HTML 테이블 형식으로 출력합니다.</br>
</br>
</br>
게시글 삭제 (public/article/doDelete.php)</br>
로그인 상태와 게시글의 작성자(회원) 여부를 확인한 후, </br>
권한이 있는 경우 게시글을 삭제합니다. 삭제 후에는 JavaScript 경고창을 띄우고 </br>
게시글 목록 페이지로 리다이렉션합니다.
</br>
</br>
게시글 수정 (public/article/doModify.php)</br>
로그인 및 권한 체크를 통해 본인이 작성한 게시글만 수정할 수 있도록 하며, </br>
수정된 제목과 내용으로 데이터베이스의 해당 게시글 정보를 업데이트합니다.
</br>
</br>

게시글 작성 (public/article/doWrite.php & public/article/write.php)</br></br>
게시글 작성 폼(public_article_write.php)에서 입력받은 제목과 내용을 이용해, </br>
로그인한 회원의 정보(회원 ID, 닉네임)를 함께 데이터베이스에 저장합니다. </br>
저장 후 새 게시글의 상세보기 페이지로 이동합니다.</br>
</br>

게시글 목록 (public/article/list.php)</br></br>
데이터베이스에 저장된 모든 게시글을 최신순(내림차순)으로 조회하여 목록을 출력하며, </br>
각 게시글에는 상세보기와 삭제 링크가 포함됩니다.</br>


**회원 관련 기능 파일**
</br>
회원 가입 (public/member/doJoin.php & public/member/join.php)</br></br>
가입 폼(public/member/join.php)에서 입력받은 로그인 아이디, 비밀번호, 닉네임을 바탕으로</br> 
중복 여부를 체크한 후, 문제가 없으면 회원 정보를 member 테이블에 저장합니다.</br>
또한, password_hash() 함수로 비밀번호를 해싱한 뒤에 저장합니다.<br>

</br>
로그인 (public/member/doLogin.php & public/member/login.php)</br>
로그인 폼에서 입력한 정보로 회원 정보를 조회하고, </br>
일치하는 회원이 있으면 세션에 회원 정보를 저장하여 로그인 상태를 유지합니다.</br>
loginId만으로 회원 정보를 먼저 가져오고<br>
DB에서 가져온 loginPw(해시 값)과 사용자가 입력한 평문 비밀번호를 password_verify()로 비교합니다.<br>
</br>
로그아웃 (public/member/doLogout.php)</br>
현재의 세션을 파괴하여 로그아웃 처리를 하고, 로그인 페이지로 이동시킵니다.</br>


**공통 레이아웃 및 초기화**
</br>
</br>
레이아웃 (public/part/head.php & public/part/foot.php)</br>
public/part/head.php는 HTML 헤더 부분으로, </br>
CSS, jQuery, 공통 JavaScript 파일을 포함하며 </br>
로그인 상태에 따라 메뉴(로그인/회원가입 또는 로그아웃/글쓰기)를 동적으로 보여줍니다.</br>
</br>
public/part/foot.php는 </br>
HTML의 닫는 태그 등을 포함하여 페이지 마무리를 담당합니다.</br>
</br>
초기화 (web_init.php) </br>
세션을 시작하고, 데이터베이스 연결 설정을 </br>
정의한 후 실제 MySQL 연결을 수행합니다. </br>
또한, 공통 라이브러리인 lib.php를 포함하여 </br>
전체 프로젝트에서 필요한 함수들을 사용할 수 있도록 초기화합니다.</br>
