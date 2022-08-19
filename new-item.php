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
    <title>New item</title>
</head>
<body>

    <div class="container main mt-4 w-25">
        <form action="">
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="name-input">Name</label>
                <input type="text" id="name-input" class="form-control" required />
            </div>
            <!-- Description input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="description-input">Description</label>
                <input type="text" id="description-input" class="form-control" required />
            </div>
            <!-- Parent input -->
            <div class="form-outline mb-4">
                <label for="parent-input" class="form-label">Parent element</label>
                <select name="parent-input" id="parent-input" class="form-select">
                    <option value="none" selected>No parent</option>
                    <option value="">Test</option>
                    <option value="">Test2</option>
                </select>
            </div>
            <!--Submit button-->
            <button type="submit" class="btn btn-primary btn-block mb-4">Add item</button>
        </form>
    </div>

</body>
</html>
