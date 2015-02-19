<?php require_once('../Connections/mb.php'); ?>
<?php



mysql_select_db($database_mb, $mb);

$sql = "select email as adm from configs";
$emailA = mysql_query($sql, $mb)or die (mysql_error());
$rowEmail = mysql_fetch_assoc($emailA);
$administrador = $rowEmail['adm'];

//$administrador = "ericktarzia@gmail.com";
$session = & JFactory :: getSession();
$usuario = $session->get('id_usuario') ;
$nomee = $session->get('nome');

$agora = date('Y-m-d');
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
		
  $insertSQL = sprintf("INSERT INTO comentarios (id_comentario_conteudo_fk, usuario_comentario, comentario, data_comentario) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['conteudo'], "int"),
                       GetSQLValueString($_POST['id_user'], "int"),
                       GetSQLValueString($_POST['comentario_novo'], "text"),
                       GetSQLValueString($_POST['dataComentario'], "date"));
 
  mysql_select_db($database_mb, $mb);
  $Result1 = mysql_query($insertSQL, $mb) or die(mysql_error());
  $ultimo = mysql_insert_id($mb);
  $insertGoTo = "#";
  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  $conteudoFK = $_POST['conteudo'];
	$usuarioID = $_POST['id_user'];
	$usuarioNome = $_POST['nome'];
	$comentario = $_POST['comentario_novo'];
	mysql_select_db($database_mb, $mb);
	$sqlComentario ="select c.*,u.*,ct.id_conteudo, ct.nome as nomeC from comentarios c left join usuarios u on u.id_usuarios = c.usuario_comentario left join conteudos ct on c.id_comentario_conteudo_fk = ct.id_conteudo where c.id_comentario_conteudo_fk=$conteudoFK";
	$comm = mysql_query($sqlComentario, $mb)or die(mysql_error());
	$linhaC = mysql_fetch_assoc($comm);
	$titulo = $linhaC['nomeC'];
	$idComentario = $linhaC['id_comentario'];

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Administrador<". $administrador .">\r\n";
	$mensagem = "
	<html>
	<body>
	Novo Coment&aacute;rio inserido em $titulo .</br>
	Usu�rio: id = $usuarioID</br></br>
	
	<h3>$usuarioNome</h3>
	Disse:</br>
	$comentario </br></br>
	
	Permitir Comentário : 
	<a href='http://staff4solutions.com.br/s4s/includesS4S/autorizarComentario.php?id_comentario=$ultimo'>SIM</a> 
	
	</body>
	</html>
	";
		mail($administrador, "Novo comentário no conteúdo: ".$titulo."",$mensagem,$headers);
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_comentarios = "-1";
if (isset($_GET['id_conteudo'])) {
  $colname_comentarios = $_GET['id_conteudo'];
}
mysql_select_db($database_mb, $mb);
$query_comentarios = "SELECT c.id_comentario, c.exibir_comentario, c.id_comentario_conteudo_fk, c.usuario_comentario, c.data_comentario, c.comentario, DATE_FORMAT(c.data_comentario, '%d / %m / %Y') as dataZ, u.* FROM comentarios c LEFT JOIN usuarios u ON u.id_usuarios = c.usuario_comentario WHERE c. id_comentario_conteudo_fk = '$colname_comentarios' AND u.lista_negra = 0 ORDER BY c.id_comentario DESC";
$comentarios = mysql_query($query_comentarios, $mb) or die(mysql_error());
$row_comentarios = mysql_fetch_assoc($comentarios);
$totalRows_comentarios = mysql_num_rows($comentarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="adm/js/editorTinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "simple"
    });
</script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  

</head>

