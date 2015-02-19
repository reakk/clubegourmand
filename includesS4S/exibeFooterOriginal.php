<?php


/* *******************************************************************
 * Staff 4 Solutions (c) 2011
 * 
 * Descrição: 
 * Created on 18/12/2011
 * Developer: Lago
 * Projeto: mbAssociados
 * TODO: TODO
 * Revision:
 /* *****************************************************************/
/* funtion para retornar tipo de link - adriano.lago 05-10-2011 */
function getLinkRodape($label, $flag_label, $tipo_link, $id_produto, $id_conteudo) {

	if ($flag_label == "S") { //caso seja apenas label
		echo "<span class='labelRodape'>";
		echo $label;
		echo "</span><br>";
	} else {
		if ($tipo_link == "L") {
			echo "<a class='labelRodape' href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto style=text-decoration:none;>";
			echo "<span class='labelRodape'>";
			echo $label;
			echo "</span></a>YY<br>";
		} else
			if ($tipo_link == "A") {
				echo "<a class='labelRodape' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto style=text-decoration:none;>";
				echo "<span class='labelRodape'>";
				echo $label;
				echo "</span></a>ZZ<br>";
			}
	}
}

function getLinkSubRodape($label, $flag_label, $tipo_link, $id_produto, $id_conteudo, $espaco, $traco) {

	if ($flag_label == "S") { //caso seja apenas label
		echo "<span class='labelRodape'>XX";
		echo $label;
		echo "</span><br>";
	} else {
		if ($tipo_link == "L") {
			echo "<a class='subMenuRodape' href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto style=text-decoration:none;>";
			echo "<span class='subMenuRodape'>AA";
			echo $label;
			echo "</span></a><br>";
		} else
			if ($tipo_link == "A") {
				echo "<span class='subMenuRodape'>BB<a class='subMenuRodape' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto style=text-decoration:none;>";
				echo $label;
				echo "</a></span><br>";
			}
	}
}
?>

<!-- --------------------------- INICIO CUSTOMIZACAO S4S - rodape home ------------------------------- -->

<table cellpadding="0" cellspacing="0" border="0" height="461" width="100%">
   <tr>
     <td width="1001" valign="top" align="left" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/fundoRodape.jpg');background-repeat:repeat-xy;">
     	<!-- center -->
     	<!-- ////////////////////////////// inicio logo e compartilhe /////////////////////////////////////////////////// -->
     	<table border="0" cellspacing="0" cellspadding="0" align=center style="margin-top:6px" width="1001">
     		<tr>
     		 <td width="241">
     		 	<img src="<?php echo $tmpTools->templateurl(); ?>/images/header/logoMbRodape.png" style="margin-top:10px">
     		 </td>
     		 <td width="208">
     		 	<img src="<?php echo $tmpTools->templateurl(); ?>/images/header/textoAcompanheDePerto.png" style="margin-top:10px">
     		 </td>
     		 <td align="right">
     		   <img src="<?php echo $tmpTools->templateurl(); ?>/images/header/textoCompartilheEstaPagina.png" style="margin-top:17px" border=0>&nbsp;
     		 </td>
     		 <td align="right" width="147">
     		   <img src="<?php echo $tmpTools->templateurl(); ?>/images/header/iconRedesSociais.png" style="margin-top:10px">
     		 </td>     		 
     		</tr>
     	</table>
     	<!-- ////////////////////////////// fim logo e compartilhe /////////////////////////////////////////////////// -->
     	<table width="100%">
     	  <tr>
     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
     		&nbsp;
     		</td>
     	  </tr>
     	</table>

     	<!-- ////////////////////////////// inicio itens menu /////////////////////////////////////////////////// -->
    
		<!-- inicio primeiro bloco --> 
		
		<!-- será dinâmico esta parte --> 
     	<table border="0" cellspacing="0" cellspadding="0" style="margin-top:-20px" width="1001" align=center>
     		<tr>
     		 <td valign="top">
     			<!-- <img src="<?php echo $tmpTools->templateurl(); ?>/images/header/menusRodapeExemplo.png" />-->
     		 	
     		 	<!-- inicio artigos 
     		 	-->      		 	

				<!-- /////////////////////////////////// linha 1 //////////////////////////////////////////// -->
				<?php

//'instancia' singleton 
$db = & JFactory :: getDBO();
//submete a consulta ao banco
$sql = "SELECT * FROM  mbAssociados.home_menu_raiz_portal order by id_menu_raiz";
$db->setQuery($sql);
$row = $db->loadAssocList();
?>	
				<table border="0" cellspacing="0" cellspadding="0" width="100%">
				     		<tr>
<?php

?>


				     		
				     		 <td  valign="top" class=labelRodape>
								<?php echo $row[0]['descricao'];?><br>	
				     		    
				   				<table border="0" cellspacing="0" cellspadding="0" width="100%" height="114">
				   			  		<tr>
				     		    <?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu

function getMenuOptionArtigosRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=1 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//echo $sql; 
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 

		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape("</td><td  valign=top class=labelRodape>" . $row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}

		/*
		if($row[$i]["pertence"] == $pertence){ #:: verifica se o pertence é o valor padrão do pai 
		        $options .= "<b>{$row[$i]["nome"]} </b><br>\r\n"; # contatena essa linha a mais para a variavel $options 
		}elseif($id != $id_anterior){ #:: verifica se o $id é igual ao $id_anterior 
		          $conta++; #:: acrecenta mais 1 para a variavel $conta 
		        $id_anterior = $id; #:: define um valor para o id anterior 
		        $options .= "{$espaco} {$traco} {$row[$i]["nome"]}  <br>\r\n"; # contatena essa linha a mais para a variavel $options  
		}else{ 
		        $options .= "{$espaco} {$traco} {$row[$i]["nome"]}  <br>\r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		} 
		*/
		$options .= getMenuOptionArtigosRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionArtigosRodape();
