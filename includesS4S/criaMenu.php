<?php
	//error_reporting(E_ALL);
	include("Connections/mb.php");
?>
  <link rel="stylesheet" type="text/css" href="includes/shadowbox/shadowbox.css" />
    <script type="text/javascript" src="includes/shadowbox/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="includes/shadowbox/shadowbox.js"></script>
	<script type="text/javascript">
		Shadowbox.init({
			handleOversize:     "drag",
			   language: 'pt',
			   player: ['html','img','swf'],

			   });
		</script>
<script>

var timeout	= 200;
var closetimer	= 0;
var ddmenuitem	= 0;
function mopen(id)
{
	mcancelclosetime();

	// fechar camada antiga
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 

		</script>

	
	<?php

	header("Content-Type: text/html; charset=UTF-8",true); 
	$separadorMenu = "<img src='images/menuseparator.png' />";
	$subIco = "<img src='templates/mbAssociados/images/arrow.png' />";
	$transparente = "<img src='images/trans.png' />";
	$seta = '<img src="templates/mbAssociados/images/arrow.png" />';

/******************************** SELECT DO MENU ********************************************/
	
	$db = & JFactory :: getDBO();
	$sql = 'SELECT * FROM portal_gourmand.home_menu_raiz_portal where id_menu_raiz_portal=' . $portal . ' order by id_menu_raiz';
	$db->setQuery($sql);
	$row =  $db->loadAssocList();
	var_dump($row);
	
 

/******************************** SELECT DO MENU ********************************************/

	$db2 = & JFactory :: getDBO();
	$sql2 = 'SELECT * FROM portal_gourmand.home_menu_portal where pertence="0" AND id_portal=' . $portal . ' order by posicao';
	$db2->setQuery($sql2);
	$rowSub = $db2->loadAssocList();
							$t=0;
							$w=0;
							$p=0;
							$c=0;
							$m=0;
							$z=0;
							$b=0;
							
			for($k = 0; $k < count($rowSub); $k++) {
				$arraySubId[$t++]=$rowSub[$k]['id_menu_raiz_fk'];
				$arraySubDesc[$w++]=$rowSub[$k]['nome'];
				$arrayProduto[$p++]=$rowSub[$k]['id_produto'];
				$arrayConteudo[$c++]=$rowSub[$k]['id_conteudo'];
				$arrayMenu[$m++]=$rowSub[$k]['id_menu'];
				$arrayTipo[$z++]=$rowSub[$k]['tipo_link'];
				$arrayFlag[$b++]=$rowSub[$k]['flag_label'];
				$resultado = count($arraySubId);
			}

	$db3 = & JFactory :: getDBO();
	$sql3 = 'SELECT * FROM portal_gourmand.home_menu_portal where pertence!="0" AND id_portal=' . $portal . ' order by posicao';
	$db3->setQuery($sql3);
	$rowSub2 = $db3->loadAssocList();
							$t2=0;
							$w2=0;
							$p2=0;
							$c2=0;
							$m2=0;
							$z2=0;
							$b2=0;
							$x=0;
						
			for($k2 = 0; $k2 < count($rowSub2); $k2++) {
				$arraySubId2[$t2++]=$rowSub2[$k2]['id_menu_raiz_fk'];
				$arraySubDesc2[$w2++]=$rowSub2[$k2]['nome'];
				$arrayProduto2[$p2++]=$rowSub2[$k2]['id_produto'];
				$arrayConteudo2[$c2++]=$rowSub2[$k2]['id_conteudo'];
				$arrayMenu2[$m2++]=$rowSub2[$k2]['id_menu'];
				$arrayTipo2[$z2++]=$rowSub2[$k2]['tipo_link'];
				$arrayFlag2[$b2++]=$rowSub2[$k2]['flag_label'];
				$arrayPertence[$x++]=$rowSub2[$k2]['pertence'];
				@$resultado2 = count($arraySubId2);
			}
			
?>

	<div id="meNu">
	<ul id="menu2" style='top:0;'>
			<?php
				$tamanho=1400/ count($row)-1;
				//echo $separadorMenu;
				for ($i = 0; $i < count($row); $i++) { // abre o for principal

					mysql_select_db($database_mb, $mb) or die(mysql_error());
					$sqlQtd = " select * from home_menu_portal where id_menu_raiz_fk = " . $row[$i]['id_menu_raiz'];
					$qtd = mysql_query($sqlQtd, $mb) or die('Erro no banner!');
					$rowQtd = mysql_fetch_assoc($qtd);
					$totalQtd = mysql_num_rows($qtd);
					
				
				echo '	<div id="btMenu' . $i . '" style="height:100%;" >'; // div de cada item do menu principal
				$botao[$i]=$row[$i]["descricao"];

				if ( //se o botao for de contato:
				strtoupper($botao[$i]) == 'CONTATO' ||
				strtoupper($botao[$i]) == 'FALE CONOSCO' ||
				strtoupper($botao[$i]) == 'CONTATOS'
				)
				{	
					echo '		<a href="includesS4S/forms/paginaContatos.php" rel="shadowbox;width=650;height=540" title="Fale Conosco"  onmouseover="mopen(\'m' . $i . '\')"  onmouseout="mclosetime()">';
					echo strtoupper($botao[$i]);
					echo '		</a>';
					echo '			<div id="m'.$i.'" onmouseover="mcancelclosetime()"  onmouseout="mclosetime()">';
				    echo '				<div id="setaParaBaixo"></div>';//setinha do sub menu


				}else
                {
                if($row[$i]["descricao"]!=" "){
					if($totalQtd == 1){
						if($rowQtd['tipo_link'] == 'L'){
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$rowQtd['id_produto'].'&id_menu='.$rowQtd['id_menu'].'">' . $row[$i]["descricao"] .'</a>';//apresentação dos links principais
						}

						if($rowQtd['tipo_link'] == 'A'){
							echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$rowQtd['id_conteudo'].'&id_menu='.$rowQtd['id_menu'].'">' . $row[$i]["descricao"] .'</a>';//apresentação dos links principais
						}
						
					} else {
						echo '		<a href="#" title=""  onmouseover="mopen(\'m' . $i . '\')"  onmouseout="mclosetime()">'. $row[$i]["descricao"] .'</a>';//apresentação dos links principais
					}
				//echo '		<a href="#" title=""  onmouseover="mopen(\'m' . $i . '\')"  onmouseout="mclosetime()">'. $row[$i]["descricao"] .'</a>';//apresentação dos links principais
				echo '			<div id="m'.$i.'" onmouseover="mcancelclosetime()"  onmouseout="mclosetime()">';
				echo '				<div id="setaParaBaixo"></div>';//setinha do sub menu
                            }
                             }
							for ($a=0;$a<$resultado;$a++){ //abre o for subnivel 1

								echo '<div id="n'.$i.'">';

								if ($arraySubId[$a] == $row[$i]['id_menu_raiz']){ //condição de pertence ao menu principal

									$tipo_link = $arrayTipo[$a];
									$flag =  $arrayFlag[$a];
								if ($flag == "S") {
										echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
										echo $arraySubDesc[$a];
										echo '</div>';
								}else

									if ($tipo_link == "L") {
										echo '<div id="linhasDosubMenu">';
										echo $seta;
										echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto[$a].'&id_menu='.$arrayMenu[$a].'">';
										echo $arraySubDesc[$a];
										echo '</a><br />';
										echo '</div>';
									}else
										if ($tipo_link == "A") {
											echo '<div id="linhasDosubMenu">';
											echo $seta;
											echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo[$a].'&id_menu='.$arrayMenu[$a].'">';
											echo $arraySubDesc[$a];
											echo '</a><br />';
											echo '</div>';
										}else
											if ($tipo_link == "B") {
												echo '<div id="linhasDosubMenu">';
												echo $seta;
												echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo[$a].'id_produto='.$arrayProduto[$a].'&id_menu='.$arrayMenu[$a].'" >';
												echo $arraySubDesc[$a];
												echo '</a><br />';
												echo '</div>';
											}else
												if ($tipo_link == "I") {
													echo '<div id="linhasDosubMenu">';
													echo $seta;
													echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo[$a].'id_produto='.$arrayProduto[$a].'&id_menu='.$arrayMenu[$a].'" >';
													echo $arraySubDesc[$a];
													echo '</a><br />';
													echo '</div>';
												}else
													if ($tipo_link == "LB") {
														echo '<div id="linhasDosubMenu">';
														echo $seta;
														echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto[$a].'&id_menu='.$arrayMenu[$a].'">';
														echo $arraySubDesc[$a];
														echo '</a><br />';
														echo '</div>';
													}else
														if ($tipo_link == "LP") {
															echo '<div id="linhasDosubMenu">';
																echo $seta;
																echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto[$a].'&id_menu='.$arrayMenu[$a].'">';
																echo $arraySubDesc[$a];
																echo '</a><br />';
																echo '</div>';
														
								}
														
/******************************************** fim do sub nivel 1 *****************************************************************************************************************************/
					?>
		
													<style>

														#btMenu<?php echo $i ?>{
															float:left;
														<?php
															if($i == 7){
														?>
														
														<?php
															}else{
														?>
															border-right:2px groove white;
														<?php } ?>
															text-align:center;
															height:27px !important;
															line-height:2;

														   
														}
													
														#m<?php echo $i ?>{
															background-color:#ebebeb;
															visibility: hidden;
															border:1px solid black;
															border-radius:5px;
															padding:5px;
															position:absolute;
															text-align:left;
															color:black;
															min-width:150px;
																												
														}
														
													
															#m<?php echo $i ?> a {
																	
																color:black;
															
														}
															#m<?php echo $i ?> a:hover {
																	
																color:#333;
														}
													
															#n<?php echo $i ?>:hover {
															background-color:ebebeb;
															border-radius:2px;
															
															
														}
															#n<?php echo $i ?> img, a {
																margin-left:11px;
																margin-right:11px;
															
														}
														#linhasDosubMenu{
															border-top:1px dotted #999;
															
														}
														#linhasDosubMenu:hover{
															background-color:#CCC;
															border-radius:10px;
														}
													

														</style>
								
