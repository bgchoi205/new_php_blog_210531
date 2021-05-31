<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['boardId'] ) ) {
  jsHistoryBackExit("게시판번호를 입력해주세요.");
}


$boardId = intval($_GET['boardId']);

$sql = "
SELECT *
FROM article AS A
WHERE A.boardId = '$boardId'
ORDER BY A.id DESC
";

$rs = mysqli_query($dbConn, $sql);

$articles = [];

while($article = mysqli_fetch_assoc($rs)){
  $articles[] = $article;
}

$sqlBoard = "
SELECT *
FROM board AS B
WHERE B.id = '$boardId'
";

$rsBoard = mysqli_query($dbConn, $sqlBoard);

$board = mysqli_fetch_assoc($rsBoard);

?>

<?php

$pageTitle = "${board['name']} 게시판";

?>

<?php require_once __DIR__ . "/../head.php"; ?>
  <span><a href="list.php">리스트</a></span>
  <span><a href="write.php">글쓰기</a></span>
  <hr>

  <?php foreach($articles as $article) {?>

    <div>
      <a href="detail.php?id=<?=$article['id']?>">번호 : <?=$article['id']?></a>&ensp;
      등록 : <?=$article['regDate']?><br>
      게시판 : <?=$board['name']?><br>
      <a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?></a>
      <hr>
    </div>
  <?php }?>


  <?php require_once __DIR__ . "/../foot.php"; ?>