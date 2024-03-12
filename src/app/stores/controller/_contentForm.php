<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";
require "../src/model/contacts/contacts.class.php";

$titleStore = "ALTA";
$store = new Stores();

$categories = new Categories();
$listCategories = $categories->getAllCategories();

$benefit = new Benefits();
$contact = new Contacts();

if($_GET){
    $titleStore = "EDITAR";
    $id_store = $_GET["id"];
    $store->getStoresById($id_store);
    $benefit->getBenefitsByStoresId($id_store);
    $contact->getContactByStoresId($id_store);
}


?>