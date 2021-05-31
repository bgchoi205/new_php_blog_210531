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

$rs = mysqli_query($dbConn, $sql);

$article = mysqli_fetch_assoc($rs);

$memberId = $_SESSION['loginedMemberId'];

if($article['memberId'] != $memberId){
  jsHistoryBackExit("권한이 없습니다.");
}

?>

<?php

$pageTitle = "$id 번 게시물 수정";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <form action="doModify.php">
    <div>
      <input type="hidden" name="id" value="<?=$id?>">
    </div>
    <div>
      <span>제목 입력</span><br>
      <input required placeholder="제목 입력" type="text" name="title">
    </div>
    <div>
      <span>내용 입력</span><br>
      <textarea required placeholder="내용 입력" name="body"></textarea>
    </div>
    <div>
      <input type="submit" value="수정">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>