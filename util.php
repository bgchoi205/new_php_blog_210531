<?php

class DB__SecSql{
  private string $templateStr = ""; # 초기화
  private array $params = [];

  public function __toString(): string{
    
  }

  public function add(string $sqlBit, string $param = null){
    $this -> templateStr .= " " . $sqlBit;

    if($param){
      $this->params[] = $param;
    }
  }

  public function getTemplate() : string{
    return $this -> templateStr;
  }

  public function getForBindParam1stArg() : string{
    $paramTypesStr = "";

    $count = count($this -> params);

    for($i = 0; $i < $count; $i++){
      $paramTypesStr .= "s";
    }

    return $paramTypesStr;
  }

  public function getParams() : array {
    return $this->params;
  }

}

function DB__secSql(){
  // $stmt = $dbConn->prepare($sql);
  // $stmt -> bind_param("ss", $loginId, $loginPw);
  // $stmt -> execute();
  // $rs = $stmt->get_result();

  return new DB__SecSql();
}

function DB__getRow2(DB__SecSql $sql){
  global $dbConn;
  $stmt = $dbConn->prepare($sql->getTemplate());
  $stmt->bind_param($sql -> getForBindParam1stArg(), ...$sql->getParams()); # getForBindParam() 으로 "ss"처럼 타입, 그리고 몇개 들어갈지 구하기
  $stmt->execute();
  $rs = $stmt->get_result();
  
  return $rs->fetch_assoc();;
}


function DB__getRow($sql){
  global $dbConn;

  $rs = mysqli_query($dbConn, $sql);
  $row = mysqli_fetch_assoc($rs);

  return $row;
}

function DB__getRows($sql){
  global $dbConn;

  $rs = mysqli_query($dbConn, $sql);
  $rows = [];

  while($row = mysqli_fetch_assoc($rs)){
    $rows[] = $row;
  }

  return $rows;
}

function jsAlert($msg){
  echo "<script>";
  echo "alert('${msg}');";
  echo "</script>";
}

function jsLocationReplaceExit($url, $msg = null){
  if($msg){
    jsAlert($msg);
  }

  echo "<script>";
  echo "location.replace('${url}')";
  echo "</script>";
  exit;
}


function jsHistoryBackExit($msg = null){
  if($msg){
    jsAlert($msg);
  }

  echo "<script>";
  echo "history.back();";
  echo "</script>";
  exit;
}


// $query = $dbConnect->prepare('insert into parktable (total,big,mid,small,date) values (?, ?, ?, ?, ?)'); 
// $query->bind_param('iiiis', $total, $big, $md, $sm, $today); 
// $query->execute();
