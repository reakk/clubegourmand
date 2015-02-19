<script src="js/jquery-latest.js" type="text/javascript"></script>

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
///////////////////////////////////////////////////////////////////////////////////
//// inicio gravando na session permissoes -> retorno do autenticacaoArtigoRestrito 
///////////////////////////////////////////////////////////////////////////////////
?>

 <?php

require_once ('definePopupModalLogin.php');
?>
 




<?php


// Get a database object
$db = & JFactory :: getDBO();
//recuperar qtde de linhas da home
$query = "SELECT valor FROM $bancoMBAssociados.home_portal_parametros where id=1 ";
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

//echo $qtdeLinhasHome;
?>

<?php


/* ***********************************************************************************
 * 
 * INICIO CONSULTA / PESQUISA
 * 
 ********************************************************************************** */
///////////////////////// parametros paginacao //////////////////////////////////////
//Começando a Paginação   
// Quantidade de registros a ser mostrados 
$quantidade = 12;
// Verificando se existe $_GET['pagina'], caso não exista atribuir o valor 1 a ele 
$pagina = (isset ($_POST['pagina']) ? (int) $_POST['pagina'] : 1);
// Fazendo um conta para saber apartir de qual registro ira começar a paginação 
$inicio = ($quantidade * $pagina) - $quantidade;
/////////////////////// parametros paginacao //////////////////////////////////////
$id_produto = @ $_REQUEST['id_produto'];
$indice_serie = @ $_REQUEST['indice_serie'];
//////////////////////////////// INICIO CONSULTA REGISTROS GRID/////////////////////////////////
try {

	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT id_conteudo,arquivo,date_format(data_criacao, '%d/%m/%Y') data_criacao,nome,indice_da_serie,nome,nao_publicar FROM mbAssociados.conteudos where id_produto_fk=" . $id_produto;
	$sql.= " AND nao_publicar != 'S'";
	//die($sql);
	if (@ $indice_serie) {
		$sql = $sql . " and upper(indice_da_serie) like upper('%" . $indice_serie . "%')";
	}

		
	foreach($_POST as $key =>$value){
		//echo $key."=".$value."<br>";
		$$key = $value;
	}
	
    if(@$ordem != ""){
    	
			if($ordem == "data_criacao"){
				$sql = $sql." order by date_format(".$ordem.", '%Y/%m/%d %H:%i:%s')  ".$tipoOrdem." "; 
			}else{
				$sql = $sql." order by ".$ordem." ".$tipoOrdem." ";	
			}
    }else{
    	$sql = $sql." order by date_format(data_criacao, '%Y/%m/%d %H:%i:%s') desc ";
    }


	//echo $sql; 
	$db->setQuery($sql);
	$result = $db->loadAssocList();

	////	////////// INICIO CONSULTA TOTAL REGISTROS////////////////
	////	//submete a consulta ao banco 
	$sqlTot = "SELECT * FROM mbAssociados.conteudos where id_produto_fk=" . $id_produto;
	$sqlTot.= " AND nao_publicar != 'S'";
	////
	if (@ $indice_serie) {
		$sqlTot = $sqlTot . " and upper(indice_da_serie) like upper('%" . $indice_serie . "')";
	}
	$db->setQuery($sqlTot);
	$resultTot = $db->loadAssocList();

	$totalLinhas = count($resultTot);
	// total de registro e dividimos pela quantidade de registros que retornou  
	$totalPagina = ceil($totalLinhas / $quantidade);
} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
}

/* ***********************************************************************************
 * 
 * FIM CONSULTA / PESQUISA
 * 
 ********************************************************************************** */
?>



<script>
	function executarPesquisa(){
		showWait();
		document.form.pagina.value=1;
		document.form.submit();
	}


	function goPage(page){
		 
		showWait();
	    document.form.pagina.value=page;
		document.form.submit();
	}
	

</script>

<form name="form2" id="form2" method="post" action="index.php?option=com_content&view=article&id=53&id_produto=<?php echo $id_produto;?>">
<input type="hidden" name="pagina" id="pagina" value="">
<input type="hidden" name="ordem" id="ordem" value="<?php echo @$ordem;?>">
<input type="hidden" name="tipoOrdem" id="tipoOrdem" value="<?php echo @$tipoOrdem;?>">
</form>

<form name="form" method="post" action="index.php?option=com_content&view=article&id=53&id_produto=<?php echo $id_produto;?>" onsubmit="goPage(1);">
<input type="hidden" name="pagina" id="pagina" value="">



<script>
function submeterOrderBy(ordem,tipoOrdem){
	//alert(ordem);
		showWait();
		document.form2.pagina.value="1";
		document.form2.ordem.value=ordem;
		document.form2.tipoOrdem.value=tipoOrdem;
		document.form2.submit();		
}
</script>

<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<table cellpadding="0" cellspacing="0" border="0" width=991px>
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
 <TD valign='top' height=100% class='celulaTabelaColunaEsquerda' >
   <?php


