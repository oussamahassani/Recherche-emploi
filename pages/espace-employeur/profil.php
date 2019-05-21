<!-- Réception des données -->

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
            $nomOrganisationF = $infosEmployeur['nom_organisation'];
            $secteurActiviteF = $infosEmployeur['secteur_activite'];
            $adresseF = $infosEmployeur['adresse'];
            $paysF = $infosEmployeur['pays'];
            $siteWebF = $infosEmployeur['site_web'];
            $telephoneF = $infosEmployeur['telephone'];
            $latitudeF = $infosEmployeur['latitude'];
            $longitudeF = $infosEmployeur['longitude'];
            $emailF = $infosEmployeur['email'];
            $motPasseF = $infosEmployeur['mot_passe'];
        }
    }
?>

<!-- Mises à jou du profil -->

<?php
  // Définition et initialisation des variables
  $nomOrganisation = $secteurActivite = $adresse = $pays = $siteWeb = $telephone = $latitude = $longitude = $email = $motPasse = $message = "";

  // Fonction de filtrage
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Vérification des champs
  if(isset($_POST['updateProfil']))
  {
    if (!empty($_POST['nomOrganisation']) and !empty($_POST['secteurActivite']) and !empty($_POST['adresse']) and !empty($_POST['pays']) and !empty($_POST['siteWeb']) and !empty($_POST['telephone']) and !empty($_POST['latitude']) and !empty($_POST['longitude']) and !empty($_POST['email']) and !empty($_POST['motPasse']))
    {
      $nomOrganisation = test_input($_POST["nomOrganisation"]);
      $secteurActivite = test_input($_POST["secteurActivite"]);
      $adresse = test_input($_POST["adresse"]);
      $pays = test_input($_POST["pays"]);
      $siteWeb = test_input($_POST["siteWeb"]);
      $telephone = test_input($_POST["telephone"]);
      $latitude = test_input($_POST["latitude"]);
      $longitude = test_input($_POST["longitude"]);
      $email = test_input($_POST["email"]);
      $motPasse = test_input($_POST["motPasse"]);
      if($email <> $_POST['emailConf'])
      {
        $message = "<font color='red'>"."Erreur adresses mail : Les adresses mails ne sont pas identiques"."</font>";
        $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = $infosEmployeur['pays'];
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $motPasseF = "";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $message = "<font color='red'>"."Le format de l'adresse mail est invalide"."</font>";
        $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = $infosEmployeur['pays'];
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";
      }
      if (!preg_match("/^[a-zA-Z ]*$/",$nomOrganisation))
      {
        $message = "<font color='red'>"."Erreur prénom : Seul les lettres et les spaces sont autorisés"."</font>";
      }
      if($motPasse <> $_POST['motPasseConf'])
      {
        $message = "<font color='red'>"."Erreur mots de passe : Les mots de passe ne sont pas identiques"."</font>";
        $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = $infosEmployeur['pays'];
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";
      }

      // Insertion des données
      $req = $bdd->prepare('UPDATE employeur SET nom_organisation = :nomOrganisation, secteur_activite = :secteurActivite, adresse = :adresse, pays = :pays, site_web = :siteWeb, telephone = :telephone, latitude = :latitude, longitude = :longitude, email = :email, mot_passe = :motPasse WHERE id_employeur = :idEmployeur');

      $req->execute(array(

        'nomOrganisation' => $nomOrganisation,
        'secteurActivite' => $secteurActivite,
        'adresse' => $adresse,
        'pays' => $pays,
        'siteWeb' => $siteWeb,
        'telephone' => $telephone,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'email' => $email,
        'motPasse' => $motPasse,
        'idEmployeur' => $_SESSION['id_employeur']
        ));
      $message = "<font color = 'green'>"."Votre profil a été mise à jour avec succès"."</font>";
      $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = "";
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";

            header("Location:index.php?id_employeur=".$_SESSION['id_employeur']);
    }
    else
    {
      $message = "<font color = 'red'>"."Vous devez remplir tous les champs"."</font>";
      $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = "";
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";
    }
     if (isset($_FILES['logo']) and !empty($_FILES['logo']['name']))
    {
      $tailleMax = 2000000;
      $extensionsValides = array('jpg','jpeg', 'gif', 'png');
      if ($_FILES['logo']['name'] <= $tailleMax)
      {
        $extensionsUpload = strtolower(substr(strrchr($_FILES['logo']['name'], '.'), 1));
        if (in_array($extensionsUpload, $extensionsValides))
        {
          $chemin = "logo/".$_SESSION['id_employeur'].".".$extensionsUpload; 
          $resultat = move_uploaded_file($_FILES['logo']['tmp_name'], $chemin);
            if ($resultat)
            {
              $updatePhoto = $bdd->prepare("UPDATE employeur SET logo = :logo WHERE id_employeur = :idEmployeur");
              $updatePhoto->execute(array(
                "logo" => $_SESSION['id_employeur'].".".$extensionsUpload,
                "idEmployeur" => $_SESSION['id_employeur']  
              )); 
            } 
            else
            {
              $message = "<font color='red'>"."Erreur photo :  Erreur lors de l'importation de votre fichier"."</font>";
            $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = "";
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";
            }
          }
          else
          {
            $message = "<font color='red'>"."Erreur photo : Votre logo doit être au format jpg, jpeg, gif ou png"."</font>";
             $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = "";
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";  
          }
        }
        else
        {
          $message = "<font color='red'>"."Erreur photo : Votre logo ne doit pas dépasser 2 MO"."</font>";
           $nomOrganisationF = "";
            $secteurActiviteF = "";
            $adresseF = "";
            $paysF = "";
            $siteWebF = "";
            $telephoneF = "";
            $latitudeF = "";
            $longitudeF = "";
            $emailF = "";
            $nomUtilisateurF = "";
            $motPasseF = "";
        }
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
              <h3 class="page-header text-center">Informations personnelles</h3>
            </div> <!-- Fin du col-lg-12 -->
            <div class="col-lg-12">
              <div>
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title">Inscription</div>
                <p><?php echo $message ?></p>
              </div>  
              <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <label>Votre logo : </label>
                 <div style="margin-bottom: 25px" class="input-group">
                    <input type="file" class="input-group" name="logo">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="nomOrganisation" value="<?php echo $nomOrganisationF; ?>" placeholder="Nom de votre organisation">
                  </div>
                   <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                    <input type="text" class="form-control" name="secteurActivite" value="<?php echo $secteurActiviteF; ?>" placeholder="Secteur d'activité">
                  </div>
                   <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="adresse" value="<?php echo $adresseF; ?>" placeholder="Adresse">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                    <input type="text" class="form-control" name="pays" value="<?php echo $paysF; ?>" placeholder="Pays">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                    <input type="text" class="form-control" name="siteWeb" value="<?php echo $siteWebF; ?>" placeholder="Site web">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input type="text" class="form-control" name="telephone" value="<?php echo $telephoneF; ?>" placeholder="Téléphone">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                    <input type="text" class="form-control" name="latitude" value="<?php echo $latitudeF; ?>" placeholder="Latitude">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                    <input type="text" class="form-control" name="longitude" value="<?php echo $longitudeF; ?>" placeholder="Longitude">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" class="form-control" name="email" value="<?php echo $emailF; ?>" placeholder="email">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" class="form-control" name="emailConf" value="<?php echo $emailF; ?>" placeholder="Confirmez votre adresse mail">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="motPasse" value="<?php echo $motPasseF; ?>" placeholder="Mot de passe">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="motPasseConf" value="<?php echo $motPasseF; ?>" placeholder="Confirmez votre mot de passe">
                  </div>
                  <div style="margin-top:10px" class="form-group">
                    <!-- Button -->
                    <div class="col-sm-12 controls">
                      <button class="btn btn-block" type="submit" name="updateProfil">Mettre à jour mon profil</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div> 
            </div>
            <div class="col-md-4">
              
            </div>
          </div> <!-- Fin du row -->
          <div class="row">
               
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
