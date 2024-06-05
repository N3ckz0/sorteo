<?php
class StripeController
{
	function __construct(){
		require_once "controllers/Site.php";
		require_once "models/TicketModel.php";
		require_once "models/StripeModel.php";
	}

	function ticket(){
		//model instance
		$page = new SiteController;
		$stripe = new Stripe_model;
		$data['privateKey'] = $stripe->getPrivateKey();
		require 'vendor/autoload.php';
		  \Stripe\Stripe::setApiKey($data['privateKey']['cpriv']);
		  $token = $_POST["stripeToken"];
		  session_start();
		  $monto = $_SESSION['reward']['precioBoleto'] * 100;
		  $charge = \Stripe\Charge::create([
		    "amount" => $monto,
			"currency" => "mxn",
		    "description" => "Pago en mi tienda...",
		    "source" => $token
		  ]);
		  $_SESSION['charge'] = $charge;
		  $id = $_SESSION['charge']['source']['id'];
		  $page->ticket();
		 echo "<script>JsBarcode('#barcode', '$id');</script>";


	}//end ticket


}
?>