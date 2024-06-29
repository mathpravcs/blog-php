<?php
require 'config/database.php';
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        $update_query = "UPDATE posts SET category_id = 5 WHERE category_id = $id";
        $update_result = mysqli_query($connection, $update_query);
        if(!mysqli_errno($connection)){
            $delete_user_query = "DELETE FROM categories WHERE id =$id";
            $delete_user_result = mysqli_query($connection, $delete_user_query);
            $_SESSION['delete-category-success']="'{$category['title']} Excluido com sucesso";
        }
        else{
            $_SESSION['delete-category']="Não foi possível excluir a categoria, tente novamente '{$category['title']}'";
        }

    }
header('location:' . ROOT_URL . 'admin/manage-categories.php');
die();

?>