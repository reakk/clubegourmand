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
/////////////////////////////////////////////////////////////////////////////////////////////////
//desenv
//$diretorioJoomla = "portalB";
//$diretorioMb = "/mbAssociados";

//prod
$diretorioJoomla = "mbnovo/portalB";
$diretorioMb = "/mbnovo/mbAssociados";

set_include_path($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $diretorioJoomla . DIRECTORY_SEPARATOR . "includesS4S");

include ("parametrosConfiguracao.php");
// Get a database object
$db = & JFactory :: getDBO();
//recuperar qtde de linhas da home
$query = "SELECT valor FROM $bancoMBAssociados.home_portal_parametros where id=1 ";
//echo $query;
$db->setQuery($query);
$row = $db->loadAssocList();
$qtdeLinhasHome = $row[0]['valor'];

//echo $qtdeLinhasHome;
?>



<script>
	function executarPesquisa(){
		showWait();
		document.form.pagina.value=1;
		document.form.submit();
	}


	function goPage(page){
		showWait();
		document.form.pagina.value=page;
		document.form.submit();
	}
	
function abrirBancoMenu(idPai,idMenu){
	self.location="index.php?option=com_content&view=article&id=49&id_produto="+idPai+"&id_menu="+idMenu;
}
	

</script>

 <?php

require ('definePopupModalLogin.php');
?>
 

<form name="form" method="post" action="index.php?option=com_content&view=article&id=49&id_produto=<?php global $id_produto; echo $id_produto;?>" onsubmit="goPage(1);">
<input type="hidden" name="pagina" id="pagina" value="">

<!-- /////////////////////////////// INICIO TABELA MASTER //////////////////////////////// -->
<table cellpadding="0" cellspacing="0" border="0" width=991px >
<!-- /////////////////////////////// INICIO COLUNA CENTRO //////////////////////////////// -->
<tr>
 <TD valign='top' height=100% class='celulaTabelaColunaEsquerda' >
   <?php


$styleTitulo = "background:#CCCCCC; ";
$styleTitulo = $styleTitulo . " border-bottom : 1px solid #808080;";
?>
 
 				<div class="divDestaque" > <!-- inicio div BATEPAPO -->
					 <div class="divTituloDestaque" style="<?php echo $styleTitulo?>">
						<span class="tituloCaixas" >
						    <div id="divTitulo">
						    <?php require ("montaVoceEstaEm.php");?> <b>English</b>
                            </div>
						</span>  
					 </div>
					  <div class="divCorpoBancoDeDados"> 
					    
					     
                        <div class="divTabelaBancoDados">                        
                           <!-- inicio nivel -->
 <?php


#:: SQL para selecionar os Ids
// Get a database object
$db = & JFactory :: getDBO();

////////// INICIO CONSULTA REGISTROS GRID////////////////
//submete a consulta ao banco 
$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=$id_portal  and pertence in (SELECT id_menu ";
$sql = $sql . " FROM mbAssociados.home_menu_portal where id_portal=$id_portal and tipo_link in ('B') order by posicao ) order by posicao ";

//echo $sql;
$db->setQuery($sql);
$row = $db->loadAssocList();
for ($i = 0; $i < 1; $i++) {
?>                           

                 
			                 <div class="divNivelBancoDeDados" > <!-- inicio div divNivelBancoDeDados  1-->
							 
								   <div class="divCorpoNivelBancoDeDados" > <!-- inicio div divCorpoNivelBancoDeDados  1-->
									 <div class="divTituloBancoDeDados" style=""> <!-- inicio div titulo -->
									   <span class="tituloNivelBancoDados" >
										    <div id="divTitulo">
									          English
				                            </div><!-- FIM div divTitulo -->
				                        </span>                            
									 </div><!-- FIM div divTituloBancoDeDados -->
									 <!--  inicio exibicao segundo nivel -->
<?php


	

	$db->setQuery($sql);
	//echo $sql;
	$rowNivel2 = $db->loadAssocList();

	$count = 1;
	echo '<table border="0" cellspacing="0" cellspadding="0" width="90%">';
	echo "<tr>";
	for ($j = 0; $j < 1; $j++) {
?>
      <td valign='top'  class='celulaSegundoNivel'>
					  <table border="0" cellspacing="0" cellspadding="0" width="100%">
			            <tr >
						  <td style="background-color:#F2F2F2"> 
						     <table  border="0" cellspacing="0" cellspadding="0" id='tbl_<?php echo $rowNivel2[$j]["nome"];?>'> 
							   <tr>
							     <?php

		if ($rowNivel2[$j]["flag_label"] == "S") {
			echo "<td>" ;
		} else {
			echo "<td >";
		}
?>
							<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2134&id_menu=7463"   style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Articles</i></strong></a></span></p>

							<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2132&id_menu=7462"   style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Economic Notes</i></strong></span></p></a>
						 	  
						 	<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2131&id_menu=7461"  style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Economic Report</i></strong></a></span></p>
							
							<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2141&id_menu=7472"   style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Political Outlook</i></strong></a></span></p>
							
							<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2133&id_menu=7464"   style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Presentations</i></strong></span></p></a>
							
							
							<p style="margin-top:10px;">	<span style='cursor: hand'><img src="images/icones/bullet.png" style='margin-left:10px;margin-right:2px'>
							<a class='label' href="index.php?option=com_content&view=article&id=47&id_produto=2140&id_menu=7471"   style="text-decoration:none; color:black; font-family: georgia,tahoma,arial; font-size:9pt;"><strong><i>Sector Outlook</i></strong></a></span></p>

							
						 	 
						       
						         		
			                      </td>
			  				    </tr>
			  				    <!-- INICIA LINHAS TERCEIRO NIVEL -->
			  				    <?php


		$db = & JFactory :: getDBO();
		$sql = "SELECT * FROM mbAssociados.home_menu_portal where id_portal=42 and pertence=" . $rowNivel2[$j]["id_menu"] . " order by posicao ";
		$db->setQuery($sql);
		$rowNivel3 = $db->loadAssocList();

		$countNivel3 = 1;
		$retorno = "";
		
?>
			  				    <!-- FIM LINHAS TERCEIRO NIVEL -->
						     </table>  
						  </td>
						</tr>
					  </table>
					  </td>
					    <?php

		if ($count == 2) {
?> </tr><tr>
			<?php

			$count = 1;
		} else {
			$count = $count +1;
		}
	}
	echo "</td><tr></table>";
?>							
                                     <!--  fim exibicao segundo nivel -->
							       </div>    <!-- fim divCorpoNivelBancoDeDados -->                               
		                           
		                              
		                           
		                           
		                      </div>   <!-- fim div divNivelBancoDeDados  1-->
					   	<?php


}
?>   
						      <!-- fim nivel -->   
				
						  
						  
					    </div>		 <!-- fim div divTabelaBancoDados-->
 
 

 </TD>
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->

<td valign="top" width="30%">
<?php


require ("componenteLateralDinamica.php")
?>
</td>
<!-- /////////////////////////////// fim COLUNA CENTRO //////////////////////////////// -->
</tr>
</table>
</form>