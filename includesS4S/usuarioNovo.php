<?php require_once('../Connections/mb.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_mb = new KT_connection($mb, $database_mb);

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Passwords do not match.");
  $myThrowError->setField("senha");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

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
$query_agora = "select now()";
$agora = mysql_query($query_agora, $mb) or die(mysql_error());
$row_agora = mysql_fetch_assoc($agora);
$totalRows_agora = mysql_num_rows($agora);

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../images/usuarios/{nome}/");
  $deleteObj->setDbFieldName("foto");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("foto");
  $uploadObj->setDbFieldName("foto");
  $uploadObj->setFolder("../images/usuarios/{nome}/");
  $uploadObj->setResize("true", 70, 70);
  $uploadObj->setMaxSize(10000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("nome", true, "text", "", "", "", "");
$formValidation->addField("senha", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_usuarios = new tNG_multipleInsert($conn_mb);
$tNGs->addTransaction($ins_usuarios);
// Register triggers
$ins_usuarios->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_usuarios->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_usuarios->registerTrigger("END", "Trigger_Default_Redirect", 99, "UsuarioRegistro.php?e={email}&n={nome}");
$ins_usuarios->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$ins_usuarios->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_usuarios->setTable("usuarios");
$ins_usuarios->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_usuarios->addColumn("opcao", "STRING_TYPE", "POST", "opcao", "0");
$ins_usuarios->addColumn("id_clientes_fk", "STRING_TYPE", "POST", "id_clientes_fk", "0");
$ins_usuarios->addColumn("data_criacao", "DATE_TYPE", "POST", "data_criacao");
$ins_usuarios->addColumn("senha", "STRING_TYPE", "POST", "senha");
$ins_usuarios->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_usuarios->addColumn("tipo_cliente", "STRING_TYPE", "POST", "tipo_cliente", "4");
$ins_usuarios->addColumn("status", "STRING_TYPE", "POST", "status", "I");
$ins_usuarios->addColumn("foto", "FILE_TYPE", "FILES", "foto");
$ins_usuarios->setPrimaryKey("id_usuarios", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_usuarios = new tNG_multipleUpdate($conn_mb);
$tNGs->addTransaction($upd_usuarios);
// Register triggers
$upd_usuarios->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_usuarios->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_usuarios->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_usuarios->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_usuarios->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_usuarios->setTable("usuarios");
$upd_usuarios->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_usuarios->addColumn("opcao", "STRING_TYPE", "POST", "opcao");
$upd_usuarios->addColumn("id_clientes_fk", "STRING_TYPE", "POST", "id_clientes_fk");
$upd_usuarios->addColumn("data_criacao", "DATE_TYPE", "POST", "data_criacao");
$upd_usuarios->addColumn("senha", "STRING_TYPE", "POST", "senha");
$upd_usuarios->addColumn("tipo_cliente", "STRING_TYPE", "POST", "tipo_cliente");
$upd_usuarios->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_usuarios->addColumn("foto", "FILE_TYPE", "FILES", "foto");
$upd_usuarios->setPrimaryKey("id_usuarios", "NUMERIC_TYPE", "GET", "id_usuarios");

// Make an instance of the transaction object
$del_usuarios = new tNG_multipleDelete($conn_mb);
$tNGs->addTransaction($del_usuarios);
// Register triggers
$del_usuarios->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_usuarios->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_usuarios->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_usuarios->setTable("usuarios");
$del_usuarios->setPrimaryKey("id_usuarios", "NUMERIC_TYPE", "GET", "id_usuarios");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsusuarios = $tNGs->getRecordset("usuarios");
$row_rsusuarios = mysql_fetch_assoc($rsusuarios);
$totalRows_rsusuarios = mysql_num_rows($rsusuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	color: #333;
}
body {
	background-color: #CCC;
}
</style>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
  show_as_grid: false,
  merge_down_value: false
}
</script>
<script src="../js/consultaUsuarioCadastrado.js"></script>
<script>
function pesquisa(valor)
{
//FUN플O QUE MONTA A URL E CHAMA A FUN플O AJAX
url="busca_nome.php?valor="+valor;
ajax(url);
}
</script>
<script src="../js/consultaUsuarioCadastrado2.js"></script>
<script>
function pesquisa2(valor)
{
//FUN플O QUE MONTA A URL E CHAMA A FUN플O AJAX
url="busca_email.php?valor="+valor;
ajax(url);
}
</script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
    <script type="text/javascript">  
    $(document).ready(function(){  
		$("#carregando").hide();
	});  
var loading = $(
		'<img id="loading" alt="Carregando" title="Carregando" src="../adm/images/loading.gif" />'
		).appendTo('#carregando').show('slow')
		loading.ajaxStart(function(){
			$("#carregando").show("fast");								   
			$(this).show("slow");

		});
		loading.ajaxStop(function(){
			$(this).hide("slow");
			$("#carregando").hide("slow");

		});

    </script>
</head>

<body>
<div style="left:50%; top:50%; position:absolute; margin-left:-250px; margin-top:-200px; width:500px; border:1px solid gray; border-radius:10px; text-align:center; background-color:#B6BEB8; height:400px">
  <table align="center">
    <tr>
      <td align="center"><img src="../templates/mbAssociados/images/s4s_images/elementos/header-object.png" width="400" height="105" /></td>
    </tr>
    <tr>
      <td><div class="KT_tng">
        <h1>
          <?php 
// Show IF Conditional region1 
if (@$_GET['id_usuarios'] == "") {
?>
            Novo
            <?php } 
// endif Conditional region1
?>
          Usuario </h1>
        <div class="KT_tngform">
          <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
            <?php $cnt1 = 0; ?>
            <?php do { ?>
              <?php $cnt1++; ?>
              <?php 
// Show IF Conditional region1 
if (@$totalRows_rsusuarios > 1) {
?>
                <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                <?php } 
// endif Conditional region1
?>
              <table align="center" cellpadding="2" cellspacing="0" class="KT_tngtable">
                <?php 
// Show IF Conditional show_email_on_insert_only 
if (@$_GET['id_usuarios'] == "") {
?>
                  <tr>
                    <td align="right" class="KT_th"><label for="email_<?php echo $cnt1; ?>">Email:*<br />
                      <span class="footrow">(ser&aacute; seu Login)</span></label></td>
                    <td><input type="text" name="email_<?php echo $cnt1; ?>" id="email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['email']); ?>" size="32" maxlength="200" onblur="pesquisa2(this.value)"/>
                      <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("usuarios", "email", $cnt1); ?>
                      </td>
                    </tr>
                  <tr>
                    <td colspan="2">
                    	<div id="pagina2" style="text-align:center; border:1px solid #CCC; border-radius:5px"></div>
                    </td>
                    </tr>
                  <?php } 
// endif Conditional show_email_on_insert_only
?>
                <tr>
                  <td width="154" align="right" class="KT_th"><label for="nome_<?php echo $cnt1; ?>">Nome:</label></td>
                  <td width="266"><input type="text" name="nome_<?php echo $cnt1; ?>" id="nome_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['nome']); ?>" size="32" maxlength="200"/>
                    <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("usuarios", "nome", $cnt1); ?></td>
                  </tr>
                
                <tr>
                  <td align="right" class="KT_th"><label for="senha_<?php echo $cnt1; ?>">Senha:</label></td>
                  <td><input type="password" name="senha_<?php echo $cnt1; ?>" id="senha_<?php echo $cnt1; ?>" value="" size="32" maxlength="45" />
                    <?php echo $tNGs->displayFieldHint("senha");?> <?php echo $tNGs->displayFieldError("usuarios", "senha", $cnt1); ?></td>
                  </tr>
                <tr>
                  <td align="right" class="KT_th"><label for="re_senha_<?php echo $cnt1; ?>">Repita a Senha:</label></td>
                  <td><input type="password" name="re_senha_<?php echo $cnt1; ?>" id="re_senha_<?php echo $cnt1; ?>" value="" size="32" maxlength="45" /></td>
                  </tr>
  <tr>
    <td align="right" class="KT_th"><label for="foto_<?php echo $cnt1; ?>">Foto:</label></td>
    <td><input type="file" name="foto_<?php echo $cnt1; ?>" id="foto_<?php echo $cnt1; ?>" size="32" />
      <?php echo $tNGs->displayFieldError("usuarios", "foto", $cnt1); ?></td>
    </tr>
                </table>
              <input type="hidden" name="id_clientes_fk_<?php echo $cnt1; ?>" id="id_clientes_fk_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['id_clientes_fk']); ?>" />
  <input type="hidden" name="opcao_<?php echo $cnt1; ?>" id="opcao_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['opcao']); ?>" />
  <input type="hidden" name="kt_pk_usuarios_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsusuarios['kt_pk_usuarios']); ?>" />
              <input type="hidden" name="data_criacao_<?php echo $cnt1; ?>" id="data_criacao_<?php echo $cnt1; ?>" value="<?php echo $row_agora['']; ?>" />
              <input type="hidden" name="tipo_cliente_<?php echo $cnt1; ?>" id="tipo_cliente_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['tipo_cliente']); ?>" />
              <input type="hidden" name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsusuarios['status']); ?>" />
              <?php } while ($row_rsusuarios = mysql_fetch_assoc($rsusuarios)); ?>
            <div id='carregando' style="background-color:#EBEBEB; padding:10px; margin:0 auto; margin-top:10px; margin-bottom:10px; width:70%"> Carregando.. </br></div>
            <div class="KT_bottombuttons">
              <div>
                <?php 
      // Show IF Conditional region1
      if (@$_GET['id_usuarios'] == "") {
      ?>
                  <input type="submit" name="KT_Insert1" id="KT_Insert1" value="Enviar" />
                  <?php 
      // else Conditional region1
      } else { ?>
                  <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
                  <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
                  <?php }
      // endif Conditional region1
      ?>
              </div>
              </div>
            </form>
          </div>
        <br class="clearfixplain" />
      </div></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($agora);
?>
