<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['articleId'] ) ) {
  jsHistoryBackExit("articleId를 입력해주세요.");
}

if( !isset( $_GET['memberId'] ) ) {
  jsHistoryBackExit("memberId를 입력해주세요.");
}

if( !isset( $_GET['body'] ) ) {
  jsHistoryBackExit("내용을 입력해주세요.");
}

$articleId = intval($_GET['articleId']);
$memberId = intval($_GET['memberId']);
$body = $_GET['body'];

$sql = DB__secSql();
$sql->add("INSERT INTO reply");
$sql->add("SET regDate = NOW()");
$sql->add(",updateDate = NOW()");
$sql->add(",articleId = ?", $articleId);
$sql->add(",memberId = ?", $memberId);
$sql->add(",`body` = ?", $body);

DB__execute($sql);


$url = "../article/detail.php?id=${articleId}";

$msg = "댓글등록 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "댓글 등록";

?>


