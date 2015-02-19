<?php
error_reporting(0);
require("html2fpdf.php"); 
 
			$htmlFile = "http://localhost/pdf/teste.html"; 
			$buffer = file_get_contents($htmlFile); 
 
			$pdf = new HTML2FPDF('P', 'mm', 'Letter'); 
			$pdf->AddPage(); 
			$pdf->WriteHTML($buffer); 
			$pdf->Output('artigo.pdf', 'F'); 		
			
?>