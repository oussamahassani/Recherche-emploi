<?php
    session_start();

    include ("../connexion.php");

  

    // Supression d'une offre

    if (isset($_GET['id_employeur']) and $_GET['id_employeur'] > 0)
    {
        $idOffre = intval($_GET['id_employeur']);
        $requeteOffre = $bdd->prepare('DELETE  FROM offre WHERE id_offre  =  :idoffre');
        $requeteOffre->execute(array("idoffre" => $idOffre));

       $type = "success";
      $message = "<strong>".'Supression réussie !.'."</strong>". ' Vous avez supprimé votre  CV avec succès.';
        header("Location:editer-offres.php?id_demandeur=". $idOffre."&type=".$type."&message=".$message);
    }

   

   
 
?>


