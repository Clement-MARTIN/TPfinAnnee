<div class="container mt-5">
    <h1 style="text-decoration: underline"><?php echo $mode ?> un continent </h1>
    <form action="../TP3.1/index.php?uc=continents&action=valideFrom" method="post">
        <div class="form-group">
            <label for='libelle'>Libellé</label>
            <input type="text" class="form-control" id='libelle' placeholder="Saisir le libellé" name='libelle'
                   value="<?php if ($mode == "Modifier") {
                       echo $continent->getLibelle();
                   } ?>">
        </div>

        <input type="hidden" id="num" name="num" value="<?php if ($mode == "Modifier") {
            echo $continent->getNum();
        } ?>">
        <div class="row">
            <div class="col"><a href="../TP3.1/index.php.php?uc=continents&action=list"
                                class="btn btn-warning btn-block">Revenir à la liste des
                    continents</a>
            </div>
            <div class="col">
                <button type='submit' class="btn btn-success btn-block"><?php echo $mode ?> le contient
                </button>
            </div>
        </div>
    </form>
</div>