<body style="overflow: hidden"> 
<?php
/* *******************************************************************
* Staff 4 Solutions (c) 2011
* 
* Descrição: Login para conteudo restrito, utilizando infra Joomla
* Created on 09/06/2011
* Developer: Lago
* Projeto: mbAssociados
* TODO: TODO
* Revision:
/* *****************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////



set_include_path($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$diretorioJoomla.DIRECTORY_SEPARATOR."includesS4S");
include("parametrosConfiguracao.php");
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
//// inicio gravando na session permissoes -> retorno do autenticacaoArtigoRestrito 
if(@$_POST["setSession"]){

//recuperando produtos com permissao e gravando na session
$_SESSION["idProdutosPermitidos"]=@$_POST["produtos"];
$_SESSION["id_usuario"]=@$_POST["id_usuarios"][0];
$_SESSION["login_session"]=@$_POST["login_session"];

//print_R($_SESSION["idProdutosPermitidos"]);

//checando se este produto tem permissão, se sim redireciona para artigo
if(in_array(@$_GET["id_produto"],$_SESSION["idProdutosPermitidos"])){
?>
<script>
self.location='index.php?option=com_content&view=article&id=<?php echo $id_artigo_detalhe;?>&id_conteudo=<?php echo $_GET["id_conteudo"];?>';
</script>
<?php
}
}
///////////////////////////////////////////////////////////////////////////////////
/* ******************************************************************************************************
* 
* verifica se a sessão já esta gravada, caso o usuário já tenha feito o login, verifica se ele possui
* acesso ao conteudo, senão exibe Login
* 
*/
////// verifica se a sessão já esta gravada
if(@$_SESSION["idProdutosPermitidos"]){
//checando se este produto tem permissão, se sim redireciona para artigo
if(in_array(@$_GET["id_produto"],$_SESSION["idProdutosPermitidos"])){
?>
<script>
self.location='index.php?option=com_content&view=article&id=<?php echo $id_artigo_detalhe;?>&id_conteudo=<?php echo $_GET["id_conteudo"];?>';
</script>
<?php
}
}
/*
* *******************************************************************************************************
*/
?>
<!-- css do popup show modal -->
<script>
function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';
  window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}

</script>
<style> 
Body
{
	font-family: Arial;
}
 
.PopupPanel
{
	background-image:url(templates/mbAssociados/images/fundo2.png); 
	background-repeat:repeat-x;

	border-top: dashed 1px black;
	position: absolute;
	left: 50%;
	top: 50%;
	background-color: white;
	z-index: 100;
	
	height: 320px;
	margin-top: -100px;
	
	width: 615px;
	margin-left: -250px;
}
 
.PopupPanelModalArea
{
	left: 0;
	top: 0;
	height: 180%;
	width: 100%;
	position: absolute;
	background-color:silver;
    filter: progid:DXImageTransform.Microsoft.Alpha(opacity=85);
	z-index: 99;
	border: 0;
	-moz-opacity: 0.60;
}
 
 
.PopupPanel .TitleBar
{
	margin: 0;
	display: block;
	background-color: #c0c0c0;
	line-height: 20px;
	color: white;
	font-weight: bold;
	padding: 0 0 0 5px;
}
 
.PopupPanel .ContentArea
{
	padding: 0 0 0 5px;
}
</style>

<!-- javascript popupshow modal -->
<script> 
 
/**********************************
Simply displays or hides the panel
**********************************/
function TogglePopupPanel()
{
	var panelContainer = document.getElementById("PopupPanel");
	
	if (panelContainer.style.display == "none")
	{
		panelContainer.style.display = "";
		//document.getElementById('PopupPanelModalArea').focus();
		//document.body.onfocus = function() { document.getElementById('PopupPanelModalArea').focus(); };
	}
	else
	{
		panelContainer.style.display = "none";
		document.body.onfocus = function() { return true; };
	}
}
 
</script>

<!-- ****************************** -->
<!-- Start of the PopupPanel HTML   -->
<!-- ****************************** -->
 
