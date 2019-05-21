<?php
    session_start();

    $nom = "";

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
?>

<?php
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
  if(isset($_POST['publier']))
  {
    if (!empty($_POST['intituleOffre']) and !empty($_POST['qualificationRequise']) and !empty($_POST['typeContrat']) and !empty($_POST['datePublication']) and !empty($_POST['dateLimite']) and !empty($_POST['lieuDepot']) and !empty($_POST['commentaire']))
    {
      $intituleOffre = test_input($_POST["intituleOffre"]);
      $qualificationRequise = test_input($_POST["qualificationRequise"]);
      $typeContrat = test_input($_POST["typeContrat"]);
      $datePublication = test_input($_POST["datePublication"]);
      $dateLimite = test_input($_POST["dateLimite"]);
      $lieuDepot = test_input($_POST["lieuDepot"]);
      $commentaire = test_input($_POST["commentaire"]);

      // Insertion des données
      $req = $bdd->prepare('INSERT INTO offre(intitule, qualification_requise, type_contrat, date_publication, date_limite, lieu_depot, commentaire,id_employeur) VALUES(:intituleOffre, :qualificationRequise, :typeContrat, :datePublication, :dateLimite, :lieuDepot, :commentaire,:idEmployeur)');

      $req->execute(array(
        'intituleOffre' => $intituleOffre,
        'qualificationRequise' => $qualificationRequise,
        'typeContrat' => $typeContrat,
        'datePublication' => $datePublication,
        'dateLimite' => $dateLimite,
        'lieuDepot' => $lieuDepot,
        'commentaire' => $commentaire,
       'idEmployeur' => $_SESSION['id_employeur'],)
      );
      $message = "<font color = 'green'>"."L'offre a été publié avec succès"."</font>";
    }
    else
    {
      $message = "<font color = 'red'>"."Vous devez remplir tous les champs"."</font>";
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
        <div id="page-wrapper" style="padding-top:10px; " >
        <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header text-center">Publier une offre</h3>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-lg-12">
               <div class="panel-group">
                  <div class="panel panel-primary">
                    <div class="panel-heading text-center">Publiez votre offre d'emploi en ligne</div>
                    <div class="panel-body">
                      <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                          <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input type="text" class="form-control" name="intituleOffre" placeholder="Intitulé de l'offre">
                          </div>
                        </div>
                        <div class="form-group">
                          <div style="margin-bottom: 25px" class="  input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                            <input type="text" class="form-control" name="qualificationRequise" placeholder="Qualification requise">
                          </div>
                        </div>
                        <fieldset class="form-group">
                          <legend>Type de contrat</legend>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="typeContrat" id="cdd" value="cdd" checked> Contrat à durée déterminée (CDD)
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="typeContrat" id="cdi" value="cdi"> Contrat à durée indéterminée (CDI)
                            </label>
                          </div>
                        </fieldset>
                        <hr class="separator">
                        <div class="form-group">
                          <div style="margin-bottom: 25px" class="  input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok  "></i></span>
                            <input type="text" class="form-control" name="datePublication" placeholder="Date de publication">
                          </div>
                        </div>
                        <div class="form-group">
                          <div style="margin-bottom: 25px" class="  input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-remove  "></i></span>
                            <input type="text" class="form-control" name="dateLimite" placeholder="Date limite">
                          </div>
                        </div>
                        <div class="form-group">
                          <div style="margin-bottom: 25px" class="  input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home  "></i></span>
                            <input type="text" class="form-control" name="lieuDepot" placeholder="Lieu de dépôt">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="comment">Commentaire:</label>
                          <textarea class="form-control" rows="5" id="comment" name="commentaire"></textarea>
                        </div>
                        <button type="submit" class="btn btn-block" name="publier">Publier une offre d'emploi</button> <?php echo $message; ?>
                      </form>
                    </div>
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
