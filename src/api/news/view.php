<?php 
require "../src/model/news/news.class.php";
function getJsonNewsById(int $id){
    $news = new News();
    $data = array(); 
    $data =   ['success' => true,
                'news'=>$news->getNewByIdApi($id)];

    return json_encode($data);
}

$common = new Commons();
if($_GET){
    if(isset($_GET["new"])){
        $id = $_GET["new"];
        print getJsonNewsById($id);
    }else{
        print $common->badREquest(400);

    }
}else{
    print $common->badREquest(405);
}


?>