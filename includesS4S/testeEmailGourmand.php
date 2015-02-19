<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet"
	href="http://www.clubgourmand.com.br/clubgourmand/templates/mbAssociados/css/template.css"
	type="text/css" />
</head>
<body>



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
////////////////////////////////////////////////////////////////////////////////////''/////////////
//desenv
//$diretorioJoomla = "portalB";
//$diretorioMb = "/mbAssociados";

define('_JEXEC', 1);
define('JPATH_BASE', "../"); // poderia ser /var/www/html/site-joomla/  
define('DS', DIRECTORY_SEPARATOR);
require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');

$mainframe = JFactory :: getApplication('site');

//prod
$diretorioJoomla="s4s";
$diretorioMb = "/mbnovo/mbAssociados";

require_once ('funcoesGerais.php');

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// fim de parametros para funcionamento /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
// Get a database object
$db = & JFactory :: getDBO();

//recuperar qtde de linhas da home
$query = "SELECT valor FROM portal_gourmand.home_portal_parametros where id=1 ";
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

///////////////////////// parametros paginacao //////////////////////////////////////
//Começando a Paginação   
// Quantidade de registros a ser mostrados 
$quantidade = 10;
// Verificando se existe $_GET['pagina'], caso não exista atribuir o valor 1 a ele 
$pagina = (isset ($_POST['pagina']) ? (int) $_POST['pagina'] : 1);
// Fazendo um conta para saber apartir de qual registro ira começar a paginação 
$inicio = ($quantidade * $pagina) - $quantidade;
/////////////////////// parametros paginacao //////////////////////////////////////

//////////////////sql da listagem de conteudo//////////////////////////
$query = "select c.*,p.tipo_produto,date_format(now(), '%H:%m:%s') as horas,date_format(c.data_criacao, '%d') as dia,date_format(c.data_criacao, '%m') as mes,date_format(c.data_criacao, '%Y') as ano,TIMEDIFF(now(),c.data_criacao) as total_horas from portal_gourmand.conteudos c ";
$query = $query . " join portal_gourmand.produtos p on c.id_produto_fk = p.id_produto ";
$query = $query . "where ";
$query = $query . " c.nao_publicar != 'S'";
$query = $query . " and c.id_conteudo  in( select distinct id_conteudo_fk "; 
$query = $query . " from portal_gourmand.controle_conteudo_news_letter cn ";
$query = $query . "    left join portal_gourmand.controle_envio_news_letter el ";
$query = $query . "    on el.id_controle_envio_news_letter = cn.id_controle_conteudo_news_letter ";
$query = $query . " where el.data_envio is null) order by c.data_criacao desc";

//echo $query;
$db->setQuery($query);

$rowListaConteudoDinamico = $db->loadAssocList();

////////// INICIO CONSULTA TOTAL REGISTROS////////////////
//////////////////sql da listagem de conteudo//////////////////////////
$queryTot = "select c.*,p.tipo_produto,date_format(now(), '%H:%m:%s') as horas,date_format(c.data_criacao, '%d') as dia,date_format(c.data_criacao, '%m') as mes,date_format(c.data_criacao, '%Y') as ano,TIMEDIFF(now(),c.data_criacao) as total_horas from portal_gourmand.conteudos c ";
$queryTot = $queryTot . " join portal_gourmand.produtos p on c.id_produto_fk = p.id_produto ";
$queryTot = $queryTot . "where ";
$queryTot = $queryTot . " c.nao_publicar != 'S'";
$queryTot = $queryTot . " and c.id_conteudo  in( select distinct id_conteudo_fk "; 
$queryTot = $queryTot . " from controle_conteudo_news_letter cn ";
$queryTot = $queryTot . "    left join controle_envio_news_letter el ";
$queryTot = $queryTot . "    on el.id_controle_envio_news_letter = cn.id_controle_conteudo_news_letter ";
$queryTot = $queryTot . " where el.data_envio is null) order by c.data_criacao desc";
//echo $queryTot;
$db->setQuery($queryTot);
$rowTot = $db->loadAssocList();
$totalLinhas = count($rowTot);
//echo $totalLinhas;

// total de registro e dividimos pela quantidade de registros que retornou  
$totalPagina = ceil($totalLinhas / $quantidade);
?>

	<TABLE width="100%" border="0">
		<TR>
			<TD></TD>
		</TR>
		<TR>
			<TD>
				<div class="divArtigo">


					<?php
