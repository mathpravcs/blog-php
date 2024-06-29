<?php

require 'config/constants.php';

$firtsname = $_SESSION['signup-data']['firtsname']?? null;
$lastname = $_SESSION['signup-data']['lastname']?? null;
$username = $_SESSION['signup-data']['username']?? null;
$email = $_SESSION['signup-data']['email']?? null;
$createpassword = $_SESSION['signup-data']['createpassword']??null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword']?? null;
$avatar = $_SESSION['signup-data']['avatar']?? null;
unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog do Dev</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Inscreva-se</h2>
        <?php if(isset($_SESSION['signup'])):?> 
            <div class="alert_message error">
            <p>
            <?= $_SESSION['signup'];
            unset($_SESSION['signup']);
            ?>
        </p>
        </div>
        
        <?php endif ?>
        <form action="signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firtsname" value="<?= $firtsname?>" placeholder="Nome">
            <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Sobrenome">
            <input type="text" name="username" value="<?=$username?>" placeholder="Usuario">
            <input type="email" name="email" value="<?=$email?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?=$createpassword?>" placeholder="Senha">
            <input type="password" name="confirmpassword" value="<?=$confirmpassword?>" placeholder="Confirme a senha">
            <div class="form_control">
                <label for="avatar">Selecione uma imagem</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Cadastrar</button>
            <small>Já tem uma conta ? <a href="signin.php">Entrar</a></small>
        </form>
    </div>
</section>

</body>
</html>