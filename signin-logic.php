<?php
require 'config/database.php';

session_start(); // Inicia a sessão

if (isset($_POST['submit'])) {
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($username_email)) {
        $_SESSION['signin'] = "Username or email required";
    } elseif (empty($password)) {
        $_SESSION['signin'] = "Password required";
    } else {
        $fetch_user_query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = mysqli_prepare($connection, $fetch_user_query);
        mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
        mysqli_stmt_execute($stmt);
        $fetch_user_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            if (password_verify($password, $db_password)) {
                $_SESSION['user-id'] = $user_record['id'];
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                header('Location: ' . ROOT_URL . 'admin/');
                exit(); // Termina o script após o redirecionamento
            } else {
                $_SESSION['signin'] = "Verifique os dados de acesso";
            }
        } else {
            $_SESSION['signin'] = "Usuario não encontrado";
        }
    }
    header('Location: ' . ROOT_URL . 'signin.php');
    exit(); // Termina o script após o redirecionamento
} else {
    header('Location: ' . ROOT_URL . 'signin.php');
    exit(); // Termina o script após o redirecionamento
}
?>
