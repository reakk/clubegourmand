<?php


/* *******************************************************************
* Staff 4 Solutions (c) 2011
* 
* Descrição: Detahe do conteudo do produto portal, utilizando infra Joomla
* Created on 05/06/2011
* Developer: Lago
* Projeto: mbAssociados
* TODO: TODO
* Revision:
/* *****************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
require ("path_install.php");

include ("parametrosConfiguracao.php");
?>

<?php


// Get a database object
$db = & JFactory :: getDBO();
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
$db = & JFactory :: getDBO();

$query = " SELECT cor_barra_table, ";
$query .= " cor_linha_table, ";
$query .= "        icone_barra, ";
$query .= "        nao_exibe_descricao,ifnull(c.tipo_acesso_conteudo, p.tipo_acesso_conteudo) tipo_acesso_conteudo, ";
$query .= "        ifnull(c.exibe_data, hpc.exibe_data) exibe_data, ";
$query .= "        c.nao_exibe_autor,c.nao_exibe_nome, ";
$query .= "        c.nome,p.nome nome_produto, p.tipo_produto,";
$query .= "        c.id_produto_fk, c.exibir_icones_redes_sociais,";
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
$query .= " FROM    $bancoMBAssociados.conteudos c ";
$query .= " LEFT JOIN ";
$query .= "  $bancoMBAssociados.home_portal_conteudo hpc ";
$query .= "        ON (c.id_conteudo = hpc.id_conteudo_fk ";
$query .= "         OR c.id_produto_fk = hpc.id_produto_fk AND hpc.id_portal_fk = " . $id_portal . ")";
$query .= "       left join $bancoMBAssociados.produtos p on c.id_produto_fk = p.id_produto ";
$query .= " WHERE id_conteudo = '" . $_GET["id_conteudo"] . "'";

$db->setQuery($query);
$rowConteudo = $db->loadAssocList();
//echo $query;
if (count($rowConteudo) > 0) {
	// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
	$naoExibeAutor = $rowConteudo[0]['nao_exibe_autor'];
	$idAutorFk = $rowConteudo[0]['id_autor_fk'];
	$naoExibeNome = $rowConteudo[0]['nao_exibe_nome'];
	$nome = $rowConteudo[0]['nome'];
	$idConteudo = $rowConteudo[0]['id_conteudo'];
	$idProdutoFk = $rowConteudo[0]['id_produto_fk'];
	$iconePadrao = $rowConteudo[0]['icone_padrao'];
	$tipoProduto = $rowConteudo[0]['tipo_produto'];
	$diaPublicacao = $rowConteudo[0]['dia'];
	$mesPublicacao = $rowConteudo[0]['mes'];
	$anoPublicacao = $rowConteudo[0]['ano'];
	$totalHoras = $rowConteudo[0]['total_horas'];
	

}else{
	$naoExibeAutor = 'N';
	$idAutorFk = '0';
	$naoExibeNome = 'N';
	$nome = '';
	$idConteudo = 0;
	$idProdutoFk = 0;
	$iconePadrao = '';
	$tipoProduto = '';
	$diaPublicacao = '';
	$mesPublicacao = '';
	$anoPublicacao ='';
	$totalHoras = '';
}
////////////inicio validaçao basica ///////////////
/** ******************************************
 *  INICIO
 *  Se a data atual(hoje) for menor do que a data publico, 
 * o conteudo é restrito
 * 
 * dat_publico = data_criacao + qtde de dias para artigo ser publicado
 * 
****************************************** */

$session = & JFactory :: getSession();
//echo "produtos==" . @ $session->get('idProdutosPermitidos');
//echo "ID+USUARIO==" . @ $session->get('id_usuario');

