<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

if( !isset( $_GET['loginId'] ) ) {
  jsHistoryBackExit("아이디를 입력해주세요.");
}

if( !isset( $_GET['loginPw'] ) ) {
  jsHistoryBackExit("비밀번호를 입력해주세요.");
}

$loginId = $_GET['loginId'];
$loginPw = $_GET['loginPw'];

// $sql = "
// SELECT *
// FROM `member` AS M
// WHERE M.loginId = ?
// AND M.loginPw = ?
// ";

// $stmt = $dbConn->prepare($sql);
// $stmt -> bind_param("ss", $loginId, $loginPw);
// $stmt -> execute();
// $rs = $stmt->get_result();
// $member = $rs->fetch_assoc();
// print_r($member);
// exit;

$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM `member` AS M");
$sql->add("WHERE M.loginId = ?", $loginId);
$sql->add("AND M.loginPw = ?", $loginPw);

$member = DB__getRow($sql);

if( empty($member) ){
  jsHistoryBackExit("아이디 혹은 비밀번호가 틀립니다. 다시 확인해주세요.");
}

if( $member['delStatus'] == 1 ){
  jsHistoryBackExit("탈퇴한 회원입니다.");
}

$_SESSION['loginedMemberId'] = $member['id'];

$url = "../article/list.php";

$msg = "${member['nickName']} 님 환영합니다.";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "로그인";

?>


