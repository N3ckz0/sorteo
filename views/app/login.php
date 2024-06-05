<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar Sesión</title>
	<!--configuratioin for htaccess-->
	<base href="http://version1.test/">
	<!--Stylessheet-->
	<link rel="stylesheet" href="assets/css/styles.css">
	<!--Bootstrap css-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!--Bootstrap Icons-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="background: linear-gradient(rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>), rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>)), url('<?php echo $_SESSION['config']['imgfondo']; ?>') no-repeat center center fixed;!important">
	<!--login form-->
	<div class="col-sm-12 col-md-8 col-xl-3">
		<form action="/app/index" method="post" class="form-login" id="form-login">
			<div class="alert alert-danger" role="alert" id="error-msg" hidden></div>
			<img src="assets/media/logo.png" alt="Logo Tribuna" class="img-fluid">
			<div class="d-flex mt-4 mb-2">
				<i class="icons bi bi-person-fill"></i>
				<input type="text" class="form-control" name="user" id="user" placeholder="Usuario" required>
			</div>
			<div class="d-flex mt-2 mb-4">
				<i class="icons bi bi-lock-fill"></i>
				<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" pattern=".{8,16}" title="La contraseña debe tener mínimo 8 caracteres." required>
			</div>
			<button class="btn btn-tribuna w-100">Iniciar Sesión</button>
		</form>
	</div>
	<!--end login form-->

	<!--Bootstrap js-->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>