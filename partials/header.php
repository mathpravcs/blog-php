<?php 
require 'config/database.php';

if (isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $avatar = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog do Dev</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="index.php" class="nav_logo">BLOG DO DEV</a>
            <ul class="nav_items">
                
                    <li><a href="/blog.php">Blog</a></li>
                    <!-- <li><a href="/about.php">About</a></li>
                    <li><a href="/services.php">Services</a></li>
                    <li><a href="/contact.php">Contact</a></li> -->
                    <?php if(isset($_SESSION['user-id'])): ?>
                         <li class="nav_profile">
                         <div class="avatar">
                             <img src="<?= '/images/'. $avatar['avatar']?>">
                         </div>
                             <ul>
                                 <li><a href="/admin/index.php">Painel</a></li>
                                 <li><a href="/logout.php">Sair</a></li>
                             </ul>
                     </li>
                    <?php else : ?>
                  <li><a href="/signin.php">Entrar</a></li>
                  <?php endif ?> 

            </ul>
            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    