<?php

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