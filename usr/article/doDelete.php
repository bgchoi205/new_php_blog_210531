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
DELETE FROM article
WHERE id = '$id'
";

mysqli_query($dbConn, $sql);

$url = "list.php";

$msg = "${id} 번 게시물 삭제 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "게시물 삭제";

?>


