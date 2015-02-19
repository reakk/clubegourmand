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
require_once ('funcoesGerais.php');

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
$query .= "        c.id_produto_fk, ";
$query .= "        c.id_conteudo,c.descricao descricao_artigo, ";
$query .= "        id_autor_fk, a.nome as nome_autor,";
$query .= "        descricao_resumo,c.arquivo, ";
$query .= "        ifnull(c.icone_padrao,p.icone_padrao) as icone_padrao, ";
$query .= "        date_format(now(), '%H:%m:%s') AS horas, ";
$query .= "        date_format(c.data_criacao, '%d') AS dia, ";
$query .= "        date_format(c.data_criacao, '%m') AS mes, ";
$query .= "        date_format(c.data_criacao, '%Y') AS ano, ";
$query .= "        TIMEDIFF(now(), c.data_criacao) AS total_horas, ";
$query .= "        DATE_ADD(c.data_criacao, INTERVAL c.publico_dias DAY) as data_publico ";
$query .= " FROM    $bancoMBAssociados.conteudos c left join $bancoMBAssociados.autor a on a.id_autor = c.id_autor_fk";
$query .= " LEFT JOIN ";
$query .= "  $bancoMBAssociados.home_portal_conteudo hpc ";
$query .= "        ON (c.id_conteudo = hpc.id_conteudo_fk ";
$query .= "         OR c.id_produto_fk = hpc.id_produto_fk AND hpc.id_portal_fk = " . $id_portal . ")";
$query .= "       left join $bancoMBAssociados.produtos p on c.id_produto_fk = p.id_produto ";
$query .= " WHERE id_conteudo = '" . $_GET["id_conteudo"] . "'";
//echo $query;
$db->setQuery($query);

$row = $db->loadAssocList();
?>
<!-- inicio -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- inicio --><!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// --><HTML><HEAD>
<STYLE>


* {
	PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 0px
}

.tituloCaixas {
	FONT-STYLE: italic; FONT-FAMILY: georgia,garamond,Georgia, "Times New Roman", Times, serif; FONT-SIZE: 16px; FONT-WEIGHT: normal
}
.tituloCaixasArtigos {
	FONT-FAMILY: georgia,garamond,Georgia, "Times New Roman", Times, serif; FONT-SIZE: 21px; FONT-WEIGHT: bold
}



#logo {
	TEXT-ALIGN: center; MARGIN: 0px auto; WIDTH: 235px; CLEAR: both
}
#corpo {
	  MARGIN-LEFT:500PX; WIDTH: 990px;  border-left:2px solid #012E4D; border-right:2px solid #012E4D; padding-left:15px; padding-right:15px;padding-top:20px;
}
#rodape {
	BACKGROUND-IMAGE: url(fundo_rodape.jpg); width:990px; height:27px; margin-left:500px;
}
#frase_rodape {
	TEXT-ALIGN: center; MARGIN: 0px auto
}

</STYLE>

<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META name=GENERATOR content="MSHTML 9.00.8112.16441"></HEAD>
<BODY align="center">
<DIV id=fundo align=center>
<DIV id=corpo align=center><!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->

<?php


//print_R($row);


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

if (count($row) > 0) {
	
	
	
	echo "<div class='tituloCaixasArtigos'  style='FONT-FAMILY: georgia,garamond,Georgia,  Times, serif; FONT-SIZE: 21px; FONT-WEIGHT: bold; style='margin-left:100px;' align='left'> <b>" . utf8_decode($row[0]['nome']) . "</b></div>";
		echo "<div class='divTextoAutores'><span class='labelTipoProduto'>" . getDescricaoTipoProduto( $row[0]['tipo_produto']) . "</span> <span class='labelFeitoPor' >" . getPreposicaoTipoProduto($row[0]['tipo_produto']) . " </span>" .
	"<span class='labelNomeAutor' >" . utf8_decode($row[0]['nome_autor']) .
	"</span><span class='labelEmpresaAutor' >,MB Associados</span></div>" .
	"<div class='divTextoOcorridoEm'><span class='labelAgendadoPara'>" . getDescricaoOcorrencia( $row[0]['tipo_produto']) . " </span>" .
	"<span class='labelDataAgendamento'>" . getHorarioPublicacao( $row[0]['total_horas'], $row[0]['dia'], $row[0]['mes'], $row[0]['ano']) . "</span>" .
	"</div>";
	
	echo "<p  style='margin-left:5px' align='left'> <br>";
	if ($acessoAutorizado > 0) {
		echo str_replace("186.202.62.17", "127.0.0.1", utf8_decode($row[0]['descricao_artigo']));
	} else {
		echo str_ireplace("186.202.62.17", "127.0.0.1", utf8_decode($row[0]['descricao_artigo']));
	}
	echo ' </p>';
}
?>
				

</DIV><!-- corpo -->



