<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/collaborators/collaborators.class.php";

$collaborators = new Collaborators();
$show_alert = "";
$search=NULL;

if(isset($_SESSION["data_record"])){
    $dataSession = $_SESSION["data_record"];
    if($dataSession){
        $show_alert = 1;
    }else{
        $show_alert = 0;
    }
    unset($_SESSION["data_record"]);
}

if($_POST){

    $collaborators = new Collaborators();
    $common = new Commons();

    $name = $_POST["name"];
    $lastName = $_POST["last_name"];
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $institution = $_POST["institution"];
    $userName = $_POST["user_name"];
    $password = $_POST["password"];
    $rol = 2;

    $collaborators->setName($name);
    $collaborators->setLastName($lastName);
    $collaborators->setDni($dni);
    $collaborators->setEmail($email);
    $collaborators->setIdInstitution($institution);
    $collaborators->setUserName($userName);
    $collaborators->setPassword($password);
    $collaborators->setIdRol($rol);
    
    if(isset($_POST['id_collaborators']) && $_POST['id_collaborators']!=0 ){
        
        $id = $_POST["id_collaborators"];
    
        $collaborators->setId($id);
        $collaborators->updateCollaborators();

    }else{
        $collaborators->saveCollaborators();
    }

    header("Location: ../collaborators/list");
}
$collaborators->countCollaborators();

if(empty($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$totalPages = $collaborators->getTotalPages(15);

if(isset($_GET['send'])){
    $search = $_GET['search'];
}
?>