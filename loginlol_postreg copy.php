<?php
session_start();
require('db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>

<style>
#form{
    index: 1;
    position: relative;
}

#succ{
    position: absolute;
    top: 3%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    margin: 0 auto;
    width: 300px;
    background: linear-gradient(#80bfff, #cce6ff);
    border: 3px solid #3399ff;
    border-radius: 15px;
    color: white;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 10px;
    padding-bottom: 15px;
    text-align: center;
    font-weight: bold;
    opacity: 0;

    animation-name: opacityOn;
    animation-duration: 4s;
    animation-fill-mode: forwards;
    animation-iteration-count: 1;

    animation-name: opacityOff;
    animation-duration: 6s;
    animation-fill-mode: forwards;
    animation-iteration-count: 1;
}

@keyframes opacityOn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes opacityOff {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
</style>

<body>
    <div id="succ">New account has been registered.</div>
    <div class="container-fluid pt-5">
        <div class="row  d-flex justify-content-center">
            <div id="form"class="col-6 align-items-center">
            <h1 class="text-center">Login</h1>

                <form action="validation.php" method="post">
                    <div class="form-group pb-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="username" placeholder="Enter username">
                    </div>
                    <div class="form-group pb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password here">
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    Don't have an account? <a href="register.php">Register</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Check if the page is being refreshed
        if (performance.navigation.type === 1) {
            // Redirect to register.php
            window.location.href = 'loginlol.php';
        }
    </script>
</body>

</html>