<?php
class EncodedController{

    function encrypt($text) {
	    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	    $iv = openssl_random_pseudo_bytes($ivlen);
	    $encryption = openssl_encrypt($text, $cipher, CLAVE_ENCRIPTADO, $options=0, $iv);
	    return base64_encode($iv.$encryption);
	}//end encrypt

    function decrypt($text) {
    	if($text!=null){
		    $encryption = base64_decode($text);
		    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		    $iv = substr($encryption, 0, $ivlen);
		    $longitud_iv = strlen($iv);
		    if ($longitud_iv < $ivlen) {
		        $iv = str_pad($iv, $ivlen, "\0");
		    }
		    $encryption = substr($encryption, $ivlen);
		    return openssl_decrypt($encryption, $cipher, CLAVE_ENCRIPTADO, $options=0, $iv);
		}else{
			return null;
		}
	}//end decrypt

}
?>