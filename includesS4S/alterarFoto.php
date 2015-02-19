<?php require_once('../Connections/mb.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an update transaction instance
$upd_usuarios = new tNG_update($conn_mb);
$tNGs->addTransaction($upd_usuarios);
// Register triggers
$upd_usuarios->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_usuarios->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_usuarios->registerTrigger("END", "Trigger_Default_Redirect", 99, "admUser.php?usuario={id_usuarios}");
$upd_usuarios->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_usuarios->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_usuarios->setTable("usuarios");
$upd_usuarios->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_usuarios->addColumn("fone", "NUMERIC_TYPE", "POST", "fone");
$upd_usuarios->addColumn("celular", "NUMERIC_TYPE", "POST", "celular");
$upd_usuarios->addColumn("senha", "STRING_TYPE", "POST", "senha");
$upd_usuarios->addColumn("foto", "FILE_TYPE", "FILES", "foto");
$upd_usuarios->setPrimaryKey("id_usuarios", "NUMERIC_TYPE", "GET", "id_usuarios");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsusuarios = $tNGs->getRecordset("usuarios");
$row_rsusuarios = mysql_fetch_assoc($rsusuarios);
$totalRows_rsusuarios = mysql_num_rows($rsusuarios);
?>
<html xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
</head>

<body bgcolor="#CCCCCC" text="#000000">
<div id="admAqui" style="border:1px solid black; border-radius:10px; width:80%; margin:0 auto; background-color:#999; margin-top:20px; margin-bottom:20px; padding:15px">
  <table align="center">
    <tr>
      <td>Atualize seus dados.</td>
    </tr>
    <tr>
      <td><form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <tr>
            <td class="KT_th"><label for="nome">Nome:</label></td>
            <td><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rsusuarios['nome']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("usuarios", "nome"); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="fone">Fone:</label></td>
            <td><input name="fone" id="fone" value="<?php echo KT_escapeAttribute($row_rsusuarios['fone']); ?>" size="32" wdg:subtype="MaskedInput" wdg:mask="(99)9999-99999" wdg:restricttomask="no" wdg:type="widget" />
              <?php echo $tNGs->displayFieldHint("fone");?> <?php echo $tNGs->displayFieldError("usuarios", "fone"); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="celular">Celular:</label></td>
            <td><input name="celular" id="celular" value="<?php echo KT_escapeAttribute($row_rsusuarios['celular']); ?>" size="32" wdg:subtype="MaskedInput" wdg:mask="(99)9999-99999" wdg:restricttomask="no" wdg:type="widget" />
              <?php echo $tNGs->displayFieldHint("celular");?> <?php echo $tNGs->displayFieldError("usuarios", "celular"); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="senha">Senha:</label></td>
            <td><input type="password" name="senha" id="senha" value="<?php echo $row_rsusuarios['senha']; ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("senha");?> <?php echo $tNGs->displayFieldError("usuarios", "senha"); ?></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="re_senha">Re-type Senha:</label></td>
            <td><input type="password" name="re_senha" id="re_senha" value="" size="32" /></td>
          </tr>
          <tr>
            <td class="KT_th"><label for="foto">Foto:</label></td>
            <td><input type="file" name="foto" id="foto" size="32" />
              <?php echo $tNGs->displayFieldError("usuarios", "foto"); ?></td>
          </tr>
          <tr class="KT_buttons">
            <td colspan="2"><input type="submit" name="KT_Update1" id="KT_Update1" value="Atualizar" /></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>

</body>
</html>