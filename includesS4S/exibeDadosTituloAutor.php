<?php


/*
 * Created on 14/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<?php
$diretorioMb = "/s4s/adm";

require_once ('funcoesGerais.php');

// seta nome da coluna a ser concatenado no css se for coluna da esquerda nao seta nada
if (@ $nomeColuna == null) {
	$nomeColuna = "";
}
$cssExibeFoto = "_SEM_FOTO";
// se for coluna direita nao exibe foto do autor
if ((@$naoExibeAutor != "S") && (@$idAutorFk != 0) && (@$idAutorFk != null)&&($nomeColuna=="")) {
	// coloca foto
	$cssExibeFoto = "";
	echo '<div class="fotoesquerda">';

	/////////////////// autor query /////////////////
	$sqlSubAutor = " select * from portal_gourmand.autor where id_autor = '" . $idAutorFk . "' ";
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
}

if ((@$sempreExibeNome=='S')||((@$naoExibeNome != "S") || (((@$naoExibeAutor != "S") && (@$idAutorFk != 0) && (@$idAutorFk != null))))) {
	
	echo ' <div class="boxtitulotexto' . $nomeColuna . $cssExibeFoto . '" >';
}
//echo "exibe=" . $row[$i]['nao_exibe_nome'];

if ((@$sempreExibeNome=='S')||(@$naoExibeNome != "S")) {
	echo " <a  href='#' onclick='abreArtigo(" . @$idConteudo . "," . @$idProdutoFk . ")' class='tituloCaixasArtigos". $nomeColuna . $cssExibeFoto ."' style=text-decoration:none>";
	echo ' <div class="tituloCaixasArtigos' . $nomeColuna . $cssExibeFoto . '">';
	echo @$nome;
	echo " </div>";
	echo "</a> ";
}
if ((@$naoExibeAutor != "S") && (@$idAutorFk != 0) && (@$idAutorFk != null)) {

	echo " <div class='tituloCaixasAutor" . $nomeColuna. "'>";
	/** ********************
	 * 
	 *  exibe ou nao dados autor
	 * 
	 */
	if ("_DIREITA" != $nomeColuna) {
		echo "<div class='divIconeConteudo'>";

		if ($iconePadrao != "") {
			echo "<img src=images/icones/" . $iconePadrao . " style='margin-left:5px'>";
		} else {
			echo "<img src=images/icones/iconTexto.png style='margin-left:5px'>";
		}
		echo "</div>";

		echo "<div class='divTextoAutores'><span class='labelDataAgendamento'> Publicado por " .$rowSubAutor[0]['nome'] .
		", Staff 4 Solutions </span></div>" .
		"<div class='divTextoOcorridoEm'>".
		"<span class='labelDataAgendamento'>".getHorarioPublicacao($totalHoras,$diaPublicacao,$mesPublicacao,$anoPublicacao)."</span>" .
		"</div>";

	}

	echo "</div>"; //tituloCaixasAutor
}

if ((@$sempreExibeNome=='S')||((@$naoExibeNome != "S") || (((@$naoExibeAutor != "S") && (@$idAutorFk != 0) && (@$idAutorFk != null))))) {

	echo ' </div>'; // div boxtitulotexto
}
$sempreExibeNome = 'n';
?>		