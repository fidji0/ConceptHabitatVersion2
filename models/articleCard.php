<section class="articleCard">
    <div class="imageChantier">
        <?php
        //$test = json_encode($return[0]['link']);
        //foreach ($return[0]['link'] as $link){
        ?>
        <span >
            <input type="text" hidden id="arrayImg" value='<?php echo $return[0]['link'] ?>'>
           
            <img src="../files/images/depannage.png" id="imgArticle" alt="Image de chantier de rénovation" >
        </span>
        <?php

        // }
        ?>

    </div>
    <div class="description">
        <h1 class="titleArticle"><?= $return[0]['title'] ?></h1>
        <p class="descArticle"><?= $return[0]['description'] ?></p>
    </div>
</section>