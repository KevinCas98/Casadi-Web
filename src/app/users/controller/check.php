<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/users/users.class.php";
require "../src/model/vaccines/vaccines.class.php";
require "../src/model/dose/dose.class.php";
require "../src/model/files/files.class.php";


$dose = new Dose();
$arrayFilesByUser = [];

function goToList(){
    header("Location: ../users/list");
    die();
}

if($_GET){
    if(isset($_GET["id_user"])){
        $userId = $_GET["id_user"];
        $users = new Users();
        $users->getUsersById($userId);
        $files = new Files();
        $arrayFilesByUser = $files->getFilesByUserId($users->getId());

    }else{
        goToList();
    }
}else{
    goToList();
}


?>