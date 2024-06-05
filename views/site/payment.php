<?php require_once "header.php" ?>
	<!--STRIPE CONFIGURATION-->
	<script src="https://js.stripe.com/v3/"></script>
	<style>
		.StripeElement {
	        height: 40px;
	        padding: 10px 12px;
	        border-radius: 4px;
	        border: 1px solid transparent;
	        border-bottom: 3px solid var(--btn-color)!important;
	        -webkit-transition: box-shadow 150ms ease;
	        transition: box-shadow 150ms ease;
     	}
		.StripeElement--focus {
        	box-shadow: 0 1px 3px 0 #cfd7df;
      	}
      	.StripeElement--invalid {
        	border-color: #fa755a;
      	}
      	.StripeElement--webkit-autofill {
        	background-color: #fefde5 !important;
      	}
	</style>
	<!--payment form-->
	<div class="col-sm-12 col-md-8 main-site" style="background: rgba(<?php echo $_SESSION['config']['colormenu']; ?>,<?php echo $_SESSION['config']['menudegradado']; ?>)!important">
		<div class="row flex-sm-row-reverse payment">
			<!--data ticket-->
			<div class="col-sm-12 col-md-12 col-xl-8 d-flex flex-column justify-content-around" style="background: var(--btn-color);">
				<h1 class="text-center"><?php echo $_SESSION['config']['empresa']; ?></h1>
				<div>
					<h2 class="text-center">GRAN SORTEO DE UN</h2>
					<h2 class="text-center"><?php echo $_SESSION['reward']['nombre']; ?></h2>
				</div>
				<div 	class="d-flex justify-content-center align-items-center">
					<h2>Numero:</h2>
					<h1 class="mx-2" id="numero"> <?php echo $_SESSION['number']; ?></h1>
					<button type="button" class="btn btn-tribuna2" data-bs-toggle="modal" data-bs-target="#modifyNumber">
						<i class="bi bi-pencil-square"></i>
           </button>
				</div>
				<div class="d-flex justify-content-center"><div class="alert alert-danger text-center w-50" role="alert" id="alerta" hidden></div></div>
				<h3 class="text-center"><?php echo $_SESSION['reward']['fecha']; ?>    |    Costo del boleto : $<?php echo $_SESSION['reward']['precioBoleto']; ?> MXN</h3>
				<div class="d-flex justify-content-center"><div class="alert alert-warning text-center w-100" role="alert" id="alerta"><i class="bi bi-info-circle-fill"></i><?php echo $_SESSION['reward']['descripcionSorteo']; ?> . <a href="#" id="terminos-link">Leer Terminos y Condiciones</a></div></div>
			</div>
			<!--end end data ticket-->
			<!--form-->
			<div class="col-sm-12 col-md-12  col-xl-4">
				<h2>Ingresa  tus datos</h2>
				<form action="/ticket" method="post" id="payment-form">
					<div class="my-1">
						<input type="text" id="idP" name="idP" value="<?php echo $_SESSION['reward']['id']; ?>" hidden>
					</div>
					<div class="my-1">
						<input type="text" class="form-control transparent-input" placeholder="Nombre" id="name" name="name" required>
					</div>
					<div class="my-1">
						<input type="text" class="form-control transparent-input" placeholder="Apellido paterno" id="psurname" name="psurname" required>
					</div>
					<div class="my-1">
						<input type="text" class="form-control transparent-input" placeholder="Apellido materno" id="msurname" name="msurname" required>
					</div>
					<div class="my-1">
						<input type="email" class="form-control transparent-input" placeholder="Correo electrónico" id="mail" name="mail" required>
					</div>
					<div class="my-1">
						<input type="text" class="form-control transparent-input" placeholder="Teléfono" id="phone" name="phone" required>
					</div>
					<input type="text" id="num" name="num" value="<?php echo $_SESSION['number']; ?>" hidden>
					<div class="my-2">
						<label for="card-element" class="form-label" style="color: #fff;">
	          				Tarjeta de Credito o Debito
	        			</label>
	        			<div id="card-number-element"></div>
						<div id="card-expiry-element"></div>
						<div id="card-cvc-element"></div>
						<div class="alert alert-danger" role="alert" id="card-errors" hidden></div>
						<img src="assets/media/payments.png">
					</div>
					<div class="form-check text-start my-3 text-white">
						<input type="checkbox" class="form-check-input" id="check-terminos" onchange="verifica()">
						Aceptar Terminos y condiciones
					</div>
					<div class="my-3">
						<button type="submit" class="btn btn-tribuna w-100" id="btn-comprar" disabled>Pagar Boleto</button>
					</div>
				</form>
			</div>
			<!--end form-->
		</div>
	</div>
	<!-- Modal -->
