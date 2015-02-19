<?php
/*
 * Created on 19/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>



<?php
//funcao recursiva para exibiçao do menu


function getMenuOption($idMenuRaiz,$id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM portal_gourmand.home_menu_portal where exibe_menu='S' and id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=".$idMenuRaiz." and pertence='$id' order by posicao ";
	// se for primeiro nivel
	
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();
    if (( $pertence==0)&&($conta==1)){
		global $totalLinhasNivel1;
		$totalLinhasNivel1=count($row) ;
	}
	// echo "passed";

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço
	//$traco=$traco."++".$id;  
	 
	for ($i = 0; $i < count($row); $i++) {

		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 

		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLink($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$conta++;
			$options .= "{$espaco} {$traco} " . getLinkSub($conta,$row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			
			$options .= "{$espaco} {$traco} " . getLinkSub($conta,$row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
         
		$options .= getMenuOption($idMenuRaiz,$id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	//return $options; #:: retorna o contéudo 
}



function criaDropMenu($idMenuRaiz,$nomeDropMenu){
$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$idPortal =42.;
	$sql = "SELECT * FROM portal_gourmand.home_menu_portal where exibe_menu='S' and id_portal=" .$idPortal . " and id_menu_raiz_fk=".$idMenuRaiz." and pertence=0 order by posicao ";
	// se for primeiro nivel
	
	die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();
 	
	if (count($row)>1){
			echo '<div id="blurMenu'. $nomeDropMenu.'" onmouseout="esconde(\'blurMenu'.$nomeDropMenu.'\');">';
	echo '  <div class="shadow"> ';
	echo '	 <div class="content'.$nomeDropMenu.'" onmouseout="esconde(\'blurMenu'. $nomeDropMenu.'\');" onmouseover="mostra(\'blurMenu'. $nomeDropMenu.'\');"> ';
	echo '	     <table  > ';
	echo '		    <tr> ';
	echo '			  <td valign="top" align="left"> ';
	echo '				<div class=\'colMenu\' > ';
							    echo getMenuOption($idMenuRaiz, 0,  1,  0);
	echo '				</div> ';
	echo '              </td> ';
	echo '            </tr> ';
	echo '		  </table>	 ';
	echo '	 </div> ';
	echo '  </div> ';
	echo '</div> ';
	}

}
?>