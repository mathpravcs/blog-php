<?php 
include('partials/header.php');


$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Editar Postagem</h2>
        <form action="edit-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?=$post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?=$post['thumbnail'] ?>">
            <input type="text" name="title" value="<?=$post['title'] ?>" placeholder="Titulo">
            <select name="category" >
                <?php while($category = mysqli_fetch_assoc($categories)):?>
                    <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?=$post['body']?></textarea>
            <div class="form_control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" <?= ($post['is_featured'] == 1) 
                ? 'checked' : ''; ?>>
                <label for="is_featured">Compartilhar</label>
            </div>
            <div class="form_control">
                <label for="thumbnail">Trocar Imagem </label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div> 
            <button type="submit" name="submit" class="btn">Atualizar</button>
        </form>
    </div>
</section>

<?php include('../partials/footer.php');?>
