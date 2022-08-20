<?php
    include './includes/autoload.inc.php';
    include './includes/header.inc.php';
    $controller = new IndexController();
    $nodeUid = null;
    if (isset($_GET['uid'])){
        $nodeUid = $_GET['uid'];
    }
    $itemArr = $controller->getNodeDataForEdit($nodeUid);
    if (is_null($itemArr)){
        echo "<h3 class='text-center text-bg-danger'>Error! Invalid uid!</h3>";
        die();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit item</title>
</head>
<body>
    <div class="container main mt-4">
        <div class="row justify-content-center">
            <div class="col-5  old-container align-items-center justify-content-evenly d-flex flex-column ">
                <h3 class="border-bottom border-2 border-dark">Current data</h3>
                <h4><?php echo $itemArr['name'] ?></h4>
                <p><?php echo $itemArr['description'] ?></p>
            </div>
            <div class="col-5 py-3 new-container align-items-center justify-content-evenly d-flex flex-column">
                <form action="./scripts/editItem.script.php" method="post">
                    <input type="hidden" name="node-uid-input" value="<?php echo $nodeUid ?>">
                    <div class="form-outline my-2 ">
                        <label class="form-label" for="name-input">Enter name</label>
                        <input type="text" id="name-input" class="form-control" name="new-name-input" value="<?php echo $itemArr['name'] ?>" required />
                    </div>
                    <div class="form-outline my-2">
                        <label class="form-label" for="description-input">Enter description</label>
                        <input type="text" id="description-input" class="form-control" name="new-description-input" value="<?php echo $itemArr['description'] ?>"  required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block my-2">Apply changes</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