// se o usuario nao tiver acesso ao produto verifica as condicoes
$acessoAutorizado = -1;
if ((@ $session->get('idProdutosPermitidos')) && (in_array(@ $idProdutoFk, $session->get('idProdutosPermitidos')))) {
	echo "<script>";
	//				echo " alert ('acesso liberado!')";
	$acessoAutorizado = 2;
	echo "</script>";
} else {
	if ((count($rowConteudo)>0)&&($rowConteudo[0]['tipo_acesso_conteudo'] == "P")) { //SEMPRE PUBLICO
		//sempre publico
		//implemtacoes se necessário...
		$resultadoValidacao = "ARTIGO PUBLICO PODE EXIBIR";
		$acessoAutorizado = 3;
	} else {
		if ((count($rowConteudo)>0)&&($rowConteudo[0]['tipo_acesso_conteudo'] == "N")) { //nunca publico
			if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $idProdutoFk, $session->get('idProdutosPermitidos')))) {
				echo "<script>";
				$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
				//				echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
				echo "</script>";
				$acessoAutorizado = -15;
			} else {
				echo "<script>";
				//				echo " alert ('Voce deve efetuar o login 1!')";
				$acessoAutorizado = false;
				echo "</script>";
			}

		} else {
			if ((count($rowConteudo)>0)&&($rowConteudo[0]['tipo_acesso_conteudo'] == "D")) { //POR DIAS
				if (date("Y-m-d H:i:s") > $rowConteudo[0]['data_publico']) {
					//conteudo disp normal
					$acessoAutorizado = 4;
				} else {
					if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $idProdutoFk, $session->get('idProdutosPermitidos')))) {
						echo "<script>";
						$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
						//						echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
						echo "</script>";
						$acessoAutorizado = -10;
					} else {
						echo "<script>";
						//						echo " alert ('Voce deve efetuar o login 2!')";
						echo "</script>";
						$acessoAutorizado = -11;
					}

				}

			} else {
				//DEFAULT POR DATA
				if ((count($rowConteudo)>0)&&(date("Y-m-d H:i:s") > $rowConteudo[0]['data_publico'])) {
					//conteudo disp normal
					$acessoAutorizado = 5;
				} else {
					if ((@ $session->get('idProdutosPermitidos')) && (!in_array(@ $idProdutoFk, $session->get('idProdutosPermitidos')))) {
						echo "<script>";
						$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
						//						echo " alert ('Voce nao tem acesso a este produto" . $url . "');";
						echo "</script>";
						$acessoAutorizado = -12;
					} else {
						echo "<script>";
						//						echo " alert ('Voce deve efetuar o login 3!')";
						echo "</script>";
						$acessoAutorizado = -13;
					}

				}
			}

		}
	}
}

if ($acessoAutorizado > 0) {
	//echo "voce esta XXXXXXXXXXXx" .$acessoAutorizado;
} else {
	//echo "NEGADO=" .$acessoAutorizado;
}
/** ******************************************
 *  FIM
 *  Se a data atual(hoje) for menor do que a data publico, 
 * o conteudo é restrito
 * 
 * dat_publico = data_criacao + qtde de dias para artigo ser publicado
 * 
****************************************** */

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// inicio gravaçao de log de acesso ///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
$session = & JFactory :: getSession();
if (@ $session->get('id_usuario')) {
	$queryLog = "INSERT into $bancoMBAssociados.acessos(data_acesso,log_acesso,id_conteudos_fk,id_usuario_fk) VALUES(now(),''," . $_GET["id_conteudo"] . "," . $session->get('id_usuario') . ")";
	//echo $queryLog;
	$db->setQuery($queryLog);

	if (!$db->query()) {
		JError :: raiseError(500, $db->stderr());
		echo $db->stderr();
		return false;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// fim gravaçao de log de acesso ///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

//echo "RESULTADO VALIDACAO=" . @$resultadoValidacao;
?>





<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<table cellpadding="0" cellspacing="0" border="0" width=991px>
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
  		  <td  valign='top' height=100% class='celulaTabelaColunaEsquerda' > <!-- INICIO CELULA TABELA COLUNA ESQUERDA 1 -->
             <?php


require ("exibeArtigo.php");
?>  		    
	
</td>
<!-- /////////////////////////////// inicio COLUNA CENTRO //////////////////////////////// -->

<td valign="top" width="30%">
<?php


require ("componenteLateralDinamica.php")
//echo "esquerda";
?>
</td>
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->
</tr>
</table>
