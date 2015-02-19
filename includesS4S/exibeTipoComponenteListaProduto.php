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
$sqlSub = $sqlSub . " from portal_gourmand.conteudos c left join portal_gourmand.produtos p on c.id_produto_fk = p.id_produto where ";
$sqlSub = $sqlSub . " id_produto_fk = " . $idProduto;
$sqlSub = $sqlSub . " and id_conteudo not in (select id_conteudo_fk from portal_gourmand.conteudo_portais_excluidos where id_produto_portal_fk in(select id_produto_portal from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "' and status='A'))  ";
$sqlSub = $sqlSub . " and id_produto_fk in(select id_produto_fk from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "'  and status='A')  ";
$sqlSub = $sqlSub . " and c.exibir_como_detalhe_na_home != 'S'";
$sqlSub = $sqlSub . " order by  date_format(c.data_criacao, '%Y/%m/%d %H:%i:%s') desc ";
$sqlSub = $sqlSub . " LIMIT " . $qtdeExibicao;

//echo $sqlSub;
$db->setQuery($sqlSub);
$rowConteudoArtigo = $db->loadAssocList();
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
?>

<?php


$styleTitulo = "background:#" . $corBarraTable . "; ";
if ($corLinhaTable == "") {
	$styleTitulo = $styleTitulo . " border: 1px solid #C0c0c0;";
} else {
	$styleTitulo = $styleTitulo . " border: 1px solid #" . $corLinhaTable . ";";
}
?>
		 <div class="divCorpoBatepapo<?php echo $nomeColuna?>"> <!-- inicio div corpo bate papo -->
			<!--<div class="divDestaque<?php echo $nomeColuna?>"> <!-- inicio div BATEPAPO  1-->
					 <div class="divTituloDestaque" ><!-- style="<?php echo $styleTitulo?>"-->  <!-- inicio div titulo -->
						<div class="tituloCaixas">
						    <div id="divTitulo">
								<img src='adm/images/icones/iconEstrela.png' />
						 <?php

					


if ($naoExibeDescricao != "S") {
	echo $descricao;
}

	if (($naoExibeDescricao != "S") and ($exibeData == "S")) {
	echo " - ";
	}

if ($exibeData== "S"){
	echo $rowConteudoArtigo[0]['dia'] . "/";
	echo getMesAbreviado($rowConteudoArtigo[0]['mes']) . "/";
	echo $rowConteudoArtigo[0]['ano'];

}
?>
                        </div> <!-- divTituloListaProduto -->
						  
					 </div> <!-- divTituloDestaqueListaProduto -->
<?php


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($tipoExibicaoLista == "L") { //exibir somente links
	if (count($rowListaProduto) > 0) {
		$cont = 1;
		for ($j1 = 0; $j1 < count($rowListaProduto); $j1++) {
			echo $cont . ".  <a href='index.php?option=com_content&view=article&id=46&id_conteudo=" . $rowListaProduto[$j1]['id_conteudo'] . "&id_produto=" . $rowListaProduto[$j1]['id_produto_fk'] . "' style=text-decoration:none>" . $rowListaProduto[$j1]['nome'] . "</a><br>";
			$cont = $cont +1;
		}
	}
} else { //exibir completo
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if (count($rowConteudoArtigo) > 0) {
		$cont = 1;
		$qtdeLinhas = count($rowConteudoArtigo);
		for ($j2 = 0; $j2 < $qtdeLinhas; $j2++) {
			/////////////////////////////////////////////////////////////////////////////`
			// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
			$naoExibeAutor = $rowConteudoArtigo[$j2]['nao_exibe_autor'];
			$idAutorFk = $rowConteudoArtigo[$j2]['id_autor_fk'];
			$naoExibeNome = $rowConteudoArtigo[$j2]['nao_exibe_nome'];
			$nome = $rowConteudoArtigo[$j2]['nome'];
			$idConteudo = $rowConteudoArtigo[$j2]['id_conteudo'];
			$idProdutoFk = $rowConteudoArtigo[$j2]['id_produto_fk'];
			$iconePadrao = $rowConteudoArtigo[$j2]['icone_padrao'];
			$tipoProduto = $rowConteudoArtigo[$j2]['tipo_produto'];
			$diaPublicacao = $rowConteudoArtigo[$j2]['dia'];
			$mesPublicacao = $rowConteudoArtigo[$j2]['mes'];
			$anoPublicacao = $rowConteudoArtigo[$j2]['ano'];
			$totalHoras = $rowConteudoArtigo[$j2]['total_horas'];
?>
		   <div class="boxbatepapo">

<?php
	
			require ("exibeDadosTituloAutor.php");
			/////////////////////						  

			echo "<a href='index.php?option=com_content&view=article&id=46&id_conteudo=" . $rowConteudoArtigo[$j2]['id_conteudo'] . "&id_produto=" . $rowConteudoArtigo[$j2]['id_produto_fk'] . "' style=text-decoration:none>";
			if (@$nao_exibe_autor == "S"){
			echo ' <div class="textoCaixasArtigos">';
			}
			else{
			 echo ' <div class="textoCaixasArtigos_SEM_FOTO">';
			}
			//echo htmlspecialchars($rowListaProduto[$j2]['descricao_resumo']);
			//echo $rowConteudoArtigo[$j2]['descricao_resumo'];
			echo formataDescricaoResumo($rowConteudoArtigo[$j2]['descricao_resumo'],$nomeColuna,$rowConteudoArtigo[$j2]['id_conteudo']);
			echo '</div> <!-- textoCaixasArtigos -->';
			echo "</a>";
			
			 
			//echo $qtdeLinhas;
			if (($qtdeLinhas > 1) && ($qtdeLinhas != ($j2 +1))) {
				echo '<div class="divLinhaSeparacao">';
				echo '</div>';
			}
			
			echo ' </div> <!-- boxbatepapo-->' ; 
			//////////////////////////////////////////////////////////////////////////////
			$cont = $cont +1;
		}
	//	echo '</div> <!-- divcorpoBatePapo-->' ;
		echo '</div> <!--divDestaqueListaproduto -->';
	}
	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////					  
?>
