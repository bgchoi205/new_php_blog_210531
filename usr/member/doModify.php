<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
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

$id = intval($_GET['id']);
$loginPw = $_GET['loginPw'];
$name = $_GET['name'];
$nickName = $_GET['nickName'];
$email = $_GET['email'];



$sql = "
UPDATE `member`
SET updateDate = NOW(),
loginPw = '$loginPw',
`name` = '$name',
nickName = '$nickName',
email = '$email'
WHERE id = $id
";

mysqli_query($dbConn, $sql);



$url = "../member/info.php?memberId=$id";

$msg = "정보수정 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "회원정보 수정";

?>


