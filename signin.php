<?php
require 'config/constants.php';
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
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
        <h2>Entrar</h2>
        <?php if(isset($_SESSION['signup-success'])):?>
            <div class="alert_message success">
            <p>
                <?= $_SESSION['signup-success'];
                unset($_SESSION['signup-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['signin'])):?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['signin'];
                unset($_SESSION['signin']);
                ?>
            </p>
        </div>
        <?php endif?>
        <form action="signin-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Usuario ou Email">
            <input type="password" name="password" value="<?= $password  ?>" placeholder="Senha">
            <button type="submit" name="submit" class="btn">Entrar</button>
            <small>Não tem uma conta ? <a href="signup.php">Inscreva-se</a></small>
        </form>
    </div>
</section>

</body>
</html>