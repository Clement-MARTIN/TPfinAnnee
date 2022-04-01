<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h1 style="text-decoration: underline">Liste des Auteurs</h1></div>
        <div class="col-3"><a href="../TP3.1/index.php?uc=auteurs&action=add" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i> Créer un(e) Auteur(e) </a></div>

    </div>

    <form action="../TP3.1/index.php?uc=auteurs&action=list" method="POST" class="border boder-primary rounded p-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="nom" placeholder="Saisir le nom" name="nom"
                       value="<?php echo $nom; ?>">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="prenom" placeholder="Saisir le prenom" name="prenom"
                       value="<?php echo $prenom; ?>">
            </div>
            <div class="col">
                <select name="nation" class="form-control">
                    <?php
                    echo "<option value='Tous'>Tous les nationalités</option>";
                    foreach ($LesNationalites as $nationalite) {
                        $select= $nationalite->numero == $NationaliteSel ? 'selected' : '';
                        echo "<option value='" . $nationalite->numero . "'" . $select . ">" . $nationalite->libNation . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-warning btn-block">Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-hover table-striped">
        <thead>
        <tr class="table-info d-flex">
            <th scope="col" class="col-md-2">Numéro</th>
            <th scope="col" class="col-md-3">Nom</th>
            <th scope="col" class="col-md-3">Prenom</th>
            <th scope="col" class="col-md-2">Nationalites</th>
            <th scope="col" class="col-md-2">Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($LesAuteurs as $auteur) {
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-2'>" . $auteur->getNum() . "</td>";
            echo "<td class='col-md-3'>" . $auteur->getNom() . "</td>";
            echo "<td class='col-md-3'>" . $auteur->getPrenom() . "</td>";
            echo "<td class='col-md-2'>" . $auteur->libNationalite . "</td>";
            echo "<td class='col-md-2'>
     <a href='../TP3.1/index.php?uc=auteurs&action=update&num=" . $auteur->getNum() . "'class='btn btn-success'><i class='fas fa-pen'></i></a>
     <a href='#modalsupp' data-toggle='modal' data-message='Vous voulez vous supprimer cet(te) auteur(e) ?' data-suppression='../TP3.1/index.php?uc=auteurs&action=delete&num=" . $auteur->getNum() . "'class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
     </td>";
            echo "</tr>";
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