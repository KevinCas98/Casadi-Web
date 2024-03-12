<?php require "../config/commons.class.php"; ?>
<?php 
    header('Access-Control-Allow-Origin: *'); 
    header('Content-type: application/json');
?>
<?php require "../src/api/$folderPath/$filePath[0].php" ?>