<div id="PopupPanel" style="display:none">
	<iframe class="PopupPanelModalArea" frameborder="0" scrolling="0" id="PopupPanelModalArea"></iframe>
	
	<div class="PopupPanel" align=center>
		<!--
		<p class="TitleBar">
			Popup Panel Title Bar
		</p>
		-->
		<p class="ContentArea">
<?php 
// Get a database object
$db =& JFactory::getDBO();


$query = "select c.* from $bancoMBAssociados.conteudos c"; 
//echo $query;
$db->setQuery($query);

$row = $db->loadAssocList();
//autenticacaoArtigoRestrito.php
echo "<form action='$diretorioMb/pluginsJoomlaS4S/autenticacaoHome.php' method='post' name=formLogin>";
echo "<input type=hidden name='diretorioPortalJoomla' value='$diretorioJoomla'><input type=hidden name='id_conteudo' value=".$_GET['id_conteudo']."><input type=hidden name='id_portal' value=".$id_portal."><input type=hidden name='id_produto' value=".@$_GET['id_produto']."><input type=hidden name='id_artigo_origem' value=".$_GET['id'].">";
echo "<div align=right><image src='templates/mbAssociados/images/iconClose.png' border=0 style='cursor:hand' onclick=self.location='index.php'>&nbsp;&nbsp;</div>";
echo "<image src='templates/mbAssociados/images/titTextoRestrito.png' border=0> ";
echo "<table width=80% border=0>";
echo "<tr>";
echo "<td>";
echo "<image src='templates/mbAssociados/images/titJaSouCli.png' border=0>";
echo "<br>";
echo "<image src='templates/mbAssociados/images/titEntreDados.png' border=0><br><br>";
	echo "<table border=0 align=center cellspacing=3 style=color:#003399; font-family:'Segoe UI',Candara,'Bitstream Vera Sans','DejaVu Sans','Trebuchet MS',Verdana,sans-serif; font-size:12px; text-decoration:none;>";
	echo "<tr style=\"color:#000000; font-family:'Segoe UI',Candara,'Bitstream Vera Sans','DejaVu Sans','Trebuchet MS',Verdana,sans-serif; font-size:12px; text-decoration:none;\">";
	echo "<td align=right ><b>Login</b></td><td><input id=login type=text name=login style=\"color:#000000; font-family:'Segoe UI',Candara,'Bitstream Vera Sans','DejaVu Sans','Trebuchet MS',Verdana,sans-serif; font-size:9px; text-decoration:none;\" ></td>";
	echo "</tr>";
	echo "<tr style=\"color:#000000; font-family:'Segoe UI',Candara,'Bitstream Vera Sans','DejaVu Sans','Trebuchet MS',Verdana,sans-serif; font-size:12px; text-decoration:none;\">";
	echo "<td align=right><b>Senha</b></td><td><input id=senha type=password name=senha style=\"color:#000000; font-family:'Segoe UI',Candara,'Bitstream Vera Sans','DejaVu Sans','Trebuchet MS',Verdana,sans-serif; font-size:9px; text-decoration:none;\" ></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=center colspan=2><!--<input type=button value=Voltar onclick='javascript:history.back();'><input type=submit name=btLogin value=Login>-->";
	echo "<a href=# onclick=\"na_open_window('esq', '$diretorioMb/pluginsJoomlaS4S/esqueciSenha.php', 300, 300, '450', '200', '0', '0', '0', '0', '0')\"> <img src=templates/mbAssociados/images/botaoEsqueciSenha.png border=0></a> <input type=image src='templates/mbAssociados/images/botaoEntrar.png' border=0> ";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
echo "</td>";
echo "<td>";
echo "<image src='templates/mbAssociados/images/titNaoCli.png' border=0>";
echo "<br>";
echo "<image src='templates/mbAssociados/images/titSaibaMais.png' border=0>";
echo "<br><br>";
echo "<image src='templates/mbAssociados/images/botaoSaibaMais.png' border=0>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
?>
			<!--<br/>
			<br/>
			<input type="Button" value="Close Popup Panel" onclick="TogglePopupPanel()" />-->
		</p>
	</div>
