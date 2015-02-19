<?php


// refatorar esta funcao







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
function getLinkRodape($label, $flag_label, $tipo_link, $id_produto, $id_conteudo, $id_menu) {

	if ($flag_label == "S") { //caso seja apenas label
		//echo "QQ<span class='labelRodape'>";
		//echo "<span class='divLinkRodape'>".$label."</span>";
		echo $label;
	} else {
		if ($tipo_link == "L") {
			echo "<a class='subMenuRodape' href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto&id_menu=$id_menu  style=text-decoration:none;>";
			echo "<span class='divLinkRodape'>" . $label . "</span>";
			echo "</a>";
		} else
			if ($tipo_link == "A") {
				echo "<a class='subMenuRodape' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu  style=text-decoration:none;>";
				echo "<span class='divLinkRodape'>" . $label . "</span>";
				echo "</a>";

			} else
				if ($tipo_link == "B") {
					$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=50&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
					$link .= $label;
					$link .= "</a></span>";
					echo $link;
				} else
					if ($tipo_link == "I") {
						$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=49&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
						$link .= $label;
						$link .= "</a></span>";
						echo $link;
					} else
						if ($tipo_link == "LB") {
							$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=49&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
							$link .= $label;
							$link .= "</a></span>";
							echo $link;
						} else
							if ($tipo_link == "LP") {
								$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=53&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
								$link .= $label;
								$link .= "</a></span>";
								echo $link;
							}
	}
	echo "<br>";
}

function getLinkSubRodape($label, $flag_label, $tipo_link, $id_produto, $id_conteudo, $espaco, $traco, $id_menu) {

	if ($flag_label == "S") { //caso seja apenas label
		echo "<span class='subMenuRodape'>";
		echo $label;
		echo "SS</span>";
	} else {
		if ($tipo_link == "L") {
			echo "<a href=index.php?option=com_content&view=article&id=47&id_produto=$id_produto&id_menu=$id_menu  style='text-decoration:none;'>";
			echo "<span class='subMenuRodape'>";
			echo $label;
			echo "</span>";
			echo "</a>";
		} else
			if ($tipo_link == "A") {
				echo "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=46&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu  style='text-decoration:none;'>";
				echo "<span class='subMenuRodape'>";
				echo $label;
				echo "</span>";
				echo "</a>";
				//				echo "</a></span>";
			} else {
				if ($tipo_link == "B") {
					$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=50&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
					$link .= $label;
					$link .= "</a></span>";

					//					echo "</a></span";
				} else
					if ($tipo_link == "I") {
						$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=49&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
						$link .= $label;
						$link .= "</a></span>";

						//						echo "</a></span>";
					} else
						if ($tipo_link == "LB") {
							$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=49&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
							$link .= $label;
							$link .= "</a></span>";

							//							echo "</a></span>";
						} else
							if ($tipo_link == "LP") {

								echo "<a href=index.php?option=com_content&view=article&id=53&id_produto=$id_produto&id_menu=$id_menu  style='text-decoration:none;'>";
								echo "<span class='subMenuRodape'>";
								echo $label;
								echo "</span>";
								echo "</a>";

							} else {
								//						$link = "<span class='subMenuRodape'><a class='subMenuRodape' href=index.php?option=com_content&view=article&id=50&id_conteudo=$id_conteudo&id_produto=$id_produto&id_menu=$id_menu style=text-decoration:none;>";
								//						$link .= $label;
								//						$link .= "</a></span>";
								echo $label . "XX";
							}

			}
	}
	echo "<br/>";

}

//	id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu

