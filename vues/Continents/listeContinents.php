<div class="container mt-5">


    <div class="row pt-3">
        <div class="col-9"><h1 style="text-decoration: underline">Liste des continents :</h1></div>
        <div class="col-3"><a href="../TP3.1/index.php?uc=continents&action=add" class='btn btn-success'> <i
                        class="fas fa-plus-circle"></i> Créer un continent</a></div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr class="table-info d-flex">
            <th scope="col" class="col-md-5">Numéro</th>
            <th scope="col" class="col-md-5">Libellée</th>
            <th scope="col" class="col-md-2">Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lesContinents as $continent) {
            echo "<tr class='d-flex' >";
            echo "<td class='col-md-5'>".$continent->getNum()."</td>";
            echo "<td class='col-md-5'>".$continent->getLibelle()."</td>";
            echo "<td class='col-md-2'>
                        <a href='../TP3.1/index.php?uc=continents&action=update&num=" . $continent->getNum() . "' class='btn btn-success'><i class='fas fa-pencil-alt'></i></a>
                        <a href='#modalsupp' data-toggle='modal' data-suppression='../TP3.1/index.php?uc=continents&action=delete&num=".$continent->getNum()."' class='btn btn-danger'><i class='fas fa-trash'></i> </a>
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