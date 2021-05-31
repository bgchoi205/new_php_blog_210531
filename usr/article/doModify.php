<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

if( !isset( $_GET['title'] ) ) {
  jsHistoryBackExit("제목을 입력해주세요.");
}

if( !isset( $_GET['body'] ) ) {
  jsHistoryBackExit("내용을 입력해주세요.");
}

$id = intval($_GET['id']);

$title = $_GET['title'];

$body = $_GET['body'];

$sql = "
UPDATE article
SET updateDate = NOW(),
title = '$title',
`body` = '$body'
WHERE id = '$id';
";

mysqli_query($dbConn, $sql);

$url = "detail.php?id=${id}";

$msg = "${id} 번 게시물 수정 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "게시물 수정";

?>


