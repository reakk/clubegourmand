<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 
<body>
 
<?php
 
/*
Supondo que o arquivo esteja dentro do
diret�rio ra�z e sub-diret�rio phpmailer/
*/
require "../phpmailer/class.phpmailer.php";
 
// conte�do da mensagem
$mensagem = "Testando o envio de email atrav�s de aplica��es locais";
 
// Estrutura HTML da mensagem
$msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
$msg .= "<html>";
$msg .= "<head></head>";
$msg .= "<body style=\"background-color:#fff;\" >";
$msg .= "<strong>MENSAGEM:</strong><br /><br />";
$msg .= $mensagem;
$msg .= "</body>";
$msg .= "</html>";
 
// Abaixo come�aremos a utilizar o PHPMailer.
 
/*
Aqui criamos uma nova inst�ncia da classe como $mail.
Todas as caracter�sticas, fun��es e m�todos da classe
poder�o ser acessados atrav�s da vari�vel (objeto) $mail.
*/
$mail = new PHPMailer(); //
 
// Define o m�todo de envio
$mail->Mailer     = "smtp";
 
// Define que a mensagem poder� ter formata��o HTML
$mail->IsHTML(true); //
 
// Define que a codifica��o do conte�do da mensagem ser� utf-8
$mail->CharSet    = "iso-8859-1";
 
// Define que os emails enviadas utilizar�o SMTP Seguro tls
$mail->SMTPSecure = "tls";
 
// Define que o Host que enviar� a mensagem � o Gmail
$mail->Host       = "smtp.gmail.com";
 
//Define a porta utilizada pelo Gmail para o envio autenticado
$mail->Port       = "587";                  
 
// Deine que a mensagem utiliza m�todo de envio autenticado
$mail->SMTPAuth   = "true";
 
// Define o usu�rio do gmail autenticado respons�vel pelo envio
$mail->Username   = "lauriberto@staff4solutions.com.br";
 
// Define a senha deste usu�rio citado acima
$mail->Password   = "vinile27";
 
// Defina o email e o nome que aparecer� como remetente no cabe�alho
$mail->From       = "lauriberto@staff4solutions.com.br";
$mail->FromName   = "Lauriberto Serillo Junior";
 
// Define o destinat�rio que receber� a mensagem
$mail->AddAddress("lauriberto@hotmail.com");
 
/*
Define o email que receber� resposta desta
mensagem, quando o destinat�rio responder
*/
$mail->AddReplyTo("lauriberto@staff4solutions.com.br", $mail->FromName);
 
// Assunto da mensagem
$mail->Subject    = "TESTE artigo ";
 
$htmlFile = "http://" . '127.0.0.1' . "/" . 'mbnovo/portalB' . "/includesS4S/executaBtnImprimeArtigo.php?print=N&id_conteudo=" . "3193". "";

//echo $htmlFile;
$buffer = file_get_contents($htmlFile); 
 
// Toda a estrutura HTML e corpo da mensagem
$mail->Body       = $buffer;
 
// Controle de erro ou sucesso no envio
if (!$mail->Send())
{
 
    echo "Erro de envio: " . $mail->ErrorInfo;
 
}
else{
 
    echo "Mensagem enviada com sucesso!";
 
}
 
?>
 
</body>
</html>