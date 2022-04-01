<?php
$action = $_GET['action'];
switch ($action) {
    case 'list':

        /*** Formulaire de recherche*/
        $nom = "";
        $prenom = "";
        $NationaliteSel = "Tous";
        if (!empty($_POST['nom'])) {
            $nom = $_POST['nom'];
        }
        if (!empty($_POST['prenom'])) {
            $prenom = $_POST['prenom'];
        }
        if (!empty($_POST['nation'])) {
            $NationaliteSel = $_POST['nation'];
        }

        /*** Recup tout les auteurs et les nationalités pour les afficher sous forme de liste*/
        $LesAuteurs = Auteur::findAll($nom, $prenom, $NationaliteSel);
        $LesNationalites = Nationalite::findAll();
        include('../TP3.1/vues/Auteurs/listeAuteur.php');
        break;

    /*** Fonction pour ajouté auteurs */
    case 'add':
        $mode = "Ajouter";
        $LesNationalites = Nationalite::findAll();
        $LesAuteurs = Auteur::findAll();
        include('../TP3.1/vues/Auteurs/formAuteur.php');
        break;

    /*** Fonction pour mofifier un auteur via un num*/
    case 'update':
        $mode = "Modifier";
        $LesNationalites = Nationalite::findAll();
        $auteur = Auteur::findById($_GET['num']);
        include('../TP3.1/vues/Auteurs/formAuteur.php');
        break;

    /*** Fonction pour supprimer un auteur via un num*/
    case 'delete':
        try {
            $auteur = Auteur::findById($_GET['num']);
            $nb = Auteur::delete($auteur);
            $_SESSION['message'] = ["success" => "L'auteur(e)'  a bien été supprimer"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, impossible de supprimer cet(te) auteur(e)"];
        }
        header('location: ../TP3.1/index.php?uc=auteurs&action=list');
        exit();
        break;

    /*** Fonction qui permet d'ajouter ou de mofidier un auteur via un num*/
    case 'valideForm':
        try {
            $auteur = new Auteur();
            $Nationalite = new Nationalite;
            $Nationalite = Nationalite::findById($_POST['nation']);
            $message = "";
            if (empty($_POST['num'])) {
                $auteur->setNumNationalite($Nationalite);
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $nb = Auteur::add($auteur);
                $message = "Ajouter";
            } else {
                $auteur->setNumNationalite($Nationalite);
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $auteur->setNum($_POST['num']);
                $nb = Auteur::update($auteur);
                $message = "Modifier";
            }
            $_SESSION['message'] = ["success" => "L'auteur(e) a bien été $message"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, l'auteur(e) n'a pas été $message"];
        }
        header('location: ../TP3.1/index.php?uc=auteurs&action=list');
        break;
}
?>