<?php 

require "../src/model/users/users.class.php";

$common = new Commons();

function getUserByLogin(string $userName, string $password){
    $user = new Users();
    $dataUser = array();
    $userData = $user->getUserByUserNameAndPassword($userName, $password);
    if(isset($userData["id"])){
        $dataUser = ['success' => true,
                 'user'=>$userData];
    }else{
        $dataUser = ['success' => false,
                 'msj'=>"Incorrect User"];
    }
    
    return json_encode($dataUser); 
}


if($_POST){
    if(isset($_POST["user_name"]) && isset($_POST["password"])){
        print getUserByLogin($_POST["user_name"], $_POST["password"]);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}

?>