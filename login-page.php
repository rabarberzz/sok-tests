<?php
    include './includes/autoload.inc.php';
    include './includes/header.inc.php'
?>


<!doctype html>
<html lang="en">
<head>
    <title>Log-in page</title>
</head>
<body>
    <div class="container" id="login-container">
        <form action="index.php" >
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="email-input">Email address</label>
                <input type="text" id="email-input" class="form-control" required />
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="pwd-input">Password</label>
                <input type="password" id="pwd-input" class="form-control" required />
            </div>
            <!--Submit button-->
            <button type="submit" class="btn btn-primary btn-block mb-4">Log in</button>
        </form>
    </div>
</body>
</html>

<?php
    include './includes/footer.inc.php';