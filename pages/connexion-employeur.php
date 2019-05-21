<?php
  session_start();

   include ("connexion.php");
  
  // Définiion et initialisation des variables
  $email = $motPasse = $message = "";

  // Fonction de filtrage
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Vérification des champs
  if (isset($_POST['connexion']))
  {
    if (!empty($_POST['email']) and !empty($_POST['motPasse']))
    {
      $email = test_input($_POST['email']);
      $motPasse = test_input($_POST['motPasse']);
      $requeteEmployeur = $bdd->prepare("SELECT * FROM employeur WHERE email = ? and mot_passe = ?");
      $requeteEmployeur->execute(array($email, $motPasse));
      $employeurExist = $requeteEmployeur->rowcount();
      if ($employeurExist == 1)
      {
        $infosEmployeur = $requeteEmployeur->fetch();
        $_SESSION['id_employeur'] = $infosEmployeur['id_employeur'];
        header("Location: espace-employeur/index.php?id_employeur=".$_SESSION['id_employeur']);
      }
      else
        $message = "<font color = 'red'>"."Nom d'utilisateur et / ou mot de passe incorrect"."</font>";
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
    <title>Connexion employeur</title>
    <!-- Bootstrap core CSS -->
    <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
    <link href="../includes/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Styles personalisés pour ce template -->
    <link href="../includes/css/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
            <a class="navbar-brand" href="liens/index.php">recherche-emploi.com</a>
          </div><!-- Fin ddu navbar-header -->
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
              <li class="active">
                <a href="../index.php">Accueil</a>
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
                    <a href="#"><span class="glyphicon glyphicon-user"></span> Employeur</a>
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
        <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info" >
            <div class="panel-heading">
              <div class="panel-title text-center">Accèder à l'espace employeur</div>
              <p><?php echo $message ?></p>
            </div>
            <div style="padding-top:30px" class="panel-body" >
              <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
              <form id="loginform" class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="email" type="email" class="form-control" name="email" value="" placeholder="Adresse mail">
                </div>
                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="motPasse" type="password" class="form-control" name="motPasse" placeholder="Mot de passe">
                </div>
                <div style="margin-top:10px" class="form-group">
                  <!-- Button -->
                  <div class="col-sm-12 controls">
                    <button class="btn btn-primary" type="submit" name="connexion">Connexion</button>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                      Vous n'avez pas de compte! 
                      <a href="inscription-employeur.php">Incrivez-vous</a>
                    </div>
                  </div>
                </div>    
              </form>
            </div>                     
          </div>  
        </div> 
      </div><!-- Fin du container -->
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placé à la fin du document pour un chargement rapide de la page -->
      <script src="../includes/js/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../includes/js/jquery.min.js"><\/script>')</script>
      <script src="../includes/bootstrap/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
      <script src="../includes/js/ie10-viewport-bug-workaround.js"></script>
    </div>
  </body>
</html>