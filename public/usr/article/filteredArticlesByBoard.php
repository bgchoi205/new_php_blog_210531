<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

if( !isset( $_GET['boardId'] ) ) {
  jsHistoryBackExit("게시판번호를 입력해주세요.");
}


$boardId = intval($_GET['boardId']);


$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM article AS A");
$sql->add("WHERE A.boardId = ?", $boardId);
$sql->add("ORDER BY A.id DESC");

$articles = DB__getRows($sql);


$sqlBoardById = DB__secSql();
$sqlBoardById->add("SELECT *");
$sqlBoardById->add("FROM board AS B");
$sqlBoardById->add("WHERE B.id = ?", $boardId);

$boardById = DB__getRow($sqlBoardById);

$sqlBoard2 = DB__secSql();
$sqlBoard2->add("SELECT *");
$sqlBoard2->add("FROM board AS B");
$sqlBoard2->add("ORDER BY B.id DESC");

$boards = DB__getRows($sqlBoard2);


?>

<?php

$pageTitle = "${boardById['name']} 게시판";

?>

<?php require_once __DIR__ . "/../head.php"; ?>
  <span><a href="list.php">리스트</a></span>
  <span><a href="write.php">글쓰기</a></span>
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

    <div>
      <a href="detail.php?id=<?=$article['id']?>">번호 : <?=$article['id']?></a>&ensp;
      등록 : <?=$article['regDate']?><br>
      게시판 : <?=$boardById['name']?><br>
      <a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?></a>
      <hr>
    </div>
  <?php }?>


  <?php require_once __DIR__ . "/../foot.php"; ?>