<?php header('Content-disposition: attachment; filename=huge_document.pdf'); header('Content-type: application/pdf'); readfile('ContratoCVC.pdf'); ?> 


<?php

/*
 * Created on 23/11/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//prod
$diretorioJoomla="mbnovo/portalB/";
$diretorioMb = "/mbnovo";

 
 set_include_path($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$diretorioJoomla.DIRECTORY_SEPARATOR."includesS4S");


include("parametrosConfiguracao.php");
 
 echo $_GET["id_produto"];
 echo $id_artigo_login;
session_start();
 
if ((@$_SESSION["idProdutosPermitidos"]==null)||(!in_array(@ $_GET["id_produto"], @$_SESSION["idProdutosPermitidos"]))) {
?> 
<script> 
self.location='../index.php?option=com_content&view=article&id=<?php echo $id_artigo_login;?>&id_conteudo=<?php echo $_GET["id_conteudo"];?>&id_produto=<?php echo $_GET["id_produto"];?>'; </script> <?php

	die();
}else{
	header('Content-disposition: attachment; filename=huge_document.pdf'); header('Content-type: application/pdf'); readfile('huge_document.pdf');
}


?>




