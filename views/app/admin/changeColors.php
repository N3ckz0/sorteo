<?php require_once "header.php"; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Modificar Perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/index">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/admin/config">Configuración</a></li>
                                <li class="breadcrumb-item active">Modificar Perfil</li>
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
                                <form action="/admin/savecolors" method="post">
                                    <div class="mb-3">
                                        <div>
                                            <label for="imgbgrgb" class="form-label">Color de sobrefondo (rgb)</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" id="imgbgrgb" name="imgbgrgb" required value="<?php echo $data['config']['colorfondo']; ?>">
                                                <input type="color" id="bgimg" class="form-control w-25" value="">
                                            </div>
                                            <label for="imgbgrgba" class="form-label">Degradado del color (rgba)</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" id="imgbgrgba" name="imgbgrgba" required value="<?php echo $data['config']['fondodegradado']; ?>">
                                                <div class="w-25 h-auto" style="background: rgba(<?php echo $data['config']['colorfondo']; ?>, <?php echo $data['config']['fondodegradado']; ?>);"></div>
                                            </div>
                                            <label for="menubgrgb" class="form-label">Degradado de menus (rgb)</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" id="menubgrgb" name="menubgrgb" required value="<?php echo $data['config']['colormenu']; ?>">
                                                <input type="color" id="bgmenu" class="form-control w-25" value="">
                                            </div>
                                            <label for="menubgrgba" class="form-label">Degradado del color  del menu (rgba)</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" id="menubgrgba" name="menubgrgba" required value="<?php echo $data['config']['menudegradado']; ?>">
                                                <div class="w-25 h-auto" style="background: rgba(<?php echo $data['config']['colormenu']; ?>,<?php echo $data['config']['menudegradado']; ?>);"></div>
                                            </div>
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
    let imgbgrgb = document.getElementById('imgbgrgb');
    let bgimg = document.getElementById('bgimg');
    let menubgrgb = document.getElementById('menubgrgb');
    let bgmenu = document.getElementById('bgmenu');
    function rgbToHex(r, g, b) {
        // Asegurarse de que los valores estén en el rango adecuado (0-255)
        r = Math.max(0, Math.min(255, r));
        g = Math.max(0, Math.min(255, g));
        b = Math.max(0, Math.min(255, b));
        // Convertir cada componente a hexadecimal y concatenarlos
        return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    }
    function separarRGB(cadena) {
        // Dividir la cadena en sus componentes separadas por coma y eliminar los espacios
        const componentes = cadena.split(',').map(componente => parseInt(componente.trim()));
        // Verificar si hay tres componentes
        if (componentes.length !== 3) {
            throw new Error('La cadena debe tener exactamente tres componentes separadas por coma.');
        }
        // Extraer y devolver los componentes por separado
        const r = componentes[0];
        const g = componentes[1];
        const b = componentes[2];

        return { r, g, b };
    }
    function hexToRgb(hex) {
      // Eliminar el # del principio si está presente
      hex = hex.replace(/^#/, '');

      // Convertir el color hexadecimal a RGB
      const bigint = parseInt(hex, 16);
      const r = (bigint >> 16) & 255;
      const g = (bigint >> 8) & 255;
      const b = bigint & 255;

      // Devolver el valor RGB en formato de objeto
      return { r, g, b };
    }
    // Obtener el color de la imagen y convertirlo a hexadecimal
    const imgColor = separarRGB(imgbgrgb.value);
    const imgHexColor = rgbToHex(imgColor.r, imgColor.g, imgColor.b);
    bgimg.value = imgHexColor;
    // Obtener el color del menú y convertirlo a hexadecimal
    const menuColor = separarRGB(menubgrgb.value);
    const menuHexColor = rgbToHex(menuColor.r, menuColor.g, menuColor.b);
    bgmenu.value = menuHexColor;
    bgimg.addEventListener('input', function() {
      // Obtener el valor del color seleccionado
      const colorValue = bgimg.value;
      // Convertir el valor del color de formato hexadecimal a RGB
      const rgbColor = hexToRgb(colorValue);
      imgbgrgb.value = rgbColor.r + "," + rgbColor.g + "," + rgbColor.b;
    });
    bgmenu.addEventListener('input', function() {
      // Obtener el valor del color seleccionado
      const colorValue = bgmenu.value;
      // Convertir el valor del color de formato hexadecimal a RGB
      const rgbColor = hexToRgb(colorValue);
      menubgrgb.value = rgbColor.r + "," + rgbColor.g + "," + rgbColor.b;
    });
</script>
<?php require_once "footer.php"; ?>