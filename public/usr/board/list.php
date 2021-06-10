<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$pageTitle = "게시판 리스트";


$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM board AS B");
$sql->add("ORDER BY B.id DESC");

$boards = DB__getRows($sql);

?>

<?php require_once __DIR__ . "/../head.php"; ?>

  <span><a href="../article/write.php">글쓰기</a></span>&ensp;
  <span><a href="../article/list.php">리스트</a></span>
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

  <?php foreach($boards as $board) {?>
    <div>
      <a href="../article/filteredArticlesByBoard.php?boardId=<?=$board['id']?>">번호 : <?=$board['id']?></a>&ensp;
      등록 : <?=$board['regDate']?><br>
      <a href="../article/filteredArticlesByBoard.php?boardId=<?=$board['id']?>"><?=$board['name']?></a>
      <hr>
    </div>
  <?php }?>


<?php require_once __DIR__ . "/../foot.php"; ?>