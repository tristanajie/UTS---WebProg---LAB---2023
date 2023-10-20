<?php

session_start();
include('db.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['card_no']) && isset($_POST['user_prodi']) && isset($_POST['user_first_name']) && isset($_POST['user_last_name']) && isset($_FILES['image'])) {
    if (isset($_POST['submit']) && $_POST['submit'] == "register") {
        $rand = rand();
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $level = $_POST['level'];
        $u_card = $_POST['card_no'];
        $u_f_name = $_POST['user_first_name'];
        $u_l_name = $_POST['user_last_name'];
        $u_prodi = $_POST['user_prodi'];
        $msg = "";
        $image = $_FILES['image']['name'];
        $xx = $rand . "_" . $image;
        $target = "upload_images/" . $xx;

        // Check if the username already exists
        $check_query = "SELECT username FROM mahasiswa WHERE username = ?";
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
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";

                $query = "INSERT INTO mahasiswa(u_card, u_f_name, u_l_name, u_prodi, image, uploaded, username, password, level) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?)";
                $state = mysqli_stmt_init($con);
                mysqli_stmt_prepare($state, $query);
                mysqli_stmt_bind_param($state, "ssssssss", $u_card, $u_f_name, $u_l_name, $u_prodi, $xx, $username, $password, $level);

                if (mysqli_stmt_execute($state)) {
                    // JavaScript alert function to display a success message
                    echo '<script>alert("Account successfully registered. Welcome!");</script>';
                    header("location:loginlol_postreg.php");
                } else {
                    header("location:register.php");
                }
            } else {
                $msg = "Failed to upload image";
            }
        }
    }
}