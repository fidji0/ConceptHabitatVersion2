<?php


class Connexion {

    public string $id = "BernardConil";
    public string $password = "test123";


    public function connexionForm($id , $password){
        if ($id === $this->id && $password === $this->password) {
            return true;
        }else{
            return false;
        }
    }
    public function test($id){
        echo $id;
    }
}