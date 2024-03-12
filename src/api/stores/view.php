<?php 
require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";
require "../src/model/contacts/contacts.class.php";
function getJsonStoreById(int $idStore){
    $stores = new Stores();
    $dataStore = array(); 
    $dataStore =   ['success' => true,
                    'stores'=>$stores->getStoresByIdApi($idStore)];

    return json_encode($dataStore);
}

$common = new Commons();
if($_GET){
    if(isset($_GET["store"])){
        $storesId = $_GET["store"];
        print getJsonStoreById($storesId);
    }else{
        print $common->badREquest(400);

    }
}else{
    print $common->badREquest(405);
}


?>