<?php
require "../src/app/login/controller/controller.php";
require "../src/model/users/users.class.php";
require "../src/model/record_benefits/record_benefits.class.php";

$recordBenefit = new RecordBenefits();
$benefit = new Benefits();

if ($_GET) {
    $idUsers = $_GET["id"];
    $listRecordBenefit = $recordBenefit->getRecordBenefitsByUserId($idUsers, false);
}
?>