function getRodapeMenuEstatico($id = 0, $conta = 1, $pertence = 0, $idMenuRaiz) {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=" . $idMenuRaiz . " and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 
		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai 
			$options .= getLinkRodape("<span class='subMenuRodape'>" . $row[$i]["nome"] . "</span>", $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]) . "\r\n"; # contatena essa linha a mais para a variavel $options 
			//$options .= getLinkRodape( $row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]) . "\r\n"; # contatena essa linha a mais para a variavel $options
		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			$conta++; #:: acrecenta mais 1 para a variavel $conta 
			$id_anterior = $id; #:: define um valor para o id anterior 
			$options .= getLinkSubRodape(htmlspecialchars($row[$i]["nome"]) . "kk", $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options  
		} else {
			$options .= getLinkSubRodape(htmlspecialchars($row[$i]["nome"]) . "YY", $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		}
		$options .= getRodapeMenuEstatico($id_busca, $conta, $pertence, $idMenuRaiz); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos 
	}
	return $options; #:: retorna o contéudo 
}
?>
 <!-- --------------------------- INICIO  CUSTOMIZACAO S4S - rodape home ------------------------------- -->
     	<!-- ////////////////////////////// inicio logo e compartilhe /////////////////////////////////////////////////// -->
      <div id="contentFooter">
     	<div class="divLinhaLogoRodape">
     	   
     	</div>
      </div>	
     	<!-- ////////////////////////////// fim logo e compartilhe /////////////////////////////////////////////////// -->
     	<table width="100%">
     	  <tr>
     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
     		&nbsp;
     		</td>
     	  </tr>
     	</table>
    	<!-- inicio primeiro bloco -->
    		<!-- /////////////////////////////////// linha 1 //////////////////////////////////////////// --> 
        <div id="contentFooterLinha1Menu">
	       <div class="divLinhaItensMenu1">
				<?php


//'instancia' singleton 
$db = & JFactory :: getDBO();
//submete a consulta ao banco
$sql = "SELECT * FROM  mbAssociados.home_menu_raiz_portal order by id_menu_raiz";
$db->setQuery($sql);
$row = $db->loadAssocList();
?>	
             <div class="divItemMenuRaiz">
               <span class="labelRodapeItemRaiz"><?php echo $row[0]['descricao'];?></span>
             </div>     
             <!-- incio colunas itens menu -->
             <!-- div class="divColunasItemMenuLinha1" -->
<?php


//id é o id no item de menu propriamente dito
//pertence é o id do pai direto do menu, se pertence for igual a 0, este item não tem pai, portando é o primeiro nivel

//funcao recursiva para exibiçao do menu

