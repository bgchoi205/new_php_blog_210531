<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['loginId'] ) ) {
  jsHistoryBackExit("아이디를 입력해주세요.");
}

if( !isset( $_GET['loginPw'] ) ) {
  jsHistoryBackExit("비밀번호를 입력해주세요.");
}

$loginId = $_GET['loginId'];

$loginPw = $_GET['loginPw'];

$sql = "
SELECT *
FROM `member` AS M
WHERE M.loginId = '$loginId'
AND M.loginPw = '$loginPw'
";

$rs = mysqli_query($dbConn, $sql);

$member = mysqli_fetch_assoc($rs);

if( empty($member) ){
  jsHistoryBackExit("아이디 혹은 비밀번호가 틀립니다. 다시 확인해주세요.");
}

$_SESSION['loginedMemberId'] = $member['id'];

$url = "../article/list.php";

$msg = "${member['nickName']} 님 환영합니다.";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "로그인";

?>


