<?php

/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descri��o: 
 * Created on 14/10/2011
 * Developer: Lago
 * Projeto: portalB
 * TODO: TODO
 * Revision:
 /* *****************************************************************/
?>
<?php

//desenv

//$diretorioJoomla = "portalB";
//$diretorioMb = "/mbAssociados";

//prod
$diretorioJoomla = "";
$diretorioMb = "/mbnovo/mbAssociados";

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");
//error_reporting(0);
//include ("pdf/html2fpdf.php");
//$HTTP_HOST."/".$diretorioJoomla
$htmlFile = "http://" . '127.0.0.1' . "/mbnovo/portalB/includesS4S/pdfHtmlArtigoDompdf.php?id_conteudo=" . $_GET["id_conteudo"] . "";

//echo $htmlFile;
$buffer = file_get_contents($htmlFile);
//echo $buffer;
//die();



require_once("dompdf/dompdf_config.inc.php");


  if ( get_magic_quotes_gpc() )
    $buffer = stripslashes($buffer);
  $old_limit = ini_set("memory_limit", "128M"); 
  $dompdf = new DOMPDF();
  $dompdf->load_html($buffer);
  $dompdf->set_paper("letter", "portrait");
  $dompdf->render();

  $dompdf->stream("ArtigoDomPdf.pdf", array("Attachment" => true));

  exit(0);

//echo $htmlFile;
/*
$buffer = file_get_contents(nl2br($htmlFile));
//echo $buffer;  
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->SetTopMargin(100);

$pdf->SetTitle('Artigos MB Associados');
$pdf->SetAuthor('MB Associados','MB Associados');
$pdf->AddPage();
$pdf->WriteHTML($buffer);
$pdf->Output('Artigo.pdf', 'D');
*/
?>