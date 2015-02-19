<?php


/*
 * Created on 14/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<?php
$diretorioMb = "/mbnovo/mbAssociados";

require_once ('funcoesGerais.php');

// seta nome da coluna a ser concatenado no css se for coluna da esquerda nao seta nada

// se for coluna direita nao exibe foto do autor
	
	// coloca foto
		$cssExibeFoto = "";
	echo '<div class="fotoesquerda">';

	/////////////////// autor query /////////////////
	$sqlSubAutor = " select * from $bancoMBAssociados.autor where id_autor = '" . $idAutorFk . "' ";
	$db->setQuery($sqlSubAutor);
	$rowSubAutor = $db->loadAssocList();
	if (count($rowSubAutor) > 0) {
		for ($j0 = 0; $j0 < count($rowSubAutor); $j0++) {
			if ($rowSubAutor[0]['foto'] != "") {
				echo "<img src='" . $diretorioMb . "/images/autor/" . $rowSubAutor[0]['foto'] . "' style='border:1px solid black;' width=50 height=50>";
			} else {
				echo "<img src='" . $diretorioMb . "/images/autor/autor.' jpg style='border:1px solid black;'>";
			}

		}
	} else {
		echo "<img src=" . $diretorioMb . "/images/autor/autor.jpg style='margin-left:5px;border:1px solid black;'>";
	}

	/////////////////////////////////////////////////

	//echo $rowSub[$j2]['id_conteudo'];

	echo "</div>";

	echo ' <div class="boxtitulotexto' . $nomeColuna . $cssExibeFoto . '" >';

	echo " <a  href='#' onclick='abreArtigo(" . @$idConteudo . "," . @$idProdutoFk . ")' class='tituloCaixasArtigos". $nomeColuna . $cssExibeFoto ."' style=text-decoration:none>";
	echo ' <div class="tituloCaixasArtigos' . $nomeColuna . $cssExibeFoto . '">';
	echo @$nome;
	echo " </div>";
	echo "</a> ";

	echo " <div class='tituloCaixasAutor" . $nomeColuna. "'>";
	/** ********************
	 * 
	 *  exibe ou nao dados autor
	 * 
	 */
		echo "<div class='divIconeConteudo'>";

		if ($iconePadrao != "") {
			echo "<img src=images/icones/" . $iconePadrao . " style='margin-left:5px'>";
		} else {
			echo "<img src=images/icones/iconTexto.png style='margin-left:5px'>";
		}
		echo "</div>";

		echo "<div class='divTextoAutores'><span class='labelTipoProduto'>" . utf8_decode(getDescricaoTipoProduto($tipoProduto)) . "</span> <span class='labelFeitoPor' >" . getPreposicaoTipoProduto($tipoProduto) . " </span>" .
		"<span class='labelNomeAutor' >" . $rowSubAutor[0]['nome'] .
		"</span><span class='labelEmpresaAutor' >, MB Associados</span></div>" .
		"<div class='divTextoOcorridoEm'><span class='labelAgendadoPara'>" . getDescricaoOcorrencia($tipoProduto) . " </span>" .
		"<span class='labelDataAgendamento'>".getHorarioPublicacao($totalHoras,$diaPublicacao,$mesPublicacao,$anoPublicacao)."</span>" .
		"</div>";

	echo "</div>"; //tituloCaixasAutor

	echo ' </div>'; // div boxtitulotexto
?>		