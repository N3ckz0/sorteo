<?php
	$estado_session = session_status();

    if($estado_session == PHP_SESSION_NONE)
    {
        session_start();
    }

    if($_SESSION['reward'] == null){
    	require_once "views/site/errors/withoutRewards.php";
    	die();
    }
?>
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
	<script src="assets/js/JsBarcode.all.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center" style="background: linear-gradient(rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>), rgba(<?php echo $_SESSION['config']['colorfondo']; ?>,<?php echo $_SESSION['config']['fondodegradado']; ?>)), url('<?php echo $_SESSION['config']['imgfondo']; ?>') no-repeat center center fixed;!important">