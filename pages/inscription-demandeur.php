<?php
 
  // Définition et initialisation des variables
  $prenom = $nom = $adresse = $pays = $telephone = $profession = $nomOrganisation = $anneeExperience = $email = $motPasse = $message = "";

  // Fonction de filtrage
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Vérification des champs
  if(isset($_POST['inscription']))
  {
    if (!empty($_POST['prenom']) and !empty($_POST['nom']) and !empty($_POST['adresse']) and !empty($_POST['telephone']) and !empty($_POST['profession']) and !empty($_POST['nomOrganisation']) and !empty($_POST['anneeExperience']) and !empty($_POST['email']) and !empty($_POST['emailConf']) and !empty($_POST['motPasse']) and !empty($_POST['motPasseConf']))
    {
      $prenom = test_input($_POST["prenom"]);
      $nom = test_input($_POST["nom"]);
      $adresse = test_input($_POST["adresse"]);
      $telephone = test_input($_POST["telephone"]);
      $profession = test_input($_POST["profession"]);
      $nomOrganisation = test_input($_POST["nomOrganisation"]);
      $anneeExperience = test_input($_POST["anneeExperience"]);
      $email = test_input($_POST["email"]);
      $motPasse = test_input($_POST["motPasse"]);
      if($email <> $_POST['emailConf'])
      {
        $message = "<font color='red'>"."Erreur adresses mail : Les adresses mails ne sont pas identiques"."</font>";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $message = "<font color='red'>"."Le format de l'adresse mail est invalide"."</font>";
      }
      if (!preg_match("/^[a-zA-Z ]*$/",$prenom))
      {
        $message = "<font color='red'>"."Erreur prénom : Seul les lettres et les spaces sont autorisés"."</font>";
      }
      if (!preg_match("/^[a-zA-Z ]*$/",$nom))
      {
        $message = "<font color='red'>"."Erreur prénom : Seul les lettres et les spaces sont autorisés"."</font>";
      }
      if($motPasse <> $_POST['motPasseConf'])
      {
        $message = "<font color='red'>"."Erreur mots de passe : Les mots de passe ne sont pas identiques"."</font>";
      }
      include "connexion.php";
      // Insertion des données
      $req = $bdd->prepare('INSERT INTO demandeur(prenom, nom, adresse, telephone, profession, nom_organisation, annee_experience, email, mot_passe) VALUES(:prenom, :nom, :adresse, :telephone, :profession, :nomOrganisation, :anneeExperience, :email, :motPasse)');
/*(prenom, nom, adresse, telephone, profession, nom_organisation, annee_experience, email, mot_passe) */
     $req->execute(array(

        'prenom' => $prenom,
        'nom' => $nom,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'profession' => $profession,
        'nomOrganisation' => $nomOrganisation,
        'anneeExperience' => $anneeExperience,
        'email' => $email,
        'motPasse' => $motPasse,)
      );
      $message = "<font color = 'green'>"."Vous avez été inscrit avec succès"."</font>";
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
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Ces 3 meta tags *doivent* venir en premier dans le head; N'importe quelle autre élément d'en tête doit venir *après* ces tags -->
  <meta name="description" content="Site de la promotion de l'emploi">
  <link rel="icon" href="../includes/img/terre.gif">
  <title>Inscription demandeur</title>
  <!-- Bootstrap core CSS -->
  <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
  <link href="../includes/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <!-- Styles personalisés pour ce template -->
  <link href="../includes/css/jumbotron.css" rel="stylesheet">
  <!-- Juste pour les debugging. Ne pas copier actuellement ces 2 lignes! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="../includes/js/ie-emulation-modes-warning.js"></script>
  <!-- HTML5 shim and Respond.js pour le support de IE8 des elements HTML5 et des media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <meta name="chromesniffer" id="chromesniffer_meta" content="{&quot;jQuery&quot;:&quot;1.12.4&quot;,&quot;Bootstrap&quot;:-1}">
      <script type="text/javascript" src="chrome-extension://fhhdlnnepfjhlhilgmeepgkhjmhhhjkh/js/detector.js"></script>
    </head>
    <body>
      <div class="container" id="principal">
         <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">recherche-emploi.com</a>
          </div><!-- Fin ddu navbar-header -->
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
              <li class="active">
                <a href="./index.php">Accueil</a>
              </li>
              <li>
                <a href="#">Forum</a>
              </li>
              <li>
                <a href="#">Conseils</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Aide <strong class="caret"></strong></a>  
                <ul class="dropdown-menu">  
                  <li class="dropdown-header">Contacts</li>  
                  <li>
                    <a href="#">Nous contacter</a>
                  </li> 
                  <li class="divider"></li>     
                  <li>
                    <a href="#">À propos de nous</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mon compte<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="connexion-demandeur.php"><span class="glyphicon glyphicon-user"></span> Demandeur</a>
                  </li>     
                  <li class="divider"></li>
                  <li>
                    <a href="connexion-employeur.php"><span class="glyphicon glyphicon-user"></span> Employeur</a>
                  </li> 
                  <li>
                  </li>
                </ul>
              </li>
            </ul><!-- end nav pull-right -->
          </div>
        </div><!-- Fin du container fluid -->
      </nav><!-- Fin du navbar -->
        <div class="container">
          <div id="signupbox" style="margin-top:100px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title center">Inscription</div>
                <p><?php echo $message ?></p>
              </div>  
              <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="prenom" value="" placeholder="Prénom">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="nom" value="" placeholder="Nom">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="adresse" value="" placeholder="Adresse">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                    <input type="text" class="form-control" name="pays" value="" placeholder="Votre pays">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input type="number" class="form-control" name="telephone" value="" placeholder="Téléphone">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                    <input type="text" class="form-control" name="profession" value="" placeholder="profession">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="nomOrganisation" value="" placeholder="Nom de l'organisation que vous ou avez fréquenté">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    <input type="text" class="form-control" name="anneeExperience" value="" placeholder="Nombre d'années d'expérience">
                  </div>
                   <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" class="form-control" name="email" value="" placeholder="email">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" class="form-control" name="emailConf" value="" placeholder="Confirmez votre adresse mail">
                  </div>
                   <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="motPasse" value="" placeholder="Mot de passe">
                  </div>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="motPasseConf" value="" placeholder="Confirmez votre mot de passe">
                  </div>
                  <div style="margin-top:10px" class="form-group">
                    <!-- Button -->
                    <div class="col-sm-12 controls">
                      <button class="btn btn-primary" type="submit" name="inscription">Inscription</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div> 
        </div><!-- Fin du container -->
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placé à la fin du document pour un chargement rapide de la page -->
    <script src="..includes//js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../includes/js/jquery.min.js"><\/script>')</script>
    <script src="../includes/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
    <script src="../includes  /js/ie10-viewport-bug-workaround.js"></script>
  </body>
  </html>