<body>
<div style="font-size:10px; font-family:Verdana, Geneva, sans-serif; margin-bottom:20px">
<hr />
 <h3>Coment&aacute;rios<br />
 </h3>
 <?php
 $z = 0; 
 if  ($totalRows_comentarios>0){?>
<table width="90%" align="center">
  <?php do {
	 if($row_comentarios['exibir_comentario']=='S' ){
	 	?>
    <tr bgColor="#ebebeb">
      <td>
      <?php if ($row_comentarios['foto'] != ''){ ?>
      <img src="images/usuarios/<?php echo $row_comentarios['nome']; ?>/<?php echo $row_comentarios['foto']; ?>" width="54" height="54" alt="<?php echo $row_comentarios['nome']; ?>" />
      <?php }else{  ?>
      <img src="images/autor.jpg" width="54" height="54" alt="<?php echo $row_comentarios['nome']; ?>" />
<?php }?>
      </td>
      <td valign="top"><h3><?php echo $row_comentarios['nome']; ?></h3></td>
      <td valign="top" align="right">
       Disse em <?php echo $row_comentarios['dataZ']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="3" align="justify"><p><?php echo $row_comentarios['comentario']; ?></p></td>
    </tr>
    <?php if( $usuario == $row_comentarios['id_usuarios'] ){?>
       <tr>
     
      <td colspan="3" align="center">
      <div id="camada<?php echo $z ?>" style="min-height: 20px"> 
      	<div id="apagarComentario<?php echo $z ?>" style="margin: 10px; cursor: pointer; background-color: #ff9999; border-radius:10px; padding: 10px" onclick="if(confirm('Apagar o Coment&aacute;rio?')){
      		window.open(location.href='includesS4S/comentariosDEL.php?comentario=<?php echo $row_comentarios['id_comentario'];?>');
      		self.location.reload(true)}else{}">
      	
      		<img src="images/delete.png" alt="Apagar" />

      	</div>
     </div>
     </td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>
    <script type="text/javascript">

    $(document).ready(function(){
    	//Hide the tooglebox when page load
    	$("#apagarComentario<?php echo $z ?>").hide();
    	//slide up and down when hover over heading 2
    	$("#camada<?php echo $z ?>").hover(function(){
    	// slide toggle effect set to slow you can set it to fast too.
    	$("#apagarComentario<?php echo $z ?>").fadeToggle("slow");
    	return true;
    	});
    	});

</script>

  <?php 
 $z++;
	 }
	 if($row_comentarios['exibir_comentario']=='N' && $usuario == $row_comentarios['id_usuarios'] ){ ?>
	 	<tr bgColor="#ebebeb">
	 	<td>
	 	      <?php if ($row_comentarios['foto'] != ''){ ?>
	 	      <img src="images/usuarios/<?php echo $row_comentarios['nome']; ?>/<?php echo $row_comentarios['foto']; ?>" width="54" height="54" alt="<?php echo $row_comentarios['nome']; ?>" />
	 	      <?php }else{  ?>
	 	      <img src="images/autor.jpg" width="54" height="54" alt="<?php echo $row_comentarios['nome']; ?>" />
	 	<?php }?>
	 	      </td>
	 	      <td valign="top"><h3><?php echo $row_comentarios['nome']; ?></h3></td>
	 	      <td valign="top" align="right">
	 	       Disse em <?php echo $row_comentarios['dataZ']; ?>
	 	      </td>
	 	    </tr>
	 	    <tr>
	 	      <td colspan="3" align="justify"><p><?php echo $row_comentarios['comentario']; ?></p>
	 	      *Pendente de Aprova&ccedil;&atilde;o.
	 	      </td>
	 	    </tr>
	 	    <?php if( $usuario == $row_comentarios['id_usuarios'] ){?>
	 	       <tr>
	 	     
	 	      <td colspan="3" align="center">
	 	      <div id="camada<?php echo $z ?>" style="min-height: 20px"> 
	 	      	<div id="apagarComentario<?php echo $z ?>" style="margin: 10px; cursor: pointer; background-color: #ff9999; border-radius:10px; padding: 10px" onclick="if(confirm('Apagar o Coment&aacute;rio?')){
	 	      		window.open(location.href='includesS4S/comentariosDEL.php?comentario=<?php echo $row_comentarios['id_comentario'];?>');
	 	      		self.location.reload(true)}else{}">
	 	      	
	 	      		<img src="images/delete.png" alt="Apagar" />
	 	
	 	      	</div>
	 	     </div>
	 	     </td>
	 	    </tr>
	 	    <?php }?>
	 	    <tr>
	 	      <td colspan="3"><hr /></td>
	 	    </tr>
	 	    <script type="text/javascript">
	 	
	 	    $(document).ready(function(){
	 	    	//Hide the tooglebox when page load
	 	    	$("#apagarComentario<?php echo $z ?>").hide();
	 	    	//slide up and down when hover over heading 2
	 	    	$("#camada<?php echo $z ?>").hover(function(){
	 	    	// slide toggle effect set to slow you can set it to fast too.
	 	    	$("#apagarComentario<?php echo $z ?>").fadeToggle("slow");
	 	    	return true;
	 	    	});
	 	    	});
	 	
	 	</script>
	 	
	 	  <?php 
	 	 $z++;
	 }
 } while ($row_comentarios = mysql_fetch_assoc($comentarios)); ?>
  </table>
  <?php }else{
	  echo "Nenhum coment&aacute;rio para este conte&uacute;do.</br><hr>";
	  }  

	  if($usuario != ""){
		  mysql_select_db($database_mb, $mb);
		  $user="select * from usuarios where id_usuarios = $usuario";
		  $usB=mysql_query($user, $mb);
		  $rowUser = mysql_fetch_assoc($usB);
		  $listado = $rowUser['lista_negra'];
		  //echo $listado;
		  if($listado =='1'){
			  echo $nomee . " ,você não pode mais escrever comentários.</br>";
			  echo "Entre em contato com o administrador caso tenha interesse em reativar sua conta.</br></br>";
			echo $administrador;
		  }else{
	  ?>
  
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="90%" align="center">
    <tr>
      <td>Deixe o seu comentário:</td>
    </tr>
    <tr>
      <td>

      <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['id_conteudo']; ?>" />
       <input name="dataComentario" type="hidden" id="dataComentario" value="<?php echo $agora ?>" />
      <input name="id_user" type="hidden" id="id_user" value="<?php echo $usuario ?>" />

      <label>
        <input name="nome" type="text" id="nome" value="<?php echo $nomee ?>" readonly="readonly" />
      </label></td>
    </tr>
    <tr>
      <td><label>
        <textarea name="comentario_novo" id="comentario_novo" cols="45" rows="5"></textarea>
      </label></td>
    </tr>
    <tr>
      <td><label>
        <input type="submit" name="ok" id="ok" value="Submit" />
      </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<?php 
		  }
}else{
	echo "Voc&ecirc; precisa estar logado para postar um comentário</br>";
	echo "Cadastre-se no topo da tela. &Eacute; gratu&iacute;to.";

}
	?>
</div>

</body>
</html>
<?php
mysql_free_result($comentarios);
?>
