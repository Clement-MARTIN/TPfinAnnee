<main role="main">
    <div class="container mt-5">
        <h1 style="text-decoration: underline"><?php echo $mode ?> une nationalité </h1>
        <form action="../TP3.1/index.php?uc=nations&action=valideFrom" method="post">
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input type="text" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle"
                       value="<?php if ($mode == "Modifier") {
                           echo $nationalite->getLibelle();
                       } ?>">
            </div>
            <div class="form-group">
                <label for="continent">Libellé</label>
                <select name="continent" class="form-control">
                    <?php
                    foreach ($LesContinents as $continent) {
                        if ($mode == 'Modifier'){
                            $select = $continent->getNum() == $nationalite->getNumContinent()->getNum() ? 'selected' : '';
                        }
                        echo "<option value='" . $continent->getNum() . "'" . $select . ">" . $continent->getLibelle() . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" id="num" name="num" value="<?php if ($mode == "Modifier") {
                echo $nationalite->getNum();
            } ?>">
            <div class="row">
                <div class="col"><a href="../TP3.1/index.php?uc=nations&action=list" class="btn btn-warning btn-block">Revenir
                        à la liste des nationalités</a></div>
                <div class="col">
                    <button type="submit" class="btn btn-success btn-block"><?php echo $mode; ?> la nationalité</button>
                </div>
            </div>
        </form>
    </div>
</main>
