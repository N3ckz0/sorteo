<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Configuración de Stripe</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Stripe</li>
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
                        <h3 class="card-title">Claves de stripe</h3>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="container row">
                            <div class="col-lg-12 col-sm-12">
                                <label for="publicKey">Clave Pública</label>
                                <input type="text" class="form-control w-100" placeholder="Clave Pública" id="publicKey" name="publicKey" disabled value="<?php echo $data['publicKey']['cpub']; ?>">
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="privateKey">Clave Privada</label>
                                <input type="text" class="form-control w-100" placeholder="Clave Privada" id="privateKey" name="privateKey" disabled value="<?php echo $data['privateKey']['cpriv']; ?>">
                            </div>
                            <div class="col-lg-12 col-sm-12 my-4 d-flex justify-content-center">
                                <a href="/admin/modifystripe" class="btn btn-info w-50">Cambiar Claves</a>
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