<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

$id = intval($_GET['id']);

$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM article AS A");
$sql->add("WHERE A.id = ?", $id);

$article = DB__getRow($sql);


$sqlBoard = DB__secSql();
$sqlBoard->add("SELECT *");
$sqlBoard->add("FROM board AS B");
$sqlBoard->add("WHERE B.id = ?", $article['boardId']);

$board = DB__getRow($sqlBoard);


$sqlMember = DB__secSql();
$sqlMember->add("SELECT *");
$sqlMember->add("FROM `member` AS M");
$sqlMember->add("WHERE M.id = ?", $article['memberId']);

$member = DB__getRow($sqlMember);


$sqlReplies = DB__secSql();
$sqlReplies->add("SELECT *");
$sqlReplies->add("FROM reply AS R");
$sqlReplies->add("WHERE R.articleId = ?", $article['id']);
$sqlReplies->add("ORDER BY R.id DESC");

$replies = DB__getRows($sqlReplies);

if( !isset($_SESSION['loginedMemberId']) ){
  $_SESSION['loginedMemberId'] = null;
}

$loginedMemberId = $_SESSION['loginedMemberId'];


// $sqlLogined = DB__secSql();
// $sqlLogined->add("SELECT *");
// $sqlLogined->add("FROM `member` AS M");
// $sqlLogined->add("WHERE M.id = ?", $loginedMemberId);

// $loginedMember = DB__getRow($sqlLogined);


$sqlIncreaseHit = DB__secSql();
$sqlIncreaseHit->add("UPDATE article");
$sqlIncreaseHit->add("SET hit = hit + 1");
$sqlIncreaseHit->add("WHERE id = ?", $id);

DB__update($sqlIncreaseHit);

?>

<?php

$pageTitle = "게시물 상세, $id 번 게시물";

?>


<?php require_once __DIR__ . "/../head.php"; ?>
  <section>
    <a href="list.php">리스트</a>&ensp;
    <a onclick="if( confirm('정말 삭제하시겠습니까?') == false )return false;" href="doDelete.php?id=<?=$id?>">삭제</a>&ensp;
    <a href="modify.php?id=<?=$id?>">수정</a>
  </section>
  <hr>
  <div>

    <table>
      <tr>
        <td>제목 : </td>
        <td>제목입니다</td>
        <td>&ensp;</td>
        <td>작성자 : </td>
        <td>작성자명</td>
      </tr>
      <tr>
        <td>테스트3</td>
        <td>테스트4</td>
      </tr>
      <tr>
        <td>테스트3</td>
        <td>테스트4</td>
      </tr>
    </table>
    번호 : <?=$article['id']?><br>
    등록 : <?=$article['regDate']?><br>
    수정 : <?=$article['updateDate']?><br>
    게시판 : <?=$board['name']?><br>
    작성자 : <?=$member['nickName']?><br>
    제목 : <?=$article['title']?><br>
    내용 : <?=$article['body']?>
  </div>
  <hr>
  <span><i class="far fa-heart heart-icon"></i>좋아요</span>&ensp;&ensp;
  <span>조회수 : <?=$article['hit']?></span>
  <hr>
  <div>
    <span>댓글쓰기</span><br>
    <form action="../reply/doWrite.php">
      <input type="hidden" name="articleId" value="<?=$article['id']?>">
      <input type="hidden" name="memberId" value="<?=$loginedMemberid?>">
      <textarea placeholder="댓글을 써주세요." name="body"></textarea>
      <input type="submit" value="등록">
    </form>
  </div>
  <h2>댓글 목록</h2>
  <hr>
  <?php foreach($replies as $reply) {?>
    <?php
      $sqlWriter = DB__secSql();
      $sqlWriter->add("SELECT *");
      $sqlWriter->add("FROM `member` AS M");
      $sqlWriter->add("WHERE M.id = ?", $reply['memberId']);

      $writer = DB__getRow($sqlWriter);
    ?>
    <span class="replyWriter"><?=$writer['nickName']?></span> &ensp;
    <?=$reply['regDate']?> &ensp;
    <span><a href="../reply/doDelete.php?id=<?=$reply['id']?>">삭제</a></span> &ensp;
    <span><a href="../reply/modify.php?id=<?=$reply['id']?>">수정</a></span>
    <br>
    <br>
    <?=$reply['body']?>
    <hr>
  <?php }?>  


<?php require_once __DIR__ . "/../foot.php"; ?>