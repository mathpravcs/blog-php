
<footer>
            <div class="footer_social">
                <a href="https://www.instagram.com/m_basilio10?igsh=dmlja2s3OThvNm1p" target="_blank"><i class="uil uil-instagram-alt"></i></a>
                <a href="www.linkedin.com/in/matheus-basilio10" target="_blank"><i class="uil uil-linkedin"></i></a>
                <a href="https://github.com/mathpravcs" target="_blank"><i class="uil uil-github"></i></a>
                <a href="https://mathpravcs.github.io/my-portfolio/" target="_blank"><i class="uil-link"></i></a>
            </div>
            <div class="container footer_container">
                <article>
                    <h4>Categorias</h4>
                    <?php 
                     $all_categories_query = "SELECT * FROM categories";
                    $all_categories = mysqli_query($connection, $all_categories_query);
                    ?>
                     <?php while($category = mysqli_fetch_assoc($all_categories)): ?>
                        <ul>
                        <li><a href="category-posts.php?id=<?=$category['id']?>"><?=$category['title']?></a></li>
                    </ul>
                    <?php endwhile ?>
                    </article>
                <article>
                    <h4>Suporte</h4>
                    <ul>
                        <li><a href="">Suporte Online</a></li>
                        <li><a href="">Sac</a></li>
                        <li><a href="">Emails</a></li>
                        <li><a href="">Suporte de redes </a></li>
                        <li><a href="">Localização</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Blog</h4>
                    <ul>
                        <li><a href="">Segurança</a></li>
                        <li><a href="">Reparos</a></li>
                        <li><a href="">Recente</a></li>
                        <li><a href="">Popular</a></li>
                        <li><a href="">Categorias</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Permalinks</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <!-- <li><a href="">About</a></li>
                        <li><a href="">Services</a></li>
                        <li><a href="">Contact</a></li> -->
                    </ul>
                </article>
            </div>
            <div class="footer_copyright">
                <small> Copyright &copy; 2024 MATHEUS BASILIO </small>
            </div>
        </footer>

        <script src="..\js\main.js"></script>
</body>
</html>