<div class="modal fade" id="modifyNumber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Escribe el nuevo número</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="newNumber text-dark" class="form-label">El número debe ser mayor a 100 y menor a 500</label>
        <input type="text" id="newNumber" name="newNumber" class="form-control" placeholder="Ej. 345">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tribuna2 " data-bs-dismiss="modal" onclick="changeNum()">Save changes</button>
      </div>
    </div>
  </div>
</div>
	<!--end payment form-->

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("terminos-link").addEventListener("click", function(event) {
    event.preventDefault(); // Previene la acción predeterminada del enlace

    // Muestra el Sweet Alert
    Swal.fire({
      title: '<span style="color: #000;">Términos y Condiciones</span>',
      text: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo dicta quos odit inventore, debitis provident vero soluta vitae repellendus consectetur, eum deleniti expedita culpa sit at veniam incidunt sequi? Magnam maiores quaerat saepe repellendus in harum nulla amet illo dicta eaque voluptas eligendi repudiandae illum voluptatum, explicabo impedit nam fugit similique accusamus. Mollitia quibusdam dolores libero a et repudiandae temporibus laudantium obcaecati vero corrupti exercitationem maxime reprehenderit aliquam unde dicta amet voluptatum id animi, tempore quod repellendus error tenetur eum. Est, quos nulla ex earum nemo eligendi modi porro ut, in, velit quidem beatae, vitae similique itaque culpa nesciunt quia!',
      icon: 'info',
      confirmButtonText: 'Cerrar'
    });
  });
});
</script>

	<!--script fo error number-->
	<script>
		function showError(){
			let alert = document.getElementById('alerta');
			alert.removeAttribute('hidden');
			alert.textContent = "El numero ya fué usado anteriormente.";
		}
	</script>

	<!--script for  validation privacy-->
<script>
		function changeNum(){
			let newNum = document.getElementById('newNumber');
			let input = document.getElementById('num');
			let numero = document.getElementById('numero');
			let modal = document.getElementById('modifyNumber');
			if(newNum.value > 0 & newNum.value < 500){
				input.value = newNum.value;
				numero.textContent = newNum.value;
				modal.classList.remove('show');
			}
		}
</script>

	<script>
		function verifica(){
			let check = document.getElementById('check-terminos');
			let btn = document.getElementById('btn-comprar');
			if (check.checked) {
				btn.removeAttribute('disabled');
			}else{
				btn.setAttribute('disabled',true);
			}
		}
	</script>
	<!--end script for  validation privacy-->
	<!--scritp for Stripe-->
	<script>
    var stripe = Stripe('<?php echo $data['publicKey']['cpub']; ?>');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#fff',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var cardNumber = elements.create('cardNumber', {style: style});
    var cardExpiry = elements.create('cardExpiry', {style: style});
    var cardCvc = elements.create('cardCvc', {style: style});

    cardNumber.mount('#card-number-element');
    cardExpiry.mount('#card-expiry-element');
    cardCvc.mount('#card-cvc-element');

    cardNumber.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
			displayError.removeAttribute("hidden");
            displayError.textContent = event.error.message;
        } else {
			displayError.hidden = true;
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(cardNumber).then(function(result) {
            if (result.error) {				
                var errorElement = document.getElementById('card-errors');
				errorElement.removeAttribute("hidden");
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>
    <!--end script for Stripe-->
<?php require_once "footer.php" ?>