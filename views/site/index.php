<?php require_once "header.php" ?>
	<!--main content-->
	<div class="col-sm-12 col-md-6 col-xl-4 main-site" style="background: rgba(<?php echo $_SESSION['config']['colormenu']; ?>,<?php echo $_SESSION['config']['menudegradado']; ?>)!important">
		<img src="<?php echo $_SESSION['config']['logo']; ?>" alt="Logo Tribuna" class="img-fluid">
		<h2 class="text-center">Participa en nuestro sorteo y gana un premio</h2>
		<h3 class="text-center">El premio disponible es el siguiente:</h3>
		<h1 class="text-center"><?php echo $_SESSION['reward']['nombre']; ?></h1>
		<img src="<?php echo $_SESSION['reward']['imagen']; ?>" alt="premio" class="rounded mx-auto d-block site-image">
		<h3 class="main-text my-3">Descripción : <br><?php echo $_SESSION['reward']['descripcion']; ?></h3>
		<h3 class="main-text text-center my-3">Precio del boleto : $<?php echo number_format($_SESSION['reward']['precioBoleto']); ?> MXN</h3>
		<a href="/payment" class="btn btn-tribuna w-100">Comprar Boleto</a>
	</div>
	<!--end main content-->
<?php require_once "footer.php" ?>