$styleTitulo = "background:#CCCCCC; ";
$styleTitulo = $styleTitulo . " border-bottom : 1px solid #808080;";
?>
 
 				<div class="divDestaque" > <!-- inicio div BATEPAPO -->
					 <div class="divTituloDestaque" style="<?php echo $styleTitulo?>"> 
						<span class="tituloCaixas" >
						    <div id="divTitulo">
						      <?php require ("montaVoceEstaEm.php");?> 
                            </div>
						</span>  
					 </div>
					  <div class="divCorpoBancoDeDados"> 
					    
                        <div class="divTabelaBancoDados">
							<table cellspacing="0" cellpadding="8" align="center" width="100%" border="0">
							<!-- header -->
							<tr class="headerLista"> 
								
								<td width="41px"><div class="espacamentoPrimeiraColuna">	Tipo			</div>	</td>
								<td width="70px" nowrap><div class="espacamentoColunaData">		Data	<a href="#" onclick=submeterOrderBy('data_criacao','asc')  title="Ordena&ccedil;&atilde;o Crescente"><img src="/mbnovo/portalB/images/iconUp.png" border="0" alt="Ordenação Crescente"></a>  <a href="#" onclick=submeterOrderBy('data_criacao','desc')  title="Ordenação Decrescente"><img src="/mbnovo/portalB/images/iconDown.png" border="0" alt="Ordena&ccedil;&atilde;o Decrescente"></a>			</div>	</td>
								<td nowrap><div class="espacamentoColunaTitulo">		T&iacute;tulo	<a href="#" onclick=submeterOrderBy('nome','asc')  title="Ordena&ccedil;&atilde;o Crescente"><img src="/mbnovo/portalB/images/iconUp.png" border="0" alt="Ordenação Crescente"></a>  <a href="#" onclick=submeterOrderBy('nome','desc')  title="Ordenação Decrescente"><img src="/mbnovo/portalB/images/iconDown.png" border="0" alt="Ordena&ccedil;&atilde;o Decrescente"></a></div>	</td>
							
							</tr>
							<!-- linhas -->
							<?php


for ($i = 0; $i < count($result); $i++) {

	if ($i % 2 == 0) {
		echo "<tr class=fonteValoresListagemCor2>";
	} else {
		echo "<tr class=fonteValoresListagemCor1>";
	}
?>
								<td style="border-bottom: 1px solid #ffffff;" align="center"><div class="centralizarPrimeiraColuna">  <a href="arquivos/download.php?id=53&id_conteudo=<?php echo $result[$i]['id_conteudo'];?>" ><img src=images/iconPdf.png></a></div>  </td> 

								<td style="border-bottom : 1px solid #ffffff;" align="center"><div class="centralizarDataTabela"> <a style="text-decoration:none; color:black;" href="arquivos/download.php?id=53&id_conteudo=<?php echo $result[$i]['id_conteudo'];?>"><?php echo $result[$i]['data_criacao'];?></a></div></td>
								<td style="font-weight:bold;border-bottom : 1px solid #ffffff" align="left"><div class="centralizarTituloTabela"><a style="text-decoration:none; color:black;" href="arquivos/download.php?id=53&id_conteudo=<?php echo $result[$i]['id_conteudo'];?>"><?php echo $result[$i]['nome'];?></a></div></td>
							</tr>
							<?php


}
?>
							</table>


   </div> <!-- fim divTabelaBancoDados -->
										
					 </div>
				
			    </div>		 
 
 
 <?php


/* *******************************************************/
//exibindo a paginação 
// Verifica se o total de paginas é maior que 1, se for vamos mostrar a paginação 
if ($totalPagina > 1) {
	// Criando o link para a página 1 

	echo "<div class='divLinhaSeparador'></div>";
	echo "<div class='divPaginacao'>";
	
	//echo "<a href='#' onclick='goPage(1);' class='linkPaginacao' style='TEXT-DECORATION: none;'>Primeira P&aacute;gina</a> - "; 
	echo "<span class='linkPaginacao'><b>P&aacute;ginas:</b></span> ";
	$anterior = $pagina -1;
	if ($pagina != 1) {
		echo "<a href='#' onclick='goPage(" . $anterior . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'>[Anterior]</a>";
	
	}
	// vamos começar um for para percorrer a quantidade de páginas 
	for ($i = 1; $i <= $totalPagina; $i++) {
		// verificamos se esta é a página atual, se for tiramos o link 
		if ($i == $pagina) {
			echo "<b>" . $i . "</b> ";
		} else {
			// se não for colocamos o link 
			echo "<a href='#' onclick='goPage($i);'  class='linkPaginacao' style='TEXT-DECORATION: none;'> $i </a>";
		}
	}
	// Criando link para a ultima página
	$proxima = $pagina +1;
	if ($totalPagina != $pagina) {
		echo "<a href='#' onclick='goPage(" . $proxima . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'>[Pr&oacute;xima]</a>";
	
	}

	

	

	echo "</div'>"; // fim divpaginacao 

	// Fim da paginação 
} // fim do else 
?>

 </TD>
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->

<td valign="top" width="30%">
<?php


require ("componenteLateralDinamica.php")
?>
</td>
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->
</tr>
</table>
</form>
<?php
$session = & JFactory :: getSession();
if ((!@ $session->get('id_usuario'))&&(@$_GET['aut']=="S")) {
  	echo "<script>showLoginHome();</script>";
}

if ((@ $session->get('id_usuario'))&&(@$_GET['aut']=="N")) {
  echo "<script>alert('Sem acesso ao produto');</script>";
}
?>


