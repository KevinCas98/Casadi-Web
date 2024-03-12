<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/contacts/contacts.class.php";
require "../src/model/stores/stores.class.php";

$contact = new contacts();

if ($_GET) {
    $id_store = $_GET["id"];
    
    $contact->getContactByStoresId($id_store);
}
?>