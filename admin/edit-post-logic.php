<?php 
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];
     
    // set is_featured to 0 if it was uncheked
    $is_featured = $is_featured == 1 ? : 0 ;

    // check and validate of inputs 
    if(!$title){
        $_SESSION['edit-post'] = "Impossivel atualizar a postagem, verifique o formulário";
    }elseif(!$category_id){
        $_SESSION['edit-post'] = "Impossivel atualizar a postagem, verifique o formulário";
    } elseif(!$body){
        $_SESSION['edit-post'] = "Impossivel atualizar a postagem, verifique o formulário";
    }else{
        // delete thumbnail exists
        if($thumbnail['name']){
            $previous_thumbnail_path =  '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }
            // work a new thumbnail
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path =  '../images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.' ,  $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                if($thumbnail['size'] < 2000000){
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post']= "Arquivo muito grande, deve ser menor que 2mb";
                }
            }else{
                $_SESSION['edit-post']= "Arquivo deve ser png, jpg or jpeg";
            }
        }
    }
    if($_SESSION['edit-post']){
        header('location:'. ROOT_URL . 'admin/');
        die();
    }else{
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 ";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id='$category_id', is_featured='$is_featured' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }
    if(!mysqli_errno($connection)){
        $_SESSION['edit-post-success']= "Postagem atualizada com sucesso";
    }
    else{
        $_SESSION['edit-post']= "Impossivel atualizar a postagem, verifique o formulário";
    }
}
header('location:' . ROOT_URL . 'admin/');
die();




?>