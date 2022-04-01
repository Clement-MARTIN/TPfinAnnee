<div class="container mt-5">
    <h1 style="text-decoration: underline"><?php echo $mode ?> un livre</h1>

    <form action="../TP3.1/index.php?uc=livres&action=valideForm" method="post">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" placeholder="Saisir un ISBN" name="isbn"
                       value="<?php if ($mode == "Modifier") {
                           echo $livre->getIsbn();
                       } ?>">
            </div>
            <div class="form-group col-md-7">
                <label for="Titre">Titre</label>
                <input type="text" class="form-control" id="titre" placeholder="Saisir le titre" name="titre"
                       value="<?php if ($mode == "Modifier") {
                           echo $livre->getTitre();
                       } ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" id="prix" name="prix" placeholder="Saisir le prix" value="<?php if ($mode == "Modifier") {
                    echo $livre->getPrix();
                } ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="editeur">Editeur</label>
                <input type="text" class="form-control" id="editeur" placeholder="Saisir l'éditeur" name="editeur"
                       value="<?php if ($mode == "Modifier") {
                           echo $livre->getEditeur();
                       } ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="annee">Année</label>
                <input type="number" class="form-control" id="annee" name="annee" placeholder="Saisir l'année"
                       value="<?php if ($mode == "Modifier") {
                           echo $livre->getAnnee();
                       } ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="langue">Langue</label>
                <input type="text" class="form-control" id="langue" placeholder="Saisir la langue du livre" name="langue"
                       value="<?php if ($mode == "Modifier") {
                           echo $livre->getLangue();
                       } ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="auteur">Les auteurs</label>
                <select name="auteur" class="form-control">
                    <?php
                    foreach ($LesAuteurs as $auteur) {
                        if ($mode == "Modifier") {
                            $selection = $auteur->getNum() == $livre->getnumAuteur()->getNum() ? 'selected' : '';
                        }
                        echo "<option value='" . $auteur->getNum() . "'" . $selection . ">" . $auteur->getNom() . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="genre">Les genres</label>
                <select name="genre" class="form-control">
                    <?php
                    foreach ($LesGenres as $genre) {
                        if ($mode == "Modifier") {
                            $selection = $genre->getNum() == $livre ? 'selected' : '';
                        }
                        echo "<option value='" . $genre->getNum() . "'" . $selection . ">" . $genre->getLibelle() . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <input type="hidden" id="num" name="num" value="<?php if ($mode == "Modifier") {
            echo $livre->getNum();
        } ?>">
        <div class="row">
            <div class="col"><a href="../TP3.1/index.php?uc=livres&action=list" class="btn btn-warning btn-block">Revenir
                    à la liste des livres</a></div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block"><?php echo $mode; ?> le livre</button>
            </div>
        </div>

    </form>


