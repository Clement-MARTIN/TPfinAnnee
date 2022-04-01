<?php ob_start();
session_start();
include "vues/header.php";
include "vues/messageFlash.php";

include "modeles/Nationalite.php";
include "modeles/Continent.php";
include "modeles/Genre.php";
include "modeles/Auteur.php";
include "modeles/Livre.php";

include "modeles/monPDO.php";

$uc = empty($_GET['uc']) ? "acceuil" : $_GET['uc'];

switch ($uc){
    case 'acceuil' :
        include ('vues/Acceuil.php');
        break;
    case 'continents' :
        include ('controllers/continentController.php');
        break;
    case 'genres' :
        include ('controllers/genresController.php');
        break;
    case 'nations':
        include ('controllers/nationController.php');
        break;
    case 'auteurs':
        include ('controllers/auteursController.php');
        break;
    case 'livres':
        include ('controllers/livresController.php');
        break;
}
include "vues/java.php";

?>
