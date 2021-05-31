<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if( !isset($_SESSION['loginedMemberId']) ){
  jsHistoryBackExit("로그인 후 이용해주세요.");
}

if( !isset( $_GET['memberId'] ) ) {
  jsHistoryBackExit("memberId를 입력해주세요.");
}

$memberId = intval($_GET['memberId']);

$sqlMember = "
SELECT *
FROM `member` AS M
WHERE M.id = '$memberId'
";

$rsMember = mysqli_query($dbConn, $sqlMember);

$member = mysqli_fetch_assoc($rsMember);

?>

<?php

$pageTitle = "회원정보";

?>


<?php require_once __DIR__ . "/../head.php"; ?>

  <span><a href="../article/list.php">리스트</a></span>
  <hr>

  <table>
    <tr>
      <td>아이디</td>
      <td><?=$member['loginId']?></td>
    </tr>
    <tr>
      <td>가입</td>
      <td><?=$member['regDate']?></td>
    </tr>
    <tr>
      <td>수정</td>
      <td><?=$member['updateDate']?></td>
    </tr>
  </table>

  <div>
    아이디 : <?=$member['loginId']?><br>
    등록 : <?=$member['regDate']?><br>
    수정 : <?=$member['updateDate']?><br>
    이름 : <?=$member['name']?><br>
    닉네임 : <?=$member['nickName']?><br>
    이메일 : <?=$member['email']?>
  </div>
  <hr>
  <span><a href="modify.php?memberId=<?=$member['id']?>">정보수정</a></span>


<?php require_once __DIR__ . "/../foot.php"; ?>