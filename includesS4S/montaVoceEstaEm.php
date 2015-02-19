<?php


/*
 * Created on 13/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

// Get a database object
$db = & JFactory :: getDBO();

////////// INICIO CONSULTA REGISTROS GRID////////////////
//submete a consulta ao banco 

$idMenu = @ $_GET["id_menu"];
$idConteudo = @ $_GET["id_conteudo"];

if ($idMenu == null) {
	$sql = " select hmp.id_menu ";
	$sql .= " from $bancoMBAssociados.conteudos c ";
	$sql .= "   left join $bancoMBAssociados.produtos p on c.id_produto_fk =  p.id_produto ";
	$sql .= "   left join $bancoMBAssociados.home_menu_portal hmp on p.id_produto = hmp.id_produto and hmp.id_portal= " . $id_portal;
	$sql .= " where c.id_conteudo =  " . $idConteudo;
	$sql .= " limit 1 ";
	$db->setQuery($sql);
 	//die( $sql);
	$rowMenu = $db->loadAssocList();
	$teste = "total=".count($rowMenu);
	//die ($teste);
	if (count($rowMenu) > 0) {
		$idMenu = $rowMenu[0]['id_menu'];
	} else {
		$idMenu = 0;
	}
}


$sql = "select n1.id_menu as n1_id_menu,n1.nome as n1_nome, ";
$sql .= "     n2.id_menu as n2_id_menu,n2.nome as n2_nome, ";
$sql .= "     n3.id_menu as n3_id_menu,n3.nome as n3_nome, ";
$sql .= "     n4.id_menu as n4_id_menu,n4.nome as n4_nome, ";
$sql .= "     n5.id_menu as n5_id_menu,n5.nome as n5_nome, ";
$sql .= "     n6.id_menu as n6_id_menu,n5.nome as n6_nome, ";
$sql .= "     n7.id_menu as n7_id_menu,n7.nome as n7_nome ";
$sql .= "  FROM $bancoMBAssociados.home_menu_portal n1  ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n2 on n1.id_portal = n2.id_portal and n1.pertence = n2.id_menu ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n3 on n2.id_portal = n3.id_portal and n2.pertence = n3.id_menu ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n4 on n3.id_portal = n4.id_portal and n3.pertence = n4.id_menu ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n5 on n4.id_portal = n5.id_portal and n4.pertence = n5.id_menu ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n6 on n5.id_portal = n6.id_portal and n5.pertence = n6.id_menu ";
$sql .= "    left join $bancoMBAssociados.home_menu_portal n7 on n6.id_portal = n7.id_portal and n6.pertence = n7.id_menu ";
$sql .= "  where n1.id_portal= " . $id_portal;
$sql .= "  and n1.id_menu = " . $idMenu;

//echo $sql;
$db->setQuery($sql);
$rowRastro = $db->loadAssocList();
$rastro = null;
if (count($rowRastro) > 0) {
	if ($rowRastro[0]["n7_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n7_nome"];
	}

	if ($rowRastro[0]["n6_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n6_nome"];
	}

	if ($rowRastro[0]["n5_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n5_nome"];
	}

	if ($rowRastro[0]["n4_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n4_nome"];
	}

	if ($rowRastro[0]["n3_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n3_nome"];
	}

	if ($rowRastro[0]["n2_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n2_nome"];
	}

	if ($rowRastro[0]["n1_nome"] != null) {
		if ($rastro != null) {
			$rastro .= ">";
		}
		$rastro .= $rowRastro[0]["n1_nome"];
	}
}
echo "Voc&ecirc; est&aacute; em: <b> " . $rastro . " </b>";
?>





