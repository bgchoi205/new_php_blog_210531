<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['memberId'] ) ) {
  jsHistoryBackExit("memberId를 입력해주세요.");
}

$memberId = intval($_GET['memberId']);

$sqlMember = DB__secSql();
$sqlMember->add("SELECT *");
$sqlMember->add("FROM `member` AS M");
$sqlMember->add("WHERE M.id = ?", $memberId);

$member = DB__getRow($sqlMember);

?>

<?php

$pageTitle = "회원정보 수정";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <form action="doModify.php">
    <div>
      <input type="hidden" name="id" value="<?=$memberId?>">
    </div>
    <div>
      <span>가입 : <?=$member['regDate']?></span><br>
    </div>
    <div>
      <span>수정 : <?=$member['updateDate']?></span><br>
    </div>
    <hr>
    <div>
      <span>아이디(수정불가)</span><br>
      <input readonly type="text" value="<?=$member['loginId']?>">
    </div>
    <div>
      <span>비밀번호</span><br>
      <input required placeholder="비밀번호 입력" type="password" name="loginPw" value="<?=$member['loginPw']?>">
    </div>
    <div>
      <span>이름</span><br>
      <input required placeholder="이름 입력" type="text" name="name" value="<?=$member['name']?>">
    </div>
    <div>
      <span>닉네임</span><br>
      <input required placeholder="닉네임 입력" type="text" name="nickName" value="<?=$member['nickName']?>">
    </div>
    <div>
      <span>이메일</span><br>
      <input required placeholder="이메일 입력" type="text" name="email" value="<?=$member['email']?>">
    </div>
    <div>
      <input type="submit" value="수정">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>