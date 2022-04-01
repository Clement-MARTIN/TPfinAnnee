<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">Votre bibliothèque numérique</h1>
            <p class="lead fw-normal">Bienvenue sur votre bibliothèque numérique que vous pouvez retrouver sur tous vos
                appareils éléctroniques.</p>
            <a class="btn btn-outline-secondary" href="#">En savoir plus</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div style="height: 500px">
                    <div class="container mt-5 card-header bg-dark text-warning"> Livres classés en fonction de leur
                        genre
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="card-text" id="chartContainer"></div>
                    </div>
                </div>
                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            exportEnabled: true,
                            title: {
                                text: "Répartition des livres par genre"
                            },
                            subtitles: [{
                                text: "en nombre de livres"
                            }],
                            data: [{
                                type: "pie",
                                showInLegend: "true",
                                legendText: "{label}",
                                indexLabelFontSize: 16,
                                indexLabel: "{label} - #percent%",
                                yValueFormatString: "Il y a #,##0 livre(s) de ce genre",
                                dataPoints: <?php echo json_encode(Livre::nbgenre(), JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();
                    }
                </script>
            </div>
            <div class="col-md-4">
                <div class="mr-4" style="height: 500px">
                    <div class="container mt-5 card-header bg-dark text-warning">Statistiques générales</div>
                    <div class="card-body">
                        <h4 class="card-title "><span class="badge badge-success"><?php echo Livre::nbLivre(); ?> </span>
                            <a href="../TP3.1/index.php?uc=livres&action=list"class="text-warning">Nombre de livres
                            </a></h4>
                        <hr>
                        <h4 class="card-title"><span class="badge badge-primary"><?php echo Auteur::nbAuteur(); ?> </span>
                            <a href="../TP3.1/index.php?uc=auteurs&action=list"class="text-warning">Nombre d'auteurs
                            </a></h4>
                        <hr>
                        <h4 class="card-title"><span class="badge badge-danger"><?php echo Genre::nbGenre(); ?> </span>
                            <a href="../TP3.1/index.php?uc=genres&action=list" class="text-warning">Nombre de genres
                            </a></h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

