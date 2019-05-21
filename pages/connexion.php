<?php
$dbuser = 'root';
$dbpass = '';

$params = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
try
{
	 $bdd = new PDO('mysql:host=localhost;dbname=recherche_emploi;charset=utf8', $dbuser, $dbpass, $params);
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>