<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Participantes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Participantes</li>
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
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>ID de pago</th>
                                        <th>Premio</th>
                                        <th>Número de boleto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once "controllers/Encoded.php";
                                    $obj = new EncodedController;
                                    if($_SESSION['participants'] != null){
                                    foreach ($_SESSION['participants'] as $value) {
                                        echo "<tr>
                                        <td>".$value["nombre"]."</td>
                                        <td>".$value["apaterno"]."</td>
                                        <td>".$value["amaterno"]."</td>
                                        <td>".$value["correo"]."</td>
                                        <td>".$value["telefono"]."</td>
                                        <td>".$value["idTicket"]."</td>
                                        <td>".$value["pn"]."</td>
                                        <td>".$value["numero"]."</td>
                                       </tr>";
                                    }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>ID de pago</th>
                                        <th>Premio</th>
                                        <th>Número de boleto</th>
                                    </tr>
                                 </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!--Pagination of users-->
<?php require_once "footer.php"; ?>