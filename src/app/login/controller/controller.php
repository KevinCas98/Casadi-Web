<?php 
if(empty($_SESSION["user_id"])){
    header("Location: ../login/access");
    die();
}
?>