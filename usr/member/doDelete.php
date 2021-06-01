<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

if( !isset( $_GET['loginId'] ) ) {
  jsHistoryBackExit("아이디를 입력해주세요.");
}

if( !isset( $_GET['loginPw'] ) ) {
  jsHistoryBackExit("비밀번호를 입력해주세요.");
}

$id = intval($_GET['id']);

$loginId = $_GET['loginId'];

$loginPw = $_GET['loginPw'];


$sql = "
SELECT *
FROM `member` AS M
WHERE M.id = '$id'
AND M.loginId = '$loginId'
AND M.loginPw = '$loginPw'
";



$member = DB__getRow($sql);

if( empty($member) ){
  jsHistoryBackExit("아이디 혹은 비밀번호가 틀립니다. 다시 확인해주세요.");
}

$sqlDel = "
UPDATE `member`
SET delStatus = '1'
WHERE id = '$id'
";

mysqli_query($dbConn, $sqlDel);

session_unset();

$url = "../article/list.php";

$msg = "탈퇴 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "회원탈퇴";

?>