<?php		
for ($ss=0;$ss<@$resultado2;$ss++){
	if($arrayPertence[$ss] == $arrayMenu[$a]){

	$tipo_link = $arrayTipo2[$ss];
		$flag =  $arrayFlag2[$ss];
	if ($flag == "S") {
			echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
			echo $arraySubDesc2[$ss];
			echo '</div>';
	}else
		
		if ($tipo_link == "L") {
			echo '<div id="linhasDosubMenu">';
			echo $seta;
			echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ss].'&id_menu='.$arrayMenu2[$ss].'">';
			echo $arraySubDesc2[$ss];
			echo '</a><br />';
			echo '</div>';
		}else
			if ($tipo_link == "A") {
				echo '<div id="linhasDosubMenu">';
				echo $seta;
				echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo2[$ss].'&id_menu='.$arrayMenu2[$ss].'">';
				echo $arraySubDesc2[$ss];
				echo '</a><br />';
				echo '</div>';
			}else
				if ($tipo_link == "B") {
					echo '<div id="linhasDosubMenu">';
					echo $seta;
					echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo2[$ss].'id_produto='.$arrayProduto2[$ss].'&id_menu='.$arrayMenu2[$ss].'" >';
					echo $arraySubDesc2[$ss];
					echo '</a><br />';
					echo '</div>';
				}else
					if ($tipo_link == "I") {
						echo '<div id="linhasDosubMenu">';
						echo $seta;
						echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo2[$ss].'id_produto='.$arrayProduto2[$ss].'&id_menu='.$arrayMenu2[$ss].'" >';
						echo $arraySubDesc2[$ss];
						echo '</a><br />';
						echo '</div>';
					}else
						if ($tipo_link == "LB") {
							echo '<div id="linhasDosubMenu">';
							echo $seta;
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ss].'&id_menu='.$arrayMenu2[$ss].'">';
							echo $arraySubDesc2[$ss];
							echo '</a><br />';
							echo '</div>';
						}else
							if ($tipo_link == "LP") {
									echo '<div id="linhasDosubMenu">';
									echo $seta;
									echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto2[$ss].'&id_menu='.$arrayMenu2[$ss].'">';
									echo $arraySubDesc2[$ss];
									echo '</a><br />';
									echo '</div>';
							
	}

