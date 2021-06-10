<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}


$id = intval($_GET['id']);

$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM article AS A");
$sql->add("WHERE A.id = ?", $id);

$article = DB__getRow($sql);

$memberId = $_SESSION['loginedMemberId'];

if($article['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}


$sqlDel = DB__secSql();
$sqlDel->add("DELETE FROM article");
$sqlDel->add("WHERE id = ?", $id);

DB__execute($sqlDel);

$url = "list.php";

$msg = "${id} 번 게시물 삭제 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "게시물 삭제";

?>


