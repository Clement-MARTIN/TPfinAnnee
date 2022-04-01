<div class="container mt-5">
    <h1 style="text-decoration: underline"><?php echo $mode ?> un genre </h1>
    <form action="../TP3.1/index.php?uc=genres&action=valideFrom" method="post">
        <div class="form-group">
            <label for='libelle'>Libellé</label>
            <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé" name='libelle'
                   value="<?php if ($mode == "Modifier") {
                       echo $genre->getLibelle();
                   } ?>">
        </div>

        <input type="hidden" id="num" name="num" value="<?php if ($mode == "Modifier") {
            echo $genre->getNum();
        } ?>">
        <div class="row">
            <div class="col"><a href="../TP3.1/index.php?uc=genres&action=list"
                                class="btn btn-warning btn-block">Revenir à la liste des
                    genres</a>
            </div>
            <div class="col">
                <button type='submit' class="btn btn-success btn-block"><?php echo $mode ?> le genre
                </button>
            </div>
        </div>
    </form>
</div>