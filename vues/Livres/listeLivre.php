<div class="pl-3 pr-3">
    <div class="row pt-3 pl-5">
        <div class="col-9"><h1 style="text-decoration: underline">Liste des Livres</h1></div>
        <div class="col-3"><a href="../TP3.1/index.php?uc=livres&action=add" class="btn btn-success"><i
                    class="fas fa-plus-circle"></i> Créer un livre</a></div>
    </div>
    <form action="../TP3.1/index.php?uc=livres&action=list" method="POST" class="border boder-primary rounded p-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="titre" placeholder="Saisir un Titre" name="titre" value="<?php echo $titre; ?>">
            </div>
            <div class="col">
                <select name="auteur" class="form-control">
                    <?php
                    echo "<option value='Tous'>Tous les Auteurs</option>";
                    foreach($LesAuteurs as $auteur) {
                        $selection=$auteur->getNum() == $auteurSel? 'selected' : '';
                        echo "<option value='".$auteur->getNum()."'". $selection.">".$auteur->getNom()."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select name="genre" class="form-control">
                    <?php
                    echo "<option value='all'>Tous les Genres</option>";
                    foreach($LesGenres as $genre) {
                        $selection=$genre->getNum() == $genreSel? 'selected' : '';
                        echo "<option value='".$genre->getNum()."'". $selection.">".$genre->getLibelle()."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-warning btn-block">Rechercher</button>
            </div>
        </div>
    </form>
    <br>
    <table class="table table-hover table-striped">
        <thead>
        <tr class="table-info d-flex">
            <th scope="col" class="col-md-2">ISBN du livre</th>
            <th scope="col" class="col-md-2">Titre</th>
            <th scope="col" class="col-md-1">Prix</th>
            <th scope="col" class="col-md-1">Editeur</th>
            <th scope="col" class="col-md-1">Annee</th>
            <th scope="col" class="col-md-1">Langue</th>
            <th scope="col" class="col-md-2">Auteur du livre</th>
            <th scope="col" class="col-md-1">Genre</th>
            <th scope="col" class="col-md-1">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($LesLivres as $livre){
            echo"<tr class='d-flex'>";
            echo "<td class='col-md-2'>".$livre->code."</td>";
            echo "<td class='col-md-2'>".$livre->titreL."</td>";
            echo "<td class='col-md-1'>".$livre->prixL."</td>";
            echo "<td class='col-md-1'>".$livre->editeurL."</td>";
            echo "<td class='col-md-1'>".$livre->date."</td>";
            echo "<td class='col-md-1'>".$livre->langueL."</td>";
            echo "<td class='col-md-2'>".$livre->nomA.'&nbsp;-&nbsp;'.$livre->prenomA."</td>";
            echo "<td class='col-md-1'>".$livre->libGenre."</td>";
            echo "<td class='col-md-1'>
     <a href='../TP3.1/index.php?uc=livres&action=update&num=".$livre->numero."'class='btn btn-success'><i class='fas fa-pen'></i></a>
     <a href='#modalsupp' data-toggle='modal' data-message='Vous voulez vous supprimer ce livre ?' data-suppression='../TP3.1/index.php?uc=livres&action=delete&num=".$livre->numero."'class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
     </td>";
            echo"</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<div id="modalsupp" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression :</h5>
            </div>
            <div class="modal-body">
                <p>Voulez-vous réellement supprimer ce continent ?</p>
            </div>
            <div class="modal-footer">
                <a id="btnSuppr" href="" type="button" class="btn btn-success">Supprimer le continent</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>