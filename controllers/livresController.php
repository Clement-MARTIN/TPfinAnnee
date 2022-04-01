<?php
$action = $_GET['action'];
switch ($action) {
    case 'list':

        /*** Formulaire de recherche (avec titre, nom de l'auteur et la genre du livre)*/
        $titre = "";
        $auteurSel = "Tous";
        $genreSel = "Tous";

        if (isset($_POST['titre'])) {
            $titre = $_POST['titre'];
        }

        if (isset($_POST['auteur'])) {
            $auteurSel = $_POST['auteur'];
        }

        if (isset($_POST['genre'])) {
            $genreSel = $_POST['genre'];
        }

        /*** Recup tout les livres, les genres, les auteurs pour les afficher sous forme de liste*/
        $LesLivres = Livre::findAll($titre, $auteurSel, $genreSel);
        $LesGenres = Genre::findAll();
        $LesAuteurs = Auteur::findAll();
        include('../TP3.1/vues/Livres/listeLivre.php');
        break;

    /*** Fonction pour ajouté un livre */
    case 'add':

        $mode = "Ajouter";
        $LesGenres = Genre::findall();
        $LesAuteurs = Auteur::findAll();
        include('../TP3.1/vues/Livres/formLivre.php');
        break;

    /*** Fonction pour mofifier un livre via un num*/
    case 'update':

        $mode = "Modifier";
        $LesGenres = Genre::findall();
        $LesAuteurs = Auteur::findAll();
        $livre = Livre::findByid($_GET['num']);
        include('../TP3.1/vues/Livres/formLivre.php');
        break;

    /*** Fonction pour supprimer un livre via un num*/
    case 'delete':
        try {
            $livre = Livre::findByid($_GET['num']);
            $nb = Livre::delete($livre);
            $_SESSION['message'] = ["success" => "Le livre  a bien été supprimer"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Erreur, impossible de supprimer ce livre"];
        }
        header('location: ../TP3.1/index.php?uc=livres&action=list');
        exit();
        break;

    /*** Fonction qui permet d'ajouter ou de mofidier un livre via un num sur un formulaire*/
    case 'valideForm':
        try {
            $livre = new Livre();
            $Auteur = new Auteur;
            $Genre = new Genre;
            $Auteur = Auteur::findByid($_POST['auteur']);
            $Genre = Genre::findByid($_POST['genre']);
            $livre->setnumAuteur($Auteur);
            $livre->setnumGenre($Genre);
            $livre->setIsbn($_POST['isbn']);
            $livre->setTitre($_POST['titre']);
            $livre->setPrix($_POST['prix']);
            $livre->setEditeur($_POST['editeur']);
            $livre->setAnnee($_POST['annee']);
            $livre->setLangue($_POST['langue']);
            $message="";

            if (empty($_POST['num'])) {
                $nb = Livre::add($livre);
                $message = "Ajouter";
            } else {
                $livre->setNum($_POST['num']);
                $nb = Livre::update($livre);
                $message = "Modifier";
            }
            $_SESSION['message'] = ["success" => "Le livre a bien été $message"];
        }
        catch (Exception $e){
            $_SESSION['message'] = ["danger" => "Le livre n'a pas été $message"];
        }
        header('location: ../TP3.1/index.php?uc=livres&action=list');
        break;
}
?>