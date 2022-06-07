<?php
require "../controllers/db/pdo.php";
require "../controllers/db/Article.php";
require "../controllers/db/Medias.php";


$article = new Medias($pdo);
// Creation de la requete personnalisé
$request = "SELECT a.description AS description, a.title AS title , a.slug AS slug , m.type , GROUP_CONCAT( m.link  ) AS link
FROM articles a LEFT JOIN medias m ON m.articleId = a.articleId ";
$params = [];
// Vérification de la présence de paramètre
if ($_GET['id'] && $_GET['category']) {
    $request .= " WHERE a.articleId = ? AND m.category = ? ";
    $params = $_GET['id'];
    $params = $_GET['category'];
    array_push($params, $_GET['id'], $_GET['category']);
} elseif ($_GET['id'] && !$_GET['category']) {
    $request .= " WHERE a.articleId = ? ";

    array_push($params, $_GET['id']);
} elseif (!$_GET['id'] && $_GET['category']) {
    $request .= " WHERE m.category = ? ";
    array_push($params, $_GET['category']);
}

// ajout du group by
$request .= "  GROUP BY a.articleId ";

//Lancement de la méthode
$retour = $article->requeteSpe($request, $params);
foreach ($retour as $key => $r) {
    $resp = ["link" => explode(',', $r['link'])];
    $retour[$key]['link'] = $resp;
}
$json = json_encode($retour);
//$retour = $article->readImage($_GET['id'] , $_GET['category']);

if ($json) {
    echo $json;
} else {
    echo json_last_error_msg();
}
?>
<pre>
    <?php var_dump($retour);  ?>
</pre>