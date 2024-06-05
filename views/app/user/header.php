 <?php
    $estado_session = session_status();

    if($estado_session == PHP_SESSION_NONE)
    {
        session_start();
    }
    if(!isset($_SESSION['User']) || $_SESSION['User'] == null){
        require_once "views/app/errors/access.php";
        die();
    }
    //Encoded Controller
    require_once "controllers/Encoded.php";
    $ec = new EncodedController;
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
    <!-- Toastr-->
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
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
            <a href="/user/index" class="brand-link">
                <img src="assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Tribuna</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $_SESSION['User']['imagen']; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/user/profile" class="d-block"><?php echo $ec->decrypt($_SESSION['User']['nombre']) . ' ' . $ec->decrypt($_SESSION['User']['apaterno']);?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Información General</li>
                        <li class="nav-item">
                            <a href="/user/index" class="nav-link">
                                 <i class="nav-icon fa fa-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="nav-header">Categorías de los premios</li>
                         <li class="nav-item">
                            <a href="/user/categories" class="nav-link">
                                <i class="nav-icon fa fa-tag"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <!--<li class="nav-header">Imagenes del servidor</li>
                         <li class="nav-item">
                            <a href="/user/images" class="nav-link">
                                <i class="nav-icon fa fa-solid fa-image"></i>
                                <p>Imagenes</p>
                            </a>
                        </li>-->
                        <li class="nav-header">Premios Registrados</li>
                         <li class="nav-item">
                            <a href="/user/rewards" class="nav-link">
                                <i class="nav-icon fa fa-gift"></i>
                                <p>Premios</p>
                            </a>
                        </li>
                        <li class="nav-header">Participantes</li>
                         <li class="nav-item">
                            <a href="/user/participants" class="nav-link">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p>Personas</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

