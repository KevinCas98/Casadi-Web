<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";
require "../src/model/contacts/contacts.class.php";

$stores = new Stores();
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

    $benefit = new Benefits();
    $contact = new Contacts();
    $common = new Commons();

    $name = $_POST["name"];
    $cuit = $_POST["cuit"];
    $address = $_POST["address"];
    $categoryId = $_POST["category"];
    $image1 = $_POST["imagen1_hidden"];
    $image2 = $_POST["imagen2_hidden"];
    $web = $_POST["web"];
    $instagram = $_POST["instagram"];
    $whatsapp = $_POST["whatsapp"];
    $phone = $_POST["phone"];

    $benefitName = $_POST["benefit_name"];
    $benefitConditions = $_POST["benefit_conditions"];
    $benefitPin = $_POST["benefit_pin"];

    $contactName = $_POST["contact_name"];
    $contactLastName = $_POST["contact_last_name"];
    $contactCellphone = $_POST["contact_cellphone"];
    $contactEmail = $_POST["email"];


    $stores->setName($name);
    $stores->setCuit($cuit);
    $stores->setAddress($address);
    $stores->setIdCategory($categoryId);
    $stores->setCreatedBy($_SESSION["user_id"]);
    $stores->setCreatedAt(date("Y-m-d H:i:s"));
    $stores->setImage1($image1);
    $stores->setImage2($image2);
    $stores->setWeb($web);
    $stores->setInstagram($instagram);
    $stores->setWhatsapp($whatsapp);
    $stores->setPhone($phone);

    $benefit->setName($benefitName);
    $benefit->setConditions($benefitConditions);
    
    
    $contact->setName($contactName);
    $contact->setLastName($contactLastName);
    $contact->setCellPhone($contactCellphone);
    $contact->setEmail($contactEmail);
    
    
    if(isset($_POST['id_store']) && $_POST['id_store']!=0 ){
        
        $id = $_POST["id_store"];
        $id_benefit = $_POST["id_benefit"];
        $id_contact = $_POST["id_contact"];

        $stores->setId($id);
        $stores->setUpdatedBy($_SESSION["user_id"]);
        $stores->setUpdatedAt(date("Y-m-d H:i:s"));
        $stores->updateStores();

        $benefit->setIdStore($stores->getId());
        $benefit->setId($id_benefit);
        $benefit->setUpdatedBy($_SESSION["user_id"]);
        $benefit->setUpdatedAt(date("Y-m-d H:i:s"));
        $benefit->setPin($benefitPin);
        $benefit->updateBenefits();

        $contact->setIdStore($stores->getId());
        $contact->setId($id_contact);
        $contact->updateContacts();

    }else{
        $stores->saveStores();

        $benefit->setIdStore($stores->getId());
        $benefit->setPin(rand(1000,9999));

        $benefit->setCreatedBy($_SESSION["user_id"]);
        $benefit->setCreatedAt(date("Y-m-d H:i:s"));
        $benefit->saveBenefits();

        $contact->setIdStore($stores->getId());
        $contact->saveContacts();
    }

   if($stores->getId()!= 0 && $benefit->getId()!=0 && $contact->getId()!= 0 ){
        if($_FILES){
            if($_FILES['image1']['tmp_name']!=NULL){
                $fileTmpPath = $_FILES['image1']['tmp_name'];
                $fileName = $_FILES['image1']['name'];
                $stores->setImage1($fileName);
                $common->uploadFile($fileTmpPath, $fileName, $stores->getId(), "stores");       
            }
            if($_FILES['image2']['tmp_name']!=NULL){
                $fileTmpPath = $_FILES['image2']['tmp_name'];
                $fileName = $_FILES['image2']['name'];
                $stores->setImage2($fileName);
                $common->uploadFile($fileTmpPath, $fileName, $stores->getId(), "stores");  
            }
            $stores->setUpdatedBy($_SESSION["user_id"]);
            $stores->setUpdatedAt(date("Y-m-d H:i:s"));
            $stores->updateStores($stores->getId());
        }
        $_SESSION["data_record"] = 1;
    }else{
        $_SESSION["data_record"] = 2;
    }

    header("Location: ../stores/list");

}

$stores->countStores();

if(empty($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$totalPages = $stores->getTotalPages(15);

if(isset($_GET['send'])){
    $search = $_GET['search'];
}
?>