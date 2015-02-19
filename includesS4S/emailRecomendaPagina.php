<?php 
$remetente = $_GET['nome_remetente'];
$destinatario = $_GET['nome_destinatario'];
$emailDestinatario = $_GET['email'];
$mensagem = 'Olá sr(a) ' . $destinatario . ', ' . $remetente . ' te recomendou S4S. http://staff4solutions.com.br';

mail($emailDestinatario,'Oi ' . $destinatario . ' , conheça a Staff 4 Solutions!',$mensagem,"From: " . $remetente . "<teste@staff4solutions.com.br.com.br>");


?>
<head>

</head>
<body>
<div onClick='self.close()' style='height:100%'>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
	    <td align="center"><span style="background :url(http://www.mbassociados.com.br/images/fundo_cabecalho_fundo.jpg) repeat-x top padding:0;"><img src='../templates/mbAssociados/images/s4s_images/elementos/header-object.png' alt=""   /></span></td>
      </tr>
      <tr>
      	<td align="center" valign="middle">
      <?php
		
	
			echo "<table align='center' valign='middle'>";
			echo "<div style='text-align:center'>";
			echo "Obrigado sr(a) " . $remetente . ", <br/> a mensagem foi entre gue para:<br/> " . $destinatario . ", " . $emailDestinatario . "<br/>";
			echo "<p></p>";
			echo "<div id='conteudoFechaJanela' style='text-align:center; font-size:8pt'>";
			echo "clique em qualquer lugar para fechar.";
			echo "</div>";
			echo "</table>";
		
	?>
    	</td>
      </tr>
</table>
</div>
</body>