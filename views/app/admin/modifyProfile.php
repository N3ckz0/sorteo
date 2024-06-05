<?php require_once "header.php"; ?>
<?php
    $nombre = ($ec->decrypt($data['user']['nombre'])==null) ? $data['user']['nombre'] : $ec->decrypt($data['user']['nombre']);
    $apaterno = ($ec->decrypt($data['user']['apaterno'])==null) ? $data['user']['apaterno'] : $ec->decrypt($data['user']['apaterno']);
    $amaterno = ($ec->decrypt($data['user']['amaterno'])==null) ? $data['user']['amaterno'] : $ec->decrypt($data['user']['amaterno']);
    $correo = ($data['user']['correo'] == null) ? "Sin correo electrónico." : $ec->decrypt($data['user']['correo']);
    $telefono = ($data['user']['telefono'] == null) ? "Sin telefono." : $ec->decrypt($data['user']['telefono']);
 ?>
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
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/profile">Perfil</a></li>
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
                                <form action="/admin/saveprofile" method="post">
                                    <div class="mb-3">
                                        <input type="text" id="id" name="id" value="<?php echo $_SESSION['Admin']['id']; ?>" hidden>
                                        <div>
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $nombre; ?>">
                                            <label for="psurname" class="form-label">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="psurname" name="psurname" required value="<?php echo $apaterno; ?>">
                                            <label for="msurname" class="form-label">Apellido Materno</label>
                                            <input type="text" class="form-control" id="msurname" name="msurname" required value="<?php echo $amaterno; ?>">
                                            <label for="user" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="user" name="user" required value="<?php echo $data['user']['usuario']; ?>">
                                             <label for="mail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="mail" name="mail" required value="<?php echo $correo; ?>">
                                            <label for="phone" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $telefono; ?>">
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