<?php
/*
 * Created on 05/03/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
	$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
	$host = $_SERVER['HTTP_HOST'];
	$script = $_SERVER['SCRIPT_NAME'];
	$parametros = $_SERVER['QUERY_STRING'];
	$UrlAtual = $protocolo . '://' . $host . $script . '?' . $parametros;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" xml:lang="en" lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		

	<meta property="og:title" content="Teste do FB 333" />
	<meta property="og:type" content="album" />
	<meta property="og:url" content="<?php echo $UrlAtual;?>" />
	<meta property="og:image" content="http://t3.gstatic.com/images?q=tbn:ANd9GcTZBIdt0mHgI5mA_10Euuk8aCxPcQ-iNQhhM6mns1qZc1-0S4_H" />
	<meta property="og:site_name" content="Teste do FB 333" />
	<meta property="fb:admins" content="1000020404875111" />
	<meta property="og:description" content="Teste da MB fB 333"/>
	<title>Bot�o Curtir com FB:LIKE</title>

</head>
<body>

<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

<div class="fb-like" data-send="true" data-href="<?php echo $UrlAtual?>"   data-layout="button_count" data-width="100" data-show-faces="true"></div>
sdfsdaasdfsadsadfsdfasadfsdsd
333teste do fb 3333333
</body>
</html>

