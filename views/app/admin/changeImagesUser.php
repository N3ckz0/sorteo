<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Cambiar Imagen del Premio</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/profile">Perfil</a></li>
                                <li class="breadcrumb-item active">Cambiar Imagen</li>
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
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 col-sm-12">
                                <form action="/admin/saveprofilephoto" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="text" id="id" name="id" value="<?php echo $_SESSION['Admin']['id']; ?>" hidden>
                                        <div class="d-flex flex-column justify-conten-center align-items-center">
                                            <img id="img" src="<?php echo $data['user']['imagen']; ?>" alt="image-icon" class="rounded mx-auto d-block img-fluid" style="width: 400px; height: 400px;">
                                            <span id="file-status"><?php echo $data['user']['imagen']; ?></span>
                                            <label for="imagen" class="btn btn-info my-4">Elige una Imagen <strong>*</strong></label>
                                            <input type="file" class="form-control w-25" id="imagen" name="imagen"  required hidden>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
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
        let span = document.getElementById('file-status');
        if (file) {
            const fileType = file.type;
            if (fileType.startsWith('image/')) {
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