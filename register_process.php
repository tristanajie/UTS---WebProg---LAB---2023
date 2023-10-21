<?php

session_start();
include('db.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['u_f_name']) && isset($_POST['u_l_name'])) {
    if (isset($_POST['submit']) && $_POST['submit'] == "register") {
        $rand = rand();
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $u_f_name = $_POST['u_f_name'];
        $u_l_name = $_POST['u_l_name'];

        // Check if the username already exists
        $check_query = "SELECT username FROM task_user WHERE username = ?";
        $check_state = mysqli_stmt_init($con);
        mysqli_stmt_prepare($check_state, $check_query);
        mysqli_stmt_bind_param($check_state, "s", $username);
        mysqli_stmt_execute($check_state);
        mysqli_stmt_store_result($check_state);

        if (mysqli_stmt_num_rows($check_state) > 0) {
            // Username already exists, deny registration
            header("location: register_deny.php");
        } else {
            // Username is unique, proceed with registration
                $query = "INSERT INTO task_user(u_f_name, u_l_name, username, password) VALUES (?, ?, ?, ?)";
                $state = mysqli_stmt_init($con);
                mysqli_stmt_prepare($state, $query);
                mysqli_stmt_bind_param($state, "ssss", $u_f_name, $u_l_name, $username, $password);

                if (mysqli_stmt_execute($state)) {
                    // JavaScript alert function to display a success message
                    echo '<script>alert("Account successfully registered. Welcome!");</script>';
                    header("location:loginlol_postreg.php");
                } else {
                    header("location:register.php");
                }
        }
    }
}