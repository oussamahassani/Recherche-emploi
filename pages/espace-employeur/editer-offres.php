<?php
    session_start();

    include "../connexion.php";

    $message = $nom = "";

    if (isset($_GET['id_employeur']) and $_GET['id_employeur'] > 0)
    {
        $idEmployeur = intval($_GET['id_employeur']);
        $requeteEmployeur = $bdd->prepare('SELECT * FROM employeur WHERE id_employeur = ?');
        $requeteEmployeur->execute(array($idEmployeur));
        $infosEmployeur = $requeteEmployeur->fetch();

        if(isset($_SESSION['id_employeur']) and $infosEmployeur['id_employeur'] == $_SESSION['id_employeur'])
        {
            $nom = $infosEmployeur['nom_organisation'];
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
    <title>Site de recherche d'emploi</title>

    <!-- Fichiers CSS Bootstrap -->
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fichiers CSS personalisés -->
    <link href="../../includes/sb-admin-2/sb-admin-2.css" rel="stylesheet">

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
          <a class="navbar-brand" href="../../../index.php">recherche-emploi.com</a>
        </div>

        <!-- Début du navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <?php 
                if (!empty($infosEmployeur['logo']))
                {
              ?>
                <img src = "logo/<?php echo $infosEmployeur['logo'];?>"width= "250"/> 
              <?php
                }
              ?>
              <li>
                <a href="index.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-home fa-fw"></i> Accueil</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> CV<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="cv.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-eye fa-fw"></i> Afficher les CV</a>
                  </li>
                  <li>
                    <a href="rechercher-cv.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-search fa-fw"></i> Rechercher un CV</a>
                  </li>
                </ul>

                <!-- Début du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-gift fa-fw"></i> Offres<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="offres.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-eye fa-fw"></i> Afficher les offres</a>
                  </li>
                  <li>
                    <a href="publier-offres.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-paper-plane-o fa-fw"></i> Publier une offre</a>
                  </li>
                  <li>
                    <a href="editer-offres.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-pencil-square-o fa-fw"></i> Editer les offres</a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-envelope-o fa-fw"></i> Demandes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="demandes.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-inbox fa-fw"></i> Demandes reçues</a>
                  </li>
                  <li>
                    <a href="reponses.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-paper-plane-o fa-fw"></i> Réponses envoyées</a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Mon compte<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="profil.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-info fa-fw"></i> Mon profil</a>
                  </li>
                  <li>
                    <a href="../deconnexion.php?id_employeur=<?php echo $_SESSION['id_employeur'];?>"><i class="fa fa-sign-out fa-fw"></i> Déconnexion </a>
                  </li>
                </ul> <!-- fin du nav-second-level -->
              </li>
            </ul>
          </div> <!-- Fin du sidebar-collapse -->
        </div> <!-- Fin du navbar-static-side -->
        </nav>

        <!-- Début du wraper -->
        <div id="page-wrapper" style="padding-top:10px;">
        <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header text-center">Edition des offres</h3>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
              <?php
                if(isset($_SESSION['id_employeur']) and isset($_SESSION['id_employeur']) > 0 and isset($_GET['message']))
                {
                  echo "<div class='alert alert-success alert-dismissible fade in' role='alert'>";
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
            <div class="col-lg-12">
              <?php
                $reponse = $bdd->prepare('SELECT * FROM offre WHERE id_employeur = ?');
                $reponse->execute(array($_SESSION['id_employeur']));
                while ($donnees = $reponse->fetch())
                {
                  echo "<div class='col-sm-6 col-md-4'>";
                     echo "<div class='thumbnail'>";
                        echo "<div class='caption'>";
                          echo "<h3>".$donnees['intitule']."</h3>";
                          echo "<hr/>";
                          echo "<p>".'Qualifiction requise : '.$donnees["qualification_requise"]."</p>";
                          echo "<p>".'Type de contrat : '.strtoupper($donnees["type_contrat"])."</p>";
                          echo "<button class='btn btn-block btn-lg' data-toggle='modal' data-target='#myModal'>".'Afficher offre'."</button>";
                          echo "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog'>";
                              echo "<div class='modal-content'>";
                                echo "<div class='modal-header'>";
                                  echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>".'&times;'."</button>";
                                  echo "<h4 class='modal-title' id='myModalLabel'>".$donnees["intitule"]."</h4>";
                                echo "</div>";
                                echo "<div class='modal-body'>";
                                    echo "<h4>".'Qalification requise :'."</h4>";
                                    echo $donnees["qualification_requise"];
                                    echo "<h4>".'Type de contrat :'."</h4>";
                                    echo "<p>".strtoupper($donnees['type_contrat'])."</p>";
                                    echo "<h4>".'Date de publication :'."</h4>";
                                    echo "<p>".$donnees['date_publication']."</p>";
                                    echo "<h4>".'Date de Limite :'."</h4>";
                                    echo "<p>".$donnees['date_limite']."</p>";
                                    echo "<h4>".'Lieu de dépôt :'."</h4>";
                                    echo "<p>".$donnees['lieu_depot']."</p>";
                                    echo "<h4>".'Commentaire :'."</h4>";
                                    echo "<p>".$donnees['commentaire']."</p>";
                                    echo "<hr/>";
                                    echo "<p>"."<a href='modifier-offres.php?id_employeur=".$_SESSION['id_employeur']."&id_offre=".$donnees['id_offre']."' class='btn btn-warning' role='button'>".'Modifier'."</a>"."<a href='supression.php?id_employeur=".$donnees['id_offre']."' class='btn btn-danger pull-right' role='button'>".'Supprimer'."</a>"."</p>";
                                echo "</div>";
                              echo "</div>";
                            echo "</div>";
                           echo "</div>";
                          echo "</div>";
                        echo "</div>";
                      echo "</div>";
                }
                $reponse->closeCursor();
              ?>
            </div>
          </div>
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