</div>


<!-- **************************************************************************************************************** -->
<!-- inicio do artigo normal com exibição resumida  -->
<!-- *************************************************************************************************************** -->
<?php
// Get a database object
$db =& JFactory::getDBO();
//recuperar qtde de linhas da home
$query = "SELECT valor FROM $bancoMBAssociados.home_portal_parametros where id=1 "; 
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

//echo $qtdeLinhasHome;
?>
<?php
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

// Get a database object
$db =& JFactory::getDBO();

$query = "select c.* from $bancoMBAssociados.conteudos c where id_conteudo = '".$_GET["id_conteudo"]."'"; 
//echo $query;
$db->setQuery($query);

$row = $db->loadAssocList();
?>



<!-- inicio -->
<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<style>
.tituloCaixas{
	font-family : georgia,garamond,Georgia, "Times New Roman", Times, serif;
	font-size : 16px;
	font-weight:normal;
	font-style:italic;
}

.tituloCaixasArtigos{
	font-family : georgia,garamond,Georgia, "Times New Roman", Times, serif;
	font-size : 21px;
	font-weight:bold;
}
</style>
<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="80%">
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
 <td valign="top" width="70%">
    <table class="blog" cellpadding="5" cellspacing="3" border="0">

<?php 
		  $sqlProd = " select * from $bancoMBAssociados.produtos where id_produto = '".$row[0]['id_produto_fk']."' ";
		  $db->setQuery($sqlProd);			
	      $rowProd = $db->loadAssocList();	
	      //echo count($rowSub);

//print_R($row);
for($i = 0; $i <count($row) ; $i ++){

	  echo "<tr>";
	  echo "<td valign=top align=left colspan='2' width='100%'>";

	  echo "<table width='100%' cellpadding=7 cellspacing=0>";
	  echo "<tr>";
	  ////inicio caixa titulo cor
	  echo "<td class='tituloCaixas' height='35' bgcolor='#ffb700'> &nbsp;";
	  //echo "Titulo - este ocupa ".$row[$i]['colunas']." coluna(s)";
	  echo "Voc&ecirc; est&aacute; em: <a href=index.php>Home</a> > <a href=index.php?option=com_content&view=article&id=47&id_produto=".$rowProd[0]['id_produto'].">".$rowProd[0]['nome']."</a>  ";
	  echo "</td>";
	  echo "</tr>";
	  echo "<tr>";
	  ////inicio corpo caixa - titulo, texto e imagem
	  echo "<td bgcolor='#ffffff'><br/>";
	  echo "<span class='tituloCaixasArtigos'  style='margin-left:5px'> ".$row[$i]['nome']." </span>";
	  echo "<p  style='margin-left:5px'>";
	  //echo $row[$i]['descricao'];
	  echo "<image src='templates/mbAssociados/images/texto.jpg' border=0>";
	  echo "</td>";
	  echo "</tr>";
	  echo "</table>";	  
	  /* 
	  echo "<div>";
	  echo "<div class=\"contentpaneopen\">";
	  echo "<h2 class=\"contentheading\">".$row[$i]['nome']."</h2>";
	  echo "<div class=\"article-tools\"> &nbsp; <i>este ocupa ".$row[$i]['colunas']." coluna(s)</i></div>";
	  echo "<div class=\"article-content\">".$row[$i]['descricao']."</div>";
	  echo "<span class=\"article_separator\">&nbsp;</span>";
	  */
	  echo "</td>";	
}
?>
	</table>
</td>
<!-- /////////////////////////////// FIM COLUNA CENTRO //////////////////////////////// -->

<?php
require("componenteLateralDinamica.php")
?>
<!-- /////////////////////////////// FIM COLUNA CENTRO //////////////////////////////// -->
</table>
</div>
<!-- /////////////////////////////// FIM TABELA MASTER //////////////////////////////// -->


<script>
TogglePopupPanel();
</script>
