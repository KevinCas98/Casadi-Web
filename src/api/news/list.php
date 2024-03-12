<?php 
require "../src/model/news/news.class.php";
function getJsonListNew(){
    $news = new News();
    $news->countNews();
    $dataStore = array(); 
    $dataStore =   ['success' => true,
                    'total_news' => $news->getCount(),
                    'news'=>$news->getAllNews()];

    return json_encode($dataStore);
}

print getJsonListNew();

?>