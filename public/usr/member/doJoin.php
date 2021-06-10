<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['loginId'] ) ) {
  jsHistoryBackExit("아이디를 입력해주세요.");
}

if( !isset( $_GET['loginPw'] ) ) {
  jsHistoryBackExit("비밀번호를 입력해주세요.");
}

if( !isset( $_GET['name'] ) ) {
  jsHistoryBackExit("이름을 입력해주세요.");
}

if( !isset( $_GET['nickName'] ) ) {
  jsHistoryBackExit("닉네임을 입력해주세요.");
}

if( !isset( $_GET['email'] ) ) {
  jsHistoryBackExit("이메일을 입력해주세요.");
}

$loginId = $_GET['loginId'];
$loginPw = $_GET['loginPw'];
$name = $_GET['name'];
$nickName = $_GET['nickName'];
$email = $_GET['email'];


$sqlMember = DB__secSql();
$sqlMember->add("SELECT *");
$sqlMember->add("FROM `member` AS M");
$sqlMember->add("WHERE M.loginId = ?", $loginId);

$member = DB__getRow($sqlMember);

if( !empty($member) ){
  jsHistoryBackExit("사용중인 아이디입니다.");
}


$sqlMemberByNameEmail = DB__secSql();
$sqlMemberByNameEmail->add("SELECT *");
$sqlMemberByNameEmail->add("FROM `member` AS M");
$sqlMemberByNameEmail->add("WHERE M.name = ?", $name);
$sqlMemberByNameEmail->add("AND M.email = ?", $email);

$memberByNameEmail = DB__getRow($sqlMemberByNameEmail);

if( !empty($memberByNameEmail) ){
  jsHistoryBackExit("이미 등록된 회원입니다.");
}



$sql = DB__secSql();
$sql->add("INSERT INTO `member`");
$sql->add("SET regDate = NOW()");
$sql->add(",updateDate = NOW()");
$sql->add(",loginId = ?", $loginId);
$sql->add(",loginPw = ?", $loginPw);
$sql->add(",`name` = ?", $name);
$sql->add(",nickName = ?", $nickName);
$sql->add(",email = ?", $email);

DB__execute($sql);



$url = "../article/list.php";

$msg = "회원가입 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "회원가입";

?>


