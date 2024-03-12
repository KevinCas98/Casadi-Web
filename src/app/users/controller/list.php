<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/users/users.class.php";
require "../src/model/dose/dose.class.php";
require "../src/model/vaccines/vaccines.class.php";

$users = new Users();
$commons = new Commons();
$users->countUsers();
$search=NULL;

if($_POST){
    $dose = new Dose();
    $checkedUser = $_POST["data_match"];
    if($checkedUser){
        $checkedDose = $_POST["doses_applied"];

        if(isset($_POST['id_users']) && $_POST['id_users']!=0 ){

            $userId = $_POST["id_users"];
            $users->getUsersById($userId);

            if($users->getDoseQuantity() == $checkedDose){
                $userId = $_POST["id_users"];
                $dose->setIdUsers($userId);

                for ($x = 1; $x <= $checkedDose ; $x++) {
                    $vaccinesSelected = $_POST["vaccines_sel_".$x];
                    $vaccinesDate = $_POST["date_vaccines_".$x];

                    $dose->setIdVaccines($vaccinesSelected);
                    $dose->setDateCheckedDose($vaccinesDate);
                    $dose->saveDose();
                } 
            }

            if(isset($_POST["id_users"])){
                $checkedNew = "2";
                $users->setChecked($checkedNew);
                $users->setDoseQuantity($checkedDose);
                $users->setCheckedBy($_SESSION["user_id"]);
            }
            $users->updateDataUserChecked();
            
            $commons->pushNotification($users->getDeviceToken(), 'YA ESTÁS VALIDADO', "Tu usuario fue validado con éxito, ya podés acceder a los beneficios.");
            
            //Este codigo lo escribio Lauti
            // if(isset($_POST['validar'])){
            //     $subject="Validación CASADI";
            //     $message="Felicidades,ha sido verificado y puede utilizar los beneficios";
            //     $to=$users->getEmail();
            //     $headers ="From: <casadilc@gmail.com>" . "\r\n";
            //     $headers .="Reply-To: <casadilc@gmail.com>" . "\r\n";
            //     $headers .="X-Mailer: PHP/". phpversion();
            //     $mail=mail($to,$subject,$message,$headers);

            //     if($mail){
            //         print ("Se envió el correo de confirmación");
            //     }
            // }
        }
    }
}

if(empty($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$totalPages = $users->getTotalPages(15);

if(isset($_GET['send'])){
    $search = $_GET['search'];
}
?>