/******************************************** fim do sub nivel 2 *****************************************************************************************************************************/

for ($sss=0;$sss<$resultado2;$sss++){ // for subnivel2
	if($arrayPertence[$sss] == $arrayMenu2[$ss]){
		
	$tipo_link = $arrayTipo2[$sss];
		$flag =  $arrayFlag2[$sss];
	if ($flag == "S") {
			echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
			echo $arraySubDesc2[$sss];
			echo '</div>';
	}else

			
		if ($tipo_link == "L") {
			echo '<div id="linhasDosubMenu">';
			echo $transparente;
			echo $subIco;
			echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$sss].'&id_menu='.$arrayMenu2[$sss].'">';
			echo $arraySubDesc2[$sss];
			echo '</a><br />';
			echo '</div>';
		}else
			if ($tipo_link == "A") {
				echo '<div id="linhasDosubMenu">';
				echo $transparente;
				echo $subIco;
				echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo2[$sss].'&id_menu='.$arrayMenu2[$sss].'">';
				echo $arraySubDesc2[$sss];
				echo '</a><br />';
				echo '</div>';
			}else
				if ($tipo_link == "B") {
					echo '<div id="linhasDosubMenu">';
					echo $transparente;
					echo $subIco;
					echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo2[$sss].'id_produto='.$arrayProduto2[$sss].'&id_menu='.$arrayMenu2[$sss].'" >';
					echo $arraySubDesc2[$sss];
					echo '</a><br />';
					echo '</div>';
				}else
					if ($tipo_link == "I") {
						echo '<div id="linhasDosubMenu">';
						echo $transparente;
						echo $subIco;
						echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo2[$sss].'id_produto='.$arrayProduto2[$sss].'&id_menu='.$arrayMenu2[$sss].'" >';
						echo $arraySubDesc2[$sss];
						echo '</a><br />';
						echo '</div>';
					}else
						if ($tipo_link == "LB") {
							echo '<div id="linhasDosubMenu">';
							echo $transparente;
							echo $subIco;
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$sss].'&id_menu='.$arrayMenu2[$sss].'">';
							echo $arraySubDesc2[$sss];
							echo '</a><br />';
							echo '</div>';
						}else
							if ($tipo_link == "LP") {
									echo '<div id="linhasDosubMenu">';
									echo $transparente;
									echo $subIco;
									echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto2[$sss].'&id_menu='.$arrayMenu2[$sss].'">';
									echo $arraySubDesc2[$sss];
									echo '</a><br />';
									echo '</div>';
						}

