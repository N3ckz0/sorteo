<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Modificar Premio</h1>
                        </div>
                        <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/user/rewards">Premios</a></li>
                                <li class="breadcrumb-item active">Modificar Premio</li>
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
                    <div class="card-body row">
                        <div class="col-sm-12 col-lg-6 col-xl-5 text-center d-flex flex-column align-items-center justify-content-center">
                            <img id="img" src="<?php echo $_SESSION['reward']['imagen']; ?>" alt="image-icon" class="rounded mx-auto d-block img-fluid" style="width: 400px; height: 400px;">
                            <span id="file-status"><?php echo $_SESSION['reward']['imagen']; ?></span>
                            <a class="btn btn-info my-4" href="/user/changeimagesreward">Cambiar Imagen <strong>*</strong></a>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-7">
                            <form action="/user/savereward" method="post" >
                                <div class="mb-3">
                                     <input type="text" name="idReward" id="idReward" value="<?php echo $_SESSION['reward']['id']; ?>" hidden>
                                    <div class="mt-3">
                                        <label for="reward" class="form-label">Nombre del premio <strong>*</strong></label>
                                        <input type="text" class="form-control" id="reward" name="reward" required value="<?php echo $_SESSION['reward']['nombre']; ?>">
                                    </div>
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Descripción del premio <strong>*</strong></label>
                                        <textarea id="summernote" name="description">
                                           <?php echo $_SESSION['reward']['descripcion']; ?>
                                        </textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="date">Fecha del sorteo <strong>*</strong></label>
                                        <input type="date" class="form-control" id="date" name="date" required value="<?php echo $_SESSION['reward']['fecha'];; ?>">
                                    </div>
                                    <label for="ticket" class="form-label mt-3">Precio del boleto <strong>*</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="ticket" name="ticket" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Por favor, ingrese un número válido" step="0.01" value="<?php echo $_SESSION['reward']['precioBoleto']; ?>">
                                    </div>
                                    <div class="mt-3">
                                        <label for="info" class="form-label">Descripción del sorteo <strong>*</strong></label>
                                        <textarea class="form-control" id="info" name="info" rows="3" required><?php echo $_SESSION['reward']['descripcionSorteo']; ?></textarea>
                                    </div>
                                    <input type="text" id="url-img" name="url-img" value="<?php echo $_SESSION['reward']['imagen'];  ?>" hidden>
                                    <label class="form-label mt-3">Selecciona una Categoría <strong>*</strong></label>
                                    <div>
                                        <?php
                                        if($_SESSION['categoriestorewards'] != null){
                                        foreach ($_SESSION['categoriestorewards'] as $c) {
                                            if($_SESSION['reward']['idCat'] == $c['id']){
                                                echo "<div class='form-check form-check-inline'>
                                                            <input class='form-check-input' type='radio' name='categories' id='inlineRadio".$c['id']."' value='".$c['id']."' required checked>
                                                            <label class='form-check-label' for='inlineRadio1'>".$c['descripcionCatego']."</label>
                                                        </div>";
                                            }else{
                                                 echo "<div class='form-check form-check-inline'>
                                                            <input class='form-check-input' type='radio' name='categories' id='inlineRadio".$c['id']."' value='".$c['id']."' required>
                                                            <label class='form-check-label' for='inlineRadio1'>".$c['descripcionCatego']."</label>
                                                        </div>";
                                            }
                                        }}?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
                <div class="card-footer">
                        <div class="my-3">
                            <div class="alert alert-danger" role="alert" id="alerta" hidden></div>
                        </div>
                    </div>
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<?php require_once "footer.php"; ?>