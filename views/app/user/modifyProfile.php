<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Modificar Perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/user/profile">Perfil</a></li>
                                <li class="breadcrumb-item active">Modificar Perfil</li>
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
                                <form action="/user/saveprofile" method="post">
                                    <div class="mb-3">
                                        <input type="text" id="id" name="id" value="<?php echo $_SESSION['User']['id']; ?>" hidden>
                                        <div>
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $ec->decrypt($data['user']['nombre']); ?>">
                                            <label for="psurname" class="form-label">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="psurname" name="psurname" required value="<?php echo $ec->decrypt($data['user']['apaterno']); ?>">
                                            <label for="msurname" class="form-label">Apellido Materno</label>
                                            <input type="text" class="form-control" id="msurname" name="msurname" required value="<?php echo $ec->decrypt($data['user']['amaterno']); ?>">
                                            <label for="user" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="user" name="user" required value="<?php echo $data['user']['usuario']; ?>">
                                             <label for="mail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="mail" name="mail" required value="<?php echo $ec->decrypt($data['user']['correo']); ?>">
                                            <label for="phone" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $ec->decrypt($data['user']['telefono']); ?>">
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