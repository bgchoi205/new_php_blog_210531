<?php

class DB__SecSql{
  private string $templateStr = ""; # 초기화
  private array $params = [];

  public function __toString(): string
  {
    $str = '[';
    $str .= 'SQL=(' . $this->getTemplate() . ')';
    $str .= ', PARAMS=(' . implode(',', $this->getParams()) . ')';
    $str .= ']';
    
    return $str;
  }

  public function add(string $sqlBit, string $param = null){
    $this -> templateStr .= " " . $sqlBit;

    if($param){
      $this->params[] = $param;
    }
  }

  public function getTemplate() : string{
    return trim($this -> templateStr);
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

  public function getParamsCount(): int {
    return count($this->params);
  }

}

function DB__secSql(){
  return new DB__SecSql();
}

function DB__getStmtFromSecSql(DB__SecSql $sql): mysqli_stmt {
  global $dbConn;
  $stmt = $dbConn->prepare($sql->getTemplate());
  if( $sql->getParamsCount() ){
    $stmt->bind_param($sql -> getForBindParam1stArg(), ...$sql->getParams()); # getForBindParam() 으로 "ss"처럼 타입, 그리고 몇개 들어갈지 구하기
  }
  
  return $stmt;
}

function DB__getRow(DB__SecSql $sql){
  $stmt = DB__getStmtFromSecSql($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  
  return $result->fetch_assoc();
}

function DB__getRows(DB__SecSql $sql){
  $stmt = DB__getStmtFromSecSql($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $rows = [];

  while($row = $result->fetch_assoc()){
    $rows[] = $row;
  }

  return $rows;
}

function DB__execute(DB__SecSql $sql){
  global $dbConn;
  $stmt = DB__getStmtFromSecSql($sql);
  $stmt->execute();
}

function DB__insert(DB__SecSql $sql){
  global $dbConn;
  DB__execute($sql);
  return mysqli_insert_id($dbConn);
}

function DB__update(DB__SecSql $sql){
  DB__execute($sql);
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
