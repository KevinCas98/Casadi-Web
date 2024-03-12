<?php 
require "../src/model/users/users.class.php";


function setNewUserByRegister(string $name, string $lastName, string $dni, string $email, string $password, string $deviceToken, $common){

    $user = new Users();
    if(!$user->getUserByEmail($email)){
        $user->setName($name);
        $user->setLastName($lastName);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setUserName($email);
        $user->setPassword($password);
        $user->setToken(substr(str_shuffle(MD5(microtime())), 0, 10));
        $user->setDeviceToken($deviceToken);
        $user->saveUser();
        $dataUser = array(); 
        $common->pushNotification($user->getDeviceToken(), 'REGISTRO EXITOSO!', "Tu registro fue exitoso, valida tu identidad para acceder a los beneficios."); 
        $dataUser =   ['success' => true,
                        'user'=>[
                            $user->getId()=>[
                            "id"=>$user->getId(),    
                            "name"=>$user->getName(),
                            "last_name"=>$user->getLastName(),
                            "token"=>$user->getToken(),
                            "device_token"=>$user->getDeviceToken(),
                            ]
                    ]];
    }else{
        $dataUser =   ['success' => false,
                        'msj'=>["Este email ya está registrado"]];
    }
    return json_encode($dataUser);

}

$common = new Commons();
if($_POST){
    if(isset($_POST["name"]) && isset($_POST["last_name"]) && isset($_POST["dni"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["device_token"])){
            print setNewUserByRegister($_POST["name"], $_POST["last_name"], $_POST["dni"], $_POST["email"], $_POST["password"], $_POST["device_token"], $common);
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}

?>