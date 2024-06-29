<?php

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;
        if ($thumbnail_path) {
            unlink($thumbnail_path);

            $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1 ";
            $delete_result = mysqli_query($connection, $delete_post_query);
            if (mysqli_errno($connection)) {
                $_SESSION['delete-post'] = "nao foi possível excluir o post, tente novamente '{$post['title']}' ";
            } else {
                $_SESSION['delete-post-success'] = "Post '{$post['title']}' excluido com sucesso";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
