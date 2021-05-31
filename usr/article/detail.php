<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

$id = intval($_GET['id']);

$sql = "
SELECT *
FROM article AS A
WHERE A.id = '$id'
";

$rs = mysqli_query($dbConn, $sql);

$article = mysqli_fetch_assoc($rs);

$sqlBoard = "
SELECT *
FROM board AS B
WHERE B.id = '${article['boardId']}'
";

$rsBoard = mysqli_query($dbConn, $sqlBoard);

$board = mysqli_fetch_assoc($rsBoard);

$sqlMember = "
SELECT *
FROM `member` AS M
WHERE M.id = '${article['memberId']}'
";

$rsMember = mysqli_query($dbConn, $sqlMember);

$member = mysqli_fetch_assoc($rsMember);


$sqlReply = "
SELECT *
FROM reply AS R
WHERE R.articleId = '${article['id']}'
ORDER BY R.id DESC
";

$rsReply = mysqli_query($dbConn, $sqlReply);

$replies = [];

while($reply = mysqli_fetch_assoc($rsReply)){
  $replies[] = $reply;
}

$loginedMemberId = $_SESSION['loginedMemberId'];

$sqlLogined = "
SELECT *
FROM `member` AS M
WHERE M.id = '$loginedMemberId'
";

$rsLogined = mysqli_query($dbConn, $sqlLogined);

$loginedMember = mysqli_fetch_assoc($rsLogined);


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
  <div>
    <span>댓글쓰기</span><br>
    <form action="../reply/doWrite.php">
      <input type="hidden" name="articleId" value="<?=$article['id']?>">
      <input type="hidden" name="memberId" value="<?=$loginedMember['id']?>">
      <textarea placeholder="댓글을 써주세요." name="body"></textarea>
      <input type="submit" value="등록">
    </form>
  </div>
  <h2>댓글 목록</h2>
  <hr>
  <?php foreach($replies as $reply) {?>
    <?php
      $sqlWriter = "
      SELECT *
      FROM `member` AS M
      WHERE M.id = ${reply['memberId']}
      ";

      $rsWriter = mysqli_query($dbConn, $sqlWriter);

      $writer = mysqli_fetch_assoc($rsWriter);
    ?>
    <span class="replyWriter"><?=$writer['nickName']?></span> &ensp;
    <?=$reply['regDate']?><br>
    <br>
    <?=$reply['body']?>
    <hr>
  <?php }?>  


<?php require_once __DIR__ . "/../foot.php"; ?>