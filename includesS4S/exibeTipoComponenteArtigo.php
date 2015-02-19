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
//$sqlSub = " select *,date_format(now(), '%H:%m:%s') as horas,date_format(data_criacao, '%d') as dia,date_format(data_criacao, '%m') as mes,date_format(data_criacao, '%Y') as ano,TIMEDIFF(now(),data_criacao) as total_horas " .
//		"from $bancoMBAssociados.conteudos where ";
//		

$sqlSub = " select c.*,p.tipo_produto,date_format(now(), '%H:%m:%s') as horas,date_format(c.data_criacao, '%d') as dia,date_format(c.data_criacao, '%m') as mes,date_format(c.data_criacao, '%Y') as ano,TIMEDIFF(now(),c.data_criacao) as total_horas ";
$sqlSub = $sqlSub . " from portal_gourmand.conteudos c left join portal_gourmand.produtos p on c.id_produto_fk = p.id_produto where ";
$sqlSub = $sqlSub . " c.id_conteudo = " . $idConteudo;
$sqlSub = $sqlSub . " and id_conteudo not in (select id_conteudo_fk from portal_gourmand.conteudo_portais_excluidos where id_produto_portal_fk in(select id_produto_portal from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "' and status='A'))  ";
$sqlSub = $sqlSub . " and id_produto_fk in(select id_produto_fk from portal_gourmand.produtos_portais where id_portal_fk='" . $idPortal . "'  and status='A')  ";

//echo $sqlSub;
$db->setQuery($sqlSub);
$rowConteudoArtigo = $db->loadAssocList();
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

//$row[$i]['colunas'];
//$tamanhoCelula = 50 * $row[$i]['colunas'];
//echo "<td valign=top align=left colspan=".$row[$i]['colunas']." width='".$tamanhoCelula."%' bgcolor=#ffffff>";
?>


<?php

$styleTitulo = "background:#" . $corBarraTable . "; ";
if ($corLinhaTable == "") {
	$styleTitulo = $styleTitulo . " border: 1px solid #C0c0c0;";
} else {
	$styleTitulo = $styleTitulo . " border: 1px solid #" . $corLinhaTable . ";";
}
?>



				
<?php


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (count($rowConteudoArtigo) > 0) {
	// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
	$naoExibeAutor = $rowConteudoArtigo[0]['nao_exibe_autor'];
	$idAutorFk = $rowConteudoArtigo[0]['id_autor_fk'];
	$naoExibeNome = $rowConteudoArtigo[0]['nao_exibe_nome'];
	$nome = $rowConteudoArtigo[0]['nome'];
	$idConteudo = $rowConteudoArtigo[0]['id_conteudo'];
	$idProdutoFk = $rowConteudoArtigo[0]['id_produto_fk'];
	$iconePadrao = $rowConteudoArtigo[0]['icone_padrao'];
	$tipoProduto = $rowConteudoArtigo[0]['tipo_produto'];
	$diaPublicacao = $rowConteudoArtigo[0]['dia'];
	$mesPublicacao = $rowConteudoArtigo[0]['mes'];
	$anoPublicacao = $rowConteudoArtigo[0]['ano'];
	$totalHoras = $rowConteudoArtigo[0]['total_horas'];
	$arquivo = $rowConteudoArtigo[0]['arquivo'];
	
	if (count($rowConteudoArtigo)>0){
		/////////////////////////////////////////////////////////////////////////////`
?>
		 <div class="divCorpoBatepapo"> <!-- inicio div corpo bate papo -->
			<!--<div class="divDestaque<?php echo $nomeColuna?>"> <!-- inicio div BATEPAPO  1-->
					 <div class="divTituloDestaque" >
						<!-- <div class="tituloCaixas"> -->
						  
						   <!-- <div id="divTitulo"> -->
								<img src='adm/images/icones/iconEstrela.png' />
						 <?php 

if ($naoExibeDescricao!= "S") {
	echo $descricao;
}

if (($naoExibeDescricao != "S") and ($exibeData == "S")) {
	echo " - ";
}
if (($exibeData== "S") && (count($rowConteudoArtigo) > 0)) {
	//echo date("d/m/y")."llllll";
	echo $rowConteudoArtigo[0]['dia'] . "/";
	echo getMesAbreviado($rowConteudoArtigo[0]['mes']) . "/";
	echo $rowConteudoArtigo[0]['ano'];
} 
?>


 <!-- </div> -->
						<!-- </div>   -->
					 </div><!-- inicio div titulo -->
		   <!--<div class="boxbatepapo<?php echo $nomeColuna?>"> <!-- inicio div box bate papo -->

		   <div id='corpoDasCaixasAbaixoDestaque'>

			<div id='ladoEsquerdoFotoCaixasAbaixoDestaque'>
				<?php
					if($arquivo != ''){
						echo "<img src='adm/conteudos_upload_mb/artigo/".$arquivo."' />";
					}
				?>
			</div> <!-- ladoEsquerdoFotoCaixasAbaixoDestaque -->


		<div id='ladoDireitoTextoCaixasAbaixoDestaque'>

		
<?php


		//require ("exibeDadosTituloAutor.php");
								  
		
		echo "<a href='index.php?option=com_content&view=article&id=46&id_conteudo=" . $rowConteudoArtigo[0]['id_conteudo'] . "&id_produto=" . $rowConteudoArtigo[0]['id_produto_fk'] . "' style=text-decoration:none>";
		echo "<div id='titulosDosConteudosAbaixoHome'>";
		echo $nome;
		echo "</div>";
		$descricaoResumido = formataDescricaoResumo($rowConteudoArtigo[0]['descricao_resumo'],$nomeColuna,$rowConteudoArtigo[0]['id_conteudo']); 
		$resumirDescricao = strlen($descricaoResumido);
		echo "<div id='formatacaoDescricaoResumoArtigo'>";
			if($resumirDescricao > 300){
				echo substr(formataDescricaoResumo($rowConteudoArtigo[0]['descricao_resumo'],$nomeColuna,$rowConteudoArtigo[0]['id_conteudo']),0,300)."...";
				
			} else {
				echo formataDescricaoResumo($rowConteudoArtigo[0]['descricao_resumo'],$nomeColuna,$rowConteudoArtigo[0]['id_conteudo']);
			}
		echo "</div>";
		//echo "<div id='btnContinuarLendoArtigo'>";
		//	echo "<input type='button' value='continuar lendo' />";
		echo "</div>";


		echo "</a>";
		//echo ' </div>';
		echo '</div>';

	}
}
//echo '</div>';
?>
	</div> <!-- ladoDireitoTextoCaixasAbaixoDestaque -->
	</div> <!-- corpoDasCaixasAbaixoDestaque -->
</div><!-- fim div BATEPAPO LIsta Geral -->

					  