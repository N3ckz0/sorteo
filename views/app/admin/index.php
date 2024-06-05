<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Bienvenido Administrador</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Información General</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información General</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php echo $data['users']['users'];?></h3>
                                        <p>Usuarios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?php echo $data['rewards']['rewards'];?></h3>
                                        <p>Premios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php echo $data['categories']['NumCatego'];?></h3>
                                        <p>Categorías</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-tag" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3><?php echo $data['participants']['participants'];?></h3>
                                        <p>Participantes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php require_once "footer.php"; ?>