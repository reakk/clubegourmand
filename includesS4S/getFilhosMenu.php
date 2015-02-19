<?php


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descrição: 
 * Created on 21/11/2011
 * Developer: Serillo
 * Projeto: MB
 * TODO: TODO
 * Revision:

 /* *****************************************************************/

define('_JEXEC', 1);
define('JPATH_BASE', "../"); // poderia ser /var/www/html/site-joomla/  
define('DS', DIRECTORY_SEPARATOR);
require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');

$mainframe = JFactory :: getApplication('site');


$session = JFactory :: getSession();

$id_menu = @ $_REQUEST['id_menu'];
$db = & JFactory :: getDBO();
$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=42 and pertence=".$id_menu." order by posicao ";
$db->setQuery($sql);
$rowNivel2 = $db->loadAssocList(); 

$count = 1;
$retorno = "";
for ($j = 0; $j < count($rowNivel2); $j++) {
  $retorno = $retorno."|".$rowNivel2[$j]["id_menu"].";".$rowNivel2[$j]["nome"];	
}


echo $retorno;

?>