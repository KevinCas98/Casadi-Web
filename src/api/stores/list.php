<?php 
require "../src/model/stores/stores.class.php";
require "../src/model/benefits/benefits.class.php";
require "../src/model/contacts/contacts.class.php";

function getJsonListStore(){
    $stores = new Stores();
    $stores->countStores();
    $dataStore = array(); 
    $dataStore =   ['success' => true,
                    'total_stores' => $stores->getCount(),
                    'stores'=>$stores->getAllStores()];

    return json_encode($dataStore);
}

print getJsonListStore();

?>