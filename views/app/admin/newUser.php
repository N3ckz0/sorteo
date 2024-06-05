<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Nuevo Usuario</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/users">Usuarios</a></li>
                                <li class="breadcrumb-item active">Nuevo Usuario</li>
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
                        <form action="/admin/adduser" method="post">
                            <div class="mb-3">
                                <div>
                                    <label for="name" class="form-label">Nombre/s</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mt-3">
                                    <label for="psurname" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="psurname" name="psurname" required>
                                </div>
                                <div class="mt-3">
                                    <label for="msurname" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="msurname" name="msurname" required>
                                </div>
                                <div class="mt-3">
                                    <label for="user" class="form-label">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="user" name="user" required>
                                </div>
                                <div class="mt-3">
                                    <label for="mail" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="mail" name="mail" required>
                                </div>
                                 <div class="mt-3">
                                    <label for="phone" class="form-label">Número Telefónico</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mt-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" value="pass1234" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Agregar Super Usuario</button>
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