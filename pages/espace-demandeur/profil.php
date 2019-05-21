<?php
    session_start();

    include ("../connexion.php");

    $message = "";

    if (isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0)
    {
        $idDemandeur = intval($_GET['id_demandeur']);
        $requeteDemandeur = $bdd->prepare('SELECT * FROM demandeur WHERE id_demandeur = ?');
        $requeteDemandeur->execute(array($idDemandeur));
        $infosDemandeur = $requeteDemandeur->fetch();

        if(isset($_SESSION['id_demandeur']) and $infosDemandeur['id_demandeur'] == $_SESSION['id_demandeur'])
        {
            $prenomF = $infosDemandeur['prenom'];
            $nomF = $infosDemandeur['nom'];
            $adresseF = $infosDemandeur['adresse'];
            $telephoneF = $infosDemandeur['telephone'];
            $emailF = $infosDemandeur['email'];
            $motPasseF = $infosDemandeur['mot_passe'];
        }
    }
?>

<?php
  // Définition et initialisation des variables
  $prenom = $nom = $profession = $nom_organisation = $annee_experience = $adresse = $telephone = $email = $motPasse = $message = "";

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
    if (!empty($_POST['prenom']) and !empty($_POST['nom']) and !empty($_POST['adresse']) and !empty($_POST['telephone']) and !empty($_POST['email']) and !empty($_POST['emailConf']) and !empty($_POST['motPasse']) and !empty($_POST['motPasseConf']))
    {
      $prenom = test_input($_POST["prenom"]);
      $nom = test_input($_POST["nom"]);
      $profession = test_input($_POST["profession"]);
      $nomOrganisation = test_input($_POST["nomOrganisation"]);
      $anneeExperience = test_input($_POST["anneeExperience"]);
      $adresse = test_input($_POST["adresse"]);
      $telephone = test_input($_POST["telephone"]);
      $email = test_input($_POST["email"]);
      $motPasse = test_input($_POST["motPasse"]);
      if($email <> $_POST['emailConf'])
      {
        $type = "danger";
        $message = "<strong>".'Erreur adresse mail !.'."</strong>". ' Erreur lors de la mise à jour de votre profil, les adresses mail ne sont pas identiques.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $type = "danger";
        $message = "<strong>".'Erreur adresse mail !.'."</strong>". ' Le format de votre adresse mail est invalide.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
      }
      if (!preg_match("/^[a-zA-Z ]*$/",$prenom))
      {
        $type = "danger";
        $message = "<strong>".'Erreur prénom !.'."</strong>". ' Seul les lettres et les espaces sont autorisées.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
      }
      if($motPasse <> $_POST['motPasseConf'])
      {
        $type = "danger";
        $message = "<strong>".'Erreur mot de passe !.'."</strong>". ' Les mots de passe ne concordent pas.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
      }
      // Insertion des données
      $req = $bdd->prepare("UPDATE demandeur SET prenom = :prenom, nom = :nom, profession = :profession, nom_organisation = :nomOrganisation, annee_experience = :anneeExperience, adresse = :adresse, telephone = :telephone, email = :email, mot_passe = :motPasse WHERE id_demandeur = ".$_SESSION['id_demandeur']);

      $req->execute(array(

        'prenom' => $prenom,
        'nom' => $nom,
        'profession' => $profession,
        'nomOrganisation' => $nomOrganisation,
        'anneeExperience' => $anneeExperience,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'email' => $email,
        'motPasse' => $motPasse,)
      );
      $type = "success";
        $message = "<strong>".'Mise à jour réussie !.'."</strong>". ' Votre profil a été mise à jour avec succès.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
    }
    else
    {
      $type = "danger";
        $message = "<strong>".'Erreur lors de la mise à jour !.'."</strong>". ' Vous devez remplir tous les champs.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
    }
    if (isset($_FILES['photo']) and !empty($_FILES['photo']['name']))
    {
      $tailleMax = 2000000;
      $extensionsValides = array('jpg','jpeg', 'gif', 'png');
      if ($_FILES['photo']['name'] <= $tailleMax)
      {
        $extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
        if (in_array($extensionsUpload, $extensionsValides))
        {
          $chemin = "photo/".$_SESSION['id_demandeur'].".".$extensionsUpload; 
          $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            if ($resultat)
            {
              $updatePhoto = $bdd->prepare("UPDATE demandeur SET photo = :photo WHERE id_demandeur = :idDemandeur");
              $updatePhoto->execute(array(
                "photo" => $_SESSION['id_demandeur'].".".$extensionsUpload,
                "idDemandeur" => $_SESSION['id_demandeur']  
              )); 
            } 
            else
            {
              $type = "danger";
        $message = "<strong>".'Erreur photo !.'."</strong>". ' Une erreur s\'est produite lors de l\'impotation de votre photo.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
            }
          }
          else
          {
            $type = "danger";
        $message = "<strong>".'Erreur photo !.'."</strong>". ' Votre photo doit être au format jpg, jpeg, gif ou png.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
          }
        }
        else
        {
          $type = "danger";
        $message = "<strong>".'Erreur photo !.'."</strong>". ' La taille de votre photo ne doit pas dépasser 2MO.';
        header("Location: index.php?id_demandeur=".$_SESSION['id_demandeur']."&type=".$type."&message=".$message);
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
              <h2 class="page-header text-center" id="titre"><i class="fa fa-user" aria-hidden="true"></i> Mon profil</h2>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
          <div class="row">
            <div class="col-md-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title center">Profil</div>
                <p><?php echo $message ?></p>
              </div>  
              <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <label>Votre photo : </label>
                 <div style="margin-bottom: 25px" class="input-group">
                    <input type="file" class="input-group" name="photo">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenomF; ?>" placeholder="Prénom">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="nom" value="<?php echo $nomF; ?>" placeholder="Nom">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="adresse" value="<?php echo $adresseF; ?>" placeholder="Adresse">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input type="number" class="form-control" name="telephone" value="<?php echo $telephoneF; ?>" placeholder="Téléphone">
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
      <div class="row">
               
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
