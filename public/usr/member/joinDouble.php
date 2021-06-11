<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

if( !isset( $_GET['loginId'] ) ) {
  jsHistoryBackExit("아이디를 입력해주세요.");
}

$loginId = $_GET['loginId']; //get 또는 post받은 데이터


$sql = DB__secSql();
$sql->add("SELECT *");
$sql->add("FROM `member` AS M");
$sql->add("WHERE M.loginId = ?" ,$loginId);

$member=DB__getRow($sql);

$returnStr="";

if($member == null){
  $returnStr="사용할 수 있는 아이디입니다.";
}
else{
  $returnStr="사용할 수 없는 아이디입니다.";
}
// mysqli_free_result($result);
// mysqli_close($dbConn);
echo $returnStr;


?>

<?php

$pageTitle = "아이디 중복 체크";

?>


