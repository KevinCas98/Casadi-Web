<?php
require "../src/app/login/controller/controller.php";
require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";

$benefits = new benefits();

if ($_GET) {
    $id_store = $_GET["id"];
    $benefits->getBenefitsByStoresId($id_store);
}
?>