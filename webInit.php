<?php

session_start();

require_once __DIR__ . "/util.php";

$dbConn = mysqli_connect("127.0.0.1", "sbsst", "sbs123414", "new_php_blog") or die("Error yo");