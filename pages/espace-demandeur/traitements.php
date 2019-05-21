<?php
    session_start();

    include ("../connexion.php");

  // Fonction de filtrage

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // Gestion des CV

    // Publication

    if (isset($_SESSION['id_demandeur']) and isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0 and isset($_POST['profession']) and isset($_POST['nomOrganisation']) and isset($_POST['anneeExperience']) and isset($_POST['description']))
    {
      if (!empty(($_POST['description'])))
      {
        $idDemandeur = intval($_GET['id_demandeur']);
        $profession = $_POST['profession'];
        $nomOrganisation = $_POST['nomOrganisation'];
        $anneeExperience = $_POST['anneeExperience'];
        $description = $_POST['description'];
        $requeteDemandeur = $bdd->prepare('INSERT INTO cv (profession, nom_organisation, annee_experience, description, id_demandeur) VALUES (:profession, :nomOrganisation, :anneeExperience, :description, :idDemandeur)');
        $requeteDemandeur->execute(array(
          "profession" => $profession,
          "nomOrganisation" => $nomOrganisation,
          "anneeExperience" => $anneeExperience,
          "description" => $description,
          "idDemandeur" => $idDemandeur,)
        );
        $type = "success";
        $message = "<strong>".'Publication réussie !.'."</strong>". ' Vous avez publié votre  CV avec succès.';
        header("Location: publier-cv.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
      }
      else
      {
        $idDemandeur = intval($_GET['id_demandeur']);
        $type = "danger";
        $message = "<strong>".'Publication impossible !.'."</strong>". ' Vous devez donner une description de votre CV.';
        header("Location: publier-cv.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
      }
    }

    // Modification

    if (isset($_SESSION['id_demandeur']) and isset($_GET['id_demandeur']) and $_GET['id_demandeur'] > 0 and isset($_GET['id_cv']) and $_GET['id_cv'] > 0 and isset($_POST['profession']) and isset($_POST['nomOrganisation']) and isset($_POST['anneeExperience']) and isset($_POST['modifierCV']))
    {
      if (!empty(($_POST['modifierCV'])))
      {
        $idDemandeur = intval($_GET['id_demandeur']);
        $idCV = intval($_GET['id_cv']);
        $profession = $_POST['profession'];
        $nomOrganisation = $_POST['nomOrganisation'];
        $annee_experience = $_POST['anneeExperience'];
        $description = $_POST['modifierCV'];
        $requeteDemandeur = $bdd->prepare('UPDATE cv SET profession = :profession, nom_organisation = :nomOrganisation, description = :description WHERE id_cv = :idCV');
        $requeteDemandeur->execute(array(    /*annee_experience = :anneeExperience,*/                   
          "profession" => $profession,
          "nomOrganisation" => $nomOrganisation,
         /* "anneeExperience" => $anneeExperience,*/
          "description" => $description,
          "idCV" => $idCV)
        );
        $type = "success";
        $message = "<strong>".'Modification réussie !.'."</strong>". ' Vous avez modifié votre  CV avec succès.';
        header("Location: cv.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
      }
      else
      {
        $idDemandeur = intval($_GET['id_demandeur']);
        $type = "danger";
        $message = "<strong>".'Modification impossible !.'."</strong>". ' Vous devez donner une description de votre CV.';
        header("Location: cv.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
      }
    }

    // Supression
/*
    if (isset($_SESSION['id_demandeur']) and $_SESSION['id_demandeur'] > 0 and isset($_GET['id_cv']) and $_GET['id_cv'] > 0 )
    {
      $idDemandeur = intval($_SESSION['id_demandeur']);
      $idCV = intval($_GET['id_cv']);
      $requeteDemandeur = $bdd->prepare('DELETE FROM cv WHERE id_cv = :idCV and id_demandeur = :idDemandeur');
      $requeteDemandeur->execute(array(
      "idCV" => $idCV,
      "idDemandeur" => $idDemandeur)
      );
      $type = "success";
      $message = "<strong>".'Supression réussie !.'."</strong>". ' Vous avez supprimé votre  CV avec succès.';
        header("Location: cv.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
    }
*/
    // Gesion des favoris

    // Ajout

    if (isset($_SESSION['id_demandeur']) and $_SESSION['id_demandeur'] > 0 and isset($_POST['secteur']))
    {
      $idDemandeur = intval($_SESSION['id_demandeur']);
      $secteur = test_input($_POST['secteur']);
      $requeteFavoris = $bdd->prepare('INSERT INTO favoris (secteur, id_demandeur) VALUES (:secteur, :idDemandeur)');
      $requeteFavoris->execute(array(
      "secteur" => $secteur,
      "idDemandeur" => $idDemandeur)
      );
      $message = "<strong>".'Insertion réussie !.'."</strong>". ' Vous avez ajouté avec succès un nouveau favoris.';
      header("Location: favoris.php?id_demandeur=".$idDemandeur."&message=".$message);
    }

    // Suppression

    if (isset($_SESSION['id_demandeur']) and $_SESSION['id_demandeur'] > 0 and isset($_GET['id_favoris']) and $_GET['id_favoris'] > 0 )
    {
      $idDemandeur = intval($_SESSION['id_demandeur']);
      $idFavoris = intval($_GET['id_favoris']);
      $requeteFavoris = $bdd->prepare('DELETE FROM favoris WHERE id_favoris = :idFavoris and id_demandeur = :idDemandeur');
      $requeteFavoris->execute(array(
      "idFavoris" => $idFavoris,
      "idDemandeur" => $idDemandeur)
      );
      $message = "<strong>".'Suppression réussie !.'."</strong>". ' Le favoris a été suprimé avec succès.';
      header("Location: favoris.php?id_demandeur=".$idDemandeur."&message=".$message);
    }

    // Gestion des offres

    // Postuler

    if (isset($_SESSION['id_demandeur']) and $_SESSION['id_demandeur'] > 0 and isset($_GET['id_offre']) and $_GET['id_offre'] > 0 )
    {
      $idDemandeur = intval($_SESSION['id_demandeur']);
      $idOffre = intval($_GET['id_offre']);
      $requeteFavoris = $bdd->prepare('INSERT INTO postuler VALUES(:datePostulation , :idDemandeur, :idOffre)');
      $requeteFavoris->execute(array(
        "datePostulation" => date("Y-m-d"),
        "idDemandeur" => $_SESSION['id_demandeur'],
        "idOffre" => $_GET['id_offre'])
      );
      $idDemandeur = intval($_SESSION['id_demandeur']);
        $type = "succes";
        $message = "<strong>".'Demnande envoyé !.'."</strong>". ' Votre demande d\'emploi a été transmise avec succès. Vous serez informé de la suite réservée à votre demande';
        header("Location: offres.php?id_demandeur=".$idDemandeur."&type=".$type."&message=".$message);
    } 

    // Gestion du profil

      
?>