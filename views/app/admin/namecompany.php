<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Cambiar Nombre de Empresa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/company">Empresa</a></li>
                                <li class="breadcrumb-item active">Cambiar Nombre de Empresa</li>
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
                        <form action="/admin/savename" method="post">
                            <div class="mb-3">
                                <div>
                                    <input type="text" name="id" id="id" value="<?php echo $data['config']['id']; ?>" hidden>
                                    <label for="namecompany" class="form-label">Nombre de la empresa</label>
                                    <input type="text" class="form-control" id="namecompany" name="namecompany" required value="<?php echo $data['config']['empresa']; ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Cambiar Nombre</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="alert alert-danger" role="alert" id="alerta" hidden></div>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php require_once "footer.php"; ?>