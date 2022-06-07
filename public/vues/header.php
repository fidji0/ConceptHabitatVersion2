<?php



include_once "./vues/head.php"; ?>

<body>
<section class="entete">
            
            <div>
                <img class="imgLogo" src="../files/images/logoConcept.png" alt="">
            </div>
            <nav class="navbar">

                <ul>
                    <li class="navlink"><a href=""><b>Réalisations</b></a></li>
                    <li class="navlink"><a href=""><b>Cuisine</b></a></li>
                    <li class="navlink"><a href=""><b>Rangement</b></a></li>
                    <li class="navlink"><a href=""><b>Agencement</b></a></li>
                    <li class="navlink"><a href=""><b>Sol</b></a></li>

                </ul>
            </nav>

    <header>


        
            <div class="facebook">
                <button class="buttonContact">
                    <a href="<?= $router->generate('contact') ?>"> Contactez-nous</a>
                </button>
                <button class="buttonAppel">
                    <a href="tel:+0644246174">06 44 24 61 74</a>
                </button>
                <a href="https://www.facebook.com/Concept-habitat-368341587057307" target="_blank" rel="noopener noreferrer"></a>
                
            </div>
            <div class="logoHamburger">
                <button value="close" id="hamburgerButton"><img id="hamburgerImg" src="../files/svg/hamburger.svg" alt=""></button>

            </div>
        </section>
        
        
        <section class="imgHeader ">
       <!-- <a target="_blank"  href="https://www.facebook.com/Concept-habitat-368341587057307"><img class="stky" src="../files/images/flecheFacebook.png" alt=""></a>-->
            <div class="textA">

                <?php include "../models/contactForm.php";?>
            </div>
            
            <img class="imgHeaderimg" src="../files/images/imgHeader.png" alt="">
        </section>

    </header>
    <main>
    