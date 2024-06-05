<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Modifica Categoría</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/categories">Categorías</a></li>
                                <li class="breadcrumb-item active">Modificar Categoría</li>
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
                        <div class="alert alert-warning d-flex align-items-center justify-content-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill mx-2"></i>
                            <div><strong>NOTA:</strong> Todos los campos son obligatorios.</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/savecategory" method="post">
                            <div class="mb-3">
                                <input type="text" id="idCategory" name="idCategory" value="<?php echo $_SESSION['modifyCategory']['id']; ?>" hidden>
                                <div>
                                    <label for="category" class="form-label">Categoría</label>
                                    <input type="text" class="form-control" id="category" name="category" required value="<?php echo $_SESSION['modifyCategory']['descripcionCatego']; ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Agregar Categoría</button>
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