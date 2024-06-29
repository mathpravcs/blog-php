<?php include('partials/header.php');
$title = $_SESSION['add-category-data']['title']?? null;
$descripition = $_SESSION['add-category-data']['descripition'] ?? null;
unset($_SESSION['add-category-data']);

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Adicionar Categoria</h2>
        <?php if(isset($_SESSION['add-category'])):?>
            <div class="alert_message error">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);?>
            </p>
        </div>
        <?php endif ?>
        <form action="add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Titulo">
           <textarea rows="4" value="<?= $descripition ?>" name="descripition" placeholder="descrição"></textarea>
            <button type="submit" name="submit" class="btn">Adicionar</button>
        </form>
    </div>
</section>

<?php include('../partials/footer.php');?>