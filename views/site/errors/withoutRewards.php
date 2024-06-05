<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sorteo Tribuna</title>
	<!--configuratioin for htaccess-->
	<base href="http://version1.test/">
	<!--Stylessheet-->
	<link rel="stylesheet" href="assets/css/styles.css">
	<!--Bootstrap css-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!--Bootstrap Icon-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="background: linear-gradient(rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>), rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>)), url('<?php echo $_SESSION['config']['imgfondo']; ?>') no-repeat center center fixed;!important">
	<div class="col-sm-12 col-md-6 col-xl-4 main-site" style="background: rgba(<?php echo $_SESSION['config']['colormenu']; ?>,<?php echo $_SESSION['config']['menudegradado']; ?>)!important">
		<img src="<?php echo $_SESSION['config']['logo']; ?>" alt="logo" class="img-fluid">
		<h2 class="text-center my-5">Lo sentimos, actualmente no hay productos disponibles.</h2>
		<h1 class="text-center my-5">¡Regresa Pronto!</h1>
	</div>
	<!--Bootstrap js-->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>