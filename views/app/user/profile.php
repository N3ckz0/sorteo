<?php require_once "header.php"; ?>
<?php
    $nombre = ($ec->decrypt($data['profile']['nombre'])==null) ? $data['profile']['nombre'] : $ec->decrypt($data['profile']['nombre']);
    $apaterno = ($ec->decrypt($data['profile']['apaterno'])==null) ? $data['profile']['apaterno'] : $ec->decrypt($data['profile']['apaterno']);
    $amaterno = ($ec->decrypt($data['profile']['amaterno'])==null) ? $data['profile']['amaterno'] : $ec->decrypt($data['profile']['amaterno']);
    $correo = ($data['profile']['correo'] == null) ? "Sin correo electrónico." : $ec->decrypt($data['profile']['correo']);
    $telefono = ($data['profile']['telefono'] == null) ? "Sin telefono." : $ec->decrypt($data['profile']['telefono']);
 ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Perfil</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-body row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <div class="d-flex flex-column">
                                <img src="<?php echo $data['profile']['imagen']; ?>" alt="foto de perfil" class="img-fluid">
                                <a class="btn btn-info mt-3" href="/user/changeprofilephoto">Cambiar Imagen</a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <h2><?php echo $nombre . " " . $apaterno . " " . $amaterno; ?></h2>
                            </div>
                            <div class="form-group">
                                <label >Nombre de Usuario</label>
                                <h2><?php echo $data['profile']['usuario']; ?></h2>
                            </div>
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <h2><?php  echo $correo; ?></h2>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <h2><?php echo $telefono; ?></h2>
                            </div>
                            <div class="form-group d-flex justify-content-around">
                                <a href="/user/changeprofile" type="submit" class="btn btn-warning">Modificar Perfil</a>
                                <a href="/user/changepassword" type="submit" class="btn btn-danger">Cambiar Contraseña</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php require_once "footer.php"; ?>