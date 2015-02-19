
<?php


/*
 * Created on 29/12/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>


<?php

include ('includesS4S/Conexao.class.php');
try {
	//'instancia' singleton 
	$Conexao = Conexao :: getInstance();

	//submete a consulta ao banco
	$sql = "SELECT c.*,c.exibir_icones_redes_sociais as no_rede,c.nao_exibe_nome as no_nome,c.nome as nome_conteudo,c.descricao as descri_cont,p.*,p.nome as nome_produto from conteudos c ";
	$sql .= " inner join produtos p on c.id_produto_fk = p.id_produto where id_conteudo = " . $rowConteudo[0]['id_conteudo'];
	$result = $Conexao->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC); 
	$publico_dias = $row['publico_dias'];

	$sqlNovas = " select * from conteudos where id_produto_fk = " . $produto . " and id_conteudo > " . $conteudo . " order by id_conteudo asc limit 0,1 " ;
	$novas = $Conexao->query($sqlNovas);
	$rowNovas = $novas->fetch_array(MYSQLI_ASSOC); 
	$nova = $rowNovas['id_conteudo'];
	$countNova = count($rowNovas);

	$sqlAntigas = " select * from conteudos where id_produto_fk = " . $produto . " and id_conteudo < " . $conteudo . " order by id_conteudo asc limit 0,1 " ;
	echo $sqlAntigas;
	$antigas = $Conexao->query($sqlAntigas);
	$rowAntiga = $antigas->fetch_array(MYSQLI_ASSOC); 
	$antiga = $rowAntiga['id_conteudo'];
	$countAntiga = count($rowAntiga);
	


	//fecha a conexao 
	$Conexao->close();
} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
}
?>


 

	<div class="divArtigo" > <!-- inicio div BATEPAPO -->
					
		 

			<div class="divTituloDestaqueHomePagIni"> 
					<div id="divTituloHomePagInici">
						<img src='adm/images/icones/iconEstrela.png' />
                          <?php echo htmlentities ( $row['nome_produto']); ?>  
					</div>
			</div>

		<div class="divCorpoArtigoSemImg"> 
			<div id="tituloDoConteudoExibeArtigo">
				<?php 
				
					if($row['no_nome'] != 'S'){
						echo  htmlentities ( $row['nome_conteudo']);
						
					}	
				?>
			</div> 

			<div id='conteudoDoArtigoExibicaoArtigo'>
				<?php echo $row['descri_cont']; ?>
			</div>
		</div>


				<?php

					if($row['no_rede'] == 'S'){
						require ("exibeRedesSociais.php");
					}

				?>

		

	</div>






