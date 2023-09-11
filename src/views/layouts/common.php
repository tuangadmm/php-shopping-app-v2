<?php

ob_start();
include('./src/views/partials/common-nav.php');
$navFallback = ob_get_clean();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <title><?= $title ?? '' ?></title>
    </head>
    <body>
        <nav class="nav">
            <?= $nav ?? $navFallback?>
        </nav>
        <div class="container">
            <?= $content ?? '' ?>
        </div>
    </body>
    <footer>
        <hr>
            footer
        <hr>
    </footer>

</html>


