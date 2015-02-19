<?php
/*
 * Created on 16/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
define('_JEXEC', 1);
define('JPATH_BASE', "../"); // poderia ser /var/www/html/site-joomla/  
define('DS', DIRECTORY_SEPARATOR);

require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');
$mainframe = & JFactory :: getApplication('site');
$mainframe->initialise();
 // limpa sessao
    $session = & JFactory :: getSession();
	$session->set('idProdutosPermitidos', null);
	$session->set('id_usuario', null);
	$session->set('nome', null);
	echo "ok";
?>
