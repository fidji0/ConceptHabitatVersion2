<?php
// home page
$router->map('GET', '/', 'accueil', 'accueil');
$router->map('POST', '/', 'accueil', 'acc');
// contact page
$router->map('GET', '/#contact', 'contact', 'contact');
$router->map('POST', '/#contact', 'contact', 'cont');

//compétence
$router->map('GET', '/#competences', 'competences', 'competences');
$router->map('POST', '/#competences', 'competences', 'comp');
//presentation
$router->map('GET', '/#presentation', 'presentation', 'presentation');
$router->map('POST', '/#presentation', 'presentation', 'pres');
// Nos realisations
$router->map('GET', '/nos-realisations/[*:slug]-[i:id]?', 'realisation', 'Nos Réalistation');
// condition générale
$router->map('GET', '/mentions-legales', 'mentions-legales', 'mentions-legales');

// contact page
$router->map('GET', '/404', '404');
$router->map('POST', '/404', '404');

//admin
$router->map('GET', '/admin', 'admin', 'administrateur');
$router->map('POST', '/admin', 'admin', 'admin');
?>