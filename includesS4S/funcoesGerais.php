<?php


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descricao: 
 * Created on 18/12/2011
 * Developer: Lago
 * Projeto: mbAssociados
 * TODO: TODO
 * Revision:
 /* *****************************************************************/
 if (function_exists('getDiretorioProduto')) {
 }else{
function getDiretorioProduto($tipoProduto) {
	$retorno = "";
	switch ($tipoProduto) {
		case 1 :
		case 01 :
			$retorno = "artigo/";
			break;
		case 2 :
		case 02 :
			$retorno = "batepapo/";
			break;
		case 3 :
		case 03 :
			$retorno = "bancodedados/";
			break;
		case 4 :
		case 04 :
			$retorno = "podcast/";
			break;
		case 5 :
		case 05 :
			$retorno = "video/";
			break;

	}
	return $retorno;

}
 }
 if (function_exists('renomeiaPlayerVideo')) {
 }else{
function renomeiaPlayerVideo($html, $nomeColuna, $idConteudo) {

	$qtde = substr_count($html, 'jwplayer(');
	$htmlFinal = $html;
	//echo "Quantidade = " . $qtde;
	for ($i = 1; $i <= $qtde; $i++) {
		//	echo "<br>Posicao=" . strpos($html, 'jwplayer(');
		$parte = substr($html, strpos($html, 'jwplayer(') + 10) . "|";
		//echo $parte;
		$nomeComponente = substr($parte, 0, strpos($parte, ')') - 1);
		//echo "<br>nome=" .$nomeComponente  . "|";
		$html = substr($html, strpos($html, 'jwplayer(') + 10);
		$htmlFinal = str_replace($nomeComponente, $nomeComponente . "_" . $nomeColuna . "_" . $idConteudo . "_" . $i, $htmlFinal);
	}
	return $htmlFinal;

}
 }
 if (function_exists('formataDescricaoResumo')) {
 }else{ 

function formataDescricaoResumo($descricaoResumo, $nomeColuna, $idConteudo) {
	$formatado = str_replace("#ffba75;", "#FFFFFF", $descricaoResumo);
	//$formatado = str_replace("jwplayer(\"", "jwplayer(\"zz",$formatado);
	$formatado = renomeiaPlayerVideo($formatado, $nomeColuna, $idConteudo);
	return $formatado;
}
 }
  if (function_exists('getMes')) {
 }else{ 
//function retornar mes por extenso
function getMes($mes) {
	$retorno = "";
	switch ($mes) {
		case 1 :
		case 01 :
			$retorno = " Janeiro ";
			break;
		case 2 :
		case 02 :
			$retorno = " Fevereiro ";
			break;
		case 3 :
		case 03 :
			$retorno = " Mar&ccedil;o ";
			break;
		case 4 :
		case 04 :
			$retorno = " Abril ";
			break;
		case 5 :
		case 05 :
			$retorno = " Maio ";
			break;
		case 6 :
		case 06 :
			$retorno = " Junho ";
			break;
		case 7 :
		case 07 :
			$retorno = " Julho ";
			break;
		case 8 :
		case 08 :
			$retorno = " Agosto ";
			break;
		case 9 :
		case 09 :
			$retorno = " Setembro ";
			break;
		case 10 :
			$retorno = " Outubro ";
			break;
		case 11 :
			$retorno = " Novembro ";
			break;
		case 12 :
			$retorno = " Dezembro ";
			break;
	}
	return $retorno;

}
 }
  if (function_exists('getMesAbreviado')) {
 }else{ 
//function retornar mes por extenso
function getMesAbreviado($mes) {
	switch ($mes) {
		case 1 :
		case 01 :
			echo "Jan";
			break;
		case 2 :
		case 02 :
			echo "Fev";
			break;
		case 3 :
		case 03 :
			echo "Mar";
			break;
		case 4 :
		case 04 :
			echo "Abr";
			break;
		case 5 :
		case 05 :
			echo "Mai";
			break;
		case 6 :
		case 06 :
			echo "Jun";
			break;
		case 7 :
		case 07 :
			echo "Jul";
			break;
		case 8 :
		case 08 :
			echo "Ago";
			break;
		case 9 :
		case 09 :
			echo "Set";
			break;
		case 10 :
			echo "Out";
			break;
		case 11 :
			echo "Nov";
			break;
		case 12 :
			echo "Dez";
			break;
	}

}
 }
  if (function_exists('getUrlAtual')) {
 }else{ 
function getUrlAtual() {
	$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
	$host = $_SERVER['HTTP_HOST'];
	$script = $_SERVER['SCRIPT_NAME'];
	$parametros = $_SERVER['QUERY_STRING'];
	$UrlAtual = $protocolo . '://' . $host . $script . '?' . $parametros;
	return $UrlAtual;

}
 }
  if (function_exists('getUrlTwitter')) {
 }else{ 
function getUrlTwitter($idConteudo) {
	$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
	$host = $_SERVER['HTTP_HOST'];
	$script = $_SERVER['SCRIPT_NAME'];
	$parametros = $_SERVER['QUERY_STRING'];
	//prod
	$diretorioJoomla = "";
	$UrlTwitter = $protocolo . '://' . $host . "/" . $diretorioJoomla . "/t.php?p=" . $idConteudo;
	return $UrlTwitter;

}
 }
  if (function_exists('getDescricaoOcorrencia')) {
 }else{ 
function getDescricaoOcorrencia($pTipoProduto) {
	switch ($pTipoProduto) {
		case 1 :
			return "Publicado ";
			break;
		case 2 :
			return "Agendado para ";
			break;
		case 3 :
			return "Banco de Dados";
			break;
		case 4 :
			return "Publicado";
			break;
		case 5 :
			return "Publicado";
			break;

	}

}
 }
  if (function_exists('getHorarioPublicacao')) {
 }else{ 
function getHorarioPublicacao($totalHoras, $diaPublicacao, $mesPublicacao, $anoPublicacao) {
	$horas_tmp = explode(":", $totalHoras);
	$retorno = "";
	if ($horas_tmp[0] < 24) { //pulicacao de menos de um dia

		$retorno .= " h&aacute; ";
		if ($horas_tmp[0] != "00") {
			$retorno .= $horas_tmp[0] . " hora(s) e ";
		}
		$retorno .= $horas_tmp[1] . " minuto(s) ";

	} else { //publicacao de mais de um dia

		$retorno .= "  em ";
		$retorno .= $diaPublicacao;
		$retorno .= " de ";
		$retorno .= getMes($mesPublicacao);
		$retorno .= " de ";
		$retorno .= $anoPublicacao;
	}
	return $retorno;
}
 }
  if (function_exists('getPreposicaoTipoProduto')) {
 }else{ 
function getPreposicaoTipoProduto($pTipoProduto) {
	switch ($pTipoProduto) {
		case 1 :
			return "escrito por";
			break;
		case 2 :
			return "com";
			break;
		case 3 :
			return "Banco de Dados";
			break;
		case 4 :
			return "de";
			break;
		case 5 :
			return "de";
			break;

	}

}
 }
  if (function_exists('adicionaMetaTagFaceBook')) {
 }else{ 
function adicionaMetaTagFaceBook() {
	//$_GET["id_conteudo"]
	if (@ $_GET["id_conteudo"] > 0) {
		// Get a database object
		$db = & JFactory :: getDBO();
		$sql = ' select nome,descricao_resumo,id_conteudo from portal_gourmand.conteudos ';
		$sql = $sql . " where id_conteudo = " . $_GET["id_conteudo"];
		//echo $sql;
		$db->setQuery($sql);
		$rowConteudoArtigo = $db->loadAssocList();

		echo '<meta property="og:title" content="'.$rowConteudoArtigo[0]["nome"].'" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:url" content="'.getUrlAtual().'" />';
		echo '<meta property="og:image" content="http://186.202.62.17/mbnovo/portalB/images/logo_mb.gif" />';
		echo '<meta property="og:site_name" content="MB Associados" />';
		echo '<meta property="og:description" content="'.strip_tags(formataDescricaoResumo($rowConteudoArtigo[0]['descricao_resumo'],"head",$rowConteudoArtigo[0]['id_conteudo'])).'"/>';
		echo '<meta property="fb:page_id" content="'.$_GET["id_conteudo"].'" />';

	} else {
		//echo "NAO ENTROU";
	}
}
 }
  if (function_exists('getDescricaoTipoProduto')) {
 }else{ 
function getDescricaoTipoProduto($pTipoProduto) {
	switch ($pTipoProduto) {
		case 1 :
			return "Artigo";
			break;
		case 2 :
			return "Bate-Papo";
			break;
		case 3 :
			return "Banco de Dados";
			break;
		case 4 :
			return "PodCast";
			break;
		case 5 :
			return "V&iacutedeo"; //;
			break;

	}

}
 }
