<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Premio Actualmente Activo</h1>
                        </div>
                        <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/rewards">Premios</a></li>
                                <li class="breadcrumb-item active">Premio Activo</li>
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
                            <img src="<?php echo $_SESSION['active']['imagen']; ?>" alt="premio actual" class="img-fluid">
                        </div>
                        <div class="col-7">
                        	<h3 class="my-3"><?php echo $_SESSION['active']['nombre']; ?></h3>
              				<p><?php echo $_SESSION['active']['descripcion']; ?></p>
              				<hr>
                             <h3 class="my-3">Fecha del sorteo : <?php echo $_SESSION['active']['fecha']; ?></h3>
                            <p><?php echo $_SESSION['active']['descripcionSorteo']; ?></p>
                            <hr>
              				<h4 class="mt-3">Categoría</h4>
              				<div class="btn-group btn-group-toggle" data-toggle="buttons">
                				<label class="btn btn-default text-center">
                  					<input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  					<span class="text-xl"><?php echo $_SESSION['active']['descripcionCatego']; ?></span>
                				</label>
              				</div>
              				<div class="bg-gray py-2 px-3 mt-4">
                				<h4 class="mb-0"><small>Precio del Boleto</small></h4>
                				<h2 class="mb-0">$ <?php echo number_format($_SESSION['active']['precioBoleto']); ?> MXN</h2>
              				</div>
                            <div class="d-flex justify-content-center mt-3">
                                <a href="/admin/disable/<?php echo $_SESSION['active']['id'];  ?>" class="w-100 btn btn-danger btn-lg">Desactivar</a>
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