<?php
$req = $_SERVER['REQUEST_URI'];

$content = '';
$title = '';

//manage routes
switch ($req) {
    case '/':
        $content = file_get_contents('./src/views/home/Index.php');
        $title = 'Home';
        break;
    case '/products':
        $content = file_get_contents('./src/views/home/Products.php');
        $title = 'Products';
        break;
    default:
        $content = file_get_contents('error.php');
        $title = '404';
        break;
}
ob_start();
include('./src/views/partials/common-head.php');
$head = ob_get_clean();

?>

<!doctype html>
<html lang="en">
<?= $head ?>
<body>
<div class="container">
    <?= $content ?>

</div>
</body>

</html>



