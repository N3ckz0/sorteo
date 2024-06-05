<?php require_once "header.php"; ?>
<style>
    .pos-relative{
        position: relative;
    }
    .button{
        position:  absolute;
        top: 0;
        right: 8px;
    }
</style>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Imagenes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/user/index">Inicio</a></li>
                                <li class="breadcrumb-item active">Imagenes</li>
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
                        <h3 class="card-title"><a href="/user/newimage" class="btn btn-success">Agregar Imagen</a></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            if($_SESSION['images']!=null){
                                                foreach ($_SESSION['images'] as $img) {
                                                    echo "<div class='col-sm-12 col-md-3 col-lg-2 pos-relative'>
                                                        <img src='".$img['url']."' class='img-fluid mb-3'>
                                                        <a href='/user/deleteimage/".$img['id']."' class='btn btn-danger rounded-circle button'><i class='bi bi-trash3-fill'></i></a>
                                                    </div>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
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

<?php require_once "footer.php"; ?>