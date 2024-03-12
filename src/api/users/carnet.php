<?php 
require "../src/model/users/users.class.php";
require "../src/model/files/files.class.php";

function setDataCarnet($token, $doseQuantity, $typeOfCard, $files, $commons){
    $user = new Users();
    $dataUser = array(); 
    $user->setDoseQuantity($doseQuantity);
    $user->setTypeOfCard($typeOfCard);
    $user->setChecked(1);
    $user->updateDataCard($token);
    $userByToken =  $user->getUserByToken($token); 
    $userId = $userByToken["id"];

    if($files){
        $filesData = new Files();
        $filesData->setIdUser($userId);
        $filesData->updateCheckByIdUser();
        foreach($files as $v){
            $filesData = new Files();
            $filesData->setIdUser($userId);
            $filesData->setName($v["name"]);
            $filesData->setChecked(1);
            $filesData->setPath($v["name"]);
            $filesData->saveFiles();
            $commons->uploadFile($v["tmp_name"], $v["name"], $filesData->getIdUser(), "users");
        }
    }

    $commons->pushNotification($userByToken[$userId]->getDeviceToken(), 'CARNET ACTUALIZADO', "Tu carnet ya fue actualizado, te notificaremos cuando este validado.");
    $dataUser = ['success' => true,
                'user'=>$user->getUserByToken($token)];
        return json_encode($dataUser); 


}
$commons = new Commons();
if($_POST){
    if(isset($_POST["token"]) && isset($_POST["dose_quantity"]) && isset($_POST["type_Of_card"]) && isset($_FILES)){
        print setDataCarnet($_POST["token"], $_POST["dose_quantity"], $_POST["type_Of_card"], $_FILES, $commons);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}

?>