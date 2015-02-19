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

//prod
$diretorioJoomla = "";
$diretorioMb = "/mbnovo";

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");
require_once ('funcoesGerais.php');

$session = JFactory :: getSession();
?>

<?php


// Get a database object
$db = & JFactory :: getDBO();

$query = " SELECT cor_barra_table, ";
$query .= " cor_linha_table, ";
$query .= "        icone_barra, ";
$query .= "        nao_exibe_descricao,ifnull(c.tipo_acesso_conteudo, p.tipo_acesso_conteudo) tipo_acesso_conteudo, ";
$query .= "        ifnull(c.exibe_data, hpc.exibe_data) exibe_data, ";
$query .= "        c.nao_exibe_autor,c.nao_exibe_nome, ";
$query .= "        c.nome,p.nome nome_produto, p.tipo_produto,";
$query .= "        c.id_produto_fk, a.nome as nome_autor, ";
$query .= "        c.id_conteudo,c.descricao descricao_artigo, ";
$query .= "        id_autor_fk, ";
$query .= "        descricao_resumo,c.arquivo, ";
$query .= "        ifnull(c.icone_padrao,p.icone_padrao) as icone_padrao, ";
$query .= "        date_format(now(), '%H:%m:%s') AS horas, ";
$query .= "        date_format(c.data_criacao, '%d') AS dia, ";
$query .= "        date_format(c.data_criacao, '%m') AS mes, ";
$query .= "        date_format(c.data_criacao, '%Y') AS ano, ";
$query .= "        TIMEDIFF(now(), c.data_criacao) AS total_horas, ";
$query .= "        DATE_ADD(c.data_criacao, INTERVAL c.publico_dias DAY) as data_publico ";
$query .= " FROM    $bancoMBAssociados.conteudos c left join $bancoMBAssociados.autor  a on  a.id_autor = c.id_autor_fk ";
$query .= " LEFT JOIN ";
$query .= "  $bancoMBAssociados.home_portal_conteudo hpc ";
$query .= "        ON (c.id_conteudo = hpc.id_conteudo_fk ";
$query .= "         OR c.id_produto_fk = hpc.id_produto_fk AND hpc.id_portal_fk = " . $id_portal . ")";
$query .= "       left join $bancoMBAssociados.produtos p on c.id_produto_fk = p.id_produto ";
$query .= " WHERE id_conteudo = " . $_GET["id_conteudo"];
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
	   WIDTH: 550px;  padding-left:15px; padding-right:15px;padding-top:0px;
	   
}
#rodape {
	 width:650; height:27px; margin-top: 0px;
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



</style>

<META content="Content-type:text/html;charset=iso-8859-1"></META>
</head>
<body>

<br><br>
<table width="650" border="0" cellspacing="0" cellspadding="0" align="center">

	<tr>
		<td align = center style='background :url(http://www.mbassociados.com.br/images/fundo_cabecalho_fundo.jpg) repeat-x top padding:0;'>
				<img src='http://www.mbassociados.com.br/images/fundo_cabecalho_logo.jpg'   />
		</td>
	</tr>
<?php


