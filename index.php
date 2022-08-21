<?php
    include './includes/loginCheck.inc.php';
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
        <div class="row justify-content-center mx-auto">
            <div class="tree col-4 mx-2 text-start py-2">
                <?php
                    $controller->getTree();
                ?>
            </div>
            <div class="node col-6 text-center mx-2 py-2 align-items-center justify-content-evenly d-flex flex-column">
                <h4 id="name">Node not found</h4>
                <p id="description">No description</p>
            </div>
        </div>
            <div class="row justify-content-center my-2 py-2" id="button-row">
                <div class="col-10 button-container d-flex align-items-center justify-content-center flex-column">
                    <button class="w-25" onclick="sendToNewItem();">Add item</button>
                    <button class="w-25" onclick="sendToNewItem(true)">Add child item</button>
                    <button class="w-25" onclick="editNode()">Edit item</button>
                    <button class="w-25" id="remove-btn" onclick="removeNode()">Remove item</button>
                </div>
            </div>
    </div>
</body>
</html>

<?php
include './includes/footer.inc.php';
?>