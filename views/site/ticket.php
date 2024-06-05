<?php require_once "header.php" ?>
	<div class="col-sm-12 col-md-6 col-xl-4 boleto">
		<div class="content">
			<!--HEADER-->
			<h4 class="text-start p-2">Boleto <?php echo $_SESSION['config']['empresa']; ?></h4>
			<div class="separador"></div>
			<div class="d-flex flex-column pb-2">
				<div class="d-flex">
					<h5 class="text-start m-0 p-0 pt-2">Estimado Cliente</h5>
					<button id="btn-print" class="btn btn-tribuna ms-auto" onclick="printTicket()"><i class="bi bi-printer"></i></button>
				</div>
				<h6 class="text-justify">Queremos agradecer por su confianza y participar en nuestro sorteo. Las especificaciones de compra se muestran a continuación</h6>
			</div>
			<h4 class="text-start">Especificaciones de compra</h4>
			<div class="separador-2"></div>
			<div class="details mt-4">
				<div class="d-flex mt-1">
					<h6 class="fw-bold">ID de compra: </h6>
					<h6 class="ms-auto fw-light"><?php echo $_SESSION['charge']['source']['id']; ?></h6>
				</div>
				<div class="d-flex mt-1">
					<h6 class="fw-bold">Premio sorteado: </h6>
					<h6 class="ms-auto fw-light"><?php echo $_SESSION['reward']['nombre']; ?></h6>
				</div>
				<div class="d-flex mt-2">
					<h6 class="fw-bold">Estado de compra: </h6>
					<h6 class="ms-auto fw-light">Exitoso.</h6>
				</div>
				<div class="d-flex mt-2">
					<h6 class="fw-bold">Número de boleto: </h6>
					<h6 class="ms-auto fw-light"><?php echo $_SESSION['numticket']; ?></h6>
				</div>
			</div>
			<div class="d-flex mt-4">
				<h5 class="fw-bold">Costo de boleto: </h6>
				<h5 class="ms-auto fw-light">$<?php echo $_SESSION['charge']['amount']/100; ?> <?php echo strtoupper($_SESSION['charge']['currency']); ?></h6>
			</div>
			<div class="separador"></div>
			<div class="d-flex justify-content-center align-items-center">
				<svg id="barcode"></svg>
			</div>
			<div class="d-flex justify-content-center">
				<a id="btn-buy" href="/payment" class="btn btn-tribuna w-50">Comprar Otro Boleto</a>
			</div>
		</div>
	</div>

<script>
	function printTicket(){
		let btnprint = document.getElementById("btn-print");
		let btnbuy = document.getElementById("btn-buy");
		btnprint.hidden = true;
		btnbuy.hidden = true;
		window.addEventListener("afterprint", function() {
			btnprint.hidden = false;
			btnbuy.hidden = false;
		});
		window.print();
	}
</script>
<?php require_once "footer.php" ?>