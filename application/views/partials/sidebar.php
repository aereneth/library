<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a href="#" class="dropdown-trigger" data-target="userDropdown"><?= "{$user->first_name} {$user->last_name}" ?></a>
                <ul id="userDropdown" class="dropdown-content">
                    <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="white-text material-icons">menu</i></a>
    </div>
</nav>

 <ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="images/office.jpg">
            </div>
            <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
            <a href="#name"><span class="white-text name">John Doe</span></a>
            <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div>
    </li>
    <li><a class="subheader">Library</a></li>
    <li><a href="<?= base_url('acquisition') ?>" class="waves-effect"><i class="material-icons">add_box</i>Acquisition</a></li>
    <li><a href="#!" class="waves-effect"><i class="material-icons">autorenew</i>Circulation</a></li>
    <li><a href="#!" class="waves-effect"><i class="material-icons">create</i>Inventory</a></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="<?= base_url('/logout') ?>"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>