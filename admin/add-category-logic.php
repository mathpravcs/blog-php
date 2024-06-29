<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripition = filter_var($_POST['descripition'],FILTER_SANITIZE_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category']="Entre com o nome da categoria";
    }elseif(!$descripition){
        $_SESSION['add-category']="Entre com a descrição da categoria";
    }
    if(isset($_SESSION['add-category'])){
        $_SESSION['add-category-data']=$_POST;
        header('location:'. ROOT_URL . 'admin/add-category.php');
        die();
    }else{
        $query = "INSERT INTO categories (title, descripition)VALUES('$title','$descripition')";
        $result = mysqli_query($connection,$query);
        if(mysqli_errno($connection)){
            $_SESSION['add-category']="Falha ao adicionar categoria $title";
            header('location:'.ROOT_URL.'admin/add-category.php');
            die();
        }else{
            $_SESSION['add-category-success']="Categoria $title adicionada com sucesso";
            header('location:'.ROOT_URL.'admin/manage-categories.php');
            die();
        }
    }

}