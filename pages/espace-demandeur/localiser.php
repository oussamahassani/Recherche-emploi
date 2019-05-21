<?php
    session_start();

    include ("../connexion.php");

    $idEmployeur = $idOffre = $idDemandeur = $nom = $intitule = $motivation = $message = "";

    if (isset($_GET['id_employeur']) and $_GET['id_employeur'] > 0)
    {     
        $requeteEmployeur = $bdd->prepare('SELECT * FROM employeur, offre WHERE employeur.id_employeur = offre.id_employeur and employeur.id_employeur = ?');
        $requeteEmployeur->execute(array($_GET['id_employeur']));
        $infosEmployeur = $requeteEmployeur->fetch();

        // Récupèration des informations de l'organisation

        $nomEmployeur = $infosEmployeur['nom_organisation']; 
    }

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
    <title>Site de recherche d'emploi</title>

    <!-- Fichiers CSS Bootstrap -->
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fichiers CSS personalisés -->
    <link href="../../includes/sb-admin-2/sb-admin-2.css" rel="stylesheet">
    <link href="../../includes/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../../includes/css/style.css" rel="stylesheet" type="text/css">

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
              <h2 class="page-header text-center" id="titre"><?php echo $nomEmployeur?></h2>
            </div> <!-- Fin du col-lg-12 -->
          </div> <!-- Fin du row -->
        <div class="row">
              <div class="col-lg-12">
                <div class="thumbnail">
                <div class="caption">
                  <h3 class="text-center">Informations de la société</h3>
                  <hr class="separator"/>
                  <div id="map"></div>
                  <hr class="separator"/>
                  <div class="row">
                    <div class="container-fluid">
                        <div class="col-md-4">
                          <h4><i class="fa fa-pencil" aria-hidden="true"></i> Nom de la société : </h4>
                          <?php echo $infosEmployeur["nom_organisation"]; ?>
                          <h4><i class="fa fa-arrows" aria-hidden="true"></i> Secteur d'activité : </h4>
                          <?php echo $infosEmployeur["secteur_activite"]; ?>
                        </div>
                        <div class="col-md-4">
                          <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Adresse : </h4>
                          <?php echo $infosEmployeur["adresse"]; ?>
                          <h4><i class="fa fa-flag" aria-hidden="true"></i> Pays : </h4>
                          <?php echo $infosEmployeur["pays"]; ?>
                        </div>
                        <div class="col-md-4">
                          <h4><i class="fa fa-globe" aria-hidden="true"></i> Site web : </h4>
                          <?php echo $infosEmployeur["site_web"]; ?>
                          <h4><i class="fa fa-envelope" aria-hidden="true"></i> Adresse mail : </h4>
                          <?php echo $infosEmployeur["email"]; ?>
                        </div>    
                    </div>
              </div>
                </div>
              </div>  
        </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
            <div class="thumbnail">
              <div class="caption">
                <h3 class="text-center">Informations sur l'offre</h3>
                <hr class="separator"/>
                  <?php
                    echo "<p>"."<strong>".'Intitulé de l\'offre : '."</strong>". $infosEmployeur['intitule']."</p>"; 
                    echo "<p>"."<strong>".'Qualification requise : '."</strong>". $infosEmployeur['qualification_requise']."</p>";
                    echo "<p>"."<strong>".'Type de contrat : '."</strong>". strtoupper($infosEmployeur['type_contrat'])."</p>";
                    echo "<p>"."<strong>".'Date de publication : '."</strong>". $infosEmployeur['date_publication']."</p>";
                    echo "<p>"."<strong>".'Date limite : '."</strong>". $infosEmployeur['date_limite']."</p>";
                    echo "<p>"."<strong>".'Lieu de dépôt de dossier : '."</strong>". $infosEmployeur['lieu_depot']."</p>";
                    echo "<p>"."<strong>".'Commentaire : '."</strong>". $infosEmployeur['commentaire']."</p>";
                  ?>
                <hr class="separator"/>
                <a  href="traitements.php?id_offre=<?php echo $_GET['id_offre']?>" type="button" class="btn btn-block"> Envoyer ma candidature</a>  
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
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key= AIzaSyDq7lVg0pcWE-jLwhpKkQC_JZM5Zko4pp8"></script>
    <script type="text/javascript">
      $(function () {

    function initMap() {

        var location = new google.maps.LatLng(<?php echo $infosEmployeur['latitude']; ?>, <?php echo $infosEmployeur['longitude']; ?>);

        var mapCanvas = document.getElementById('map');
        var mapOptions = {
            center: location,
            zoom: 16,
            panControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        var markerImage = '../../includes/img/marker.png';

        var marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: markerImage
        });

        var contentString = '<?php echo $nomEmployeur; ?>'

        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 400
        });

        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initMap);
});

    </script>
    <!-- Tinymce -->
    <script src="../../includes/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </body>
</html>