$i=0;
for ($i = 0; $i < count($rowListaConteudoDinamico); $i++) {
	// seta nome da coluna a ser concatenado no css se for coluna da esquerda nao seta nada
	$nomeColuna = "";
	// seta variaveis a serem utilizadas para a exibicao dos dados do titulo e autor
	$naoExibeAutor = $rowListaConteudoDinamico[$i]['nao_exibe_autor'];
	$idAutorFk = $rowListaConteudoDinamico[$i]['id_autor_fk'];
	$naoExibeNome = $rowListaConteudoDinamico[$i]['nao_exibe_nome'];
	$nome = $rowListaConteudoDinamico[$i]['nome'];
	$arquivo = $rowListaConteudoDinamico[$i]['arquivo'];
	$idConteudo = $rowListaConteudoDinamico[$i]['id_conteudo'];
	$idProdutoFk = $rowListaConteudoDinamico[$i]['id_produto_fk'];
	$iconePadrao = $rowListaConteudoDinamico[$i]['icone_padrao'];
	$tipoProduto = $rowListaConteudoDinamico[$i]['tipo_produto'];
	$diaPublicacao = $rowListaConteudoDinamico[$i]['dia'];
	$mesPublicacao = $rowListaConteudoDinamico[$i]['mes'];
	$anoPublicacao = $rowListaConteudoDinamico[$i]['ano'];
		$totalHoras= $rowListaConteudoDinamico[$i]['total_horas'];

	$data_criacao_reg = $rowListaConteudoDinamico[$i]['data_criacao'];

	if ($rowListaConteudoDinamico[$i]['data_inicial'] == '0000-00-00') {
		$data_inicio_agenda = '';
		$sempreExibeNome = 'S';
	} else {
		$data_inicio_agenda = $rowListaConteudoDinamico[$i]['data_inicial'];
	}

	if ($rowListaConteudoDinamico[$i]['data_final'] == '0000-00-00') {
		$data_fim_agenda = '';
		$sempreExibeNome = 'S';
	} else {
		$data_fim_agenda = $rowListaConteudoDinamico[$i]['data_final'];
	}

	$hoje = date("Y-m-d");

	//se esta setado agendamento

		//echo $nao_publicar;


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
								<img
									src='http://www.clubgourmand.com.br/clubgourmand/adm/conteudos_upload_mb/<?php echo $arquivo; ?>' />
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

				echo "<a href='#' onclick='abreArtigo(" . $rowListaConteudoDinamico[$i]['id_conteudo'] . "," . $rowListaConteudoDinamico[$i]['id_produto_fk'] . ")' style=text-decoration:none>";
					echo ' <div class="textoCaixasArtigos">';
						echo formataDescricaoResumo($rowListaConteudoDinamico[$i]['descricao_resumo'],$nomeColuna,$rowListaConteudoDinamico[$i]['id_conteudo']);
					echo '</div>';
				echo "</a>";
			echo ' </div>';
	if($arquivo != ''){
		echo "</div>";
	}



		
		
		//////////////////////////////////////////////////////////////////////////////
		//	$cont = $cont +1;
	
}
?>
							</div>
							<!-- fim div BATEPAPO -->
			</TD>
		</TR>
		<TR>
			<TD></TD>
		</TR>
	</TABLE>


	<form name="form" method="post"
		action="index.php?option=com_content&view=article&id=<?php echo $id_artigo_lista;?>&id_produto=<?php echo $_GET["id_produto"];?>&id_menu=<?php echo $_GET["id_menu"];?>"
		onsubmit="goPage(1);">
		<input type="hidden" name="pagina" id="pagina" value=""> <input
			type="hidden" name="id_portal" id="id_portal"
			value="<?php echo $id_portal;?>"> <input type="hidden"
			name="id_produto" id="id_produto"
			value="<?php echo $_GET["id_produto"];?>"> <input
			type="hidden" name="id_menu" id="id_menu"
			value="<?php echo $_GET["id_menu"];?>">
	</form>

	<script>
	function goPage(page){
		showWait();
		document.form.pagina.value=page;
		document.form.submit();
	}
	
	
</script>

	<?php


/* *******************************************************/
//exibindo a paginação 
// Verifica se o total de paginas é maior que 1, se for vamos mostrar a paginação 
if ($totalPagina > 1) {
	$sempreExibeNome = 'S';
	// Criando o link para a página 1 

	echo "<div class='divPaginacao'>";
	echo "<div id='paginacaoCentralizado'>";

	//echo "<a href='#' onclick='goPage(1);' class='linkPaginacao' style='TEXT-DECORATION: none;'>Primeira P&aacute;gina</a> - "; 

	echo "<span class='linkPaginacao'><b>P&aacute;ginas:</b></span> ";
	if ($pagina == 1) {
		$sempreExibeNome = 'S';
	} else {
		$anterior = $pagina -1;
		echo "<a href='#' onclick='goPage(" . $anterior . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'>[Anterior]</a>";
	}
	// vamos começar um for para percorrer a quantidade de páginas 
	for ($i = 1; $i <= $totalPagina; $i++) {
		// verificamos se esta é a página atual, se for tiramos o link 
		if ($i == $pagina) {
			echo "<b>" . $i . "</b> ";
			$sempreExibeNome = 'S';
		} else {
			// se não for colocamos o link 
			echo "<a href='#' onclick='goPage($i);'  class='linkPaginacao' style='TEXT-DECORATION: none;'> $i </a>";
		}
	}
	// Criando link para a ultima página
	if ($totalPagina == $pagina) {
		$proxima = $pagina;
		$sempreExibeNome = 'S';
	} else {
		$proxima = $pagina +1;
		echo "<a href='#' onclick='goPage(" . $proxima . ");' class='linkPaginacao' style='TEXT-DECORATION: none;'>[Pr&oacute;xima]</a>";
	}

	
	echo "</div'>"; // fim paginacaoCentralizado 
	echo "</div'>"; // fim divpaginacao 

	// Fim da paginação 
} // fim do else 
?>
</body>
</html>
