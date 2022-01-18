<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-biking"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BikeAdmin</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>
    @if (session()->get('user_role_id') == 1 || session()->get('user_role_id') == 4)
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        administration
    </div>
    <!-- Nav Item - Produits -->
    <li class="nav-item">
        <a class="nav-link" href="users">
            <i class="fas fa-fw fa-user"></i>
            <span>Utilisateurs</span></a>
    </li>
    <!-- Nav Item - Stocks -->
    <li class="nav-item">
        <a class="nav-link" href="roles">
            <i class="fas fa-fw fa-cubes"></i>
            <spsan>Roles</spsan>
        </a>
    </li>
    <!-- Nav Item - Personnels -->
    <li class="nav-item">
        <a class="nav-link" href="staffs">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Personnels</span></a>
    </li>
    <!-- Nav Item - Magasins -->
    <li class="nav-item">
        <a class="nav-link" href="stores">
            <i class="fas fa-fw fa-store"></i>
            <span>Magasins</span></a>
    </li>
    <!-- Divider -->
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        production
    </div>
    <!-- Nav Item - Produits -->
    <li class="nav-item">
        <a class="nav-link" href="products">
            <i class="fas fa-fw fa-product-hunt"></i>
            <span>Produits</span></a>
    </li>
    <!-- Nav Item - Stocks -->
    <li class="nav-item">
        <a class="nav-link" href="stocks">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Stocks</span></a>
    </li>
    <!-- Nav Item - Marques -->
    <li class="nav-item">
        <a class="nav-link" href="brands">
            <i class="fas fa-fw fa-typo3"></i>
            <span>Marques</span></a>
    </li>
    <!-- Nav Item - Catégories -->
    <li class="nav-item">
        <a class="nav-link" href="categories">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Catégories</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        vente
    </div>
    <!-- Nav Item - Factures -->
    <li class="nav-item">
        <a class="nav-link" href="orders">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Factures</span></a>
    </li>
    <!-- Nav Item - Clients -->
    <li class="nav-item">
        <a class="nav-link" href="customers">
            <i class="fas fa-fw fa-male"></i>
            <span>Clients</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->