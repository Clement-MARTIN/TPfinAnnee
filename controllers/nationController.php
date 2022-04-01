<?php
$action = $_GET['action'];
switch ($action) {
    case 'list' :

        /*** Formulaire de recherche (avec la nationalité, et le continent)*/
        $libelle = '';
        $continentSel = 'Tous';
        if (!empty($_POST['libelle']) || !empty($_POST['continent'])) {
            $libelle = $_POST['libelle'];
            $continentSel = $_POST['continent'];
        }

        /*** Recup tout les nationalités, les continents*/
        $LesNationalites = Nationalite::findAll($libelle, $continentSel);
        $LesContinents = Continent::findAll();
        include('../TP3.1/vues/Nations/listeNation.php');
        break;

    /*** Fonction pour ajouté une nationalité */
    case 'add' :
        $mode = "Ajouter";
        $LesContinents = Continent::findAll();
        include('../TP3.1/vues/Nations/formNation.php');
        break;

    /*** Fonction pour modifier une nationalité */
    case 'update':
        $mode = "Modifier";
        $LesContinents = Continent::findAll();
        $nationalite = Nationalite::findById($_GET['num']);
        include('../TP3.1/vues/Nations/formNation.php');
        break;

    /*** Fonction pour supprimer une nationalité */
    case 'delete':
        try {
            $nationalite = Nationalite::findById($_GET['num']);
            $nb = Nationalite::delete($nationalite);
            $_SESSION['message'] = ["success" => "La nationalité a bien été supprimée"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, impossible de supprimée la nationalité"];
        }
        header('location: ../TP3.1/index.php?uc=nations&action=list');
        exit();
        break;

    /*** Fonction qui permet d'ajouter ou de mofidier une nationalité" via un num sur un formulaire*/
    case 'valideFrom' :
        try {
            $nationalite = new Nationalite();
            $continent = new Continent;
            $continent = Continent::findById($_POST['continent']);
            $message = "";
            if (empty($_POST['num'])) {
                $nationalite->setLibelle($_POST['libelle']);
                $nationalite->setNumContinent($continent);
                $nb = Nationalite::add($nationalite);
                $message = "ajoutée";
            } else {
                $nationalite->setNum($_POST['num']);
                $nationalite->setLibelle($_POST['libelle']);
                $nationalite->setNumContinent($continent);
                $nb = Nationalite::update($nationalite);
                $message = "modifiée";
            }
            $_SESSION['message'] = ["success" => "La nationalité a bien été $message"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "La nationalité n'a pas été $message"];
        }

        header('location: ../TP3.1/index.php?uc=nations&action=list');
        break;

}