<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Nueva Imagen</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/user/images">Imagenes</a></li>
                                <li class="breadcrumb-item active">Nueva Imagen</li>
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
                        <h3 class="card-title">Las imagenes se guardan en el servido para ser usadar al mostrar un premio</h3>
                    </div>
                    <div class="card-body">
                        <form action="/user/addimage" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-conten-center align-items-center">
                            <img id="img" src="assets/media/image.png" alt="image-icon" class="rounded mx-auto d-block" style="width: 400px; height: 400px;">
                            <span id="file-status">Niguna imagen seleccionada</span>
                            <label for="imagen" class="btn btn-info my-4">Elige una Imagen</label>
                            <input type="file" class="form-control w-25" id="imagen" name="imagen"  required hidden>
                            <button type="submit" class="btn btn-success w-25" id="guarda" disabled>Guardar</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        let btn = document.getElementById('guarda');
        let span = document.getElementById('file-status');
        if (file) {
            const fileType = file.type;
            if (fileType.startsWith('image/')) {
                btn.disabled = false;
                span.textContent = file.name;
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