function getMenuOptionArtigosRodape($id = 0, $conta = 1, $pertence = 0, $apenas_primeiro_nivel = "S") {
	global $id_portal;
	$options = null;
	$id_anterior = null;
	#:: SQL para selecionar os Ids
	// Get a database object
	$db = & JFactory :: getDBO();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 
	$sql = "SELECT id_menu, nome, endereco, posicao, pertence, id_menu_raiz_fk, flag_label, ifnull(id_produto,0) id_produto, ifnull(id_conteudo,0)id_conteudo , tipo_link, id_portal, exibe_rodape, exibe_menu ";
	$sql .= " FROM mbAssociados.home_menu_portal where id_portal=" . $_GET['id_portal'] . " and id_menu_raiz_fk=1 and pertence='$id' and exibe_rodape = 'S' order by posicao ";
	//echo $sql; 
//	die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();

	$traco = str_repeat("&nbsp;", 0); #:: ou coloca 1 para ficar somente com 1 vez a repetição;) 
	$espaco = str_repeat(" &nbsp;&nbsp; ", $conta); #:: ou coloca um $conta no lugar do 2 para dar espaço  
	for ($i = 0; $i < count($row); $i++) {
		$id_busca = $row[$i]["id_menu"]; #:: recupera a id 

		if ($row[$i]["pertence"] == $pertence) { #:: verifica se o pertence é o valor padrão do pai
			if ($apenas_primeiro_nivel == "S") {
				//$options .= getLinkRodape("Az<div class='divColunasItemMenuLinha1_" . $i . "_TITULO'><span class='labelRodape'>" . $row[$i]["nome"] . "</span>", $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]) . "\r\n"; # contatena essa linha a mais para a variavel $options		    	
//jr ok				  echo    "<div class='divColunasItemMenuLinha1_" . $i . "_TITULO'><span class='labelRodape'>ss" . $row[$i]["nome"] . "</span></div>";
				  // lixo echo    "<div class='divColunasItemMenuLinha1_" . $i . "_TITULO'>".getLinkApenasRodape($row[$i]["nome"] , $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]);
				    echo    "<div class='divColunasItemMenuLinha1_" . $i . "_TITULO'><a href=# style=text-decoration:none;><span class='labelRodape' onclick='abreLinkRodape(\"".$row[$i]["flag_label"]."\",\"".$row[$i]['tipo_link']."\",".$row[$i]['id_produto'].",".$row[$i]['id_conteudo'].",".$row[$i]['id_menu'] .");' style='cursor:hand'>" . $row[$i]["nome"] . "</span></a></div>";
				  
			} else {
				//$options .= getLinkRodape("Bz<div class='divColunasItemMenuLinha1_" . $i . "_SUBTITULO'>", $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $row[$i]["id_menu"]) . "\r\n"; # contatena essa linha a mais para a variavel $options
				//echo $row[$i]["nome"];
				//echo   "<div class='divColunasItemMenuLinha1_" . $i . "_SUBTITULO'>AA";
				
			}

		}
		elseif ($id != $id_anterior) { #:: verifica se o $id é igual ao $id_anterior 
			 
			$id_anterior = $id; #:: define um valor para o id anterior 
			echo  getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options
	        // echo   $row[$i]["nome"];
		} else {
			echo   getLinkSubRodape($row[$i]["nome"], $row[$i]["flag_label"], $row[$i]["tipo_link"], $row[$i]["id_produto"], $row[$i]["id_conteudo"], $espaco, $traco, $row[$i]["id_menu"]) . " \r\n"; # contatena essa linha a mais para a variavel $options /// (Menu Raiz: {$row["id_menu_raiz_fk"]} - Posicao: {$row["posicao"]} - ID deste: {$row["id_menu"]} - Pertence: {$row["pertence"]})
		 //  echo $row[$i]["nome"];
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
		if ($apenas_primeiro_nivel == "N") {
		
			
			echo  "<div class='divColunasItemMenuLinha1_" . ($conta-1) . "_SUBTITULO'>";
			$conta++; #:: acrecenta mais 1 para a variavel $conta
			echo  getMenuOptionArtigosRodape($id_busca, $conta); #:: chama novamente a função com o novo ID para recuperar as informações sobre seus filhos
				echo  "&nbsp;</div>";
		}
	}
//	$options . "</div>";

	//return $options; #:: retorna o contéudo 
}
?>		       
<div class="divLinhaItensMenu1">
<?php echo getMenuOptionArtigosRodape(0, 1, 0,"S");?>

</div>
<div class="divLinhaItensMenu222">
<?php echo getMenuOptionArtigosRodape( 0, 1, 0,"N"); ?>
</div>

           </div>    
             <!-- fim conlunas itens menu -->  
          	      
	       
        </div>     	<!-- fim contentFooterLinh -->
        	<!-- /////////////////////////////////// fim linha 1 //////////////////////////////////////////// -->
        
     	<!-- ////////////////////////////// fim logo e compartilhe /////////////////////////////////////////////////// -->
     	
     	<table width="100%">
     	  <tr>
     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
     		&nbsp;
     		</td>
     	  </tr>
     	</table>
     	
<!-- /////////////////////////////////// linha 2 //////////////////////////////////////////// -->
<!-- /////////////////////////////////// linha XXX //////////////////////////////////////////// -->


	<!-- inicio primeiro bloco -->
				<div id="contentFooterLinha2Menu">
					<div class="divLinhaSobre">
					<span class="labelRodape">SOBRE</span>
					
					<div class="divLinhaItensSobre">
					   <?php


echo getRodapeMenuEstatico(0, 1, 0, 5);
?>
                     </div>
					</div>
					<div class='divColunasAreaAtuacao'>
					<span class="labelRodape">&AacuteREA DE ATUA&Ccedil&AtildeO</span><br/>
					<div class='divColunasItensAreaAtuacao'>
					   <?php


echo getRodapeMenuEstatico(0, 1, 0, 6);
?>

                     </div>
					</div>
					
					<div class='divColunasProdutos'>
					<span class="labelRodape">PRODUTOS</span><br/>
					<div class='divColunasItensProdutos'>
					   <?php


echo getRodapeMenuEstatico(0, 1, 0, 7);
?>

 					</div>
					</div>
					<div class='divColunasEquipe'>
					<?php

	$db = & JFactory :: getDBO();
 
	//submete a consulta ao banco
	 
	$sql = "SELECT id_conteudo,ifnull(id_produto,0) as id_produto,id_menu FROM mbAssociados.home_menu_portal where exibe_menu='S' and id_portal=" .$idPortal . " and id_menu_raiz_fk=8 and pertence=0 order by posicao ";
	// se for primeiro nivel
	
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();
 	
 	
 	
 	
	if (count($row)>1){?>					
					
					<span class="labelRodape">EQUIPE</span><br/>
					<div class='divColunasItensEquipe'>
					<?php


echo getRodapeMenuEstatico(0, 1, 0, 8);
?>
			</div>
					 <?php }else{?>
					 	<a href="#" class="labelRodape" style="text-decoration:none;">
		<span class="labelRodape" onclick="abreArtigoMenu(<?php echo $row[0]["id_conteudo"];?>, <?php echo $row[0]["id_produto"];?>,<?php echo $row[0]["id_menu"];?>);" style="text-decoration:none;cursor:hand">
		<span class="labelRodape">EQUIPE</span>
		</span>		</a>
					 <?php }?>			
			</div>
			
			
					<div class='divColunasContato'>
					<?php

	$db = & JFactory :: getDBO();
 
	//submete a consulta ao banco
	 
	$sql = "SELECT id_conteudo,ifnull(id_produto,0) as id_produto,id_menu FROM mbAssociados.home_menu_portal where exibe_menu='S' and id_portal=" .$idPortal . " and id_menu_raiz_fk=9 and pertence=0 order by posicao ";
	// se for primeiro nivel
	
	//die($sql);
	$db->setQuery($sql);
	$row = $db->loadAssocList();
 	
 	
 	
 	
	if (count($row)>1){?>
					<span class="labelRodape">CONTATO</span><br/>
					<div class='divColunasItensContato'>
					<?php


echo getRodapeMenuEstatico(0, 1, 0, 9);
?>

					 </div>
					 <?php }else{?>
					 	<a href="#" class="labelRodape" style="text-decoration:none;">
		<span class="labelRodape" onclick="abreArtigoMenu(<?php echo $row[0]["id_conteudo"];?>, <?php echo $row[0]["id_produto"];?>,<?php echo $row[0]["id_menu"];?>);" style="text-decoration:none;cursor:hand">
		<span class="labelRodape">CONTATO</span>
		</span>		</a>
					 <?php }?>
					</div>
					<!-- fim conlunas itens menu -->

				</div>     	<!-- fim contentFooterLinha1Menu -->
<!-- /////////////////////////////////// fim linha XX //////////////////////////////////////////// -->	
<!-- /////////////////////////////////// fim linha 2 //////////////////////////////////////////// -->     	
      	
     	<table width="100%">
     	  <tr>
     		<td height="2" style="background-image:url('<?php echo $tmpTools->templateurl(); ?>/images/header/riscoFundoRodape.jpg');background-repeat:repeat-x;">
     		&nbsp;
     		</td>
     	  </tr>
     	</table>
		
        <div id="contentFooterLinhaDadosMB">
					<div class="divLinhaDadosMB">
					</div>	
		
		</div>			
		
			</div>     	<!-- fim contentFooterLinha1Menu -->
     	
<!-- --------------------------- FIM CUSTOMIZACAO S4S - rodape home ------------------------------- -->