$acessoAutorizado = -1;
if ((@ $session->get('idProdutosPermitidos')) && (in_array(@ $row[0]["id_produto_fk"], $session->get('idProdutosPermitidos')))) {
	echo "<script>";
	//				echo " alert ('acesso liberado!')";
	$acessoAutorizado = 2;
	echo "</script>";
} else {
	if ($row[0]['tipo_acesso_conteudo'] == "P") { //SEMPRE PUBLICO
		//sempre publico
		//implemtacoes se necessário...
		$resultadoValidacao = "ARTIGO PUBLICO PODE EXIBIR";
		$acessoAutorizado = 3;
	} else {
		if ($row[0]['tipo_acesso_conteudo'] == "N") { //nunca publico
			if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $row[0]["id_produto_fk"], $session->get('idProdutosPermitidos')))) {
				echo "<script>";
				$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
				//				echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
				echo "</script>";
				$acessoAutorizado = -1;
			} else {
				echo "<script>";
				//				echo " alert ('Voce deve efetuar o login 1!')";
				$acessoAutorizado = false;
				echo "</script>";
			}

		} else {
			if ($row[0]['tipo_acesso_conteudo'] == "D") { //POR DIAS
				if (date("Y-m-d H:i:s") > $row[0]['data_publico']) {
					//conteudo disp normal
					$acessoAutorizado = 4;
				} else {
					if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $row[0]["id_produto_fk"], $session->get('idProdutosPermitidos')))) {
						echo "<script>";
						$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
						//						echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
						echo "</script>";
						$acessoAutorizado = -1;
					} else {
						echo "<script>";
						//						echo " alert ('Voce deve efetuar o login 2!')";
						echo "</script>";
						$acessoAutorizado = -1;
					}

				}

			} else {
				//DEFAULT POR DATA
				if (date("Y-m-d H:i:s") > $row[0]['data_publico']) {
					//conteudo disp normal
					$acessoAutorizado = 5;
				} else {
					if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $row[0]["id_produto_fk"], $session->get('idProdutosPermitidos')))) {
						echo "<script>";
						$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
						//						echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
						echo "</script>";
						$acessoAutorizado = -1;
					} else {
						echo "<script>";
						//						echo " alert ('Voce deve efetuar o login 3!')";
						echo "</script>";
						$acessoAutorizado = -1;
					}

				}
			}

		}
	}
}
?>
	
<tr>
		<td align="center">
		
			<table width="650" border="0" cellspacing="0" cellspadding="0" align="center">

				<tr>
					<td style="width:20px"> &nbsp;&nbsp;&nbsp; </td>
					<td align="center">

		<?php


if (count($row) > 0) {

	echo "<span class='tituloCaixasArtigos' align='center' style='FONT-FAMILY: georgia,garamond,Georgia,Times, serif; FONT-SIZE: 12pt;'> <b>" . utf8_decode($row[0]['nome']) . "</b></span>";
	echo "</td>";
	echo "<td style=\"width:20px\"> &nbsp;&nbsp;&nbsp;&nbsp; </td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "<td>&nbsp;</td>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "<td>&nbsp;</td>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "<td>";

	echo "<table style='margin-left:135px'><tr><td align=right>";
	echo "<div class='' align=right> <span style='font-weight: bold;'>" . getDescricaoTipoProduto($row[0]['tipo_produto']) . "</span>" . " " . getPreposicaoTipoProduto($row[0]['tipo_produto']) . " " .
		"<span style='font-weight: bold;'>" . utf8_decode($row[0]['nome_autor']) . "</span>" . " " . ", MB Associados<br>".getDescricaoOcorrencia($row[0]['tipo_produto']) . getHorarioPublicacao($row[0]['total_horas'], $row[0]['dia'], $row[0]['mes'], $row[0]['ano'])."</span></div>" .
		"";
	echo "</td></tr></table>";
	
	echo "</td>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "<td>&nbsp;</td>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "<td>";
	echo "<div style='margin-left:20px;margin-right:20px'>";
	if ($acessoAutorizado > 0) {
		echo str_replace("186.202.62.1755", "127.0.0.1", $row[0]['descricao_resumo']);
	} else {
		echo str_ireplace("186.202.62.1755", "127.0.0.1", $row[0]['descricao_resumo']);
	}
	echo "<br>";
	echo "<br>";
	
	echo '<div align=center><a href="http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo='. $_GET["id_conteudo"] . '">Clique aqui para Acessar o Artigo </a></div> ';
	echo " </div>";

	echo "<br>";
	echo "<br>";
	
	echo "</td>";
	echo "<td style=\"width:20px\"> &nbsp; </td>";
	echo "</tr>";
	

}
?>
</tr>

	<tr>
		<td colspan="3" align = center style='background :url(http://www.mbassociados.com.br/images/fundo_rodape_fundo.jpg) repeat-x top padding:0;'>
				<img src= 'http://www.mbassociados.com.br/images/fundo_rodape_logo.jpg'    />
		</td>
	</tr>

</table>

</body>

</html>
<?php


if (@ $_GET["print"] != 'N') {
?>
<script>
  window.print();
</script>	
<?php


}
?>

