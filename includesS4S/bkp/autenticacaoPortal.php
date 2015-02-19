<?php


/* *******************************************************************
* Staff 4 Solutions (c) 2011
* 
* Descrição: Autenticaçao home
* Created on 13/06/2011 ~ 16/06/2011 ~ 16/11/2011
* Developer: Lago
* Projeto: mbAssociados
* TODO: TODO
* Revision:
/* *****************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

define('_JEXEC', 1);
define('JPATH_BASE', "../"); // poderia ser /var/www/html/site-joomla/  
define('DS', DIRECTORY_SEPARATOR);

require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');
$mainframe = & JFactory :: getApplication('site');
$mainframe->initialise();
require ("path_install.php");

include ("parametrosConfiguracao.php");

//echo "parametros=" . $bancoMBAssociados;
//
//echo "login = " . $_POST["login"];
//echo "senha= " . $_POST["pass"];
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

$session = & JFactory :: getSession();
//echo $session->get('idPortal');

$idPortal = $session->get('idPortal');
//echo "ID_PORTAL=" . $idPortal;
//submete a consulta ao banco
//verifica se login e senha confere
$sql = "select id_usuarios,nome from " . $bancoMBAssociados . ".usuarios where email = '" . $_POST["login"] . "' and senha='" . $_POST["pass"] . "'";
//echo $sql;
// Get a database object
$db = & JFactory :: getDBO();
$db->setQuery($sql);
$rowLoginUsuario = $db->loadAssocList();
$qtdeLinhasUsuairo = count($rowLoginUsuario);
if ($qtdeLinhasUsuairo <= 0) {
	$session->set('controle_login', '-1');
	header( 'Location: '.$_POST["redirecionamento"] ) ;
	
	//echo $qtdeLinhasUsuairo;
} else {
	//submete a consulta ao banco
	//verifica direitos de acesso do usuario

	$sql = "SELECT u.id_usuarios, ";
	$sql .= "       ud.id_produto_portal_fk, ";
	$sql .= "       pp.id_portal_fk, ";
	$sql .= "       pp.id_produto_fk ";
	$sql .= "FROM " . $bancoMBAssociados . ".usuarios u ";
	$sql .= "     join " . $bancoMBAssociados . ".usuarios_direitos ud on u.id_usuarios=ud.id_usuarios_fk ";
	$sql .= "     join " . $bancoMBAssociados . ".produtos_portais pp on pp.id_produto_portal = ud.id_produto_portal_fk ";
	$sql .= "where pp.id_portal_fk=$idPortal      ";
	$sql .= "    and u.id_usuarios =  ".$rowLoginUsuario[0]['id_usuarios'];
	$sql .= " union ";
	$sql .= "SELECT u.id_usuarios, ";
	$sql .= "       cd.id_produto_portal_fk, ";
	$sql .= "       pp.id_portal_fk, ";
	$sql .= "       pp.id_produto_fk ";
	$sql .= "FROM " . $bancoMBAssociados . ".usuarios u ";
	$sql .= "     join " . $bancoMBAssociados . ".clientes_direitos cd on cd.id_clientes_fk=u.id_clientes_fk ";
	$sql .= "     join " . $bancoMBAssociados . ".produtos_portais pp on pp.id_produto_portal = cd.id_produto_portal_fk ";
	$sql .= "where pp.id_portal_fk=$idPortal ";
	$sql .= "    and u.id_usuarios = ".$rowLoginUsuario[0]['id_usuarios'];
	 
	$db->setQuery($sql);
	$rowProdutosUsuario = $db->loadAssocList();
   // die ($sql." - ".count($rowProdutosUsuario));
	for ($i = 0; $i < count($rowProdutosUsuario); $i++) {
		$idProdutosPermitidos[] = $rowProdutosUsuario[$i]['id_produto_fk'];
	}

	$session->set('idProdutosPermitidos', $idProdutosPermitidos);

	$session->set('id_usuario', $rowLoginUsuario[0]['id_usuarios']);
	$session->set('nome', $rowLoginUsuario[0]['nome']);
	//$session->set('controle_login', '1');
	//echo $sql;
	//echo $rowLoginUsuario[0]['id_usuarios'] . "|" . $rowLoginUsuario[0]['nome'] . "|" . "AUTORIZADO";
	//echo $_POST["redirecionamento"];
	header( 'Location: '.$_POST["redirecionamento"] ) ;
}

//