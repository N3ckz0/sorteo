<?php
class SiteController
{
	//Construct
	function __construct(){
		require_once "models/TicketModel.php";
		require_once "models/RewardsModel.php";
		require_once "models/ConfigModel.php";
		require_once "models/StripeModel.php";
	}

	function index(){
		//model instance
		$rewards = new Rewards_model;
		$config = new Config_model;
		//
		session_start();
		$_SESSION['reward'] = $rewards->getActiveReward();
		$_SESSION['config'] = $config->getData();
		require_once "views/site/index.php";
	}//end index

	function payment(){
		//model instance
		$stripe = new Stripe_model;
		//
		$estado_session = session_status();
	    if($estado_session == PHP_SESSION_NONE)
	    {
	        session_start();
	    }
		$_SESSION['number'] = mt_rand(0,500);
		$data['publicKey'] = $stripe->getPublicKey();
		require_once "views/site/payment.php";
	}//end payment

	function ticket(){
		//model instance
		$obj = new Ticket_model;
		//form data
		$nombre = $_POST['name'];
		$apaterno = $_POST['psurname'];
		$amaterno = $_POST['msurname'];
		$correo = $_POST['mail'];
		$telefono = $_POST['phone'];
		$numero = $_POST['num'];
		$idPremio = $_POST['idP'];

		//
		$conf = false;
		$nums = $obj->getNumbers();
		if($nums != null){
			foreach ($nums  as $n) {
				if($n['numero'] == $numero){
					$conf = true;
				}
			}
			if($conf){
				$this->payment();
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>Swal.fire({
			        icon: 'error',
			        title: 'Error',
			        text: 'El número ya fué registrado.'
			    }).then((result) => {
			        if (result.isConfirmed) {
			            window.location.href = '/payment';
			        }
			    });</script>";
				die();
			}
		}
		$idTicket = $_SESSION['charge']['source']['id'];
		$idLastInsert = $obj->saveParticipant($nombre,$apaterno,$amaterno,$correo,$telefono);
		$idUsuario = $idLastInsert['id'];
		$obj->saveSoldTicket($numero,$idUsuario,$idTicket,$idPremio);
		$_SESSION['numticket'] = $numero = $_POST['num'];
		$this->enviarCorreo($_POST['mail'], "¡Gracias por tu compra!", "Tu compra ha sido procesada exitosamente.");
		require_once "views/site/ticket.php";
	}//end ticket

	function enviarCorreo($destinatario, $asunto, $mensaje){
	    // Cabeceras adicionales
	    $headers = "From: cortes.hoyos.eduardo@gmail.com\r\n";
	    $headers .= "Reply-To: cortes.hoyos.eduardo@gmail.com\r\n";
	    $headers .= "MIME-Version: 1.0\r\n";
	    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	    // Enviar correo electrónico
	    $resultado = mail($destinatario, $asunto, $mensaje, $headers);

	    if ($resultado) {
	        echo "Correo electrónico enviado correctamente.";
	    } else {
	        echo "Error al enviar el correo electrónico.";
	    }
	}//end enviarCorreo

}
?>