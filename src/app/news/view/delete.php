<?php require "../src/model/news/news.class.php";
    $news = new News();
    if($_GET){
        if(isset($_GET["new"])){
            $id = $_GET["new"];
            if($news->deleteNews($id)){
                $_SESSION["data_record"] = 1;
            }else{
                $_SESSION["data_record"] = 2;
            }
        }
    }
    header("Location: ../news/list");
    die();
?>