<footer class="container py-5">
    <div class="row tex">

        <div class="col-6 col-md">
            <h5>Auteurs</h5>
            <ul class="list-unstyled text-small text">
                <li><a class="text-dark" href="../TP3.1/index.php?uc=auteurs&action=list">Liste des auteurs</a></li>
                <li><a class="text-dark" href="../TP3.1/index.php?uc=auteurs&action=add">Ajouter un auteur</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Genres</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-dark" href="../TP3.1/index.php?uc=genres&action=list">Liste des genres</a></li>
                <li><a class="text-dark" href="../TP3.1/index.php?uc=genres&action=add">Ajouter un genre</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Nationalités</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-dark" href="../TP3.1/index.php?uc=nations&action=list">Liste des nationalités</a></li>
                <li><a class="text-dark" href="../TP3.1/index.php?uc=nations&action=add">Ajouter une nationalité</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Continents</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-dark" href="../TP3.1/index.php?uc=continents&action=list">Liste des continents</a></li>
                <li><a class="text-dark" href="../TP3.1/index.php?uc=continents&action=add">Ajouter un continent</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Livres</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-dark" href="../TP3.1/index.php?uc=livres&action=list">Liste des livres</a></li>
                <li><a class="text-dark" href="../TP3.1/index.php?uc=livres&action=add">Ajouter un livre</a></li>
            </ul>
        </div>
    </div>
    <br>
    <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted" style="text-align: center">&copy; TP 3 Clément MARTIN 2020-2021</small>
    </div>
</footer>
<!-- script -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    $("a[data-suppression]").click(function () {
        var lien = $(this).attr("data-suppression");
        $("#btnSuppr").attr("href", lien);
    })
</script>
</body>
</html>
<?php ob_end_flush();?>
