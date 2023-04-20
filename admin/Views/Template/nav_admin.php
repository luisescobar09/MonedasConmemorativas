    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombre_completo']; ?></p>
                <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombre_rol']; ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="<?= base_url(); ?>/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-o" aria-hidden="true"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/permisos"><i class="icon fa fa-circle-o"></i> Permisos</a></li>
                </ul>
            </li>

            <li><a class="app-menu__item" href="<?= base_url(); ?>/familias"><i class="app-menu__icon fa-solid fa-people-group" aria-hidden="true"></i><span class="app-menu__label">Familias</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/denominaciones"><i class="app-menu__icon fa fa-list-ol" aria-hidden="true"></i><span class="app-menu__label">Denominaciones</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/monedas"><i class="app-menu__icon fa-solid fa-coins" aria-hidden="true"></i><span class="app-menu__label">Monedas</span></a></li>

            <li><a class="app-menu__item" href="<?= base_url(); ?>/logout"><i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i><span class="app-menu__label">Cerrar sesión</span></a></li>

        </ul>
    </aside>