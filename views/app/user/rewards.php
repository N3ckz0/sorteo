<?php require_once "header.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Premios</h1>
                        </div>
                        <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Premios</li>
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
                            <a href="/user/newreward" class="btn btn-success">Agregar Premio</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Premio</th>
                                        <th>Fecha del sorteo</th>
                                        <th>Precio del boleto</th>
                                        <th>Estado</th>
                                        <th>Categoría</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($_SESSION['rewards'] != null){
                                      foreach ($_SESSION['rewards'] as $r) {
                                        echo "<tr>
                                        <th scope='row' hidden>".$r["id"]."</th>
                                        <td>".$r["nombre"]."</td>
                                        <td>".$r["fecha"]."</td>
                                        <td>".$r["precioBoleto"]."</td>
                                        <td>".$r["estado"]."</td>
                                        <td>".$r["descripcionCatego"]."</td>
                                         <td><a class='btn' href='/user/modifyreward/".$r["id"]."'><i class='fa fa-solid fa-pen' style='color:rgb(255, 193, 7);'></i></a></td>
                                        <td><button class='delete-btn btn' data-id='".$r["id"]."'><i class='fa fa-solid fa-trash' style='color:rgb(220,53,69);'></i></button></td>
                                       </tr>";
                                    }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Premio</th>
                                        <th>Fecha del sorteo</th>
                                        <th>Precio del boleto</th>
                                        <th>Estado</th>
                                        <th>Categoría</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                 </tfoot>
                            </table>
                        </div>
                    </div>
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
                    text: "Este premio se eliminará permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirecciona a la ruta de eliminar con el ID correspondiente
                        window.location.href = '/user/deletereward/' + rewardId;
                    }
                });
            });
        });
    </script>
<?php require_once "footer.php"; ?>