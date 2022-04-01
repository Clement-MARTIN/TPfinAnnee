<?php
if (!empty($_SESSION['message'])) {
    $mesMessages = $_SESSION['message'];
    foreach ($mesMessages as $key => $message) {
        echo '<div class="alert alert-' . $key . ' alert-dismissble fade show" role= "alerte">' . $message . '
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    $_SESSION['message'] = [];
}
?>