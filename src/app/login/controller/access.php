<?php 
require "../src/model/collaborators/collaborators.class.php";

$errorLogin = false;

if($_POST){

    $userName = $_POST["username"];
    $password = $_POST["password"];

    $collaborator = new Collaborators();
    $loginCollaborator = $collaborator->getCollaboratorByUserAndPass($userName, $password);

    if($loginCollaborator){
        $_SESSION["user_id"]        = $collaborator->getId();
        $_SESSION["name_user"]      = $collaborator->getName()." ".$collaborator->getLastName();
        $_SESSION["institution_id"] = $collaborator->getIdInstitution();
        $_SESSION["rol"]            = $collaborator->getRol()->getCodeName();
        header("Location: ../home/dashboard");
    }else{
        $errorLogin = true;
    }

}
?>