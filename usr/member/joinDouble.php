<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$loginId = $_POST['loginId']; //get 또는 post받은 데이터

$sql="
SELECT * 
FROM `member` AS M 
WHERE M.loginId = '$loginId'
";

$result=mysqli_query($dbConn,$sql);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);

$returnStr="";
if($row['loginId']!=$loginId){
  $returnStr="사용할 수 있는 아이디입니다.";
}else{
  $returnStr="사용할 수 없는 아이디입니다.";
}
mysqli_free_result($result);
mysqli_close($dbConn);
echo $returnStr;


?>

<?php

$pageTitle = "아이디 중복 체크";

?>


