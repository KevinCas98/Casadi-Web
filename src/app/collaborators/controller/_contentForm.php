<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/collaborators/collaborators.class.php";
require "../src/model/institution/institution.class.php";

$titleCollaborators = "ALTA";
$collaborators = new Collaborators();
$institution = new Institution();

$listInstitution = $institution->getAllInstitution();

if($_GET){
    $titleCollaborators = "EDITAR";
    $id_collaborators = $_GET["id"];
    $collaborators->getCollaboratorsById($id_collaborators);
}

?>