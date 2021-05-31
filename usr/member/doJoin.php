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

$sqlMember = "
SELECT *
FROM `member` AS M
WHERE M.loginId = '${loginId}'
";

$rsMember = mysqli_query($dbConn, $sqlMember);

$member = mysqli_fetch_assoc($rsMember);

if( !empty($member) ){
  jsHistoryBackExit("사용중인 아이디입니다.");
}

$sql = "
INSERT INTO `member`
SET regDate = NOW(),
updateDate = NOW(),
loginId = '$loginId',
loginPw = '$loginPw',
`name` = '$name',
nickName = '$nickName',
email = '$email'
";

mysqli_query($dbConn, $sql);



$url = "../article/list.php";

$msg = "회원가입 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "회원가입";

?>


