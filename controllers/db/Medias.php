<?php



class Medias extends Article
{
    public $success;
    public $message;

    //Create
    public function createImage(array $links, $articleId, $category, $type, $avant)
    {
        try {

            foreach ($links as $link => $category) {
                $request = "INSERT INTO medias (link , avant , category , type , articleId) VALUES (? , ? ,? ,? ,? )";
                $r = $this->pdo->prepare($request);
                $r->execute([$link, $avant, $category, $type, $articleId]);
            }
        } catch (PDOException $th) {
            return $th;
        }
    }
    //Read
    public function readImage($articleId = null, string $category = null)
    {
        try {
            $request = "SELECT * FROM medias ";
            if ($articleId !== null && $category == null) {
                $request .= " WHERE articleId = $articleId";
            } elseif ($category !== null && $articleId == null) {
                $request .= " WHERE category = '$category'";
            } elseif ($category !== null && $articleId !== null) {
                $request .= " WHERE category = '$category' AND articleId = $articleId";
            }
            // return $request;
            $r = $this->pdo->prepare($request);
            $r->execute();
            $p = $r->fetchAll(PDO::FETCH_ASSOC);
            // return $p;
            return $p;
        } catch (PDOException $th) {
            return $th;
        }
    }
    //Update


    // upload
    public function uploadImage()
    {
        $mime_types = array(

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'webp' => 'image/webp',


        );
        $uploaddir = "../files/uploadImage/";
        $listLink = [];
        $verif = 0;
        $error = null;
        foreach ($_FILES as $files) {

            if ((in_array($files["type"], $mime_types) && $files["size"] <= 2000000) || !$files["type"]) {
            } else {
                $verif++;
                $error .= '/Le format du fichier ' . $files['name'] . 'ne correspond pas';
            }
        }

        if ($verif === 0) {
            $add = 1;
            for ($i = 0; $i <= count($_FILES); $i++) {

                if ($_FILES[$i]["type"]) {
                    $uploadfile = $uploaddir . uniqid() . basename(str_replace(' ', '', $_FILES[$i]['name']));

                    if (move_uploaded_file($_FILES[$i]['tmp_name'], $uploadfile)) {
                        $test = [
                            'link' => $uploadfile,
                            'category' => $_POST['file' . $add],
                            'type' => $_POST['typeFile' . $add],
                            'avant' => $_POST['avantFile' . $add],
                        ];
                        array_unshift($listLink, $test);
                        $add++;
                    } else {

                        $error .= "/Une erreur c'est produite lors du téléchargement du fichier " . $_FILES[$i]['name'];
                        //$return = $this->response(false, "Une erreur c'est produite lors du téléchargement du fichier " .$files['name']); 
                    }
                }
            }

            if ($verif === 0) {
                $error = $this->prepareRequestMedias($listLink);
                //$this->createArticle($_POST['title'] , $_POST['description'], $_POST['location']);
                $return = $this->response(true, 'Le fichier a été téléchargé', $error);
            } else {
                $return = $this->response(false, 'Une erreur c\'est produite', $error);
            }

            //$this->createArticle($_POST['title'], $_POST['description'], $_POST['location'] );

            //$this->createImage($listLink, 2);

            return $return;

            /*        foreach ($_FILES as $files) {
                if (!$files["type"]) {
                } else {
                    $uploadfile = $uploaddir . uniqid() . basename(str_replace(' ', '', $files['name']));
                    if (move_uploaded_file($files['tmp_name'], $uploadfile)) {

                        array_unshift($listLink , $uploadfile);
                    } else {
                        $verif++;
                        $error .= "/Une erreur c'est produite lors du téléchargement du fichier " . $files['name'];
                        //$return = $this->response(false, "Une erreur c'est produite lors du téléchargement du fichier " .$files['name']); 
                    }
                }
            }*/
        }
    }
    private function prepareRequestMedias(array $link)
    {
        $id = uniqid();

        $request = "INSERT INTO medias (link , avant , category , type , articleId) VALUES ";

        for ($i = 0; $i < count($link); $i++) {

            $lien = $link[$i]['link'];
            $avant = $link[$i]['avant'];
            $category = $link[$i]['category'];
            $type = $link[$i]['type'];

            $request .= "('$lien' , $avant , '$category' , '$type' , $id)";

            if ($i < count($link) - 1) {
                $request .= ",";
            } else {
                $request .= ";";
            }
        }
        return $request;
    }
    // methode requete spécifique
    public function requeteSpe($requete, array $params)
    {
        try {

            $r = $this->pdo->prepare($requete);
            $r->execute($params);
            $return = $r->fetchAll(PDO::FETCH_ASSOC);
            return $return;
        } catch (PDOException $e) {
            echo $e;
        } catch (Exception $e) {
            echo $e;
        }
    }
    // affichage article avec image
    public function affichageArticle($id = null, $category = null)
    {

        $request = "SELECT a.description AS description, a.title AS title , a.slug AS slug , m.type , GROUP_CONCAT( m.link  ) AS link
FROM articles a LEFT JOIN medias m ON m.articleId = a.articleId ";
        $params = [];
        // Vérification de la présence de paramètre
        if ($id && $category) {
            $request .= " WHERE a.articleId = ? AND m.category = ? ";
            $params = $id;
            $params = $category;
            array_push($params, $id, $category);
        } elseif ($id && !$category) {
            $request .= " WHERE a.articleId = ? ";

            array_push($params, $id);
        } elseif (!$id && $category) {
            $request .= " WHERE m.category = ? ";
            array_push($params, $category);
        }

        // ajout du group by
        $request .= "  GROUP BY a.articleId ";

        //Lancement de la méthode
        $retour = $this->requeteSpe($request, $params);

        /*foreach ($retour as $key => $r) {
            $resp = explode(',', $r['link']);
            $retour[$key]['link'] = $resp;
        }*/
        return $retour;
    }
    //Delete

    //return
    private function response($success, $message, $error = null)
    {
        $this->success = $success;
        $this->message = $message;
        $return = ['success' => $this->success, 'message' => $this->message, 'error' => $error];
        return $return;
    }
}
