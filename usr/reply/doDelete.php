<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}


$id = intval($_GET['id']);

$sql = "
SELECT *
FROM reply AS R
WHERE R.id = '$id'
";

$reply = DB__getRow($sql);

$memberId = $_SESSION['loginedMemberId'];

if($reply['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

$url = "../article/detail.php?id=${reply['articleId']}";

$msg = "댓글 삭제 완료";

$sqlDel = "
DELETE FROM reply
WHERE id = '$id'
";

mysqli_query($dbConn, $sqlDel);



jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "댓글 삭제";

?>


