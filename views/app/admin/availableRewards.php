<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Premios Autorizados</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/rewards">Premios</a></li>
                                <li class="breadcrumb-item active">Premios Autorizados</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
             <section class="content">
                <!-- Default box -->
                <div class='card card-solid'>
                    <div class='card-body pb-0'>
                        <div class='row'>
                            <?php
                            if($_SESSION['authorized'] == null){
                                echo "No hay premios autorizados.";
                            }else{
                                foreach ($_SESSION['authorized'] as $p) {
                                    echo "<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column'>
                                <div class='card bg-light d-flex flex-fill'>
                                    <div class='card-header text-muted border-bottom-0'><br></div>
                                    <div class='card-body pt-0'>
                                        <div class='row'>
                                            <div class='col-7'>
                                                <h2 class='lead text-xl'><b>".$p['nombre']."</b></h2>
                                                <p class='text-muted text-lg'>".$p['descripcion']."</p>
                                                <ul class='ml-4 mb-0 fa-ul text-muted'>
                                                    <li class='text-lg'><span class='fa-li'><i class='bi bi-currency-dollar'></i></span>".number_format($p['precioBoleto'])." MXN</li>
                                                    <li class='text-lg'><span class='fa-li'><i class='bi bi-tag'></i></span>".$p['descripcionCatego']."</li>
                                                </ul>
                                            </div>
                                            <div class='col-5 text-center'>
                                                <img src='".$p['imagen']."' alt='user-avatar' class='img-fluid'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-footer'>
                                        <div class='text-right'>";
                                            if($p['actived']!=true){
                                                echo "<a href='/admin/active/".$p["id"]."' class='btn btn-sm btn-success'>
                                                <i class='bi bi-check-circle'></i> Activar Premio
                                                </a>";
                                            }else{
                                                echo "<button class='btn btn-sm btn-info' disabled>
                                                <i class='bi bi-check-circle'></i> Premio activado
                                                </button>";
                                            }
                                        echo "</div>
                                    </div>
                                </div>
                            </div>";
                                }
                            }
                            ?>

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