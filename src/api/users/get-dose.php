<?php 
require "../src/model/dose/dose.class.php";
require "../src/model/vaccines/vaccines.class.php";

function getDoseByUser($idUser, $commons){
    $doces = new Dose();
    $dataDoce = ['success' => true,
                 'dose'=>$doces->getDoseByUserId($idUser)];
        return json_encode($dataDoce); 
}

$commons = new Commons();

if($_GET){
    if(isset($_GET["id_user"]) ){
            print getDoseByUser($_GET["id_user"],$commons);
    }else{
        print $commons->badREquest(400);
    }
}else{
    print $commons->badREquest(405);
}

?>