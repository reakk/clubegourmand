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
$sqlSub = " select *,date_format(now(), '%H:%m:%s') as horas,date_format(data_criacao, '%d') as dia,date_format(data_criacao, '%m') as mes,date_format(data_criacao, '%Y') as ano,TIMEDIFF(now(),data_criacao) as total_horas from $bancoMBAssociados.conteudos ";
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
		$caminhoImagem = 'http://' . $_SERVER['HTTP_HOST'] . '/mbnovo/mbAssociados/conteudos_upload_mb/artigo';
		$caminhoImagem .= '/' . $rowDestaque[0]['image_detalhe_home'];
		$cssComImagem = "";
	}
}
//echo $cssComImagem;
?>



	       <div class="divDestaque" > <!-- inicio div Destaque -->
				     <div class="divTituloDestaque" style="background:#42b4ff; BORDER-BOTTOM: #0033FF 1px solid;"> 
					    <div class="tituloCaixas">
						  <IMG  border=0 src="images/icoEstrela.png"  /><div id="divTitulo">Em Destaque</div>
                        </div>  
					 </div>
					 <div class="divCorpoDestaque"> 
				<?php


if ($cssComImagem != "_COM_IMAGEM") {
?> 
					   <div class="fotoBoxDestaque">
	                        <a href='index.php?option=com_content&view=article&id=46&id_conteudo=<?php echo $rowDestaque[0]['id_conteudo']?>&id_produto=<?php echo $rowDestaque[0]['id_produto_fk']?>' style=text-decoration:none>
							<IMG  alt=Imagem  
							src="<?php echo @$caminhoImagem;?>"  style='border:0px solid black;'
							width="297px" height="160px" /> </A>
						</div>
				<?php }?>	
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
					  </div>
				</div> <!-- fim  div Destaque -->
