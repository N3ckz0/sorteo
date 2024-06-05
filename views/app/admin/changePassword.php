<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Cambiar Contraseña</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/profile">Perfil</a></li>
                                <li class="breadcrumb-item active">Cambiar Contraseña</li>
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
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 col-sm-12">
                                <form action="/admin/savepassword" method="post">
                                    <div class="mb-3">
                                        <input type="text" id="id" name="id" value="<?php echo $_SESSION['Admin']['id']; ?>" hidden>
                                        <div>
                                            <label for="oldpass" class="form-label">Escribe la antigua contraseña</label>
                                            <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                                            <label for="newpass" class="form-label mt-3">Escribe la nueva contraseña</label>
                                            <input type="password" class="form-control" id="newpass" name="newpass" required>
                                            <label for="pass" class="form-label mt-3">Verifica la contraseña</label>
                                            <input type="password" class="form-control" id="pass" name="pass" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                                </form>
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