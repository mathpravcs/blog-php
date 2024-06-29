<?php include('partials/header.php'); 
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id='$current_admin_id'";
$users = mysqli_query($connection, $query);
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-user-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['add-user-success'];
            unset($_SESSION['add-user-success']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-user-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['edit-user-success'];
            unset($_SESSION['edit-user-success']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-user'])): ?>
        <div class="alert_message error container">
            <p>
            <?= $_SESSION['edit-user'];
            unset($_SESSION['edit-user']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-user'])): ?>
        <div class="alert_message error container">
            <p>
            <?= $_SESSION['delete-user'];
            unset($_SESSION['delete-user']);
            ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-user-success'])): ?>
        <div class="alert_message success container">
            <p>
            <?= $_SESSION['delete-user-success'];
            unset($_SESSION['delete-user-success']);
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
                    <h5>Adicionar Postagem</h5>
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
                    <h5>Adicionar Usuário</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                    <h5>Gerenciar Usuários</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php"><i class="uil uil-edit"></i>
                    <h5>Adicionar Categoria</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                    <h5>Gerenciar Categorias</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Gerenciar Usuários</h2>
            <?php if(mysqli_num_rows($users) > 0):?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuario</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                        <th>Administrador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= "{$user['firtsname']} {$user['lastname']}"?></td>
                        <td><?= $user['username']?></td>
                        <td><a href="edit-user.php?id=<?=$user['id']?>" class="btn sm">Editar</a></td>
                        <td><a href="delete-user.php?id=<?=$user['id']?>" class="btn sm danger">Deletar</a></td>
                        <td><?= $user['is_admin'] ? 'Yes' : 'No' ?> </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else :?>
                <div class="alert_message error">
                    <?= "No Users found"?>
                </div>
                <?php endif ?>
        </main>
    </div>
</section>

<?php include('../partials/footer.php');?>