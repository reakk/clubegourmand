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


$usuario = $_GET['usuario'];

mysql_select_db($database_mb, $mb);
$query_usuario = "SELECT * FROM usuarios where id_usuarios = $usuario";
$usuario = mysql_query($query_usuario, $mb) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_comentarios = "-1";
if (isset($_GET['usuario'])) {
  $colname_comentarios = $_GET['usuario'];
}
mysql_select_db($database_mb, $mb);
$query_comentarios = sprintf("SELECT * FROM comentarios c left join conteudos ct on c.id_comentario_conteudo_fk = ct.id_conteudo WHERE usuario_comentario = %s order by c.id_comentario DESC", GetSQLValueString($colname_comentarios, "int"));
$comentarios = mysql_query($query_comentarios, $mb) or die(mysql_error());
$row_comentarios = mysql_fetch_assoc($comentarios);
$totalRows_comentarios = mysql_num_rows($comentarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sem t&iacute;tulo</title>
</head>

<body bgcolor="#CCCCCC" text="#000000">
<div id="admAqui" style="border:1px solid black; border-radius:10px; width:80%; margin:0 auto; background-color:#999; margin-top:20px; margin-bottom:20px; padding:15px">
  <table width="100%" align="center">
    <tr>
      <td colspan="3" align="center">
      	<div style="border:2px solid #666; border-radius:10px; background-color:#ebebeb">
      		Seja Bem Vindo <?php echo $row_usuario['nome']; ?> !
      	</div>
      </td>
    </tr>
    <tr>
      <td width="70"><div id="fotoUsuario"><a href="alterarFoto.php?id_usuarios=<?php echo $row_usuario['id_usuarios'];?>"><img src="../images/usuarios/<?php echo $row_usuario['nome']; ?>/<?php echo $row_usuario['foto']; ?>" alt="Clique para alterar" /></a></div>
      </td>
      <td>Nome: <?php echo $row_usuario['nome']; ?><br />
      Email: <?php echo $row_usuario['email']; ?><br /></td>
      <td align="right"><a href="#"></a><br />
      	<a style="cursor:pointer" onclick="if(confirm('Deseja cancelar sua assinatura?')){
        									
      										location.href='cancelarAssinatura.php?usuario=<?php echo $row_usuario['id_usuarios'] ;?>';
                                            }">
      		Cancelar sua conta
      	</a>
      </td>
    </tr>
    <tr>
      <td colspan="3"><form id="form2" name="form2" method="post" action="">
      </form></td>
    </tr>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#999999">
        Seus Comentários: <?php echo $totalRows_comentarios ?> no total.</td>
     </tr>
    <tr>
      <td colspan="3" bgcolor="#999999"><hr /></td>
    </tr>
    </table>
    <?php do { ?>
    <div style="border:1pt solid #666; border-radius:5px; margin:0 auto; margin-top:5px; margin-bottom:5px; background-color:#ebebeb; padding:10px; text-align:justify">
    <table width="90%" align="center">
      <tr>
        <td width="98%" align="center">
        	<div style="border:1pt #CCC; background-color:#C0C0C0; border-radius:10px">
				<?php echo $row_comentarios['data_comentario']; ?>
                 -	Conte&uacute;do: 
          		<?php echo $row_comentarios['nome']; ?>
             </div>
          </td>
        <td width="2%" rowspan="3" align="center"><img src="../images/delete.png" width="16" height="16" alt="Apagar" onclick="if(confirm('Apagar o Coment&aacute;rio?')){
      		window.open(location.href='comentariosDEL.php?comentario=<?php echo $row_comentarios['id_comentario'];?>');
      		self.location.reload(true)}else{}"/></td>
        </tr>
      <tr>
        <td>Voc&ecirc; escreveu:<br />
          <?php echo $row_comentarios['comentario']; ?></td>
        </tr>

       </table>
    </div>
      <?php } while ($row_comentarios = mysql_fetch_assoc($comentarios)); ?>
 
</div>
</body>
</html>
<?php
mysql_free_result($usuario);

mysql_free_result($comentarios);
?>
