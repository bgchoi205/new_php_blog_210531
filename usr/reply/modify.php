<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['id'] ) ) {
  jsHistoryBackExit("id를 입력해주세요.");
}

$id = intval($_GET['id']);

$sqlReply = "
SELECT *
FROM reply AS R
WHERE R.id = '$id'
";

$rsReply = mysqli_query($dbConn, $sqlReply);

$reply = mysqli_fetch_assoc($rsReply);

$memberId = $_SESSION['loginedMemberId'];

if($reply['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

?>

<?php

$pageTitle = "댓글 수정";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <span><a href="../article/list.php">리스트</a></span> &ensp;
  <span><a href="../article/detail.php?id=<?=$reply['articleId']?>">원문</a></span>
  <hr>
  <form action="doModify.php">
    <div>
      <input type="hidden" name="id" value="<?=$id?>">
    </div>
    <div>
      <span>수정할 내용</span><br>
      <textarea placeholder="수정할 댓글 내용 입력" name="body" value="<?=$reply['body']?>"></textarea>
    </div>
    <div>
      <input type="submit" value="수정">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>