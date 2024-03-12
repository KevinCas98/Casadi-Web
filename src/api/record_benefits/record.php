<?php 
require "../src/model/record_benefits/record_benefits.class.php";
require "../src/model/users/users.class.php";
function setRecordBenefits($token, $idBenefits, $idStores, $commons){
    $users = new Users();
    $recordsBenefits = new RecordBenefits();
    $data = array(); 
    $idUser = $users->getUserByToken($token);
    $recordsBenefits->setIdUser($idUser["id"]);
    $recordsBenefits->setIdBenefits($idBenefits);
    $recordsBenefits->setIdStores($idStores);
    $recordsBenefits->setDateRecord(date("Y-m-d H:i:s"));
    $recordsBenefits->saveRecordBenefits();
    $commons->pushNotification($idUser[$idUser["id"]]->getDeviceToken(), 'BENEFICIO UTILIZADO', "Utilizaste un beneficio, puedes revisar tu historial de beneficios en tu Perfil.");
    $data = ['success' => true,
             'id_record'=>$recordsBenefits->getId()];
        return json_encode($data); 

}

$common = new Commons();
if($_POST){
    if(isset($_POST["token"]) && isset($_POST["id_benefit"]) && isset($_POST["id_store"])){
        print setRecordBenefits($_POST["token"], $_POST["id_benefit"], $_POST["id_store"], $common);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}


?>