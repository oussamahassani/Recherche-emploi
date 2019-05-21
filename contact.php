<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ces 3 meta tags *doivent* venir en premier dans le head; N'importe quelle autre élément d'en tête doit venir *après* ces tags -->
    <meta name="description" content="Site de la promotion de l'emploi">
    <link rel="icon" href="includes/img/terre.gif">
    <title>Site de la promotion de l'emploi</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts personnalisés -->
    <link href="includes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"
    <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
    <link href="includes/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Juste pour les debugging. Ne pas copier actuellement ces 2 lignes! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="includes/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js pour le support de IE8 des elements HTML5 et des media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/  html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="chromesniffer" id="chromesniffer_meta" content="{&quot;jQuery&quot;:&quot;1.12.4&quot;,&quot;Bootstrap&quot;:-1}">
    <script type="text/javascript" src="chrome-extension://fhhdlnnepfjhlhilgmeepgkhjmhhhjkh/js/detector.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">recherche-emploi.com</a>
          </div><!-- Fin ddu navbar-header -->
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
              <li class="active">
                <a href="index.php">Accueil</a>
              </li>
              <li>
                <a href="index.php"></a>
              </li>
              <li>
                <a href="index.php"></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Aide <strong class="caret"></strong></a>  
                <ul class="dropdown-menu">  
                  <li class="dropdown-header">Contacts</li>  
                  <li>
                    <a href="contact.php">Nous contacter</a>
                  </li> 
                  <li class="divider"></li>     
                  <li>
                    <a href="aprpos.php">À propos de nous</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mon compte<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="pages/connexion-demandeur.php"><span class="glyphicon glyphicon-user"></span> Demandeur</a>
                  </li>     
                  <li class="divider"></li>
                  <li>
                    <a href="pages/connexion-employeur.php"><span class="glyphicon glyphicon-user"></span> Employeur</a>
                  </li> 
                  <li>
                  </li>
                </ul>
              </li>
            </ul><!-- end nav pull-right -->
          </div>
        </div><!-- Fin du container fluid -->
      </nav><!-- Fin du navbar -->
      <!-- Header Carousel -->
      <header id="myCarousel" class="carousel slide" style="margin-top:50px;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="includes/img/emploi.jpg">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="includes/img/chercheur.png">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="includes/img/street-view.jpg">
                <div class="carousel-caption">
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
      <div class="container">
        <!-- Fonctionnalités -->
        <div class="row">
          <div class="col-lg-12">
                <h3 class="page-header text-center">
                    Bienvenue dans notre site dédié aux demandeurs d'emploi et aux recruteurs du monde entier <img src="includes/img/terre.gif" height="40">
                </h3>
            </div>
         
      
        
								<form role="form" id="footer-form">
									<div class="form-group has-feedback">
										<label class="sr-only" for="name2">Name</label>
										<input type="text" class="form-control" id="name2" placeholder="Votre nom" name="name2" required>
										<i class="fa fa-user form-control-feedback"></i>
									</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="email2">Email address</label>
										<input type="email" class="form-control" id="email2" placeholder="Votre email" name="email2" required>
										<i class="fa fa-envelope form-control-feedback"></i>
									</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="message2">Message</label>
										<textarea class="form-control" rows="8" id="message2" placeholder="Laissez votre message" name="message2" required></textarea>
										<i class="fa fa-pencil form-control-feedback"></i>
									</div>
									<input type="submit" value="Envoyez" class="btn btn-default">
								</form>
							</div>
         
        </div>
         
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Vous avez trouvé votre bonheur en visitant notre site web, vous avez été satisfait par la qualité de nos services ou tout simplement vous avez des choses à nous signaler. Faites-nous le savoir en postant un commentaire</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Poster un commentraire</a>
                </div>
            </div>
        </div>
        <hr>
        <footer>
          <p>Copyright © Informatique Appliquée 2016.</p>
        </footer>
      </div>
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placé à la fin du document pour un chargement rapide de la page -->
      <script src="includes/js/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="includes/js/jquery.min.js"><\/script>')</script>
      <script src="includes/bootstrap/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack pour Surface/desktop Windows 8 bug -->
      <script src="includes/js/ie10-viewport-bug-workaround.js"></script>
      <!-- La validation des formulaires avec jQuery Validate -->
      <script type="text/javascript" src="includes/js/jquery.min.js"></script>
  </body>
</html>