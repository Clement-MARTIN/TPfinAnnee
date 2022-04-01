<main role="main">
    <div class="container mt-5">
        <h1 style="text-decoration: underline"><?php echo $mode ?> un(e) auteur(e)</h1>
        <form action="../TP3.1/index.php?uc=auteurs&action=valideForm" method="post">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Saisir le nom" name="nom"
                           value="<?php if ($mode == "Modifier") {
                               echo $auteur->getNom();
                           } ?>">
                </div>
                <div class="form-group col-md-7">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" placeholder="Saisir le prenom" name="prenom"
                           value="<?php if ($mode == "Modifier") {
                               echo $auteur->getPrenom();
                           } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nation">Nationalités</label>
                <select name="nation" class="form-control">
                    <?php
                    foreach ($LesNationalites as $nationalite) {
                        if ($mode == "Modifier") {
                            $selection = $nationalite->numero == $auteur->getNumNationalite()->getNum() ? 'selected' : '';
                        }

                        echo "<option value='" . $nationalite->numero . "'" . $selection . ">" . $nationalite->libNation . "</option>";

                    }
                    ?>
                </select>
            </div>
            <input type="hidden" id="num" name="num" value="<?php if ($mode == "Modifier") {
                echo $auteur->getNum();
            } ?>">
            <div class="row">
                <div class="col"><a href="../TP3.1/index.php?uc=auteurs&action=list" class="btn btn-warning btn-block">Revenir
                        à la liste des auteur(e)s</a></div>
                <div class="col">
                    <button type="submit" class="btn btn-success btn-block"><?php echo $mode; ?> l'auteur(e)</button>
                </div>
            </div>
        </form>

    </div>

