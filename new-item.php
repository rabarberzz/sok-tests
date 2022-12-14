<?php
    include './includes/loginCheck.inc.php';
    include './includes/autoload.inc.php';
    include './includes/header.inc.php';
    $isChild = 'false';
    if (isset($_GET['isChild'])){
        $isChild = 'true';
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New item</title>
</head>
<body>

    <div class="container main mt-4 w-25">
        <form action="./scripts/newItem.script.php" method="post">
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="name-input">Name</label>
                <input name="name-input" type="text" id="name-input" class="form-control" required />
            </div>
            <!-- Description input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="description-input">Description</label>
                <input name="description-input" type="text" id="description-input" class="form-control" required />
            </div>
            <!--Hidden uid inputs-->
            <input type="hidden" name="uid-input" value=<?php echo $_GET['uid'] ?>>
            <input type="hidden" name="parent-uid-input" value=<?php echo $isChild ?>>
            <!--Submit button-->
            <button type="submit" class="btn btn-primary btn-block mb-4">Add item</button>
        </form>
    </div>

</body>
</html>
