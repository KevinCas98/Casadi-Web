<?php
session_start();
require "db.php"; 

$requestUri="$_SERVER[REQUEST_URI]"; 
$filePath=explode("/", $requestUri);
$folderPath = $filePath[3];
$filePath=explode("?", $filePath[4]);


if($filePath[0][0]=="_"){
     require "../src/app/$folderPath/view/$filePath[0].php"; 
     die();
}

?>