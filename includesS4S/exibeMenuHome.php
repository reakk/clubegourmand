
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

/*
 * Detalhe Artigo
index.php?option=com_content&view=article&id=46
Parametro: id_conteudo
conteudo Exemplo 35
Lista
index.php?option=com_content&view=article&id=47
Parametro: id_produto
exemplo 68

 */
/* funtion para retornar tipo de link - adriano.lago 05-10-2011 */

/* funtion para retornar tipo de link - adriano.lago 05-10-2011 */

$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
$linhasExibidas = 0;
function getLink($label, $flag_label, $tipo_link, $id_produto, $id_conteudo, $id_menu) {
	//echo $tipo_link."-";
	global $linhaAtualNivel1;
	$linhaAtualNivel1++;
	global $linhasExibidas;
	$linhasExibidas++;
	global $totalLinhasNivel1;
	//	echo "TOTAL= ".$totalLinhasNivel1;
	//	echo "ATUAL= ".$linhaAtualNivel1;
	$metade = $totalLinhasNivel1 / 2;
	if (($linhasExibidas > 4) && ($linhasExibidas > $metade)) {
		$linhasExibidas = 0;
?>
									</div>
		
		  						  </td>
								  <td valign="top">
									<div class='colMenu'>
							 	
							 	
							 	<?php


	}

	if ($flag_label == "S") { //caso seja apenas label
		$link = "<span class='label'>";
		$link .= $label;
		$link .= "</span><br>";
		echo $link;
	} else {
		if ($tipo_link == "L") {
			$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto&id_menu=$id_menu  style=text-decoration:none;>";
			$link .= $label;
			$link .= "</a></span><br>";
			echo $link;
		} else
			if ($tipo_link == "A") {
				$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
				$link .= $label;
				$link .= "</a></span><br>";
				echo $link;
			} else
				if ($tipo_link == "B") {
					$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=50&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";

					$link .= $label;
					$link .= "</a></span><br>";
					echo $link;
				} else
					if ($tipo_link == "I") {
						$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=49&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
						$link .= $label;
						$link .= "</a></span><br>";
						echo $link;
					} else
						if ($tipo_link == "LB") {
							$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=49&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
							$link .= $label;
							$link .= "</a></span><br>";
							echo $link;
						} else
							if ($tipo_link == "LP") {
								$link = "<span class='label'><a class='label' href=index.php?option=com_content&view=article&id=53&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
								$link .= $label;
								$link .= "</a></span><br>";
								echo $link;
							}
	}

}

function getLinkSub($conta, $label, $flag_label, $tipo_link, $id_produto, $id_conteudo, $espaco, $traco, $id_menu) {
	//echo $tipo_link."-";
	if ($flag_label == "S") { //caso seja apenas label
		$link = "<span class='label'>";
		$link .= $espaco . $traco . $label;
		$link .= "</span><br>";
		echo $link;
	} else {
		if ($tipo_link == "L") {
			$link = "<span class='submenu'><a class='submenu' href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto&id_menu=$id_menu style='text-decoration:none;color: #808080;'>";
			$link .= $espaco . $traco . $label;
			$link .= "</a></span><br>";
			echo $link;

		} else
			if ($tipo_link == "A") {
				$link = "<span class='submenu'><a class='submenu' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style='text-decoration:none;color: #808080;'>";
				$link .= $espaco . $traco . $label;
				$link .= "</a></span><br>";
				echo $link;
			} else
				if ($tipo_link == "B") {
					$link = "<span class='submenu'><a class='submenu' href=index.php?option=com_content&view=article&id=49&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style='text-decoration:none;color: #808080;'>";
					$link .= $espaco . $traco . $label;
					$link .= "</a></span><br>";
					echo $link;
				} else
					if ($tipo_link == "I") {
						$link = "<span class='submenu'><a class='submenu' href=index.php?option=com_content&view=article&id=50&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style='text-decoration:none;color: #808080;'>";
						$link .= $espaco . $traco . $label;
						$link .= "</a></span><br>";
						echo $link;
					} else
						if ($tipo_link == "LB") {
							$link = "<span class='submenu'><a class='submenu' href=index.php?option=com_content&view=article&id=49&id_produto=$id_produto&id_menu=$id_menu style='text-decoration:none;color: #808080;'>";
							$link .= $espaco . $traco . $label;
							$link .= "</a></span><br>";
							echo $link;
						} else
							if ($tipo_link == "LP") {
								$link = "<span class='submenu'><a  href=index.php?option=com_content&view=article&id=53&id_produto=$id_produto&id_menu=$id_menu class='submenu' style='text-decoration:none;color: #808080;'>";
								$link .= $espaco . $traco . $label;
								$link .= "</a></span><br>";
								echo $link;
							}

	}
}

require ("criaDropMenu.php");
/*
	$db = & JFactory :: getDBO();
	$sql = "SELECT * FROM mbAssociados.home_menu_raiz_portal order by id_menu_raiz ";
	
	$db->setQuery($sql);
	$row = $db->loadAssocList(); 


				for ($i = 0; $i < count($row); $i++) {
					echo "criaDropMenu('. $row[$i]["id_menu_raiz"] .' \, \' '. $row[$i]["descricao"] .' \' )";
					echo $totalLinhasNivel1 = 0;
					echo $linhaAtualNivel1 = 0;
					echo global $linhasExibidas;
					echo $linhasExibidas = 0;
				

				}

		
*/





criaDropMenu(1, "ArtigoAnalise");

criaDropMenu(2, "PRODUTOS");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(3, "Videos");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(4, "MinhaPagina");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(5, "Sobre");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(6, "AreaAtuacao");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(7, "Produtos");
$totalLinhasNivel1 = 0;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(8, "Equipe");
$totalLinhasNivel1 = 0;
global $linhasExibidas;
$linhaAtualNivel1 = 0;
global $linhasExibidas;
$linhasExibidas = 0;
criaDropMenu(9, "Contato");

?>