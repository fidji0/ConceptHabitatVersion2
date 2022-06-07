<section class="addArticle" style="background: lightblue;">
    <div class="addArticleDiv">
        <h2>Ajouter un article</h2>
        <form action="" method="POST" class="connexionForm" id="addArticleForm" enctype="multipart/form-data">
            <input class="inputForm" type="text" name="title" placeholder="Titre">
            
            <input class="inputForm" type="text" name="location" placeholder="Ville et code postal">
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
            <div class="fileInput" id="fileInput">
                <input type="file" name="1" id="file1">
                
                <select name="file1" id="select1">
                    <option value="sol">Sol</option>
                    <option value="agencement">Agencement</option>
                    <option value="rangement">Rangement</option>
                    <option value="cuisine">Cuisine</option>
                </select>
                <input type="button" value="reset" onclick="document.querySelector('#file1').value = ''">
            </div>
            <input type="button" value="Ajouter un fichier supplémentaire" id="addFileButton">
            <!--<button class="btn btn-primary" id="addFileButton" type="button">Ajouter un fichier supplémentaire </button>-->
            <button class="btn btn-primary" type="submit">Valider</button>
        </form>
    </div>
</section>