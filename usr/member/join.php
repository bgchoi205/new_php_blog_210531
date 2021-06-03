<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


?>

<?php

$pageTitle = "회원가입";

?>


<?php require_once __DIR__ . "/../head.php"; ?>
  <div>
    <span><a href="../article/list.php">리스트</a></span>&ensp;
    <span><a href="login.php">로그인</a></span>
  </div>
  <hr>

  <form action="doJoin.php">
    <div>
      <span>사용할 아이디 입력</span><br>
      <input required placeholder="아이디 입력" type="text" name="loginId" id="loginId">
      <input type="button" id="btn_check_id" value="중복확인">
      <span class="double_result">(아이디는 영문,숫자)</span>
      <script type="text/javascript">
      $(document).ready(function(){
        $("#btn_check_id").click(function(){
          $.ajax({
            url : 'join_double.php?loginId='+$(#loginId).val(),
            type:'post',
            dataType:'text',
            success:function(data){
              $(.double_result).html(data);
            },
            error:function(xhr,textStatus,errorThrown){
              $('.double_result').html('ERROR');
            }

          });

        });
      
      });

      </script>
    </div>
    <div>
      <span>사용할 비밀번호 입력</span><br>
      <input required placeholder="비밀번호 입력" type="password" name="loginPw">
    </div>
    <div>
      <span>이름 입력</span><br>
      <input required placeholder="이름 입력" type="text" name="name">
    </div>
    <div>
      <span>닉네임 입력</span><br>
      <input required placeholder="닉네임 입력" type="text" name="nickName">
    </div>
    <div>
      <span>이메일 입력</span><br>
      <input required placeholder="이메일 입력" type="text" name="email">
    </div>
    <div>
      <input type="submit" value="가입하기">
    </div>
  </form>

<?php require_once __DIR__ . "/../foot.php"; ?>