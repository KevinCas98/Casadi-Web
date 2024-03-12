<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/news/news.class.php";

$commons = new Commons();
$news = new News();
$show_alert = "";
$show_alert_deleted = "";
$search=NULL;

if(isset($_SESSION["data_record"])){
    $dataSession = $_SESSION["data_record"];
    if($dataSession){
        $show_alert = 1;
    }else{
        $show_alert = 0;
    }
    unset($_SESSION["data_record"]);
}

if($_POST){

    $news = new News();

    $title = $_POST["title"];
    $description = $_POST["description"];
    $image = $_POST["imagen_hidden"];


    $news->setTitle($title);
    $news->setDescription($description);
    $news->setImage($image);
    $news->setCreatedBy($_SESSION["user_id"]);
    $news->setCreatedAt(date("Y-m-d H:i:s"));
    
    if(isset($_POST['id_news']) && $_POST['id_news']!=0 ){
        
        $id = $_POST["id_news"];
    
        $news->setId($id);
        $news->setUpdatedBy($_SESSION["user_id"]);
        $news->setUpdatedAt(date("Y-m-d H:i:s"));
        $news->updateNews();

    }else{
        $news->saveNews();
    }

   if($news->getId()!= 0){
        if($_FILES){
            if($_FILES['image']['tmp_name']!=NULL){
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $common->uploadFile($fileTmpPath, $fileName, $news->getId(), "news");       
            }
            $news->setUpdatedBy($_SESSION["user_id"]);
            $news->setUpdatedAt(date("Y-m-d H:i:s"));
            $news->updateNews($news->getId());
        }
        $_SESSION["data_record"] = 1;
    }else{
        $_SESSION["data_record"] = 2;
    }

    header("Location: ../news/list");
}
$news->countNews();

if(empty($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$totalPages = $news->getTotalPages(15);

if(isset($_GET['send'])){
    $search = $_GET['search'];
}
?>