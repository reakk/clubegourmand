 
<?php


/*
Supondo que o arquivo esteja dentro do
diretório raíz e sub-diretório phpmailer/
*/
//require "/public_html/clubgourmand/includes/phpmailer/class.phpmailer.php";
//require_once '/public_html/clubgourmand/includesS4S/Conexao.class.php';

require "../includes/phpmailer/class.phpmailer.php";
require_once '../includesS4S/Conexao.class.php';


function getAssuntoMensagem($idConteudo) {
	try {
		//'instancia' singleton 
		$Conexao = Conexao :: getInstance();

		////////// INICIO CONSULTA REGISTROS GRID////////////////
		//submete a consulta ao banco 

		$sql = " select * from conteudos";
		$sql .= "  where id_conteudo=" . $idConteudo;

		$result = $Conexao->query($sql);
		$nome = '';
		//percorre o objeto mysqli_result retornado (array associativo) 
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$nome = $row['nome'];
		}
		//fecha a conexao 
		$Conexao->close();
		return $nome;
	} catch (Exception $e) {
		//se der erro mostra na tela 
		echo $e->getMessage();
	}
}

function my_file_get_contents( $site_url ){
	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	curl_setopt ($ch, CURLOPT_URL, $site_url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	ob_start();
	curl_exec($ch);
	curl_close($ch);
	$file_contents = ob_get_contents();
	ob_end_clean();
	return $file_contents;
}

function enviaEmail($destinatario, $id_controle_envio_news_letter) {

	$email_to = $destinatario;
//	$email_subject = getAssuntoMensagem($idConteudo);
	$email_subject = "News - Gourmand Midia";


	//$htmlFile = "http://" . '127.0.0.1' . "/public_html/clubgourmand/includesS4S/newsLetterEmailGourmand.php?print=N&id=" . $id_controle_envio_news_letter;
    $htmlFile = "http://www.clubgourmand.com.br/includesS4S/newsLetterEmailGourmand.php?print=N&id=" . $id_controle_envio_news_letter;

	//echo $htmlFile;
	//$buffer = file_get_contents($htmlFile);
$buffer = my_file_get_contents($htmlFile);

//echo  $buffer;
	$email_message = $buffer;
	try {
		// create email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";		
		$headers .= 'From: informativo@gourmandmidia.com.br' . "\r\n" .
		'Reply-To: informativo@gourmandmidia.com.br' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$result = mail($email_to, $email_subject, $email_message, $headers);

		if (!$result) {

			echo "Erro de envio: " . $mail->ErrorInfo;

		} else {

			echo "Mensagem enviada com sucesso!";

		}
	} catch (Exception $e) {
		//se der erro mostra na tela 
		echo $e->getMessage();
	}
	echo "FIM ENVIO exim";

}

try {
	//'instancia' singleton 
	$Conexao = Conexao :: getInstance();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 

	$sql = " SELECT id_controle_envio_email, id_produto_fk, id_produto_portal, id_clientes_fk, nome, email, data_solicitacao, data_envio_email, id_conteudo_fk,id_controle_envio_news_letter_fk ";
	$sql .= "  FROM  portal_gourmand.controle_envio_email";
	$sql .= "  where data_envio_email is null ";
    $sql = $sql . " LIMIT 0,50";

	$result = $Conexao->query($sql);

	//percorre o objeto mysqli_result retornado (array associativo) 
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		//echo $row['nome'];
		enviaEmail($row['email'], $row['id_controle_envio_news_letter_fk']);

		$sql = " update  portal_gourmand.controle_envio_email set data_envio_email = now(),status_envio='Enviado' where id_controle_envio_email=" . $row['id_controle_envio_email'];

		$resultUpdate = $Conexao->query($sql);

	}
	//fecha a conexao 
	$Conexao->close();
} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
}
echo "FIM ENVIO EMAIL atualizado imagem";
?>
