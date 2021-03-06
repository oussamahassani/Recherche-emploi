<?php
    session_start();

    include ("../connexion.php");

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

    // Supression d'une offre

   /* if (isset($_GET['id_offre']) and $_GET['id_offre'] > 0)
    {
        $idOffre = intval($_GET['id_offre']);
        $requeteOffre = $bdd->prepare('DELETE  FROM offre WHERE id_offre  =  $idOffre');
        $requeteOffre->execute(array($idOffre));

        $message = "Offre supprimé avec succès";
    }
*/
    // Envoi d'une notification

    if (isset($_GET['id_employeur']) and $_GET['id_employeur'] > 0 and isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0 and isset($_POST['reponse']))
    {
        if (!empty($_POST['reponse']))
        {
        $idEmployeur = intval($_GET['id_employeur']);
        $idDemandeur = intval($_GET['id_demandeur']);
        $reponse = htmlspecialchars($_POST['reponse']);
        $requeteNotifier = $bdd->prepare('INSERT INTO notifier VALUES(:dateNotification, :reponse, :idDemandeur, :idEmployeur)');
        $requeteNotifier->execute(array(
          "dateNotification" => date('Y-m-d'),
          "reponse" => $reponse,
          "idDemandeur" => $idDemandeur,
          "idEmployeur" => $idEmployeur
          )
        );
        $message = "<strong>".'Notification réussie !.'."</strong>". ' Votre réponse a été transmise avec sussès.';
      header("Location: demandes.php?id_employeur=".$idEmployeur."&message=".$message);
      }
      else
      {
         $message = "Erreur";
      header("Location: demandes.php?id_employeur=".$idEmployeur."&message=".$message);
      }
    }

    // Mise à jour d'une offre

    // Définition et initialisation des variables

  $intituleOffre = $qualificationRequise = $typeContrat = $datePublication = $dateLimite = $lieuDepot = $commentaire = $message = "";

  // Fonction de filtrage

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Vérification des champs

  if(isset($_GET['id_employeur']) and $_GET['id_employeur'] > 0 and isset($_GET['id_offre']) and $_GET['id_offre'] > 0)
  {
    $idEmployeur = intval($_GET['id_employeur']);
    $idOffre = intval($_GET['id_offre']);

    if (!empty($_POST['intituleOffre']) and !empty($_POST['qualificationRequise']) and !empty($_POST['typeContrat']) and !empty($_POST['datePublication']) and !empty($_POST['dateLimite']) and !empty($_POST['lieuDepot']) and !empty($_POST['commentaire']))
    {
      $intituleOffre = test_input($_POST["intituleOffre"]);
      $qualificationRequise = test_input($_POST["qualificationRequise"]);
      $typeContrat = test_input($_POST["typeContrat"]);
      $datePublication = test_input($_POST["datePublication"]);
      $dateLimite = test_input($_POST["dateLimite"]);
      $lieuDepot = test_input($_POST["lieuDepot"]);
      $commentaire = test_input($_POST["commentaire"]);

      // Mises à jour des données

      $req = $bdd->prepare('UPDATE offre SET intitule = :intituleOffre, qualification_requise = :qualificationRequise, type_contrat = :typeContrat, date_publication = :datePublication, date_limite = :dateLimite, lieu_depot = :lieuDepot, commentaire = :commentaire WHERE id_employeur = :idEmployeur and id_offre = :idOffre');

      $req->execute(array(
        'intituleOffre' => $intituleOffre,
        'qualificationRequise' => $qualificationRequise,
        'typeContrat' => $typeContrat,
        'datePublication' => $datePublication,
        'dateLimite' => $dateLimite,
        'lieuDepot' => $lieuDepot,
        'commentaire' => $commentaire,
        'idEmployeur' => $idEmployeur,
        'idOffre' => $idOffre)
      );
      $message = "<strong>".'Mises à jour réussie !.'."</strong>". ' L\'offre a été mise à jour avec succès.';
      header("Location: editer-offres.php?id_employeur=".$idEmployeur."&message=".$message);
    }
    else
    {
      $message = "<font color = 'red'>"."Vous devez remplir tous les champs"."</font>";
      echo $message;
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
         <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header">Bienvenue <?php/* echo $nom*/ ?> dans votre espace personnel </h3>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
          <div class="container-fluid">
              <div class="col-lg-12">
                
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