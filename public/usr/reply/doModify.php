<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

if( !isset( $_GET['body'] ) ) {
  jsHistoryBackExit("내용을 입력해주세요.");
}

$id = intval($_GET['id']);
$body = $_GET['body'];

$sqlReply = DB__secSql();
$sqlReply->add("SELECT *");
$sqlReply->add("FROM reply AS R");
$sqlReply->add("WHERE R.id = ?", $id);

$reply = DB__getRow($sqlReply);

$memberId = $_SESSION['loginedMemberId'];

if($reply['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

$sql = DB__secSql();
$sql->add("UPDATE reply");
$sql->add("SET updateDate = NOW()");
$sql->add(",`body` = ?", $body);
$sql->add("WHERE id = ?", $id);

DB__execute($sql);


$url = "../article/detail.php?id=${reply['articleId']}";

$msg = "댓글수정 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "댓글 수정";

?>


