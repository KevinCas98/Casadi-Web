<?php 
require "../src/model/files/files.class.php";

function getJsonListFileByUser(int $userId){
    $files = new Files();
    $dataFile = array(); 
    $dataFile =   ['success' => true,
                    'file'=>$files->getFilesByUserId($userId)];

    return json_encode($dataFile);
}
$common = new Commons();
if($_GET){
    if(isset($_GET["id_user"])){
        $userId = $_GET["id_user"];
        print getJsonListFileByUser($userId);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}
?>