<?php
    include './includes/autoload.inc.php';
    include './includes/header.inc.php';
    $controller = new IndexController();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main page</title>
</head>
<body>
    <div class="container main mt-4 " >
        <div class="row justify-content-center ">
            <div class="tree col-3 mx-2 text-start py-2">
                <?php
                    $controller->getTree();
                ?>
            </div>
            <div class="node col-8 text-center mx-2 py-2 align-items-center justify-content-center d-flex flex-column">
                <h4 id="name">Node not found</h4>
                <p id="description">No description</p>
            </div>
            <button class="w-50" onclick="location.href='new-item.php'">Add item</button>
        </div>
    </div>
</body>
</html>

<?php
include './includes/footer.inc.php';
?>