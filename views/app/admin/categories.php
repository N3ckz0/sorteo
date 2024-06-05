<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Categorías</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Categorías</li>
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
                        <h3 class="card-title">
                            <a href="/admin/newcategory" class="btn btn-success">Agregar Categoría</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Categoría</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once "controllers/Encoded.php";
                                    $obj = new EncodedController;
                                    if($_SESSION['categories'] != null){
                                    foreach ($_SESSION['categories'] as $value) {
                                        echo "<tr>
                                        <th scope='row' hidden>".$value["id"]."</th>
                                        <td>".$value["descripcionCatego"]."</td>
                                        <td><a href='/admin/modifycategory/".$value["id"]."'><i class='fa fa-solid fa-pen' style='color:rgb(255, 193, 7);'></i></a></td>
                                        <td><button class='delete-btn btn' data-id='".$value["id"]."'><i class='fa fa-solid fa-trash' style='color:rgb(220,53,69);'></i></button></td>";
                                    }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Categoría</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                 </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Agrega un evento de clic a todos los botones de eliminar
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var categoryId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Si eliminas la categoría se eliminarán los premios registrados con la misma.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirecciona a la ruta de eliminar con el ID correspondiente
                        window.location.href = '/admin/deletecategory/' + categoryId;
                    }
                });
            });
        });
    </script>
<?php require_once "footer.php"; ?>