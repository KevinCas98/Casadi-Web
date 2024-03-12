<?php 
require "../src/app/login/controller/controller.php";
require "../src/model/news/news.class.php";

$titleNews = "ALTA";
$news = new News();

if($_GET){
    $titleNews = "EDITAR";
    $id_news = $_GET["id"];
    $news->getNewsById($id_news);
}


?>