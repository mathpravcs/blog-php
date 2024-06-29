<?php
require 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
}else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}

?>

<section class="posts section_extra-margin ">
<div class="container posts_container">
    <?php while($post = mysqli_fetch_assoc($posts)): ?>
    <article class="post">
        <div class="post_thumbnail">
            <img src="images/<?=$post['thumbnail']?>">
        </div>
        <div class="post_info">
        <?php
        $category_id = $post['category_id'];
        $category_query = "SELECT * FROM categories WHERE id = $category_id";
        $category_result = mysqli_query($connection, $category_query);
        $category = mysqli_fetch_assoc($category_result);
        $category_title = $category['title'];
        ?>
        <a href="category-posts.php?id=<?=$post['category_id']?>" class="category_button"><?=$category['title']?></a></a>
            <h3 class="post_title"><a href="post.php?id=<?=$post['id']?>"><?=$post['title']?></a></h3>
            <p class="post_body">
                <?= substr($post['body'], 0, 150)?>...
            </p>
            <div class="post_author">
            <?php
                $author_id = $post['author_id'];
                $author_query = "SELECT * FROM users WHERE id = $author_id";
                $author_result = mysqli_query($connection, $author_query);
                $author = mysqli_fetch_assoc($author_result);
                ?>
                <div class="post_author-avatar">
                    <img src="images/<?=$author['avatar']?>">
                </div>
                <div class="post_author-info">
                    <h5>By: <?="{$author['firtsname']} {$author['lastname']}" ?></h5>
                    <small> <?= date('d m, Y, - H:i', strtotime($post['date_time'])) ?></small>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile ?>
</div>
</section>
<?php if(mysqli_num_rows($posts) == 0): ?>
        <div class="alert_message error lg">
        <h2 class="empty">Nenhuma postagem correpondeu a busca</h2>
        </div>
    <?php endif ?>

    <section class="category_buttons">
        <div class="container category_buttons-container">
        <?php 
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
         <?php while($category = mysqli_fetch_assoc($all_categories)): ?>
            <a href="category-posts.php?id=<?=$category['id']?>" class="category_button"><?=$category['title']?></a>
            <?php endwhile ?>
        </div>
    </section>
    
<?php
include 'partials/footer.php';
?>
