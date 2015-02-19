	     <?	
	$email = "lauriberto@hotmail.com";

	$message = "teste msg";
	$teste="vai ser o assunto";
	if (mail("teste2@mbassociados.com.br", "Email Subject", $message, "From: $email","-s$teste")) {

		echo "Mail successful";
	} else {
		echo "Mail failed.";
	};
?>	