?>		
								</table>	
								
																		     		 
				     		 </td>


				     		</tr>
				 </table>      		 	
			    <!-- /////////////////////////////////// linha 1 //////////////////////////////////////////// -->
				</td></tr></table>
	     
	     
				     <table width="100%">
			     	  <tr>
			     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
			     		&nbsp;
			     		</td>
			     	  </tr>
			     	</table>
				
				<!-- /////////////////////////////////// linha 2 //////////////////////////////////////////// -->

				<!-- /////////////////////////////////// linha 2 //////////////////////////////////////////// -->
				<table border="0" cellspacing="0" cellspadding="0" align="center" width="1001" height="114"  style="margin-top:-20px">
				     		<tr>


<?php

?>


							 <td  valign="top" class=labelRodape>
								<?php echo $row[4]['descricao'];?><br>	

<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu
function getMenuOptionSobreRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=5 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getMenuOptionSobreRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionSobreRodape();
?>		
							 </td>	
<?php

?>


							 <td  valign="top" class=labelRodape>
								<?php echo $row[5]['descricao'];?><br>	

<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu
function getMenuOptionAreaAtuacaoRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where  id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=6 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getMenuOptionAreaAtuacaoRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionAreaAtuacaoRodape();
?>		
							 </td>					     		
<?php

?>


							 <td  valign="top" class=labelRodape>
								<?php echo $row[6]['descricao'];?><br>	

<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu
function getMenuOptionProdutosRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and  id_menu_raiz_fk=7 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getMenuOptionProdutosRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionProdutosRodape();
?>		
							 </td>	
<?php

?>


							 <td  valign="top" class=labelRodape>
								<?php echo $row[7]['descricao'];?><br>	

<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu
function getMenuOptionEquipeRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=8 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getMenuOptionEquipeRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionEquipeRodape();
?>		
							 </td>
<?php

?>


							 <td  valign="top" class=labelRodape>
								<?php echo $row[8]['descricao'];?><br>	

<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu
function getMenuOptionContatoRodape($id = 0, $conta = 1, $pertence = 0) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and  id_menu_raiz_fk=9 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= "{$espaco} {$traco} " . getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getMenuOptionContatoRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}

echo getMenuOptionContatoRodape();
?>		
							 </td>	

				     		</tr>
				 </table>      		 	
     	<table width="100%">
     	  <tr>
     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
     		&nbsp;
     		</td>
     	  </tr>
     	</table>
				 
				<!-- /////////////////////////////////// linha 2 //////////////////////////////////////////// -->

				
				
				<!-- /////////////////////////////////// linha 2 //////////////////////////////////////////// -->

  
     	<!-- ////////////////////////////// fim  itens menu /////////////////////////////////////////////////// -->
	 
	 
	    <!-- ////////////////////////////// inicio dados empresa /////////////////////////////////////////////////// -->
     	<table border="0" cellspacing="0" cellspadding="0" style="margin-top:-20px" width="1001" align="center">
     		<tr>
     		 <td width="25%">
     		 	<span class="fonteTextoMinRodape">
     		 	<b>MB Associados - Consultoria em An&aacute;lise<br> Macroecon&ocirc;mica</b>
     		 	<br>
					Av. Brigadeiro Faria Lima, 1739 - 5o. Andar<br>
					Jardim Paulistano - 01452 001<br>
					S&atilde;o Paulo - SP - Brasil    		 	
     		 	</span>
     		 </td>     
    
			<td align="center" width="50%">
			<table width="100%">
			  <tr>
			    <td align="left"><br><br>
			    <span class="fonteTextoMinRodape">
			     Tel.: +55 (11) 3062 1085<br>
				 Fax.: +55 (11) 3062 1086	     		 	
			    </span>
			   </td>
			   <td width="70%">
				   <span class="fonteTextoMinRodape">
	     		 		Copyright &copy; 2011 - MB Associados<br>
						Todos os direitos reservados<br>
						Avisos legais e termos de uso
	     		 	</span>
	     		</td>
	     	   </tr>
	     	  </table>	
     		 </td>          		     
			<td width="25%">
     		 	<table width="100%">
     		 	   <tr>
     		 	     <td>
		      		 	<span class="fonteTextoMinRodape">
		     		 	   <img src="<?php echo $tmpTools->templateurl(); ?>/images/header/flagUsa.png"> This site in english
		     		 	   <br>
		     		 	   <img src="<?php echo $tmpTools->templateurl(); ?>/images/header/flagEspanha.png"> Este sitio en espa&ntilde;ol
		     		 	</span>    		 	     
     		 	     </td>
     		 	     <td align=right>
		     		 	<img src="<?php echo $tmpTools->templateurl(); ?>/images/header/textoCreditos.png" style="margin-left:8px">
     		 	     </td>
     		 	    </tr>
     		 	  </table>   
     		 </td>      		      		 		 
			</tr>
     	</table>	    
	    <!-- ////////////////////////////// fim dados empresa /////////////////////////////////////////////////// -->
     </td>
   </tr>
</table>  


<!-- --------------------------- FIM CUSTOMIZACAO S4S - rodape home ------------------------------- -->
