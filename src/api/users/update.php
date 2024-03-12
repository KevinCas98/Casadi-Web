<?php 
require "../src/model/users/users.class.php";

function updateUserByToken(int $id, string $token, string $name, string $lastName, string $sex, string $dataOfBirth, string $dni, string $city, string $province, string $contact, string $imgHidden, array $files, Commons $commons){
    $user = new Users();
    $arrayDataUser = $user->getUserByToken($token);
    $user->setName($name);
    $user->setLastName($lastName);
    $user->setSex($sex);
    $user->setDateOfBirth($dataOfBirth);
    $user->setToken($token);
    $user->setDni($dni);
    $user->setCity($city);
    $user->setProvince($province);
    $user->setContact($contact);
    $user->setProfileImg(isset($files["name"])?$files["name"]:$imgHidden);
    $user->updateUser();
    $commons->pushNotification($user->getDeviceToken(), 'PERFIL ACTUALIZADO', "Tu perfil ya fue actualizado.");
    if(isset($files["tmp_name"])){
        $commons->uploadFile($files["tmp_name"], $files["name"], $arrayDataUser[$id]->getId(), "users");  
    }
    $dataUser = array(); 
    $dataUser =   ['success' => true,
                    'user'=>[
                        $user->getId()=>["name"=>$user->getName(),
                        "last_name"=>$user->getLastName(),
                        "token"=>$user->getToken()]
                ]];
    
    return json_encode($dataUser);
}

$commons = new Commons();

if($_POST){
    if(isset($_POST["token"])&&isset($_POST["id"]) ){
            $file = isset($_FILES["profile_img"])?$_FILES["profile_img"]:array();
            print updateUserByToken($_POST["id"],
            $_POST["token"],
            $_POST["name"], 
            $_POST["last_name"], 
            $_POST["sex"], 
            $_POST["date_of_birth"], 
            $_POST["dni"],
            $_POST["city"],
            $_POST["province"],
            $_POST["contact"],
            $_POST["img_hidden"],
            $file,
            $commons
        );
    }else{
        print $commons->badREquest(400);
    }
}else{
    print $commons->badREquest(405);
}