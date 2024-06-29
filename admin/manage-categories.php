<?php include('partials/header.php');
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>
session_start();



<section class="dashboard">
<?php if(isset($_SESSION['delete-category'])): ?>
        <div class="alert_message error container">
            <p>
            <?= $_SESSION['delete-category'];
            unset($_SESSION['delete-category']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-category-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['delete-category-success'];
            unset($_SESSION['delete-category-success']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['add-category-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['add-category-success'];
            unset($_SESSION['add-category-success']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['add-category'])): ?>
        <div class="alert_message error container">
            <p>
            <?= $_SESSION['add-category'];
            unset($_SESSION['add-category']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-category'])): ?>
        <div class="alert_message error container">
            <p>
            <?= $_SESSION['edit-category'];
            unset($_SESSION['edit-category']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-category-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['edit-category-success'];
            unset($_SESSION['edit-category-success']);
            ?>
            </p>
        </div>

        <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                    <h5>Criar Postagem</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i>
                    <h5>Gerenciar Postagens</h5>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_is_admin'])):
                ?>
                <li>
                    <a href="add-user.php"><i class="uil uil-user-plus"></i>
                    <h5>Adicionar Usuario</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                    <h5>Gerenciar Usuarios</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php"><i class="uil uil-edit"></i>
                    <h5>Adicionar Categoria</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                    <h5>Gerenciar Categorias</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>manage-categories</h2>
            <?php if(mysqli_num_rows($categories)> 0):?>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title']?></td>
                        <td><?= $category['descripition']?></td>
                        <td><a href="edit-category.php?id=<?=$category['id']?>" class="btn sm">Editar</a></td>
                        <td><a href="delete-category.php?id=<?=$category['id']?>" class="btn sm danger">Deletar</a></td>
                      
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert_message error">
                    <p>
                        <?="Categorias não encontradas"?>
                    </p>
                </div>
                <?php endif ?>
        </main>
    </div>
</section>

<?php include('../partials/footer.php');?>