//echo $qtdeLinhasHome;
 if (function_exists('converter_data')) {
 }else{ 
function converter_data($strData) {
	// Recebemos a data no formato: dd/mm/aaaa
	// Convertemos a data para o formato: aaaa-mm-dd
	if (@ $strData != "") {
		if (preg_match("#-#", $strData) == 1) {
			$strDataFormat = "";
			$strDataFormat .= implode('/', array_reverse(explode('-', $strData)));
			//$strDataFormat .= "'";
		}
	} else {
		$strDataFormat = null;
	}
	return $strDataFormat;
}
 }
  if (function_exists('format_file_fize_size')) {
 }else{ 
function format_file_fize_size($size, $display_bytes = false) {
	if ($size < 1024)
		$filesize = $size . ' bytes';
	elseif ($size >= 1024 && $size < 1048576) $filesize = round($size / 1024, 2) . ' KB';

	elseif ($size >= 1048576) $filesize = round($size / 1048576, 2) . ' MB';

	if ($size >= 1024 && $display_bytes)
		$filesize = $filesize . ' (' . $size . ' bytes)';

	return $filesize;
}
 }
 //fun��o espec�fica para resolver bug %5C%22 que aparece no nome da imagem enviada pelo editor tiny
   if (function_exists('erroErro')) {
 }else{ 
 	function erroErro( $str ){
		$str = str_replace( '%5C%22', '', $str );	
	}
 }
 
  if (function_exists('imprime')) {
 }else{ 
// Caracteres especiais Erick 

       function imprime( $str ){
    $str = str_replace( '�', '&#192;', $str );
    $str = str_replace( '�', '&#193;', $str );
    $str = str_replace( '�', '&#194;', $str );
    $str = str_replace( '�', '&#195;', $str );
    $str = str_replace( '�', '&#196;', $str );
    $str = str_replace( '�', '&#197;', $str );
    $str = str_replace( '�', '&#198;', $str );
    $str = str_replace( '�', '&#199;', $str );
    $str = str_replace( '�', '&#200;', $str );
    $str = str_replace( '�', '&#201;', $str );
    $str = str_replace( '�', '&#202;', $str );
    $str = str_replace( '�', '&#203;', $str );
    $str = str_replace( '�', '&#204;', $str );
    $str = str_replace( '�', '&#205;', $str );
    $str = str_replace( '�', '&#206;', $str );
    $str = str_replace( '�', '&#207;', $str );
    $str = str_replace( '�', '&#208;', $str );
    $str = str_replace( '�', '&#209;', $str );
    $str = str_replace( '�', '&#210;', $str );
    $str = str_replace( '�', '&#211;', $str );
    $str = str_replace( '�', '&#212;', $str );
    $str = str_replace( '�', '&#213;', $str );
    $str = str_replace( '�', '&#214;', $str );
    $str = str_replace( '�', '&#215;', $str );  
    $str = str_replace( '�', '&#216;', $str );
    $str = str_replace( '�', '&#217;', $str );
    $str = str_replace( '�', '&#218;', $str );
    $str = str_replace( '�', '&#219;', $str );
    $str = str_replace( '�', '&#220;', $str );
    $str = str_replace( '�', '&#221;', $str );
    $str = str_replace( '�', '&#222;', $str );
    $str = str_replace( '�', '&#223;', $str );
    $str = str_replace( '�', '&#224;', $str );
    $str = str_replace( '�', '&#225;', $str );
    $str = str_replace( '�', '&#226;', $str );
    $str = str_replace( '�', '&#227;', $str );
    $str = str_replace( '�', '&#228;', $str );
    $str = str_replace( '�', '&#229;', $str );
    $str = str_replace( '�', '&#230;', $str );
    $str = str_replace( '�', '&#231;', $str );
    $str = str_replace( '�', '&#232;', $str );
    $str = str_replace( '�', '&#233;', $str );
    $str = str_replace( '�', '&#234;', $str );
    $str = str_replace( '�', '&#235;', $str );
    $str = str_replace( '�', '&#236;', $str );
    $str = str_replace( '�', '&#237;', $str );
    $str = str_replace( '�', '&#238;', $str );
    $str = str_replace( '�', '&#239;', $str );
    $str = str_replace( '�', '&#240;', $str );
    $str = str_replace( '�', '&#241;', $str );
    $str = str_replace( '�', '&#242;', $str );
    $str = str_replace( '�', '&#243;', $str );
    $str = str_replace( '�', '&#244;', $str );
    $str = str_replace( '�', '&#245;', $str );
    $str = str_replace( '�', '&#246;', $str );
    $str = str_replace( '�', '&#247;', $str );  
    $str = str_replace( '�', '&#248;', $str );
    $str = str_replace( '�', '&#249;', $str );
    $str = str_replace( '�', '&#250;', $str );
    $str = str_replace( '�', '&#251;', $str );
    $str = str_replace( '�', '&#252;', $str );
    $str = str_replace( '�', '&#253;', $str );
    $str = str_replace( '�', '&#254;', $str );
    $str = str_replace( '�', '&#255;', $str );
   
    return $str;
}
 }
?>
				


