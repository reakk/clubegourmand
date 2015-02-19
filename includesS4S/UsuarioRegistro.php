<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once('../Connections/mb.php'); 

mysql_select_db($database_mb, $mb);

$sql = "select email as adm from configs";
$emailA = mysql_query($sql, $mb)or die (mysql_error());
$rowEmail = mysql_fetch_assoc($emailA);
$adm = $rowEmail['adm'];
$nome = $_GET['n'];
$email = $_GET['e'];

//$senha = $_GET['s'];
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrador<". $adm .">\r\n";


$mensagem = "
<html>
<head>
 <title>Confirme Sua conta</title>
</head>
<body>
	Olá $nome, Clique <a href='http://staff4solutions.com.br/s4s/includesS4S/UsuarioConfirmaCadastro.php?e=$email'> aqui </a> para ativar sua conta.</br>

	
</body>

</html>
";
$mensagem2 = "
<html>
<head>
 <title>Novo Usuário</title>
</head>
<body>
	Nome: $nome</br>
	Email: $email</br>
	
</body>

</html>
";
mail($email,"Confirmação de cadastro S4S",$mensagem,$headers);
mail($adm,"Novo Usuário",$mensagem2,$headers);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body bgcolor="#000000" text="#CCCCCC" link="#CCCCCC">
<table width="350" align="center">
  <tr>
    <td>
    Ol&aacute; <?php echo $nome ?></br>
    <br />    Um email de confirma&ccedil;&atilde;o foi enviado para <?php echo $_GET['e']; ?><br />
    Verifique sua caixa de entrada e ative sua conta.
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>