<?php
require 'config/database.php'; 
if (isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripition = filter_var($_POST['descripition'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$title || !$descripition){
        $_SESSION['edit-category']= 'Formulario invalido';
        }else {
        $query= "UPDATE categories SET title ='$title', descripition='$descripition' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(mysqli_errno($connection)){
            $_SESSION['edit-category']="Falha ao atualizar $title";
        }else{
            $_SESSION['edit-category-success']="Categoria $title atualizada com sucesso";
        }
    }
    header('location:'. ROOT_URL . 'admin/manage-categories.php');
    die();
}
?>
