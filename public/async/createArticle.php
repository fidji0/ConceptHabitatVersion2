<?php
session_start();
require "../../controllers/db/pdo.php";
require "../../controllers/db/Article.php";
require "../../controllers/db/Medias.php";
$media = new Medias($pdo);
if ($_POST && $_SESSION['admin'] === true) {
    $return = $media->uploadImage();
    //echo json_encode($_FILES);


    echo json_encode($return);
} else {
    echo 'redirect';
    //echo "<script>document.location.href = '/'</script>";
    exit();
}

/*$link =
    [
        'lien1' => 'sol',
        'lien2' => 'category'
    ];
$avant = true;
$category = 'sol';
$type = 'img';
$artticleId = 1;
$request = "INSERT INTO medias (link , avant , category , type , articleId) VALUES ";
foreach($link as $key => $value){
    $request .= "($key , $avant , $value , $type , $artticleId),"; 
}
$r = $pdo->prepare($request);
try {
    $r->execute();
    echo json_encode($r);
} catch (PDOException $th) {
    echo json_encode('erreur '.$th->getMessage());
}
*/
