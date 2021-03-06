<div class="navbar-fixed">
    <nav class="blue" role="navigation">
        <div class="nav-wrapper">
            <a id="logo-container" href="#" class="brand-logo">adInfinitum</a>
            <ul class="right hide-on-med-and-down">
                <?php if($user->privilege == 3): ?>
                <li><a href="<?= base_url('cart') ?>"><i class="material-icons left">shopping_cart</i>Cart</a></li>
                <?php endif ?>
                <li>
                    <a href="#" class="dropdown-trigger" data-target="userDropdown"><?= "{$user->first_name} {$user->last_name}" ?></a>
                    <ul id="userDropdown" class="dropdown-content">
                        <li><a href="<?= base_url('/logout') ?>"><i class="material-icons">exit_to_app</i>Logout</a></li>
                    </ul>
                </li>
            </ul>
            <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="white-text material-icons">menu</i></a>
        </div>
    </nav>
</div>

 <ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="<?= base_url('assets/img/sidebar-bg.jpg') ?>">
            </div>
            <a href="#user"><img class="circle" src="<?= base_url('assets/img/logo-bg.png') ?>"></a>
            <a href="#name"><span class="white-text name"><?= "{$user->first_name} {$user->last_name}" ?></span></a>
            <a href="#email"><span class="white-text email"><?= $user->email_address ?></span></a>
        </div>
    </li>
    <li><a href="<?= base_url() ?>" class="waves-effect"><i class="material-icons">home</i>Home</a></li>
    <li><div class="divider"></div></li>
    <?php if($user->privilege <= 2): ?>
    <li><a class="subheader">Library</a></li>
    <li><a href="<?= base_url('acquisition') ?>" class="waves-effect"><i class="material-icons">add_box</i>Acquisition</a></li>
    <li><a href="<?= base_url('circulation') ?>" class="waves-effect"><i class="material-icons">autorenew</i>Circulation</a></li>
    <li><a href="<?= base_url('inventory') ?>" class="waves-effect"><i class="material-icons">storage</i>Inventory</a></li>
    <li><a href="<?= base_url('reservation') ?>" class="waves-effect"><i class="material-icons">list</i>Reservation</a></li>
    <li><div class="divider"></div></li>
    <?php endif ?>
    <?php if($user->privilege  == 3): ?>
    <li><a class="subheader">Reservation</a></li>
    <li><a href="<?= base_url('shelf') ?>" class="waves-effect"><i class="material-icons">library_books</i>View Shelf</a></li>
    <li><a href="<?= base_url('cart') ?>" class="waves-effect"><i class="material-icons">shopping_cart</i>Open Cart</a></li>
    <li><a href="<?= base_url('reservation/history') ?>" class="waves-effect"><i class="material-icons">history</i>History</a></li>
    <li><div class="divider"></div></li>
    <?php endif ?>
    <li><a class="subheader">Catalog</a></li>
    <li><a href="<?= base_url('catalog') ?>" class="waves-effect"><i class="material-icons">view_list</i>OPAC</a></li>
    <li><div class="divider"></div></li>
    <?php if($user->privilege <= 1): ?>
    <li><a class="subheader">Accounts</a></li>
    <li><a href="<?= base_url('account') ?>" class="waves-effect"><i class="material-icons">people</i>Manage Account</a></li>
    <li><div class="divider"></div></li>
    <?php endif ?>
    <?php if($user->privilege <= 2): ?>
    <li><a class="subheader">Settings</a></li>
    <li><a href="<?= base_url('settings') ?>" class="waves-effect"><i class="material-icons">settings</i>Settings</a></li>
    <li><div class="divider"></div></li>
    <?php endif ?>
    <li><a class="waves-effect" href="<?= base_url('/logout') ?>"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>