/******************************************** fim do sub nivel 3 *****************************************************************************************************************************/
for ($ssss=0;$ssss<$resultado2;$ssss++){ // for subnivel3
	if($arrayPertence[$ssss] == $arrayMenu2[$sss]){
		
	$tipo_link = $arrayTipo2[$ssss];
		$flag =  $arrayFlag2[$ssss];
	if ($flag == "S") {
			echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
			echo $arraySubDesc2[$ssss];
			echo '</div>';
	}else
			
		if ($tipo_link == "L") {
			echo '<div id="linhasDosubMenu">';
			echo $transparente;
			echo $transparente;
			echo $subIco;
			echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'">';
			echo $arraySubDesc2[$ssss];
			echo '</a><br />';
			echo '</div>';
		}else
			if ($tipo_link == "A") {
				echo '<div id="linhasDosubMenu">';
				echo $transparente;
				echo $transparente;
				echo $subIco;
				echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'">';
				echo $arraySubDesc2[$ssss];
				echo '</a><br />';
				echo '</div>';
			}else
				if ($tipo_link == "B") {
					echo '<div id="linhasDosubMenu">';
					echo $transparente;
					echo $transparente;
					echo $subIco;
					echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo2[$ssss].'id_produto='.$arrayProduto2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'" >';
					echo $arraySubDesc2[$ssss];
					echo '</a><br />';
					echo '</div>';
				}else
					if ($tipo_link == "I") {
						echo '<div id="linhasDosubMenu">';
						echo $transparente;
						echo $transparente;
						echo $subIco;
						echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo2[$ssss].'id_produto='.$arrayProduto2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'" >';
						echo $arraySubDesc2[$ssss];
						echo '</a><br />';
						echo '</div>';
					}else
						if ($tipo_link == "LB") {
							echo '<div id="linhasDosubMenu">';
							echo $transparente;
							echo $transparente;
							echo $subIco;
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'">';
							echo $arraySubDesc2[$ssss];
							echo '</a><br />';
							echo '</div>';
						}else
							if ($tipo_link == "LP") {
									echo '<div id="linhasDosubMenu">';
									echo $transparente;
									echo $transparente;
									echo $subIco;
									echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto2[$ssss].'&id_menu='.$arrayMenu2[$ssss].'">';
									echo $arraySubDesc2[$ssss];
									echo '</a><br />';
									echo '</div>';
						}
/******************************************** fim do sub nivel 4 *****************************************************************************************************************************/
for ($sssss=0;$sssss<$resultado2;$sssss++){ // for subnivel4
	if($arrayPertence[$sssss] == $arrayMenu2[$ssss]){
		
	$tipo_link = $arrayTipo2[$sssss];
		$flag =  $arrayFlag2[$sssss];
	if ($flag == "S") {
			echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
			echo $arraySubDesc2[$sssss];
			echo '</div>';
	}else

			
		if ($tipo_link == "L") {
			echo '<div id="linhasDosubMenu">';
			echo $transparente;
			echo $transparente;
			echo $transparente;
			echo $subIco;
			echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'">';
			echo $arraySubDesc2[$sssss];
			echo '</a><br />';
			echo '</div>';
		}else
			if ($tipo_link == "A") {
				echo '<div id="linhasDosubMenu">';
				echo $transparente;
				echo $transparente;
				echo $transparente;
				echo $subIco;
				echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'">';
				echo $arraySubDesc2[$sssss];
				echo '</a><br />';
				echo '</div>';
			}else
				if ($tipo_link == "B") {
					echo '<div id="linhasDosubMenu">';
					echo $transparente;
					echo $transparente;
					echo $transparente;
					echo $subIco;
					echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo2[$sssss].'id_produto='.$arrayProduto2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'" >';
					echo $arraySubDesc2[$sssss];
					echo '</a><br />';
					echo '</div>';
				}else
					if ($tipo_link == "I") {
						echo '<div id="linhasDosubMenu">';
						echo $transparente;
						echo $transparente;
						echo $transparente;
						echo $subIco;
						echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo2[$sssss].'id_produto='.$arrayProduto2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'" >';
						echo $arraySubDesc2[$sssss];
						echo '</a><br />';
						echo '</div>';
					}else
						if ($tipo_link == "LB") {
							echo '<div id="linhasDosubMenu">';
							echo $transparente;
							echo $transparente;
							echo $transparente;
							echo $subIco;
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'">';
							echo $arraySubDesc2[$sssss];
							echo '</a><br />';
							echo '</div>';
						}else
							if ($tipo_link == "LP") {
									echo '<div id="linhasDosubMenu">';
									echo $transparente;
									echo $transparente;
									echo $transparente;
									echo $subIco;
									echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto2[$sssss].'&id_menu='.$arrayMenu2[$sssss].'">';
									echo $arraySubDesc2[$sssss];
									echo '</a><br />';
									echo '</div>';
						}
	
/******************************************** fim do sub nivel 5 *****************************************************************************************************************************/
for ($ssssss=0;$ssssss<$resultado2;$ssssss++){ // for subnivel5
	if($arrayPertence[$ssssss] == $arrayMenu2[$sssss]){
		
	$tipo_link = $arrayTipo2[$ssssss];
		$flag =  $arrayFlag2[$ssssss];
	if ($flag == "S") {
			echo '<div style="background-color:gray; color:white; font-weight:bold; text-align:center">';
			echo $arraySubDesc2[$ssssss];
			echo '</div>';
	}else
			
		if ($tipo_link == "L") {
			echo '<div id="linhasDosubMenu">';
			echo $transparente;
			echo $transparente;
			echo $transparente;
			echo $transparente;
			echo $subIco;
			echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'">';
			echo $arraySubDesc2[$ssssss];
			echo '</a><br />';
			echo '</div>';
		}else
			if ($tipo_link == "A") {
				echo '<div id="linhasDosubMenu">';
				echo $transparente;
				echo $transparente;
				echo $transparente;
				echo $transparente;
				echo $subIco;
				echo '<a href="index.php?option=com_content&view=article&id=46&id_conteudo='.$arrayConteudo2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'">';
				echo $arraySubDesc2[$ssssss];
				echo '</a><br />';
				echo '</div>';
			}else
				if ($tipo_link == "B") {
					echo '<div id="linhasDosubMenu">';
					echo $transparente;
					echo $transparente;
					echo $transparente;
					echo $transparente;
					echo $subIco;
					echo '<a href="index.php?option=com_content&view=article&id=50&id_conteudo='.$arrayConteudo2[$ssssss].'id_produto='.$arrayProduto2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'" >';
					echo $arraySubDesc2[$ssssss];
					echo '</a><br />';
					echo '</div>';
				}else
					if ($tipo_link == "I") {
						echo '<div id="linhasDosubMenu">';
						echo $transparente;
						echo $transparente;
						echo $transparente;
						echo $transparente;
						echo $subIco;
						echo '<a href="index.php?option=com_content&view=article&id=49&id_conteudo='.$arrayConteudo2[$ssssss].'id_produto='.$arrayProduto2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'" >';
						echo $arraySubDesc2[$ssssss];
						echo '</a><br />';
						echo '</div>';
					}else
						if ($tipo_link == "LB") {
							echo '<div id="linhasDosubMenu">';
							echo $transparente;
							echo $transparente;
							echo $transparente;
							echo $transparente;
							echo $subIco;
							echo '<a href="index.php?option=com_content&view=article&id=47&id_produto='.$arrayProduto2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'">';
							echo $arraySubDesc2[$ssssss];
							echo '</a><br />';
							echo '</div>';
						}else
							if ($tipo_link == "LP") {
									echo '<div id="linhasDosubMenu">';
									echo $transparente;
									echo $transparente;
									echo $transparente;
									echo $transparente;
									echo $subIco;
									echo '<a href="index.php?option=com_content&view=article&id=53&id_produto='.$arrayProduto2[$ssssss].'&id_menu='.$arrayMenu2[$ssssss].'">';
									echo $arraySubDesc2[$ssssss];
									echo '</a><br />';
									echo '</div>';
						}
	}
}
/******************************************************* fim sub niveis **********************************************************/
	
	}
}
	}
}
	}
}
	}
}
								}
				echo '		</div>';
							}

				echo '	</div>';
				echo '</div>';
				}
?>

</ul>
</div>	


