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
            $nom = $infosDemandeur['prenom'];
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
              <h2 class="page-header text-center" id="titre"><i class="fa fa-search" aria-hidden="true"></i> Rechercher une offre d'emploi</h2>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="page-header">
                <div class="col-md-6">
                    <h4><i class="fa fa-keyboard-o" aria-hidden="true"></i> Veuillez entrer l'intitulé de l'emploi que vous recherchez</h4>
                </div>
                <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class=" col-md-6 input-group custom-search-form">
                  <input type="text" class="form-control" name="intitule" placeholder="Exemple : Développeur PHP">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="rechercher">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div> <!-- Fin du input-group -->
                </form>
              </div>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><i class="fa fa-list" aria-hidden="true"></i> Cliquez sur une offre pour afficher les détails</h3>
                </div>
                <div class="panel-body">
                <?php
                    if (isset($_POST['rechercher']))
                    {
                        $intitule = htmlspecialchars($_POST['intitule']);
                        $reponse = $bdd->prepare("SELECT * FROM employeur, offre WHERE employeur.id_employeur = offre.id_employeur and intitule LIKE ?");
                        $reponse->execute(array('%'.$intitule.'%'));
                        $resultat = $reponse->rowCount();
                        if ($resultat == 0)
                        {
                            echo "<div class='alert alert-danger' role='alert'>";
                            echo "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
                            echo "<span class='sr-only'>".'Error:'."</span>".' La recherche n\'a donné aucun résultat';
                          echo "</div>";
                        }
                        else
                        {

                while ($donnees = $reponse->fetch())
                {
                    echo "<li class='list-group-item'>"."<a href='localiser.php?id_employeur=".$donnees['id_employeur']."&id_offre=".$donnees['id_offre']."'>".$donnees['intitule'].", ".strtoupper($donnees['type_contrat'])."</a>"."</li>";
                }
                $reponse->closeCursor();
                    }
                }
                ?>
                </div>
                </div>
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
