<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/record_benefits/record_benefits.class.php";

$recordBenefits = new RecordBenefits();
$arrayBenefit = [];

if ($_GET) {
    $id_store = $_GET["id"];
    $arrayBenefit = $recordBenefits->getRecordBenefitsByStoresId($id_store, false);
}
?>