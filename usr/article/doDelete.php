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
FROM article AS A
WHERE A.id = '$id'
";

$article = DB__getRow($sql);

$memberId = $_SESSION['loginedMemberId'];

if($article['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

$sqlDel = "
DELETE FROM article
WHERE id = '$id'
";

mysqli_query($dbConn, $sqlDel);

$url = "list.php";

$msg = "${id} 번 게시물 삭제 완료";

jsLocationReplaceExit($url, $msg);

?>

<?php

$pageTitle = "게시물 삭제";

?>


