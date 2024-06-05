<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Súper Usuarios</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
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
                            <a href="/admin/newuser" class="btn btn-success">Agregar Súper Usuario</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once "controllers/Encoded.php";
                                    $obj = new EncodedController;
                                    if($_SESSION['users'] != null){
                                    foreach ($_SESSION['users'] as $value) {
                                        echo "<tr>
                                        <th scope='row' hidden>".$value["id"]."</th>
                                        <td>".$obj->decrypt($value["nombre"])."</td>
                                        <td>".$obj->decrypt($value["apaterno"])."</td>
                                        <td>".$obj->decrypt($value["amaterno"])."</td>
                                        <td>".$value["usuario"]."</td>
                                        <td>".$obj->decrypt($value["correo"])."</td>
                                        <td>".$obj->decrypt($value["telefono"])."</td>
                                        <td><a class='btn' href='/admin/modifyuser/".$value["id"]."'><i class='fa fa-solid fa-pen' style='color:rgb(255, 193, 7);'></i></a></td>
                                        <td><button class='delete-btn btn' data-id='".$value["id"]."'><i class='fa fa-solid fa-trash' style='color:rgb(220,53,69);'></i></button></td>
                                       </tr>";
                                    }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
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
                var rewardId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Este usuario se eliminará permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirecciona a la ruta de eliminar con el ID correspondiente
                        window.location.href = '/admin/deleteuser/' + rewardId;
                    }
                });
            });
        });
    </script>
        <!--Pagination of users-->
    <script>
        (function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
<?php require_once "footer.php"; ?>