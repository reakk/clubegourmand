<?php


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descrição: 
 * Created on 18/12/2011
 * Developer: Lago
 * Projeto: mbAssociados
 * TODO: TODO
 * Revision:
 /* *****************************************************************/

///////////////////////////////////////////////////////////
////tipo artigo
//submete a consulta ao banco
$sqlSub = " select c.*,p.tipo_produto,date_format(now(), '%H:%m:%s') as horas,date_format(c.data_criacao, '%d') as dia,date_format(c.data_criacao, '%m') as mes,date_format(c.data_criacao, '%Y') as ano,TIMEDIFF(now(),c.data_criacao) as total_horas ";
$sqlSub = $sqlSub . "from portal_gourmand.conteudos  c left join portal_gourmand.produtos p on c.id_Produto_fk = p.id_produto ";
$sqlSub = $sqlSub . " where id_conteudo not in (select id_conteudo_fk from portal_gourmand.conteudo_portais_excluidos where id_produto_portal_fk in(select id_produto_portal from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "' and status='A'))  ";
$sqlSub = $sqlSub . " and id_produto_fk in(select id_produto_fk from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "'  and status='A')  ";
$sqlSub = $sqlSub . " and p.exibe_em_ultimas_atualizacoes='S' ";
$sqlSub = $sqlSub . " and c.exibir_como_detalhe_na_home != 'S'";
$sqlSub = $sqlSub . " order by  date_format(c.data_criacao, '%Y/%m/%d %H:%i:%s') desc ";
$sqlSub = $sqlSub . " LIMIT " . $qtdeExibicao;

//echo $sqlSub;
$db->setQuery($sqlSub);
$rowListaGeral = $db->loadAssocList();
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

?>

<?php


$styleTitulo = "background:#" . $corBarraTable . "; ";
if ($corLinhaTable == "") {
	$styleTitulo = $styleTitulo . " border-bottom : 1px solid #C0c0c0;";
} else {
	$styleTitulo = $styleTitulo . " border-bottom : 1px solid #" . $corLinhaTable . ";";
}
?>
				<div class="divCorpoBatepapo<?php echo $nomeColuna?>" > <!-- inicio div BATEPAPO  1-->
					 <div class="divTituloDestaque" ><!--style="<?php echo $styleTitulo?>"> <!-- inicio div titulo -->
						<div class="tituloCaixas" >
						  <!--  <img style='width:16px;height:16px;' src='./images/icones/<?php echo $iconeBarra?>' border='0'>-->
						    <div id="divTitulo">
								<img src='adm/images/icones/iconEstrela.png' />
						 <?php


if ($naoExibeDescricao != "S") {
	echo $descricao;
}

if (($naoExibeDescricao != "S") and ($exibeData == "S")) {
	echo " - ";
}

if ($exibeData == "S") {
	echo date("d/m/y");
}
?>
  </div>
						</div>  
					 </div><!-- inicio div titulo -->
<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
if ($tipoExibicaoLista == "L") { //exibir somente links

	if (count($rowListaGeral) > 0) {
		echo ' <div class="divTipoExibicaoListagem' . $nomeColuna . '"> <!-- inicio div corpo bate papo -->';
		$cont = 1;
		for ($j1 = 0; $j1 < count($rowListaGeral); $j1++) {
			$teste = "TESTE TESTE TES" . $rowListaGeral[$j1]['tipo_produto'];
			//die (getDescricaoTipoProduto($rowListaGeral[$j1]['tipo_produto']));
			echo $cont . ".  <a href='index.php?option=com_content&view=article&id=46&id_conteudo=" . $rowListaGeral[$j1]['id_conteudo'] . "&id_produto=" . $rowListaGeral[$j1]['id_produto_fk'] . "' class='linkLinhaTipoExibicaoListagem' style='text-decoration: none;'>" . $rowListaGeral[$j1]['nome'] . " <i> (" . getDescricaoTipoProduto($rowListaGeral[$j1]['tipo_produto']) . ")</i></a><br>";
			$cont = $cont +1;
		}
		echo ' </div> '; //divCorpoBatepapo
	}
} else { //exibir completo
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
	if (count($rowListaGeral) > 0) {

		$cont = 1;
		$qtdeLinhas = count($rowListaGeral);
		for ($j2 = 0; $j2 < $qtdeLinhas; $j2++) {
			/////////////////////////////////////////////////////////////////////////////`
			// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
			$naoExibeAutor = $rowListaGeral[$j2]['nao_exibe_autor'];
			$idAutorFk = $rowListaGeral[$j2]['id_autor_fk'];
			$naoExibeNome = $rowListaGeral[$j2]['nao_exibe_nome'];
			$nome = $rowListaGeral[$j2]['nome'];
			$idConteudo = $rowListaGeral[$j2]['id_conteudo'];
			$idProdutoFk = $rowListaGeral[$j2]['id_produto_fk'];
			$iconePadrao = $rowListaGeral[$j2]['icone_padrao'];
			$tipoProduto = $rowListaGeral[$j2]['tipo_produto'];
			$diaPublicacao =  $rowListaGeral[$j2]['dia'];
			$mesPublicacao =  $rowListaGeral[$j2]['mes'];
			$anoPublicacao =  $rowListaGeral[$j2]['ano'];
			$totalHoras =  $rowListaGeral[$j2]['total_horas'];
?>
		 <div class="divCorpoBatepapo<?php echo $nomeColuna?>"> <!-- inicio div corpo bate papo -->
		   <div class="boxbatepapo<?php echo $nomeColuna?>"> <!-- inicio div box bate papo -->

<?php

			//echo "DADOS TITULO";
			require ("exibeDadosTituloAutor.php");
			/////////////////////							  

			echo "<a href='index.php?option=com_content&view=article&id=46&id_conteudo=" . $rowListaGeral[$j2]['id_conteudo'] . "&id_produto=" . $rowListaGeral[$j2]['id_produto_fk'] . "' style=text-decoration:none>";
			echo ' <div class="textoCaixasArtigos' . $nomeColuna . '" ><!-- inicio textoCaixasArtigos -->';
			//echo $rowListaGeral[$j2]['descricao_resumo'];
			echo formataDescricaoResumo($rowListaGeral[$j2]['descricao_resumo'],$nomeColuna,$rowListaGeral[$j2]['id_conteudo']);
			echo '</div><!-- fim textoCaixasArtigos -->';
			echo "</a>";
			echo ' </div>';
			echo '</div>';
			if (($qtdeLinhas > 1) && ($qtdeLinhas != ($j2 +1))) {
				echo '<div class="divLinhaSeparacao">';
				echo '</div>';
			}

			//////////////////////////////////////////////////////////////////////////////
			$cont = $cont +1;
		}
	}
	echo '</div>';
	echo '</div><!-- fim div BATEPAPO LIsta Geral -->';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////							  
?>

