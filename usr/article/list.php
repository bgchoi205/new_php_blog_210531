<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$sql = "
SELECT *
FROM article AS A
ORDER BY A.id DESC
";

$articles = DB__getRows($sql);


$sqlBoard2 = "
SELECT *
FROM board AS B
ORDER BY B.id DESC
";

$boards = DB__getRows($sqlBoard2);

?>

<?php
$pageTitle = "전체 게시물 리스트";
?>

<?php require_once __DIR__ . "/../head.php"; ?>

  <span><a href="write.php">글쓰기</a></span> &ensp;
  <span><a href="../board/list.php">전체 게시판 목록</a></span>
  <hr>
  <form action="../article/filteredArticlesByBoard.php">
    <span>게시판 목록 : </span>
    <select name="boardId">
      <?php foreach($boards as $board) {?>
        <option value="<?=$board['id']?>">
          <?=$board['id']?>.<?=$board['name']?>
        </option>
      <?php }?>
    </select>
    <input type="submit" value="이동">
  </form>
  <hr>

  <?php foreach($articles as $article) {?>

    <?php
    
      $sqlBoard = "
      SELECT *
      FROM board AS B
      WHERE B.id = '${article['boardId']}'
      ";

      $board = DB__getRow($sqlBoard);
      
    ?>

    <div>
      <a href="detail.php?id=<?=$article['id']?>">번호 : <?=$article['id']?></a>&ensp;
      등록 : <?=$article['regDate']?><br>
      게시판 : <?=$board['name']?><br>
      <a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?></a>
      <hr>
    </div>
  <?php }?>


  <?php require_once __DIR__ . "/../foot.php"; ?>