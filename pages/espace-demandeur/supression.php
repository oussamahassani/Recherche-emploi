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

//supression
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

    
      
?>