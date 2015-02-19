<?php



$diretorioJoomla = "s4s";
$diretorioMb = "/mbnovo/mbAssociados";

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");
require_once ('funcoesGerais.php');

?>
<?php


// Get a database object
$db = & JFactory :: getDBO();
//recuperar qtde de linhas da home
$query = "SELECT valor FROM portal_gourmand.home_portal_parametros where id_portal = $id_portal ";
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

//echo $qtdeLinhasHome;
?>

<!-- inicio -->

<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<table cellpadding="0" cellspacing="0" border="0" width='100%'>
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
 <TD vAlign="top" > 
 <?php

require_once ('definePopupModalLogin.php');
?>
 
	  <TABLE BORDER ="0" cellpadding="0" cellspacing="0" border='0' width='100%'> <!-- INICIO TABELA COLUNA ESQUERDA -->

					<?php


// Get a database object
$db = & JFactory :: getDBO();

///loop das linhas//////////////////////////////////////////
for ($i = 1; $i <= $qtdeLinhasHome; $i++) {
?> 
        <TR> <!-- INICIO LINHA TABELA COLUNA ESQUERDA -->
          
						<?php


	$controle = "";
	//loop das colunas ///////////////////////////////////

	for ($j = 0; $j < 2; $j++) {

		$sql = " select hp.*,hi.* from portal_gourmand.home_portal_conteudo hp, portal_gourmand.home_portal_index hi where hp.id = hi.id_home_portal_fk  ";
		$sql = $sql . " and local_exibicao = 'C'";
		$sql = $sql . " and linha_exibicao = " . $i;
		$sql = $sql . " and coluna_exibicao = " . $j . "+1";
		$sql = $sql . " and hp.status = 'A'";
		$sql = $sql . " and hi.id_portal_fk =  $id_portal ";
		$sql;
		$db->setQuery($sql);
		$rowPortalConteudo = $db->loadAssocList();

		if ($j == 0) {
			if (count($rowPortalConteudo) > 0) {
				echo "<td width='50%' valign='top' height=100% class='celulaTabelaColunaEsquerda' > <!-- INICIO CELULA TABELA COLUNA ESQUERDA 1 -->";
				$controle = "true";
			} else {
				echo "<td colspan=2 valign='top' height=100% class='celulaTabelaColunaEsquerda'><!-- INICIO CELULA TABELA COLUNA ESQUERDA 2 -->";
			}
		} else {
			if ($controle == "true") {
				echo "<td  width='50%' valign='top' height=100% class='celulaTabelaColunaEsquerda'><!-- INICIO CELULA TABELA COLUNA ESQUERDA  3-->";
			}
		}
		// fim td inicial
?>


						   	
							<?php


		if (($j == 0) || ($controle == "true")) {
			//loop das linhas dentro das colunas
			//JR NAO PRECISA...VAI SER DIV echo "<table border=0 cellpadding=0 cellspacing=0 width=100%  height=100% style='min-height: 100%;height:100%'>";
			for ($x = 0; $x < 3; $x++) {
				//consulta item
				//submete a consulta ao banco
				$sql = " select hp.*,hi.*, hi.id_portal_fk as portal from portal_gourmand.home_portal_conteudo hp, portal_gourmand.home_portal_index hi where hp.id = hi.id_home_portal_fk  ";
				$sql = $sql . " and local_exibicao = 'C'";
				$sql = $sql . " and linha_exibicao = " . $i;
				$sql = $sql . " and coluna_exibicao = " . $j;
				$sql = $sql . " and ordem_exibicao = " . $x;
				$sql = $sql . " and hp.status = 'A'";
				$sql = $sql . " and hi.id_portal_fk =  $id_portal ";
				//echo $sql;
				$db->setQuery($sql);
				$rowPortalConteudoEsquerda = $db->loadAssocList();

				if (count($rowPortalConteudoEsquerda) > 0) {
					for ($r = 0; $r < count($rowPortalConteudoEsquerda); $r++) {
						// seta nome da coluna a ser concatenado no css se for coluna da esquerda nao seta nada
						$nomeColuna = "";
						// incio seta variaveis utilizada pelas .php de exibicao de tipo

						$idConteudo = $rowPortalConteudoEsquerda[$r]['id_conteudo_fk'];

						$idProduto = $rowPortalConteudoEsquerda[$r]['id_produto_fk'];
						$idPortal = $rowPortalConteudoEsquerda[$r]['portal'];
						$qtdeExibicao = $rowPortalConteudoEsquerda[$r]['qtde_exibicao'];
						$corBarraTable = $rowPortalConteudoEsquerda[$r]['cor_barra_table'];
						$corLinhaTable = $rowPortalConteudoEsquerda[$r]['cor_linha_table'];
						$iconeBarra = $rowPortalConteudoEsquerda[$r]['icone_barra'];
						$tipoExibicaoLista = $rowPortalConteudoEsquerda[$r]['tipo_exibicao_lista'];
						$exibeAutor = $rowPortalConteudoEsquerda[$r]['exibe_autor'];
						$naoExibeDescricao = $rowPortalConteudoEsquerda[$r]['nao_exibe_descricao'];
						$descricao = $rowPortalConteudoEsquerda[$r]['descricao'];
						$exibeData = $rowPortalConteudoEsquerda[$r]['exibe_data'];

						if ($rowPortalConteudoEsquerda[$r]['tipo_componente'] == "D") {
							require ("exibeTipoComponenteDestaque.php");
							//echo "destaque";
						}

						if ($rowPortalConteudoEsquerda[$r]['tipo_componente'] == "P") {
							require ("exibeTipoComponenteUltimoArtigo.php");
							//echo "ultimo artigo";
						}

						// fim seta variaveis utilizada pelas .php de exibicao de tipo
						/* *********************************************************************************
						 * 
						 * 
						 *   tipo componente artigo
						 * 
						 ********************************************************************************* */
						if ($rowPortalConteudoEsquerda[$r]['tipo_componente'] == "A") {
							require ("exibeTipoComponenteArtigo.php");
							//echo "exibeTipoComponenteArtigo";
						}

						/* *********************************************************************************
						 * 
						 *   tipo componente lista produto
						 * 
						 ********************************************************************************* */
						if ($rowPortalConteudoEsquerda[$r]['tipo_componente'] == "U") {
							require ("exibeTipoComponenteListaProduto.php");
							//echo "exibeTipoComponenteListaProduto";

						}


						/* *********************************************************************************
						 * 
						 *   tipo componente lista geral
						 * 
						 ********************************************************************************* */
						if ($rowPortalConteudoEsquerda[$r]['tipo_componente'] == "T") {
							require ("exibeTipoComponenteListaGeral.php");
							//echo "exibeTipoComponenteListaGeral";
						}

					}
				}
				//echo "<div id='".$row['id_home_portal_fk']."' class=\"drag t1\"> :: ".$row['descricao']."</div>";
?>
								<?php


			}
?>
						<?php


		}
	}
?>

					<?php


}
?>





          </td><!-- FIM CELULA TABELA COLUNA ESQUERDA -->
        </TR> <!-- FIM LINHA TABELA COLUNA ESQUERDA -->


	</table>
</td>
<!-- /////////////////////////////// inicio COLUNA CENTRO //////////////////////////////// -->
<!--
<td valign="top" class="celulaTabelaColunaDireita" > -->
<?php


//require ("componenteLateralDinamica.php");
?>
<!-- </td> -->
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->
</tr>
</table>





<!-- /////////////////////////////// FIM TABELA MASTER //////////////////////////////// -->
