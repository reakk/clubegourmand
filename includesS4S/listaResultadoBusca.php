<?php


/*
 * Created on 15/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//prod
$diretorioJoomla="s4s";
$diretorioMb = "/mbnovo/mbAssociados";

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");


$criterioBusca = @ $_REQUEST['criterio'];
// Get a database object
$db = & JFactory :: getDBO();



////////// INICIO CONSULTA TOTAL REGISTROS////////////////
//////////////////sql da listagem de conteudo//////////////////////////
$queryTot = "SELECT c.*, ";
$queryTot .= "       p.tipo_produto, ";
$queryTot .= "       date_format(now(), '%H:%m:%s') AS horas, ";
$queryTot .= "       date_format(c.data_criacao, '%d') AS dia, ";
$queryTot .= "       date_format(c.data_criacao, '%m') AS mes, ";
$queryTot .= "       date_format(c.data_criacao, '%Y') AS ano, ";
$queryTot .= "       TIMEDIFF(now(), c.data_criacao) AS total_horas ";
$queryTot .= "  FROM    portal_gourmand.conteudos c ";
$queryTot .= "       JOIN ";
$queryTot .= "          portal_gourmand.produtos p ";
$queryTot .= "       ON c.id_produto_fk = p.id_produto ";
$queryTot .= "       join portal_gourmand.produtos_portais pp on c.id_produto_fk = pp.id_produto_fk and pp.id_portal_fk=$id_portal ";
$queryTot .= " WHERE  c.nao_publicar != 'S'";
$queryTot .= "				 AND c.id_conteudo NOT IN ";
$queryTot .= "              (SELECT id_conteudo_fk ";
$queryTot .= "                 FROM portal_gourmand.produtos_portais pp, ";
$queryTot .= "                      portal_gourmand.conteudo_portais_excluidos pe, ";
$queryTot .= "                      portal_gourmand.conteudos c ";
$queryTot .= "                WHERE     pp.id_produto_portal = pe.id_produto_portal_fk ";
$queryTot .= "                      AND c.id_conteudo = pe.id_conteudo_fk ";
$queryTot .= "                      AND c.id_produto_fk = pp.id_produto_fk ";
$queryTot .= "                      AND pp.id_portal_fk = $id_portal) ";

if (@ $criterioBusca != null) {
	$queryTot .= " and  (upper(c.descricao) like upper('%" . $criterioBusca . "%') or upper(c.nome) like upper('%" . $criterioBusca . "%') or upper(c.descricao_resumo) like upper('%" . $criterioBusca . "%')) ";
}

//echo $queryTot;
$db->setQuery($queryTot);
$rowTot = $db->loadAssocList();
$totalLinhas = count($rowTot);


if ($totalLinhas > 100) {
	$totalLinhas = 100;
}

//echo $totalLinhas;

// total de registro e dividimos pela quantidade de registros que retornou  


///////////////////////// parametros paginacao //////////////////////////////////////
//Começando a Paginação   
// Quantidade de registros a ser mostrados 

// Verificando se existe $_GET['pagina'], caso não exista atribuir o valor 1 a ele 
$pagina = (isset ($_POST['pagina']) ? (int) $_POST['pagina'] : 1);
$quantidade = 10;
$totalPagina = ceil($totalLinhas / $quantidade);

// Fazendo um conta para saber apartir de qual registro ira começar a paginação 
$inicio = ($quantidade * $pagina) - $quantidade;

$quantidade = 10 * $pagina;

/////////////////////// parametros paginacao //////////////////////////////////////

//////////////////sql da listagem de conteudo//////////////////////////
$query = "SELECT c.*, ";
$query .= "       p.tipo_produto, ";
$query .= "       date_format(now(), '%H:%m:%s') AS horas, ";
$query .= "       date_format(c.data_criacao, '%d') AS dia, ";
$query .= "       date_format(c.data_criacao, '%m') AS mes, ";
$query .= "       date_format(c.data_criacao, '%Y') AS ano, ";
$query .= "       TIMEDIFF(now(), c.data_criacao) AS total_horas ";
$query .= "  FROM    portal_gourmand.conteudos c ";
$query .= "       JOIN ";
$query .= "          portal_gourmand.produtos p ";
$query .= "       ON c.id_produto_fk = p.id_produto ";
$query .= "       join portal_gourmand.produtos_portais pp on c.id_produto_fk = pp.id_produto_fk and pp.id_portal_fk=$id_portal ";
$query .= " WHERE  c.nao_publicar != 'S'";
$query .= " AND c.id_conteudo NOT IN ";
$query .= "              (SELECT id_conteudo_fk ";
$query .= "                 FROM portal_gourmand.produtos_portais pp, ";
$query .= "                      portal_gourmand.conteudo_portais_excluidos pe, ";
$query .= "                      portal_gourmand.conteudos c ";
$query .= "                WHERE     pp.id_produto_portal = pe.id_produto_portal_fk ";
$query .= "                      AND c.id_conteudo = pe.id_conteudo_fk ";
$query .= "                      AND c.id_produto_fk = pp.id_produto_fk ";
$query .= "                      AND pp.id_portal_fk = $id_portal) ";


if (@ $criterioBusca != null) {
	$query .= " and  upper(c.descricao) like upper('%" . $criterioBusca . "%') or upper(c.nome) like upper('%" . $criterioBusca . "%') or upper(c.descricao_resumo) like upper('%" . $criterioBusca . "%')";
}

$query .= " ORDER BY  date_format(c.data_criacao, '%Y/%m/%d %H:%i:%s') DESC ";
$query .= " LIMIT $inicio, $quantidade ";

//echo $query;
$db->setQuery($query);

$rowListaConteudoBusca = $db->loadAssocList();


?>


 
 				<div class="divArtigo"> 
					<div class='divTituloDestaqueHomePagIni'>

						    <div id='divTituloHomePagInici'>
								<img src='adm/images/icones/iconEstrela.png' />
    						    Resultado da Busca
                            </div>
 
					 </div>

                         
                             		<?php 
//////////// NADA ENCONTRADO ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							 			
           								if( count($rowListaConteudoBusca) == 0){
											echo "<div id='nadaEncontrado'>";
											echo "<div id='nadaEncontradoTXT'>Resultado n&atilde;o encontrado. <br/> ";	
											echo "</div>";
											echo "</div>";
										}else{


									?>

	
                           
 <?php


for ($i = 0; $i < count($rowListaConteudoBusca); $i++) {
	// seta nome da coluna a ser concatenado no css se for coluna da esquerda nao seta nada
	$nomeColuna = "";
	// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
	$naoExibeAutor = $rowListaConteudoBusca[$i]['nao_exibe_autor'];
	$idAutorFk = $rowListaConteudoBusca[$i]['id_autor_fk'];
	$naoExibeNome = $rowListaConteudoBusca[$i]['nao_exibe_nome'];
	$nome = $rowListaConteudoBusca[$i]['nome'];
	$arquivo = $rowListaConteudoBusca[$i]['arquivo'];
	$idConteudo = $rowListaConteudoBusca[$i]['id_conteudo'];
	$idProdutoFk = $rowListaConteudoBusca[$i]['id_produto_fk'];
	$iconePadrao = $rowListaConteudoBusca[$i]['icone_padrao'];
	$tipoProduto = $rowListaConteudoBusca[$i]['tipo_produto'];
	$diaPublicacao = $rowListaConteudoBusca[$i]['dia'];
	$mesPublicacao = $rowListaConteudoBusca[$i]['mes'];
	$anoPublicacao = $rowListaConteudoBusca[$i]['ano'];
	$totalHoras = $rowListaConteudoBusca[$i]['total_horas'];

	$data_criacao_reg = $rowListaConteudoBusca[$i]['data_criacao'];

	if ($rowListaConteudoBusca[$i]['data_inicial'] == '0000-00-00') {
		$data_inicio_agenda = '';
	} else {
		$data_inicio_agenda = $rowListaConteudoBusca[$i]['data_inicial'];
	}

	if ($rowListaConteudoBusca[$i]['data_final'] == '0000-00-00') {
		$data_fim_agenda = '';
	} else {
		$data_fim_agenda = $rowListaConteudoBusca[$i]['data_final'];
	}

	$hoje = date("Y-m-d");

	
		if ($i>0) {
			echo '<div class="divLinhaSeparacao" style="background:gray;height:1px;width:100%;">';
			echo '</div>';
		}
	
?>

			<?php
				if($arquivo != ''){
			?>
		<div class="divCorpoArtigo">
			<?php
				} else {
			?>
			<div class='divCorpoArtigoSemImg'>
			<?php
				}
			?>
				<?php
					if($arquivo != ''){
				?>

				<div id='ladoEsquerdoListagemImg'>
					<img src='adm/conteudos_upload_mb/<?php echo $arquivo; ?>' />
				</div>
				
				<?php
					}
				?>

				<?php
					if($arquivo != ''){
				?>

				<div id='ladoDireitoListagemConteudo'>

				<?php
					}
				?>
			<div id="tituloDoConteudoExibeArtigo">
				<?php echo $nome; ?>
            </div>
<?php
		

		
		echo "<a href='#' onclick='abreArtigo(" . $rowListaConteudoBusca[$i]['id_conteudo'] . "," . $rowListaConteudoBusca[$i]['id_produto_fk'] . ")' style=text-decoration:none>";
			echo ' <div class="textoCaixasArtigos">';
				echo formataDescricaoResumo($rowListaConteudoBusca[$i]['descricao_resumo'],$nomeColuna,$rowListaConteudoBusca[$i]['id_conteudo']);
			echo '</div>';
		echo "</a>";
	  echo "</div>";
	if($arquivo != ''){
		echo "</div>";
	}


	}
}
?>

			     
 
 
 
 <?php


/* *******************************************************/
//exibindo a paginação 
// Verifica se o total de paginas é maior que 1, se for vamos mostrar a paginação 
if ($totalPagina > 1) {
	// Criando o link para a página 1 

	echo "<div class='divPaginacao'>";

	//echo "<a href='#' onclick='goPage(1);' class='linkPaginacao' style='TEXT-DECORATION: none;'>Primeira P&aacute;gina</a> - "; 
	echo "<span class='linkPaginacao'><b>P&aacute;ginas:</b></span> ";
	// Criando link para a primeira página
		
		//$primeiraPagina = 1;
		$anterior = $pagina -1;
	
	//mostrar "Anterior" e "Primeira" se a página atual for diferente de 1
	if($pagina!=1){
		//echo "<a href='#' onclick='goPagePesquisaSite(" . $primeiraPagina . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'> [Primeira] </a>";
		echo "<a href='#' onclick='goPagePesquisaSite(" . $anterior . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'> [Anterior] </a>";
	}
	// vamos começar um for para percorrer a quantidade de páginas 
	for ($i = 1; $i <= $totalPagina; $i++) {
		// verificamos se esta é a página atual, se for tiramos o link 
		if ($i == $pagina) {
			echo "<b>" . $i . "</b> ";
		} else {
			// se não for colocamos o link 
			echo "<a href='#' onclick='goPagePesquisaSite($i);'  class='linkPaginacao' style='TEXT-DECORATION: none;'> $i </a>";
			
		}
	}
	// Criando link para a ultima página
	if ($totalPagina == $pagina) {
		$proxima = $pagina;
	} else {
		$proxima = $pagina +1;
		//$ultimaPagina = $totalPagina;
	}
	//Mostar "Próximo" caso não seja a última página
	if($pagina != $totalPagina){
		echo "<a href='#' onclick='goPagePesquisaSite(" . $proxima . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'> [Pr&oacute;xima] </a>";
		//echo "<a href='#' onclick='goPagePesquisaSite(" . $ultimaPagina . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'> [&Uacute;ltima] </a>";
	}
	echo "</div'>"; // fim divpaginacao 

	// Fim da paginação 
} // fim do else 
?>
 </div><!-- fim div BATEPAPO -->
	
 
 

