<body bgcolor="#CCCCCC" text="#000000">
<?php require_once('../Connections/mb.php'); ?>
<?php


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


mysql_select_db($database_mb, $mb);

$sql = "select email as adm from configs";
$emailA = mysql_query($sql, $mb)or die (mysql_error());
$rowEmail = mysql_fetch_assoc($emailA);
$adm = $rowEmail['adm'];

$colname_user = "-1";
if (isset($_GET['usuario'])) {
  $colname_user = $_GET['usuario'];
}
mysql_select_db($database_mb, $mb);
$query_user = sprintf("SELECT * FROM usuarios WHERE id_usuarios = %s", GetSQLValueString($colname_user, "int"));
$user = mysql_query($query_user, $mb) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
$email = $row_user['email'];
$nome = $row_user['nome'];
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrador<". $adm .">\r\n";


$mensagem = "
<html>
<head>
 <title>Usuário Desativado</title>
</head>
<body>
	Olá $nome, sua conta foi desativada com sucesso!</br>
clique <a href='http://staff4solutions.com.br/s4s/includesS4S/UsuarioConfirmaCadastro.php?e=$email'> aqui </a> para reativar sua conta.
	
</body>

</html>
";

mysql_select_db($database_mb, $mb);
$sql = "UPDATE usuarios SET status = 'I' where id_usuarios = $colname_user";
$upUSER = mysql_query($sql, $mb) or die(mysql_error());


mail($email,"S4S",$mensagem,$headers);

mysql_free_result($user);
?>
<table width="90%" align="center">
  <tr>
    <td align="center">
	<?php echo "Usu&aacute;rio ".$row_user['nome']." Desativado!"; ?>
    </td>
  </tr>
  <tr align="center">
    <td>Voc&ecirc; receber&aacute; um email confirmando. </td>
  </tr>
</table>
