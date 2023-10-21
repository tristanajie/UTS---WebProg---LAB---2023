<?php
session_start();
include 'db.php';

if (isset($_SESSION['username'])) {
    header('location:index.php');
}

$username = $_POST['username'];
$pass = sha1($_POST['password']);

$query = "SELECT * FROM task_user WHERE username = ? AND password = ?";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $pass);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['u_f_name'] = $data['u_f_name'];
    $_SESSION['u_l_name'] = $data['u_l_name'];

    header('location:index.php');
} else {
    header('location:loginlol_fail.php');
}
