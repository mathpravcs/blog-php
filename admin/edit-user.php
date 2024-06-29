<?php include('partials/header.php');
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($connection,$query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Editar Usuário</h2>
        <form action="edit-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="hidden"  name="id" value="<?=$user['id']?>">
            <input type="text"  name="firtsname" value="<?=$user['firtsname']?>" placeholder="Nome">
            <input type="text" name="lastname" value="<?=$user['lastname']?>" placeholder="Sobrenome">
           <select name="userrole">
            <option value="0">Author</option>
            <option value="1">Administrador</option>
           </select>
            <button type="submit" name="submit" class="btn">Atualizar</button>
            
        </form>
    </div>
</section>

<?php include('../partials/footer.php');?>