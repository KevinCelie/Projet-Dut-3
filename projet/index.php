<!doctype html>
<html id="html">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title> La Taverne du vieux Montreuil </title>



        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="style1.css" id="link"/> 
        <?php
        	session_start();
        	include_once 'modules/mod_connexion/mod_connexion.php';
        	include_once 'modules/mod_register/mod_register.php';
        	BDD::connexion();
        ?>
    </head>
    <!-- <script type="text/javascript">
window.addEventListener("resize", resize);
function resize() {

document.getElementById("html").style.width = window.innerWidth;
window.width = 1080px;
}

</script> -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(function(){
            $("[data-toggle=popover]").popover();
        });
    </script>

    <body id="body">

        <div>
            <div class="row justify-content-md-center">
                <div class="row align-items-start">
                    <div class="col-md-2">
                        <img src="images/banniere1.png" class="banniere">
                    </div>

                    <div class="col-md-8" id = "milieu">

                        <header id="header">


                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h1 class="text-center shadow-text taverne-text">La Taverne du vieux Montreuil</h1>
                                    </div>
                                    <div class="col-md-4" id="connect">
                                        <div >
                                            <?php
                                            ob_start();
                                            $modConnexion = new ModConnexion();

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            include 'composants/navbar/controleur_navbar.php';
                            $navbar = new Controleur_Navbar();
                            $navbar -> affiche_navbar();
                            ?>
                            <!-- <nav id="nav">
<a href='index.php?module=profil' class="lien_nav fondGold" id="btNav" >Profil</a>
<a href='index.php?module=equipe' class="lien_nav fondGold" id="btNav" >Equipe</a>
</nav> -->

                        </header>

                        <div class="container-fluid" id="corps">
                            <?php 
                            if(!isset($_SESSION['inscriptionFini'])) {
                                $m = new ModRegister();
                            }
                            else {
                                if(isset($_GET['module'])) {
                                    $module = $_GET['module'];
                                }
                                else {
                                    $module = "profil";
                                }

                                switch ($module) {
                                    case 'recherche':
                                        include_once 'modules/mod_recherche/mod_recherche.php';
                                        $modRecherche = new ModRecherche();

                                        $modRecherche -> action("pageRecherche");
                                        break;

                                    case "projet":
                                        include_once 'modules/mod_projet/controleur_projet.php';
                                        $controleurProjet = new Controleur_Projet();
                                        $controleurProjet -> action();
                                        break;


                                    default:
                                        include_once 'modules/mod_profil/mod_profil.php';
                                        $modProfil = new ModProfil();
                                        break;
                                }
                            }
                            ob_end_flush();
                            ?>
                        </div>

                        <!-- Footer -->
                        <footer class="container-fluid">

                            <!-- Copyright -->
                            <div class="footer-copyright text-center py-3">© 2019 Copyright:
                                <a href="index.php"> La Taverne du Vieux Montreuil</a>
                            </div>
                            <!-- Copyright -->

                        </footer>
                        <!-- Footer -->
                    </div>

                    <div class="col-md-2">
                        <img src="images/banniere1.png" class="banniere">
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
