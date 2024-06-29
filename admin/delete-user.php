<?php
require 'config/database.php';
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)==1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        if($avatar_path){
            unlink($avatar_path);
        }    
    }

    $thumbnails_query = "SELECT * FROM posts WHERE author_id = $id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if(mysqli_num_rows($thumbnails_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnails_result)){
            $thumbnail_name = $thumbnail['thumbnail'];
            $thumbnail_path = '../images/' . $thumbnail_name;
            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }

    $delete_user_query = "DELETE FROM users WHERE id =$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION['delete-user']="Não foi possível excluir o usuario '{$user['firstname']}' '{$user['lastname']}' ";
    }else{
        $_SESSION['delete-user-success']="Usuario '{$user['firstname']}{$user['lastname']}' excluido com sucesso";
    }
}

header('location:' . ROOT_URL . 'admin/manage-users.php');
die();

?>