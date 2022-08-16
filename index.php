<?php
    include './includes/autoload.inc.php';
    include './includes/header.inc.php';
    //header('Location: ' . 'login-page.php');
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
                <ul id="tree-root">
                    <li>Root node 1
                        <ul id="node1-subtree">
                            <li>Node 1 sub node 1
                                <ul id="node1-subnode1-subtree">
                                    <li>Node 1 sub node 1 sub node</li>
                                </ul>
                            </li>
                            <li>Node 1 sub node 2</li>
                        </ul>
                    </li>
                    <li>Root node 2</li>
                </ul>
            </div>
            <div class="node col-8 text-center mx-2 py-2">
                <h4>Node 1 title</h4>
                <p>Node 1 description </p>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include './includes/footer.inc.php';
?>