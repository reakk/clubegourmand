<?php


/* *******************************************************************
* Staff 4 Solutions (c) 2011
* 
* Descrição: Detahe do conteudo do produto portal, utilizando infra Joomla
* Created on 05/06/2011
* Developer: Lago
* Projeto: mbAssociados
* TODO: TODO
* Revision:
/* *****************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// inicio de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
require ("path_install.php");

include ("parametrosConfiguracao.php");
?>

<?php


// Get a database object
$db = & JFactory :: getDBO();
//recuperar qtde de linhas da home
$query = "SELECT valor FROM portal_gourmand.home_portal_parametros where id=1 ";
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

//echo $qtdeLinhasHome;
?>
<?php

if(isset($_GET['id_conteudo'])){
	$conteudo = $_GET['id_conteudo'];
} else {
	$conteudo = 'N';
}

if(isset($_GET['id_produto'])){
	$produto = $_GET['id_produto'];
} else {
	$produto = 'N';
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}


//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

// Get a database object
$db = & JFactory :: getDBO();

if($conteudo != 'N'){
	$query = " SELECT cor_barra_table, ";
	$query .= " cor_linha_table, ";
	$query .= "        icone_barra, ";
	$query .= "        nao_exibe_descricao,ifnull(c.tipo_acesso_conteudo, p.tipo_acesso_conteudo) tipo_acesso_conteudo, ";
	$query .= "        ifnull(c.exibe_data, hpc.exibe_data) exibe_data, ";
	$query .= "        c.nao_exibe_autor,c.nao_exibe_nome, ";
	$query .= "        c.nome,p.nome nome_produto, p.tipo_produto,";
	$query .= "        c.id_produto_fk, c.exibir_icones_redes_sociais,";
	$query .= "        c.id_conteudo,c.descricao descricao_artigo, ";
	$query .= "        id_autor_fk, ";
	$query .= "        descricao_resumo,c.arquivo, ";
	$query .= "        ifnull(c.icone_padrao,p.icone_padrao) as icone_padrao, ";
	$query .= "        date_format(now(), '%H:%m:%s') AS horas, ";
	$query .= "        date_format(c.data_criacao, '%d') AS dia, ";
	$query .= "        date_format(c.data_criacao, '%m') AS mes, ";
	$query .= "        date_format(c.data_criacao, '%Y') AS ano, ";
	$query .= "        TIMEDIFF(now(), c.data_criacao) AS total_horas, ";
	$query .= "        DATE_ADD(c.data_criacao, INTERVAL c.publico_dias DAY) as data_publico ";
	$query .= " FROM    portal_gourmand.conteudos c ";
	$query .= " LEFT JOIN ";
	$query .= "  portal_gourmand.home_portal_conteudo hpc ";
	$query .= "        ON (c.id_conteudo = hpc.id_conteudo_fk ";
	$query .= "         OR c.id_produto_fk = hpc.id_produto_fk AND hpc.id_portal_fk = " . $id_portal . ")";
	$query .= "       left join portal_gourmand.produtos p on c.id_produto_fk = p.id_produto ";
	$query .= " WHERE id_conteudo = '" . $_GET["id_conteudo"] . "'";
	
	$db->setQuery($query);
	$rowConteudo = $db->loadAssocList();
	// echo $query;
	if (count($rowConteudo) > 0) {
		// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
		$naoExibeAutor = $rowConteudo[0]['nao_exibe_autor'];
		$idAutorFk = $rowConteudo[0]['id_autor_fk'];
		$naoExibeNome = $rowConteudo[0]['nao_exibe_nome'];
		$nome = $rowConteudo[0]['nome'];
		$idConteudo = $rowConteudo[0]['id_conteudo'];
		$produto = $rowConteudo[0]['id_produto_fk'];
		$iconePadrao = $rowConteudo[0]['icone_padrao'];
		$tipoProduto = $rowConteudo[0]['tipo_produto'];
		$diaPublicacao = $rowConteudo[0]['dia'];
		$mesPublicacao = $rowConteudo[0]['mes'];
		$anoPublicacao = $rowConteudo[0]['ano'];
		$totalHoras = $rowConteudo[0]['total_horas'];
		

	}else{
		$naoExibeAutor = 'N';
		$idAutorFk = '0';
		$naoExibeNome = 'N';
		$nome = '';
		$idConteudo = 0;
		$produto = 'N';
		$iconePadrao = '';
		$tipoProduto = '';
		$diaPublicacao = '';
		$mesPublicacao = '';
		$anoPublicacao ='';
		$totalHoras = '';
	}
}


if($produto != 'N'){
	$query = " select * from portal_gourmand.produtos ";
	$query .= " where status = 'A' and id_produto = " . $produto;
	
	$db->setQuery($query);
	$rowProduto = $db->loadAssocList();

	$nome_produto = $rowProduto[0]['nome'];
}

?>





<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<table cellpadding="0" cellspacing="0" border="0" width='100%'>
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
  		  <td  valign='top' height='100%' class='celulaTabelaColunaEsquerda' > <!-- INICIO CELULA TABELA COLUNA ESQUERDA 1 -->
             <?php

				if($id == 52){
					if(isset($_POST['opcao'])){
						require("listaResultadoBuscaReceita.php");
					} else {
						require("listaResultadoBusca.php");
					}
					
				} else {
					if($conteudo!='N'){
						require ("exibeArtigo.php");
					} else {
						require("listaConteudoDinamico.php");
					}
				}
?>  		    
	
</td>
<!-- /////////////////////////////// inicio COLUNA CENTRO //////////////////////////////// -->

<!-- <td valign="top" width="30%"> -->
<?php


//require ("componenteLateralDinamica.php")
//echo "esquerda";
?>
<!-- </td> -->
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->
</tr>
</table>
