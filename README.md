공통 기능 라이브러리 (lib.php)

SQL 실행 및 결과 처리 함수


execute($sql): 주어진 SQL 문을 실행합니다.


getRows($sql), getRow($sql), getRowValue($sql): SQL 실행 결과를 배열 형태로 받아오거나 단일 행/값을 반환합니다.


JavaScript 기반 알림 및 리다이렉션 함수


jsAlert($msg): 자바스크립트를 사용하여 사용자에게 경고창(alert)을 띄웁니다.


jsHistoryBack(), jsLocationReplace($url), jsLocationHref($url): 브라우저의 이전 페이지로 이동하거나, 특정 URL로 강제 이동시키는 스크립트를 출력합니다.


세션 및 로그인 관련 함수


isLogined(): 세션 변수에서 로그인된 회원 정보를 확인하여 로그인 여부를 판단합니다.


getLastInsertId(): 마지막으로 삽입된 데이터의 ID 값을 반환합니다.


게시글 관련 기능 파일

상세보기 (public/article/detail.php)

요청받은 게시글 ID를 기준으로 article 테이블에서 데이터를 조회한 후, 해당 게시글의 ID, 작성일시, 제목, 내용 등을 HTML 테이블 형식으로 출력합니다.

게시글 삭제 (public/article/doDelete.php)

로그인 상태와 게시글의 작성자(회원) 여부를 확인한 후, 권한이 있는 경우 게시글을 삭제합니다. 삭제 후에는 JavaScript 경고창을 띄우고 게시글 목록 페이지로 리다이렉션합니다.

게시글 수정 (public/article/doModify.php)

로그인 및 권한 체크를 통해 본인이 작성한 게시글만 수정할 수 있도록 하며, 수정된 제목과 내용으로 데이터베이스의 해당 게시글 정보를 업데이트합니다.

게시글 작성 (public/article/doWrite.php & public/article/write.php)

게시글 작성 폼(public_article_write.php)에서 입력받은 제목과 내용을 이용해, 로그인한 회원의 정보(회원 ID, 닉네임)를 함께 데이터베이스에 저장합니다. 저장 후 새 게시글의 상세보기 페이지로 이동합니다.

게시글 목록 (public/article/list.php)

데이터베이스에 저장된 모든 게시글을 최신순(내림차순)으로 조회하여 목록을 출력하며, 각 게시글에는 상세보기와 삭제 링크가 포함됩니다.

회원 관련 기능 파일


회원 가입 (public/member/doJoin.php & public/member/join.php)

가입 폼(public/member/join.php)에서 입력받은 로그인 아이디, 비밀번호, 별명을 바탕으로 중복 여부를 체크한 후, 문제가 없으면 회원 정보를 member 테이블에 저장합니다.


로그인 (public/member/doLogin.php & public/member/login.php)

로그인 폼에서 입력한 정보로 회원 정보를 조회하고, 일치하는 회원이 있으면 세션에 회원 정보를 저장하여 로그인 상태를 유지합니다.


로그아웃 (public/member/doLogout.php)

현재의 세션을 파괴하여 로그아웃 처리를 하고, 로그인 페이지로 이동시킵니다.


공통 레이아웃 및 초기화


레이아웃 (public/part/head.php & public/part/foot.php)

public/part/head.php는 HTML 헤더 부분으로, CSS, jQuery, 공통 JavaScript 파일을 포함하며 로그인 상태에 따라 메뉴(로그인/회원가입 또는 로그아웃/글쓰기)를 동적으로 보여줍니다.

public/part/foot.php는 HTML의 닫는 태그 등을 포함하여 페이지 마무리를 담당합니다.

초기화 (web_init.php)

세션을 시작하고, 데이터베이스 연결 설정을 정의한 후 실제 MySQL 연결을 수행합니다. 또한, 공통 라이브러리인 lib.php를 포함하여 전체 프로젝트에서 필요한 함수들을 사용할 수 있도록 초기화합니다.
