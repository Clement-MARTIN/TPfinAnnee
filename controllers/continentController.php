<?php
$action = $_GET['action'];
switch ($action) {
    case 'list' :

        /*** Recup tout les continents pour les afficher sous forme de liste*/
        $lesContinents = Continent::findAll();
        include('../TP3.1/vues/Continents/listeContinents.php');
        break;

    /*** Fonction pour ajouté un continent */
    case 'add' :
        $mode = "Ajouter";
        include('../TP3.1/vues/Continents/formContinent.php');
        break;

    /*** Fonction pour mofifier un continent via un num*/
    case 'update' :
        $mode = "Modifier";
        $continent = Continent::findById($_GET['num']);
        include('../TP3.1/vues/Continents/formContinent.php');
        break;

    /*** Fonction pour supprimer un continent via un num*/
    case 'delete' :
        try {
            $continent = Continent::findById($_GET['num']);
            $nb = Continent::delete($continent);
            $_SESSION['message'] = ["success" => "Le continent a bien été supprimé"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, impossible de supprimer ce continent"];
        }
        header('location: ../TP3.1/index.php?uc=continents&action=list');
        exit();
        break;

    /*** Fonction qui permet d'ajouter ou de mofidier un continent via un num sur un formulaire*/
    case 'valideFrom' :
        try {
            $continent = new Continent();
            $message = "";
            if (empty($_POST['num'])) {
                $continent->setLibelle($_POST['libelle']);
                $nb = Continent::add($continent);
                $message = "ajouté";
            } else {
                $continent->setLibelle($_POST['libelle']);
                $continent->setNum($_POST['num']);
                $nb = Continent::update($continent);
                $message = "modifié";
            }
            $_SESSION['message'] = ["success" => "Le continent a bien été $message"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, le contient n'a pas été $message"];
        }

        header('location: ../TP3.1/index.php?uc=continents&action=list');
        break;

}