<?php

require_once  "../controllers/db/pdo.php";
require_once "../controllers/db/Article.php";
require_once "../controllers/db/Medias.php";

include "./vues/header.php";

$article = new Medias($pdo);

if ($match['params']['id']) {
   $return = $article->affichageArticle($match['params']['id']); 
   ?>
   <pre>
       <?= var_dump($return)?>
   </pre>
   <?php
}
include "../models/articleCard.php";

include "./vues/footer.php";