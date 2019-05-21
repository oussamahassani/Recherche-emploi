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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Aide<strong class="caret"></strong></a>  
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
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="includes/img/je-cherche-emploi.jpg" alt="Demandeur">
              <h2>Demandeur</h2>
              <p>Vous êtes un demandeur d'emploi désireux de faire valoir ses compétences, grâce à votre espace personnelles, vous pouvez gèrer plus aisément votre CV, organiser vos favoris, gèrer les offres d'emploi, visualiser vos demandes d'emploi...</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="includes/img/employeur.jpg" alt="Employeur">
              <h2>Employeur</h2>
              <p>Si vous êtes un employeur à la recherche d'un CV en particulier, ce site est fait pour vous. Accèdez à votre espace dédié, gèrez vos offres d'emploi, parcourez des CV, recherchez des CV, consultez les demandes d'emploi...</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="includes/img/sms.jpg" alt="SMS">
              <h2>Restez à l'écoute</h2>
              <p>Les demandeurs d'emploi trouveront leur bonheur dans notre site web. En plus d'être notifié de la suite réservée à leur demande, un système d'alerte par SMS permettra aux demandeurs d'être informé de toute offre d'emploi figurant dans leurs favoris...</p>
            </div>
          </div>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Des conseillers sont là pour vous guider</h2>
            </div>
            <div class="col-md-6">
                <p>Que faire, en particulier en cas de chômage longue durée, pour garder un bon moral ? </p>
                <ol>
                    <li>Revoyez votre CV</li>
                    <li>Faites du bénévolat !</li>
                    <li>Retravaillez votre réponse à la question « Présentez-vous »</li>
                    <li>Faites du sport, bougez-vous.</li>
                    <li>Travaillez les exemples que vous allez donner en entretien.</li>
                    <li>Tenez un journal de vos petits bonheurs et de vos progrès</li>
                    <li>Ne restez pas isolé !</li>
                </ol>
                <p>En conclusion, je pense que se remotiver, c'est avant tout casser la routine, et tester des choses. Je pense qu'il faut se donner la liberté d'aller dans des directions qui sont nouvelles. Ce n'est pas forcément facile, mais c'est le prix à payer pour retrouver énergie et motivation.</p>
            </div>
            <div class="col-md-6">
              <div class="embed-responsive embed-responsive-16by9">
                <video src="includes/videos/motivation.mp4" controls type="video/mp4"></video>
              </div>
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
          <p>Copyright ©2019.</p>
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