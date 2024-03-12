<?php 
require "../src/model/users/users.class.php";

$common = new Commons();
function getUserByParamete(string $parameter, Commons $common){
    if(isset($_GET[$parameter])){
        $user = new Users();
        $dataUser = array(); 
        switch($parameter){
            case "id":
                $userData = $user->getUserByIdApi($_GET[$parameter]);
                break;
            case "email":
                $userData = $user->getUserByEmail($_GET[$parameter]);
                break;
            case "token":
                $userData = $user->getUserByToken($_GET[$parameter]);
                break;          
        }
        $dataUser = ['success' => true,
                    'user'=>$userData];
        return json_encode($dataUser);            
    }else{
        print $common->badREquest(400); 
    }
}


if($_GET){
    if(isset($_GET["type_by"])){
        switch($_GET["type_by"]){
            case "id":
                $userResponses = getUserByParamete("id", $common);
                break;
            case "email":
                $userResponses = getUserByParamete("email", $common);
                break; 
            case "token":
                $userResponses = getUserByParamete("token", $common);
                break;
        }
        print $userResponses;
    }else{
        print $common->badREquest(400);
    }
}else{
    print $common->badREquest(405);
}

?>