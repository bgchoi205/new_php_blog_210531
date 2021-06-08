<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$pageTitle?></title>
  <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
  <link rel="stylesheet" href="/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="top-bar con">
    <div class="pageTitle">
      <?=$pageTitle?>
    </div>
  </div>
  <hr>
  
  <?php if( isset($_SESSION['loginedMemberId']) ){ ?>
    <?php
      $memberId = $_SESSION['loginedMemberId'];
    ?>
    <span><a onclick="if( confirm('로그아웃 하시겠습니까?') == false )return false;" href="../member/doLogout.php">로그아웃</a></span>&ensp;
    <span><a href="../member/info.php?memberId=<?=$memberId?>">회원정보</a></span>
    <hr>
  <?php }?>

  <?php if( !isset($_SESSION['loginedMemberId']) ){ ?>
    <a href="../member/login.php">로그인</a>&ensp;
    <a href="../member/join.php">회원가입</a>
    <hr>
  <?php }?>
  
  