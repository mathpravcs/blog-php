<?php include('partials/header.php');

$firtsname = $_SESSION['add-user-data']['firtsname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

unset($_SESSION['add-user-data']);
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Adicionar Usuário</h2>
        <?php if(isset($_SESSION['add-user'])):?>
            <div class="alert_message error">
            <p>
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']);?>
            </p>
        </div>
     <?php endif ?>
        <form action="add-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="firtsname" value="<?=$firtsname?>" placeholder="Primeiro Nome">
            <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Sobrenome">
            <input type="text"  name="username" value="<?=$username?>" placeholder="Usuario">
            <input type="email" name="email" value="<?=$email?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?=$createpassword?>" placeholder="Senha">
            <input type="password" name="confirmpassword" value="<?=$confirmpassword?>" placeholder="Confirme a Senha">
           <select name="userrole">
            <option value="0">Autor</option>
            <option value="1">Administrador</option>
           </select>
            <div class="form_control">
                <label for="avatar">Selecione uma imagem</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Adicionar</button>
            
        </form>
    </div>
</section>

<?php include('../partials/footer.php');?>