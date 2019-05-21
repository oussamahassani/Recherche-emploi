<?php
    session_start();

    include "../connexion.php";

    $message = $nom = "";

    if (isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0)
    {
        $idDemandeur = intval($_GET['id_demandeur']);
        $requeteDemandeur = $bdd->prepare('SELECT * FROM demandeur WHERE id_demandeur = ?');
        $requeteDemandeur->execute(array($idDemandeur));
        $infosDemandeur = $requeteDemandeur->fetch();

        if(isset($_SESSION['id_demandeur']) and $infosDemandeur['id_demandeur'] == $_SESSION['id_demandeur'])
        {
            $prenom = $infosDemandeur['prenom'];
            $nom = $infosDemandeur['nom'];
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Espace demandeur</title>

    <!-- Fichiers CSS Bootstrap -->
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fichiers CSS personalisés -->
    <link href="../../includes/sb-admin-2/sb-admin-2.css" rel="stylesheet">
    <link href="../../includes/css/style.css" rel="stylesheet">

    <!-- Fonts personnalisés -->
    <link href="../../includes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrapper">

      <!-- Début de la Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../../../index.php">Recherche Emploi</a>
        </div>

        <!-- Début du navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <?php 
                if (!empty($infosDemandeur['photo']))
                {
              ?>
                <img src = "photo/<?php echo $infosDemandeur['photo'];?>"width= "250"/> 
              <?php
                }
              ?>
              <li>
                <a href="index.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-home fa-fw"></i> Accueil</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> CV<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="cv.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-eye fa-fw"></i> Mes CV</a>
                  </li>
                  <li>
                    <a href="publier-cv.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-paper-plane-o fa-fw"></i> Publier un CV</a>
                  </li>
                </ul>

                <!-- Début du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-gift fa-fw"></i> Offres<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="offres.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-eye fa-fw"></i> Afficher les offres</a>
                  </li>
                  <li>
                    <a href="rechercher-offres.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-search fa-fw"></i> Rechercher une offre</a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-envelope-o fa-fw"></i> Demandes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="demandes.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-paper-plane-o fa-fw"></i> Demandes envoyées</a>
                  </li>
                  <li>
                    <a href="reponses.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-inbox fa-fw"></i> Réponses reçues</a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-star-o fa-fw"></i> Favoris<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="favoris.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-eye fa-fw"></i> Mes favoris</a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Mon compte<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="profil.php?id_demandeur=<?php echo $_SESSION['id_demandeur'];?>"><i class="fa fa-info fa-fw"></i> Mon profil</a>
                  </li>
                  <li>
                    <a href="../deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion </a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
            </ul>
          </div> <!-- Fin du sidebar-collapse -->
        </div> <!-- Fin du navbar-static-side -->
        </nav>

        <!-- Début du wraper -->
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="page-header text-center" id="titre"><i class="fa fa-star" aria-hidden="true"></i> Mes favoris</h2>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
              <?php
                if(isset($_SESSION['id_demandeur']) and isset($_SESSION['id_demandeur']) > 0 and isset($_GET['id_demandeur']) and isset($_GET['id_demandeur']) > 0 and isset($_GET['message']))
                {
                  echo "<div class='alert alert-success alert-dismissible' role='alert'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                      echo "<span aria-hidden='true'>".'&times;'."</span>";
                    echo "</button>";
                    echo $_GET['message'];
                  echo "</div>";
                }
              ?>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12 text-center">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><i class="fa fa-plus fa-fw"></i> Ajouter un favoris</h3>
                </div>
                <div class="panel-body">
                  <form  class="form-inline well" role="form" method="POST" action="traitements.php">
                    <div class="input-group container-fluid" style="padding:10px 10px;">
                      <select class="form-control" name="secteur">
                        <optgroup label="A">
                          <option value="Aéronautique et espace">Aéronautique et espace</option>
                          <option value="Agriculture - Agroalimentaire">Agriculture - Agroalimentaire</option>
                          <option value="Agroalimentaire - industries alimentaires">Agroalimentaire - industries alimentaires</option>
                          <option value="Artisanat">Artisanat</option>
                          <option value="Audiovisuel, cinéma">Audiovisuel, cinéma</option>
                          <option value="Audit, comptabilité, gestion">Audit, comptabilité, gestion</option>
                          <option value="Automobile">Automobile</option>
                        </optgroup>
                        <optgroup label="B">
                          <option value="Banque, assurance">Banque, assurance</option>
                          <option value="Bâtiment, travaux publics">Bâtiment, travaux publics</option>
                          <option value="Biologie, chimie, pharmacie">Biologie, chimie, pharmacie</option>
                        </optgroup>
                        <optgroup label="C">
                          <option value="Commerce, distribution">Commerce, distribution</option>
                          <option value="Communication">Communication</option>
                          <option value="Création, métiers d'art">Création, métiers d'art</option>
                          <option value="Culture, patrimoine">Culture, patrimoine</option>
                        </optgroup>
                        <optgroup label="D">
                          <option value="Défense, sécurité">Défense, sécurité</option>
                          <option value="Documentation, bibliothèque">Documentation, bibliothèque</option>
                          <option value="Droit">Droit</option>
                        </optgroup>
                        <optgroup label="E">
                          <option value="Edition, livre">Edition, livre</option>
                          <option value="Enseignement">Enseignement</option>
                          <option value="Environnement">Environnement</option>
                        </optgroup>
                        <optgroup label="F">
                          <option value="Ferroviaire">Ferroviaire</option>
                          <option value="Foires, salons et congrès">Foires, salons et congrès</option>
                          <option value="Fonction publique">Fonction publique</option>
                        </optgroup>
                        <optgroup label="H">
                          <option value="Hôtellerie, restauration">Hôtellerie, restauration</option>
                          <option value="Humanitaire">Humanitaire</option>
                        </optgroup>
                        <optgroup label="I">
                          <option value="Immobilier">Immobilier</option>
                          <option value="Industrie">Industrie</option>
                          <option value="Informatique, télécoms, Web">Informatique, télécoms, Web</option>
                        </optgroup>
                        <optgroup label="J">
                          <option value="Journalisme">Journalisme</option>
                        </optgroup>
                        <optgroup label="L">
                          <option value="Langues">Langues</option>
                        </optgroup>
                        <optgroup label="M">
                          <option value="Marketing, publicité">Marketing, publicité</option>
                          <option value="Médical">Médical</option>
                          <option value="Mode-textile">Mode-textile</option>
                        </optgroup>
                        <optgroup label="P">
                          <option value="Paramédical">Paramédical</option>
                          <option value="Propreté et services associés">Propreté et services associés</option>
                          <option value="Psychologie">Psychologie</option>
                        </optgroup>
                        <optgroup label="R">
                          <option value="Ressources humaines">Ressources humaines</option>
                        </optgroup>
                        <optgroup label="R">
                          <option value="Ressources humaines">Ressources humaines</option>
                        </optgroup>
                        <optgroup label="S">
                          <option value="Sciences humaines et sociales">Sciences humaines et sociales</option>
                          <option value="Secrétariat">Secrétariat</option>
                          <option value="Social">Social</option>
                          <option value="Spectacle - Métiers de la scène">Spectacle - Métiers de la scène</option>
                          <option value="Sport">Sport</option>
                        </optgroup>
                        <optgroup label="T">
                          <option value="Tourisme">Tourisme</option>
                          <option value="Transport-Logistique">Transport-Logistique</option>
                        </optgroup>
                      </select>
                    </div>
                      <button class="btn btn-success" type="submit" name="ajouter">Ajouter</button>
                  </form>
                </div>
              </div>
            </div> <!-- Fin du col-md-3 -->
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><i class="fa fa-star fa-fw"></i> Mes favoris</h3>
                </div>
                <div class="panel-body">
                  <?php

                    if (isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0)
                    {
                        $idDemandeur = intval($_GET['id_demandeur']);
                        $requeteFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_demandeur = ?');
                        $requeteFavoris->execute(array($idDemandeur));

                        if(isset($_SESSION['id_demandeur']) and $infosDemandeur['id_demandeur'] == $_SESSION['id_demandeur'])
                        {
                          if($requeteFavoris->rowCount() > 0)
                        {
                            echo "<div class='list-group'>";
                            while ($infosFavoris = $requeteFavoris->fetch())
                            {
                              echo "<li href='#' class='list-group-item container-fluid'>".$infosFavoris['secteur']."<a href='traitements.php?id_favoris=".$infosFavoris['id_favoris']."'>"."<span class='pull-right' style='color:red;'>".'Supprimer'."</span>"."</a>"."  </li>";
                            }
                            echo "</div>";
                          $requeteDemandeur->closeCursor();
                        }
                        else
                        {
                        echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>";
                          echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                            echo "<span aria-hidden='true'>".'&times;'."</span>";
                          echo "</button>";
                          echo "<strong>".'Cette section est vide !.'."</strong>". ' Vous n\'avez reçu aucune notification de la part des employeurs.';
                        echo "</div>";
                        }
                      }
                    }
                ?>
                </div>
              </div>
            </div> <!-- Fin du col-md-6 -->
          </div>
    </div> <!-- fin du #wrapper -->

    <!-- jQuery -->
    <script src="../../includes/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../includes/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../includes/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../includes/sb-admin-2/sb-admin-2.js"></script>
  </body>
</html>
