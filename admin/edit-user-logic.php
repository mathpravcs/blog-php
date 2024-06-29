<?php
require 'config/database.php'; 
if (isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firtsname = filter_var($_POST['firtsname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT);

    if(!$firtsname || !$lastname){
        $_SESSION['edit-user']= 'Campos invalidos';
        }else {
        $query= "UPDATE users SET firtsname = '$firtsname', lastname= '$lastname', is_admin='$is_admin' WHERE id ='$id' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['edit-user']='Falha ao atualizar';
        }else{
            $_SESSION['edit-user-success']="Usuario $firtsnane $lastname atualizado com sucesso";
        }
    }
    header('location:'. ROOT_URL . 'admin/manage-users.php');
    die();
}
?>
