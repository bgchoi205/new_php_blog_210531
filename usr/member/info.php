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

$pageTitle = "회원정보";

?>


<?php require_once __DIR__ . "/../head.php"; ?>
  <span><a href="../member/delete.php">회원탈퇴</a></span>
  <hr>
  <span><a href="../article/list.php">리스트</a></span>
  <hr>

  <table>
    <tr>
      <th>아이디</th>
      <td><?=$member['loginId']?></td>
    </tr>
    <tr>
      <th>가입</th>
      <td><?=$member['regDate']?></td>
    </tr>
    <tr>
      <th>수정</th>
      <td><?=$member['updateDate']?></td>
    </tr>
    <tr>
      <th>이름</th>
      <td><?=$member['name']?></td>
    </tr>
    <tr>
      <th>닉네임</th>
      <td><?=$member['nickName']?></td>
    </tr>
    <tr>
      <th>이메일</th>
      <td><?=$member['email']?></td>
    </tr>
  </table>

  <hr>
  <span><a href="modify.php?memberId=<?=$member['id']?>">정보수정</a></span>


<?php require_once __DIR__ . "/../foot.php"; ?>