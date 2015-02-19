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

///////////////////////////////////////////////////////////
////tipo artigo
//submete a consulta ao banco
$sqlSub = " select *,date_format(now(), '%H:%m:%s') as horas,date_format(data_criacao, '%d') as dia,date_format(data_criacao, '%m') as mes,date_format(data_criacao, '%Y') as ano,TIMEDIFF(now(),data_criacao) as total_horas from portal_gourmand.conteudos ";
$sqlSub = $sqlSub . " where  exibir_como_detalhe_na_home= 'S'";
//echo $sqlSub;
$db->setQuery($sqlSub);
$rowDestaque = $db->loadAssocList();
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

//$row[$i]['colunas'];
//$tamanhoCelula = 50 * $row[$i]['colunas'];
//echo "<td valign=top align=left colspan=".$row[$i]['colunas']." width='".$tamanhoCelula."%' bgcolor=#ffffff>";
// monta caminho imagem
$cssComImagem = "_COM_IMAGEM"; // logica trocada alterar nome
if (count($rowDestaque) > 0) {
	if ($rowDestaque[0]['image_detalhe_home'] != "") {
		$caminhoImagem = 'http://' . $_SERVER['HTTP_HOST'] . '/s4s/adm/conteudos_upload_mb/artigo';
		$caminhoImagem .= '/' . $rowDestaque[0]['image_detalhe_home'];
		$cssComImagem = "";
	}
}
//echo $cssComImagem;
?>



	       <div class="divDestaque" > <!-- inicio div Destaque -->
				    
					 <div class="divTituloDestaqueHomePagIni"> 
                          <div id="divTituloHomePagInici">
							<img src='adm/images/icones/iconEstrela.png' />
							Destaque
						  </div> 

						  <div id='corpoDoDestaque'>
							 
								<?php

									mysql_select_db($database_mb, $mb);
									$queryBanner = "select * from banner order by id_banner limit 0,1";
									$banner = mysql_query($queryBanner, $mb) or die('Erro no banner!');
									$lBanner = mysql_fetch_assoc($banner);
									$soIndex = $_SERVER['QUERY_STRING'];
									if($lBanner['mostrar']==1 && $soIndex==""){
									include('banners.php');
									}

								?>
					
								

							

						  </div> <!-- corpoDoDestaque -->

					 </div>

				


				<!--
					   <div class="fotoBoxDestaque">
	                        <a href='index.php?option=com_content&view=article&id=46&id_conteudo=<?php echo $rowDestaque[0]['id_conteudo']?>&id_produto=<?php echo $rowDestaque[0]['id_produto_fk']?>' style=text-decoration:none>
							<IMG  alt=Imagem  
							src="<?php echo @$caminhoImagem;?>"  style='border:0px solid black;'></A>
						</div>
				
						<div class="boxtitulotextoDestaque<?php echo $cssComImagem;?>">
	                        <a href='index.php?option=com_content&view=article&id=46&id_conteudo=<?php echo $rowDestaque[0]['id_conteudo']?>&id_produto=<?php echo $rowDestaque[0]['id_produto_fk']?>' style=text-decoration:none>					
							   <div class="tituloCaixasDestaque<?php echo $cssComImagem;?>"><?php if (count($rowDestaque)>0){ echo $rowDestaque[0]['nome'];}else{echo "Sem Destaque publicado";}?></div>
                            </a>
	                        <a href='index.php?option=com_content&view=article&id=46&id_conteudo=<?php echo $rowDestaque[0]['id_conteudo']?>&id_produto=<?php echo $rowDestaque[0]['id_produto_fk']?>' style=text-decoration:none>					
							   <div class="textoCaixasDestaque<?php echo $cssComImagem;?>"><?php if (count($rowDestaque)>0){
							   	 //echo $rowDestaque[0]['descricao_resumo'];
							   	 echo formataDescricaoResumo($rowDestaque[0]['descricao_resumo'],$nomeColuna,$rowDestaque[0]['id_conteudo']);
							   	 }else{echo "Sem Destaque publicado";}?></div>
							</a>
						   </div>
					  </div> -->
			</div> <!-- fim  div Destaque -->
