<?php 
require "../src/model/record_benefits/record_benefits.class.php";
function getRecordBenefitsList(string $type, int $id){
    $recordBenefit = new RecordBenefits();
    $dataBenefit = array(); 
    $listRecordBenefit = array();
    switch($type){
        case "users":
                $listRecordBenefit = $recordBenefit->getRecordBenefitsByUserId($id);
            break;
        case "store":
                $listRecordBenefit = $recordBenefit->getRecordBenefitsByStoresId($id);
            break;    
    }

    $dataBenefit = ['success' => true,
                    'record_benefits'=>$listRecordBenefit];

    return json_encode($dataBenefit);
}

$common = new Commons();
if($_GET){
    if(isset($_GET["type"]) && isset($_GET["id"])){
        print getRecordBenefitsList($_GET["type"], $_GET["id"]);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}