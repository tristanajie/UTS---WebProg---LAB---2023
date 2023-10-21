<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </head>

    <style>
        #error{
            position: relative;
            margin: 0 auto;
            width: 600px;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-right: 20px;
            padding-left: 20px;
            text-align: center;
            color: red;
        }
    </style>

    <body>
        <div class="container-fluid pt-5">
            <h1 class="text-center">Register</h1>
            <div id="error">
                Account already exists. Try make a new one!
            </div>  
            <div class="row  d-flex justify-content-center">
                <div class="col-6 align-items-center">
                    <form action="register_process.php" method="post" enctype="multipart/form-data">
                        <!-- 
                            $username
                            $password
                            $card_no
                            $user_prodi
                            $user_first_name
                            $user_last_name
                            $image
                         -->
                        <div class="pb-2">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" placeholder="Enter username" required>
                        </div>
                        <div class="pb-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password here" required>
                        </div>

                        <div class="row pb-1">
                            <div class="col-md-6">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="u_f_name" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="u_l_name" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center pt-5">
                            <button type="submit" name="submit" class="btn btn-primary" value="register">Register</button>
                        </div>
                    </form>
                    <p>Already have an account? <a href="loginlol.php">Login</a></p>
                </div>
            </div>
        </div>
        <?php

        ?>
    <script>
        // Check if the page is being refreshed
        if (performance.navigation.type === 1) {
            // Redirect to register.php
            window.location.href = 'register.php';
        }
    </script>
    </body>

    </html>