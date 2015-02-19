<?php


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descrição: 
 * Created on 15/10/2011
 * Developer: Lago
 * Projeto: portalB
 * TODO: TODO
 * Revision:
 /* *****************************************************************/

define('_JEXEC', 1);
define('JPATH_BASE', "../"); // poderia ser /var/www/html/site-joomla/  
define('DS', DIRECTORY_SEPARATOR);
require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');

$mainframe = JFactory :: getApplication('site');

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
//desenv

//$diretorioJoomla = "portalB";
//$diretorioMb = "/mbAssociados";

////prod
//$diretorioJoomla = "joomla/mbnovo/portalB";
//$diretorioMb = "/joomla/mbnovo";
//
//set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");
require_once ('funcoesGerais.php');

$session = JFactory :: getSession();
?>

<?php


// Get a database object
$db = & JFactory :: getDBO();

$query = " select email,senha from $bancoMBAssociados.usuarios where id_usuarios = " . $_GET["id_cliente"];
$db->setQuery($query);
//echo $query;
$row = $db->loadAssocList();

?>
<!-- inicio -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- inicio --><!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->

<html>

<head>

<style>


* {
	PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}

.tituloCaixas {
	FONT-STYLE: italic; FONT-FAMILY: georgia,garamond,Georgia, "Times New Roman", Times, serif; FONT-SIZE: 9pt; FONT-WEIGHT: normal
}



#cabecalho {
	 width:650px;  height:90px;
}

#corpo {
	   WIDTH: 650px;  padding-left:15px; padding-right:15px;padding-top:0px;
	   
}
#rodape {
	 width:650px; height:27px; margin-top: 0px;
}

#fundo{
	  border-left:2px solid #012E4D; 
	  border-right:2px solid #012E4D;
	  width:650px;
	  height:100px;
}

.divTextoAutoresNumero2{
	border: 0px;
	padding: 0;
	margin-right: 0px;
	background-color: transparent;
	padding-top: 5px;
	color: #000;
	width: 500px;
	height: 15px;
	text-align: left;
	padding-left: 30px;

}

.divTextoOcorridoEmNumero2{
	border: 0px;
	padding: 0;
	margin-right: 0px;
	background-color: transparent;
	padding-top: 5px;
	color: #000;
	width: 500px;
	height: 15px;
	text-align: left;
	padding-left: 30px;

}

p{
	font-family: tahoma,georgia,garamond,Georgia,Times, serif; 
	font-size: 12pt;
	margin-left:10px;
	margin-right:10px;
	text-align:justify;
}


</style>

<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META name=GENERATOR content="MSHTML 9.00.8112.16441">
</head>
<body align="left">

<body align="left">

<table width="650" border=0>

	<tr>
		<td align = center style='background :url(http://186.202.62.17/images/fundo_cabecalho_fundo.jpg) repeat-x top padding:0;'>
				<img src='http://186.202.62.17/images/fundo_cabecalho_logo.jpg'   />
		</td>
	</tr>



<tr>
		<td ALIGN='CENTER'>
			<table width="650" BORDER=0>

				<tr>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td>
					
			
			<p align="justify">	
				Conforme solicitado, seguem os dados de acesso:
			</p>

			<p align="justify">
				Login: <?php echo $row[0]["email"];?>. <br />
				Senha: <?php echo $row[0]["senha"];?>
			</p>

			
				
			

			<p align="justify" style="margin-top:20px;">
				Coment&aacute;rios e sugest&otilde;es ser&atilde;o bem vindos para que possamos melhorar cada vez mais nosso atendimento.
			</p>

			<p align="justify" style="margin-top:20px;">
				Qualquer d&uacute;vida entre em contato.
			</p>

				
				</td>
			</tr>

				<tr>
					<td>&nbsp;</td>
				</tr>
			
			</table>

				
		</td>
</tr>

	<tr>
		<td align = center style='background :url(http://186.202.62.17/images/fundo_rodape_fundo.jpg) repeat-x top padding:0;'>
				<img src= 'http://186.202.62.17/images/fundo_rodape_logo.jpg'    />
		</td>
	</tr>


</table>

</body>

</html>




