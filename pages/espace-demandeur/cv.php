<?php
    session_start();

    include ("../connexion.php");

    $message = $nom = "";

    if (isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0)
    {
        $idDemandeur = intval($_GET['id_demandeur']);
        $requeteDemandeur = $bdd->prepare('SELECT * FROM demandeur WHERE id_demandeur = ?');
        $requeteDemandeur->execute(array($idDemandeur));
        $infosDemandeur = $requeteDemandeur->fetch();
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
        <div id="page-wrapper" style="padding-top:10px;">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="page-header text-center" id="titre"><i class="fa fa-list-alt" aria-hidden="true"></i> Mes CV</h2>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
              <?php
                if(isset($_SESSION['id_demandeur']) and isset($_SESSION['id_demandeur']) > 0 and isset($_GET['id_demandeur']) and isset($_GET['id_demandeur']) > 0 and isset($_GET['type']) and isset($_GET['message']))
                {
                  echo "<div class='alert alert-".$_GET['type']."' alert-dismissible' role='alert'>";
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
                if (isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0 and $_SESSION['id_demandeur'] == $infosDemandeur['id_demandeur'])
                {
                  $idDemandeur = intval($_GET['id_demandeur']);
                  $reponse = $bdd->prepare("SELECT * FROM cv, demandeur WHERE cv.id_demandeur = demandeur.id_demandeur and demandeur.id_demandeur = ?");
                  $reponse->execute(array($_SESSION['id_demandeur']));
                  $i = 0;
                  while ($donnees = $reponse->fetch())
                  {
                    ?>      
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default" id="panel<?php echo $i;?>">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapse<?php echo $i;?>" 
                               href="#collapseOne"> <?php echo $donnees['profession'] ?>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $i;?>" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <?php
                             echo $donnees['description'];
                              echo "<hr/>";
                                echo "<div class='container-fluid'>";
                                echo "<p>"."<a href='editer-cv.php?id_demandeur=".$donnees['id_demandeur']."&id_cv=".$donnees['id_cv']."' class='btn btn-warning' role='button'>".'Modifier'."</a>"."<a href='supression.php?id_demandeur=".$donnees['id_demandeur']."&id_cv=".$donnees['id_cv']."' class='btn btn-danger pull-right' role='button'>".'Supprimer'."</a>"."</p>";
                                echo "</div>";  
                            ?>
                          </div>
                        </div>
                      </div>
                    <?php
                    $i++;
                    echo "<br/>";
                  }
                  $reponse->closeCursor();
                }
              ?>
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
