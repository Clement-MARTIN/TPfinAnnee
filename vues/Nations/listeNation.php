    <div class="container mt-5">
        <div class="row pt-3">
            <div class="col-9"><h1 style="text-decoration: underline">Liste des nationalités :</h1></div>
            <div class="col-3"><a href="../TP3.1/index.php?uc=nations&action=add" class='btn btn-success'> <i
                            class="fas fa-plus-circle"></i> Créer une nationalité</a></div>
        </div>
        <form action="../TP3.1/index.php?uc=nations&action=list" method="post" class="border border-dark rounded p-3 mt-3 mb-3">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé"
                           name='libelle' value="<?php echo $libelle; ?>">
                </div>
                <div class="col">
                    <select name="continent" class="form-control">
                        <?php
                        echo "<option value ='Tous'>Tous les continents</option>";
                        foreach ($LesContinents as $continent) {
                            $select = $continent->getNum() == $continentSel ? 'selected' : '';
                            echo "<option  value='".$continent->getNum()."'". $select."> ".$continent->getLibelle() ."</option >";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-warning btn-block">Rechercher</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
            <tr class="table-info d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-4">Libellée</th>
                <th scope="col" class="col-md-4">Continent</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($LesNationalites as $lanation) {
                echo "<tr class='d-flex' >";
                echo "<td class='col-md-2'>$lanation->numero</td>";
                echo "<td class='col-md-4'>$lanation->libNation</td>";
                echo "<td class='col-md-4'>$lanation->libContinent</td>";
                echo "<td class='col-md-2'>
                        <a href='../TP3.1/index.php?uc=nations&action=update&num=" . $lanation->numero . "' class='btn btn-success'><i class='fas fa-pencil-alt'></i></a>
                        <a href='#modalsupp' data-toggle='modal' data-suppression='../TP3.1/index.php?uc=nations&action=delete&num=$lanation->numero' class='btn btn-danger'><i class='fas fa-trash'></i> </a>
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
                    <p>Voulez-vous réellement supprimer cette nationalité ?</p>
                </div>
                <div class="modal-footer">
                    <a id="btnSuppr" href="" type="button" class="btn btn-success">Supprimer la nationalité</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

