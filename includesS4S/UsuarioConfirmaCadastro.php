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

$colname_confirm = "-1";
if (isset($_GET['e'])) {
  $colname_confirm = $_GET['e'];
}
mysql_select_db($database_mb, $mb);
$query_confirm = sprintf("SELECT * FROM usuarios WHERE lista_negra ='0' AND email = %s", GetSQLValueString($colname_confirm, "text"));
$confirm = mysql_query($query_confirm, $mb) or die(mysql_error());
$row_confirm = mysql_fetch_assoc($confirm);
$totalRows_confirm = mysql_num_rows($confirm);
$email = $row_confirm['email'];
$nome = $row_confirm['nome'];
$lista = $row_confirm['lista_negra'];

mysql_select_db($database_mb, $mb);
$sql = "UPDATE usuarios SET status = 'A' where email='$email'";
mysql_query($sql, $mb);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirma&ccedil;&atilde;o de cadastro S4S</title>
</head>

<body>
<div style="text-align:center">
<?php 
if($totalRows_confirm>0){
	echo 'Usu&aacute;rio cadastrado com sucesso!</br>';
	echo $nome."</br>";
	echo 'Seja Bem Vindo a Staff 4 Solutions.';
}else{
	echo 'Ocorreu um erro.</br></br></br>';

mysql_select_db($database_mb, $mb);
$sqlbanido=sprintf("SELECT * FROM usuarios WHERE lista_negra ='1' AND email = %s", GetSQLValueString($colname_confirm, "text"));
$banido = mysql_query($sqlbanido, $mb) or die(mysql_error());
$row_banido = mysql_fetch_assoc($banido);
$usuarioBanido = $row_banido['lista_negra'];

if($usuarioBanido == '1'){
	echo 'Voc&ecirc; n&atilde;o pode mais se cadastrar.</br>';
	echo 'Seu email foi banido</br></br>';
	echo 'Entre em contato com o administrador caso tenho interesse em reativar sua conta.</br>';
	echo 'Atenciosamente:</br><i> Staff 4 Solutions</i>';
}
}
?>
</div>
</body>
</html>
<?php
mysql_free_result($confirm);
?>
