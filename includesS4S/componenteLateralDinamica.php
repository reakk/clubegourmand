<?php

require_once ('funcoesGerais.php');


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descrição: 
 * Created on 08/12/2011
 * Developer: Lago
 * Projeto: portalB
 * TODO: TODO
 * Revision:
 /* *****************************************************************/
?>
<!-- /////////////////////////////// INICIO COLUNA DIREITA //////////////////////////////// -->
  <div class = "divLateralDireita">
<?php


///loop das linhas//////////////////////////////////////////
$sql = " select hp.*,hi.*, hi.id_portal_fk as portal from portal_gourmand.home_portal_conteudo hp, $bancoMBAssociados.home_portal_index hi where hp.id = hi.id_home_portal_fk  ";
$sql = $sql . " and local_exibicao = 'D'";
$sql = $sql . " and hp.status = 'A'";
$sql = $sql . "order by linha_exibicao";
//echo $sql;
$db->setQuery($sql);
$rowsColunaDireita = $db->loadAssocList();
//echo count($row);
for ($r = 0; $r < count($rowsColunaDireita); $r++) {
	// seta nome da coluna a ser concatenado no css
	$nomeColuna = "_DIREITA";

	// incio seta variaveis utilizada pelas .php de exibicao de tipo

	$idConteudo = $rowsColunaDireita[$r]['id_conteudo_fk'];

	$idProduto = $rowsColunaDireita[$r]['id_produto_fk'];
	$idPortal = $rowsColunaDireita[$r]['portal'];
	$qtdeExibicao = $rowsColunaDireita[$r]['qtde_exibicao'];
	$corBarraTable = $rowsColunaDireita[$r]['cor_barra_table'];
	$corLinhaTable = $rowsColunaDireita[$r]['cor_linha_table'];
	$iconeBarra = $rowsColunaDireita[$r]['icone_barra'];
	$tipoExibicaoLista = $rowsColunaDireita[$r]['tipo_exibicao_lista'];
	$exibeAutor = $rowsColunaDireita[$r]['exibe_autor'];
	$naoExibeDescricao = $rowsColunaDireita[$r]['nao_exibe_descricao'];
	$descricao = $rowsColunaDireita[$r]['descricao'];
	$exibeData = $rowsColunaDireita[$r]['exibe_data'];

	// fim seta variaveis utilizada pelas .php de exibicao de tipo    
	/* *********************************************************************************
	 * 
	 *   tipo componente artigo
	 * 
	 ********************************************************************************* */
	echo ' <div class="divBordaCorpo">';

	if ($rowsColunaDireita[$r]['tipo_componente'] == "P") {
		//echo "tipo_componente =P";
		require ("exibeTipoComponenteUltimoArtigo.php");
	}


	if ($rowsColunaDireita[$r]['tipo_componente'] == "A") {
		//		echo "tipo_componente =A";
		require ("exibeTipoComponenteArtigo.php");
	}

	/* *********************************************************************************
	 * 
	 *   tipo componente lista produto
	 * 
	 ********************************************************************************* */
	if ($rowsColunaDireita[$r]['tipo_componente'] == "U") {
	//	echo "tipo_componente =U";
		require ("exibeTipoComponenteListaProduto.php");
	}

	/* *********************************************************************************
	 * 
	 *   tipo componente lista geral
	 * 
	 ********************************************************************************* */
	if ($rowsColunaDireita[$r]['tipo_componente'] == "T") {
	//	echo "tipo_componente =T";
		require ("exibeTipoComponenteListaGeral.php");
	}
	echo '</div><!-- fim div divBordaCorpo -->';

}
?> 
  
  </div> <!-- fim divLateralDireita-->






<!-- /////////////////////////////// FIM COLUNA CENTRO //////////////////////////////// -->