<?php
require 'pdfcrowd.php';

try
{   
    // create an API client instance
    $client = new Pdfcrowd("adrilago", "d4f8cb2f6ab18ee19fde8330905353a7");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertURI('http://186.202.139.52/mbnovo/portalB/includesS4S/pdfHtmlArtigoDompdf.php?id_conteudo='.@$id_conteudo);

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"ArtigoMB.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $e)
{
    echo "Pdfcrowd Error: " . $e->getMessage();
}
?>