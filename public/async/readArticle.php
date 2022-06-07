<?php
require "../../controllers/db/pdo.php";
require "../../controllers/db/Article.php";
require "../../controllers/db/Medias.php";

if ($pdo) {
    $article = new Medias($pdo);
    //$article->createImage(["lien 4"], 3 , "rangement" , "video", 0)

    //$retour = $article->readImage($_GET['id'] , $_GET['category']);
    $request = "SELECT a.description AS description, a.title AS title , a.slug AS slug , m.type , m.link 
FROM articles a LEFT JOIN medias m ON m.articleId = a.articleId ";
    $params = [];
    $retour = $article->requeteSpe($request, $params);
    
    echo json_encode($retour);
}
