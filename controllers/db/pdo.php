<?php

try{
$dsn = 'mysql:host=localhost;dbname=concept';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);
}catch(PDOException $e){
    return $e ;
}