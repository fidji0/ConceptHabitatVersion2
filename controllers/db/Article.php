<?php
class Article 
{
    public int $id;
    public string $title;
    public string $description;
    public string $location;
    public $date;
    public object $pdo;
    

    function __construct($pdo){
        $this->pdo = $pdo;
    }
    //create
    public function createArticle($title , $description , $location ){
       try{
        $slug = str_replace(' ','-',trim($title));
        $request = "INSERT INTO articles (slug , title , description, location , date ) VALUES ( ? , ? ,  ? , ? , DATE(NOW()) )";
        $r = $this->pdo -> prepare($request);
        $r -> execute(array($slug , $title , $description , $location));
            return true;
       }catch(PDOException $e){
           return false;
       }
    }
    //read
    public function readArcticle($id = null){
        try {
            $request = "SELECT * FROM articles ";
            if ($id !== null) { 
                $request .= " WHERE id = $id";
            }
            $r = $this->pdo->prepare($request);
            $r->execute();
            $p = $r->fetchAll(PDO::FETCH_ASSOC);
            return $p;
        } catch (PDOException $th) {
            echo $th;
        }
    }
    //update
    public function updateArticle($id , $title , $description , $location ){
        try {
            $request = "UPDATE articles SET title = ? , description = ? , location = ? WHERE id = ?";
            $r = $this->pdo->prepare($request);
            $r-> execute([$title, $description , $location, $id]);
        } catch (PDOException $th) {
            echo $th;
        }
    }
    //delete 
    public function deleteArticle($id){
        try {
            $request = "DELETE FROM articles WHERE id =?";
            $r = $this->pdo->prepare($request);
            $r->execute([$id]);
            return true;
        } catch (PDOException $th) {
            echo $th;
        }
    }
    
}
