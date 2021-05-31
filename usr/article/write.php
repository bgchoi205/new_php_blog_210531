<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

$memberId = $_SESSION['loginedMemberId'];

$sqlBoard2 = "
SELECT *
FROM board AS B
ORDER BY B.id DESC
";

$rsBoard2 = mysqli_query($dbConn, $sqlBoard2);

$boards = [];

while($board2 = mysqli_fetch_assoc($rsBoard2)){
  $boards[] = $board2;
}

?>

<?php

$pageTitle = "게시물 작성하기";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <form action="doWrite.php">
    <div>
      <input required type="hidden" name="memberId" value="<?=$memberId?>">
    </div>
    <div>
      <span>게시판 선택</span><br>
      <select name="boardId">
        <?php foreach($boards as $board) {?>
          <option value="<?=$board['id']?>">
            <?=$board['id']?>.<?=$board['name']?>
          </option>
        <?php }?>
      </select>
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
      <input type="submit" value="작성">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>