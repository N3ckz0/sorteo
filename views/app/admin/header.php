 <?php
    $estado_session = session_status();

    if($estado_session == PHP_SESSION_NONE)
    {
        session_start();
    }
    if(!isset($_SESSION['Admin']) || $_SESSION['Admin'] == null){
        require_once "views/app/errors/access.php";
        die();
    }
    //Encoded Controller
    require_once "controllers/Encoded.php";
    $ec = new EncodedController;
    //validation for encrypt variables
    $name = ($ec->decrypt($_SESSION['Admin']['nombre'])==null) ? $_SESSION['Admin']['nombre'] : $ec->decrypt($_SESSION['Admin']['nombre']);
    $lastname = ($ec->decrypt($_SESSION['Admin']['apaterno'])==null) ? $_SESSION['Admin']['apaterno'] : $ec->decrypt($_SESSION['Admin']['apaterno']);
    $secondname = ($ec->decrypt($_SESSION['Admin']['amaterno'])==null) ? $_SESSION['Admin']['amaterno'] : $ec->decrypt($_SESSION['Admin']['amaterno']);
    $user = ($ec->decrypt($_SESSION['Admin']['usuario'])==null) ? $_SESSION['Admin']['usuario'] : $ec->decrypt($_SESSION['Admin']['usuario']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data['title']; ?></title>
    <base href="http://version1.test/">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!--End Session -->
                <li class="nav-item">
                    <a href="/endsession" class="btn btn-info">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin/index" class="brand-link">
                <img src="assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Tribuna</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                        <img src="<?php echo $_SESSION['Admin']['imagen']; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/admin/profile" class="d-block"><?php echo $name . ' ' . $lastname;?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Información General</li>
                        <li class="nav-item">
                            <a href="/admin/index" class="nav-link">
                                 <i class="nav-icon fa fa-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="nav-header">Todos los Usuarios</li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-solid fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right" id="all-rewards"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/users" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Súper Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/participants" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Participantes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                         <li class="nav-header">Todas las Categorías</li>
                         <li class="nav-item">
                            <a href="/admin/categories" class="nav-link">
                                <i class="nav-icon fa fa-solid fa-users"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-header">Todos los Premios</li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-gift"></i>
                                <p>
                                    Premios
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right" id="all-rewards"><?php echo $data['rewards']['rewards']; ?></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/rewards" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Premios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/reward" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Premio Actual</p>
                                        <span class="right badge badge-secondary" id="active-reward" hidden>Active</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/pendingrewards" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Premios Pendientes</p>
                                        <span class="badge badge-info right bg-warning" id="pending-rewards" hidden><?php echo $data['pending']['pending']; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/authorizedrewards" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Premios Autorizados</p>
                                        <span class="badge badge-info right bg-success" id="authorized-rewards" hidden><?php echo $data['authorized']['authorized']; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/rejectedrewards" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Premios Denegados</p>
                                        <span class="badge badge-info right bg-red" id="rejected-rewards" hidden><?php echo $data['rejected']['rejected']; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Configuración General</li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear-fill"></i>
                                <p>
                                    Configuración
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right" id="all-rewards"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/company" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Empresa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/config" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fondo y Colores</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="/admin/stripe" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Configuración Stripe</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

<script>
    let rwds = document.getElementById('all-rewards');
    let activeRwd = document.getElementById('active-reward');
    let pendingRwds = document.getElementById('pending-rewards');
    let authorizedRwds = document.getElementById('authorized-rewards');
    let rejectedRwds = document.getElementById('rejected-rewards');
</script>
<?php
    //notifications of rewards
    if ($data['rewards']['rewards'] != 0) {
        echo "<script>rwds.hidden = false;</script>";
    } else {
        echo "<script>rwds.hidden = true;</script>";
    }

    if($data['active']){
        echo "<script>activeRwd.hidden = false;</script>";
    }else{
        echo "<script>activeRwd.hidden = true;</script>";
    }

    if($data['pending']['pending'] != 0){
        echo "<script>pendingRwds.hidden = false;</script>";
    } else {
        echo "<script>pendingRwds.hidden = true;</script>";
    }

    if($data['authorized']['authorized'] != 0){
        echo "<script>authorizedRwds.hidden = false;</script>";
    } else {
        echo "<script>authorizedRwds.hidden = true;</script>";
    }

    if($data['rejected']['rejected']){
        echo "<script>rejectedRwds.hidden = false;</script>";
    } else {
        echo "<script>rejectedRwds.hidden = true;</script>";
    }
?>