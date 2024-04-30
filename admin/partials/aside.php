<aside class="menubar">
    <div class="topo_menu">
        <img src="../imagens/carmax/Group 522.png" alt="" class="logo">
        <div class="menu">
            <a href="../admin/manage-produtos.php" class="item_menu">
                <span class="material-symbols-outlined">inventory</span>
                <h2>Produtos</h3>
            </a>
            <a href="../admin/manage-marcas.php" class="item_menu">
                <span class="material-symbols-outlined">deployed_code</span>
                <h2>Marcas</h3>
            </a>
            <a href="..\admin\manage-user.php" class="item_menu">
                <span class="material-symbols-outlined">group</span>
                <h2>Usuários</h3>
            </a>
            <a href="..\admin\manage-config.php" class="item_menu">
                <span class="material-symbols-outlined">settings</span>
                <h2>Configurações</h3>
            </a>
        </div>
    </div>

    <div class="bottom_menu">
        <div class="avatar-user">
            <?php
            $current_user = $_SESSION['user-id'];
            $query = "SELECT * FROM users WHERE id=$current_user";
            $users_result = mysqli_query($connection, $query);
            $usurio = mysqli_fetch_assoc($users_result)
            ?>
            <img src="../imagemusers/<?= $usurio['avatar'] ?>" alt="" class="foto_produto_table">
            <div class="user">
                <h4><?= "{$usurio['firstname']} {$usurio['lastname']}" ?></h4>
                
                <?php if($usurio['is_admin'] == 1) : ?><small> Administrador</small>
                <?php else :?><small>Autor</small>
                <?php endif ?>
            </div>

        </div>
        <a href="<?= ROOT_URL ?>logout.php">
            <div class="btn_logout">
                <span class="material-symbols-outlined">inventory</span>
                <h3>Logout</h3>
            </div>
        </a>
    </div>

</aside>

<!--============================ FIM MENU LATERAL ===========================-->