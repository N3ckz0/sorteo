<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Configuración de la Empresa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Configuración de la Empresa</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card" style="background: rgba(<?php echo $data['config']['colorfondo']; ?>,<?php echo $data['config']['fondodegradado']; ?>);">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-lg-6 ">
                                <label class="form-label text-white">Logo de la empresa</label>
                                <img class="w-100" src="<?php echo $data['config']['logo']; ?>" alt="imagen de fondo">
                                <div class="d-flex justify-content-center">
                                    <a href="/admin/changelogo" class="btn btn-info my-4 w-50">Cambiar Imagen</a>
                                </div>
                                <label class="form-label text-white">Nombre de la empresa</label>
                                <h1 class="text-white text-center"><?php echo $data['config']['empresa']; ?></h1>
                                 <div class="d-flex justify-content-center">
                                    <a href="/admin/namecompany" class="btn btn-success my-4 w-50">Cambiar Nombre</a>
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