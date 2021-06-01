<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

$memberId = $_SESSION['loginedMemberId'];

$sql = "
SELECT *
FROM `member` AS M
WHERE M.id = '$memberId'
";


$member = DB__getRow($sql);

?>

<?php

$pageTitle = "회원탈퇴";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <div>
    <span><a href="../article/list.php">리스트</a></span>
  </div>
  <hr>
  <form action="doDelete.php">
    <div>
      <input type="hidden" name="id" value="<?=$memberId?>">
    </div>
    <div>
      <span>아이디</span><br>
      <input readonly required placeholder="아이디 입력" type="text" name="loginId" value="<?=$member['loginId']?>">
    </div>
    <div>
      <span>비밀번호</span><br>
      <input required placeholder="비밀번호 입력" type="password" name="loginPw">
    </div>
    <div>
      <input type="submit" value="탈퇴하기">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>