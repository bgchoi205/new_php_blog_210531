<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

if( !isset( $_GET['body'] ) ) {
  jsHistoryBackExit("내용을 입력해주세요.");
}

$id = intval($_GET['id']);
$body = $_GET['body'];

$sqlReply = "
SELECT *
FROM reply
WHERE id = '$id'
";

$rsReply = mysqli_query($dbConn, $sqlReply);

$reply = mysqli_fetch_assoc($rsReply);

$memberId = $_SESSION['loginedMemberId'];

if($reply['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

$sql = "
UPDATE reply
SET updateDate = NOW(),
`body` = '$body'
WHERE id = '$id'
";

mysqli_query($dbConn, $sql);


$url = "../article/detail.php?id=${reply['articleId']}";

$msg = "댓글수정 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "댓글 수정";

?>


