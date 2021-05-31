<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

session_unset();

$url = "../article/list.php";

$msg = "로그아웃";

jsLocationReplaceExit($url, $msg);

?>