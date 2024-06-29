<?php include('partials/header.php');
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($connection,$query);
    $categorie = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'admin/manage-categories.php');
    die();
}
var_dump($categorie['id']);
?>



<section class="form_section">
    <div class="container form_section-container">
        <h2>Editar Categoria</h2>
        <form action="edit-category-logic.php" enctype="multipart/form-data" method="post">
        <input type="hidden"  name="id" value="<?=$categorie['id']?>">
        
            <input type="text" name="title" value="<?=$categorie['title'] ?>" placeholder="Titulo">
           <textarea rows="4" name="descripition" placeholder="descrição"><?=$categorie['descripition']?></textarea>
            <button type="submit" name="submit" class="btn">Atualizar Categoria</button>
        </form>
    </div>
</section>

<?php include('../partials/footer.php');?>