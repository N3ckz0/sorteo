<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Nuevo Premio</h1>
                        </div>
                        <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/rewards">Premios</a></li>
                                <li class="breadcrumb-item active">Nuevo Premio</li>
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
                    <div class="card-body ">
                        <form class="row" action="/admin/addreward" method="post" enctype="multipart/form-data">
                        <div class="col-sm-12 col-lg-6 col-xl-5 text-center d-flex flex-column align-items-center justify-content-center">
                            <img id="img" src="assets/media/image.png" alt="image-icon" class="rounded mx-auto d-block img-fluid" style="width: 400px; height: 400px;">
                            <span id="file-status">Niguna imagen seleccionada</span>
                            <label for="imagen" class="btn btn-info my-4">Elige una Imagen <strong>*</strong></label>
                            <input type="file" class="form-control w-25" id="imagen" name="imagen"  required hidden>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-7">

                                <div class="mb-3">
                                    <div class="mt-3">
                                        <label for="reward" class="form-label">Nombre del premio <strong>*</strong></label>
                                        <input type="text" class="form-control" id="reward" name="reward" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Descripción del premio <strong>*</strong></label>
                                        <!--<textarea type="text" class="form-control my_summernote" id="description" name="description" rows="3" required></textarea>-->
                                        <textarea id="summernote" name="description">
                                            Escribre <em>la descripcion</em> <u>del premio</u> <strong>aqui</strong>
                                        </textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="date">Fecha del sorteo <strong>*</strong></label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <label for="ticket" class="form-label mt-3">Precio del boleto <strong>*</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="ticket" name="ticket" required pattern="[0-9]+(\.[0-9]{1,2})?" title="Por favor, ingrese un número válido" step="0.01">
                                    </div>
                                    <div class="mt-3">
                                        <label for="info" class="form-label">Descripción del sorteo <strong>*</strong></label>
                                        <textarea class="form-control" id="info" name="info" rows="3" required></textarea>
                                    </div>
                                    <input type="text" id="url-img" name="url-img" hidden>
                                    <label class="form-label mt-3">Selecciona una Categoría <strong>*</strong></label>
                                    <div>
                                        <?php
                                        if($_SESSION['categoriestorewards'] != null){
                                        foreach ($_SESSION['categoriestorewards'] as $c) {
                                            echo "<div class='form-check form-check-inline'>
                                                            <input class='form-check-input' type='radio' name='categories' id='inlineRadio".$c['id']."' value='".$c['id']."' required>
                                                            <label class='form-check-label' for='inlineRadio1'>".$c['descripcionCatego']."</label>
                                                        </div>";
                                        }}?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Agregar Premio</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        let span = document.getElementById('file-status');
        let url = document.getElementById('url-img');
        if (file) {
            const fileType = file.type;
            if (fileType.startsWith('image/')) {
                span.textContent = file.name;
                url.value = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageURL = e.target.result;
                    document.getElementById('img').src = imageURL;
                };

                reader.readAsDataURL(file);
            }
        }
    });
</script>
<?php require_once "footer.php"; ?>