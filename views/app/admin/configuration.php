<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Configuración de Inicio</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Configuración de Inicio</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-body">
                        <form class="row" action="/admin/addreward" method="post" enctype="multipart/form-data">
                        <div class="col-sm-12 col-lg-6 col-xl-5 text-center d-flex flex-column align-items-center justify-content-center">
                            <label class="form-label">Imagen de fondo</label>
                            <img class="w-100" src="<?php echo $data['config']['imgfondo']; ?>" alt="imagen de fondo">
                            <a href="/admin/changeimagespage" class="btn btn-info my-4 w-50">Cambiar Imagen</a>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-7">
                            <label class="form-label mt-1">Color de sobrefondo (rgb)</label>
                            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100px; background: rgb(<?php echo $data['config']['colorfondo']; ?>);">
                                <h3><?php echo $data['config']['colorfondo']; ?></h3>
                            </div>
                            <label class="form-label mt-1">Degradado del color (rgba)</label>
                            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100px; background: rgba(<?php echo $data['config']['colorfondo']; ?>,<?php echo $data['config']['fondodegradado']; ?>);">
                                <h3><?php echo $data['config']['colorfondo']; ?>, <?php echo $data['config']['fondodegradado']; ?></h3>
                            </div>
                            <label class="form-label mt-1">Degradado de menus (rgb)</label>
                            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100px; background: rgba(<?php echo $data['config']['colormenu']; ?>);">
                                <h3><?php echo $data['config']['colormenu']; ?></h3>
                            </div>
                            <label class="form-label mt-1">Degradado del color  del menu (rgba)</label>
                            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100px; background: rgba(<?php echo $data['config']['colormenu']; ?>,<?php echo $data['config']['menudegradado']; ?>);">
                                 <h3><?php echo $data['config']['colormenu']; ?>, <?php echo $data['config']['menudegradado']; ?></h3>
                            </div>
                            <div class="w-100 d-flex justify-content-center align-items-center">
                                <a href="/admin/changecolors" class="btn btn-success my-4 w-50">Cambiar colores</a>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php require_once "footer.php"; ?>