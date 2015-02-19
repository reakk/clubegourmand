<?php
/* *******************************************************************
* Staff 4 Solutions (c) 2011
* 
* Descri��o: Login para conteudo restrito, utilizando infra Joomla
* Created on 09/06/2011
* Developer: Lago
* Projeto: mbAssociados
* TODO: TODO
* Revision:
/* *****************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
$diretorioJoomla="mbnovo/portalB/";

$diretorioMb = "/mbAssociados";

set_include_path($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$diretorioJoomla.DIRECTORY_SEPARATOR."includesS4S");
include("parametrosConfiguracao.php");
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
/* ******************************************************************************************************
 * 
 * verifica se a sess�o j� esta gravada, caso o usu�rio j� tenha feito o login, verifica se ele possui
 * acesso ao conteudo, sen�o exibe Login
 * 
*/
 echo $_GET["id_produto"];
session_start();
////// verifica se a sess�o j� esta gravada
if(@$_SESSION["idProdutosPermitidos"]){
	//checando se este produto tem permiss�o, se sim redireciona para artigo
	if(in_array(@$_GET["id_produto"],$_SESSION["idProdutosPermitidos"])){
		echo "TEM_ACESSO";
	}else{
		echo "SEM_ACESSO_AO_PRODUTO";
		
	}
}else{
	echo "EFETUAR_LOGIN";
}
?>