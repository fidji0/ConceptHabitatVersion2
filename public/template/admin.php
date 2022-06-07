
<?php

session_start();
/*require "../controllers/db/pdo.php";
require "../controllers/db/Article.php";
require "../controllers/db/Medias.php";
$media = new Medias($pdo);
$link =
    [
        [
            'link' => 'lien 1',
            'categoty' => 'sol',
            'type' => 'img',
            'avant' => '0'
        ]


    ];

$artticleId = 1;
$request = "INSERT INTO medias (link , avant , category , type , articleId) VALUES ";
for ($i = 0; $i < count($link); $i++) {
    $lien = $link[$i]['link'];
    $avant = $link[$i]['avant'];
    $category = $link[$i]['category'];
    $type = $link[$i]['type'];

    $request .= "('$lien' , $avant , '$category' , '$type' , $artticleId)";

    if ($i < count($link) - 1) {
        $request .= ",";
    } else {
        $request .= ";";
    }
}
echo($link[0]['link']);
$r = $pdo->prepare($request);
//var_dump($link);
try {

    echo json_encode($r);
} catch (PDOException $th) {
    var_dump($th->getMessage());
}*/


$title = "Panneau d'administration";
$desc = $title;
include "./vues/head.php";

if ($_SESSION["admin"] !== true) {
    
    include "../models/connexionForm.php";
    //echo "<script>document.location.href = '/'</script>";
    include "./vues/footer.php";
    
} else {
 
    require "../vuesProtect/administration.php";
    include "./vues/footer.php";
}
if (!empty($_GET['disconnect']) && $_GET['disconnect'] == 1) {
    session_unset();
}
?>

