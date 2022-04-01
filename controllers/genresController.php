<?php
$action = $_GET['action'];
switch ($action) {
    case 'list' :

        /*** Recup tout les genres pour les afficher sous forme de liste*/
        $lesGenres = Genre::findAll();
        include('../TP3.1/vues/Genres/listeGenre.php');
        break;

    /*** Fonction pour ajouté un genre */
    case 'add' :
        $mode = "Ajouter";
        include('../TP3.1/vues/Genres/formGenre.php');
        break;

    /*** Fonction pour mofifier un genre via un num*/
    case 'update' :
        $mode = "Modifier";
        $genre = Genre::findById($_GET['num']);
        include('../TP3.1/vues/Genres/formGenre.php');
        break;

    /*** Fonction pour supprimer un genre via un num*/
    case 'delete' :
        try {
            $genre = Genre::findById($_GET['num']);
            $nb = Genre::delete($genre);
            $_SESSION['message'] = ["success" => "Le genre a bien été supprimé"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, impossible de supprimer ce genre"];
        }
        header('location: ../TP3.1/index.php?uc=genres&action=list');
        exit();
        break;

    /*** Fonction qui permet d'ajouter ou de mofidier un genre via un num sur un formulaire*/
    case 'valideFrom' :
        try {
            $genre = new Genre();
            $message="";
            if (empty($_POST['num'])) {
                $genre->setLibelle($_POST['libelle']);
                $nb = Genre::add($genre);
                $message = "ajouté";
            } else {
                $genre->setLibelle($_POST['libelle']);
                $genre->setNum($_POST['num']);
                $nb = Genre::update($genre);
                $message = "modifié";
            }
            $_SESSION['message'] = ["success" => "Le genre a bien été $message"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, le genre n'a pas été $message"];
        }
        header('location: ../TP3.1/index.php?uc=genres&action=list');
        break;

}