
<?php 
	try {
	//'instancia' singleton 
	$Conexao = Conexao :: getInstance();

//     echo "id_conteudo=".$_GET['id_conteudo'];
//	      echo "id_produto=".$_GET['id_produto'];
	//submete a consulta ao banco
	$sql = "SELECT c.*,c.exibir_icones_redes_sociais as no_rede,c.nao_exibe_nome as no_nome,c.nome as nome_conteudo,c.descricao as descri_cont,p.*,p.nome as nome_produto from conteudos c ";
	$sql .= " inner join produtos p on c.id_produto_fk = p.id_produto where id_conteudo = " . $_GET['id_conteudo'];
//	echo $sql;
	$result = $Conexao->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC); 
	$publico_dias = $row['publico_dias'];

	$sqlNovas = " select * from conteudos where id_produto_fk = " . $_GET['id_produto'] . " and id_conteudo > " . $_GET['id_conteudo'] . " order by id_conteudo asc limit 0,1 " ;
//	echo $sqlNovas;
	$novas = $Conexao->query($sqlNovas);
	$rowNovas = $novas->fetch_array(MYSQLI_ASSOC); 
	$nova = $rowNovas['id_conteudo'];
	$countNova = count($rowNovas);

	$sqlAntigas = " select * from conteudos where id_produto_fk = " . $_GET['id_produto'] . " and id_conteudo < " . $_GET['id_conteudo'] . " order by id_conteudo asc limit 0,1 " ;
//	echo 'SQL_ANTIGA='.$sqlAntigas;
	$antigas = $Conexao->query($sqlAntigas);
	$rowAntiga = $antigas->fetch_array(MYSQLI_ASSOC); 
	$antiga = $rowAntiga['id_conteudo'];
//	echo "antiga=".$antiga;
	$countAntiga = count($rowAntiga);
	


	//fecha a conexao 
	$Conexao->close();
} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
}



	$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url = explode("&id_conteudo=", $url);
	$novaUrl = $url[0]."&id_conteudo=".$nova;

	$urlFacebook ='http://' . $_SERVER['HTTP_HOST'].'/t.php?p='.$_GET["id_conteudo"];
			
	if(strlen($url[1]) > 2){
		$parteFaltante = substr($url[1],2,strlen($url[1]));
//jr retirei		$parteFaltante = substr($url[1],2,strlen($url[1]));
        $parteFaltante = substr($url[1],strpos($url[1], '&'),strlen($url[1]));


		$novaUrl = $novaUrl.$parteFaltante;
	}

	$urlAntiga = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$urlAntiga = explode("&id_conteudo=", $urlAntiga);
	$antigaUrl = $urlAntiga[0]."&id_conteudo=".$antiga;
//	echo 'anti-url'.$antigaUrl;
//	echo "falta".$url[1];		

	if(strlen($urlAntiga[1]) > 2){
//jr retirei		$parteFaltanteAntiga = substr($url[1],2,strlen($url[1]));
		$parteFaltanteAntiga = substr($url[1],strpos($url[1], '&'),strlen($url[1]));
		$antigaUrl = $antigaUrl.$parteFaltanteAntiga;
	}

//echo 'anti-url2='.$antigaUrl;


$server = $_SERVER['SERVER_NAME'];
$endereco = $_SERVER['REQUEST_URI'];
$urlatual = "http://" . $server . $endereco;

?>

  

<div class="divRedesSociais">
   
	<div id='proximasPaginasExibeArtigo'>
		<div id='nextArtigoPaginaArtigo'>

			 <div id='antigasNextPagina'>
			 <?php
				if($countNova > 0){
			 ?>
				<a href='#' onclick='location="<?php echo $novaUrl; ?>"'>
			 <?php
				}
			 ?>
				  <div style='float:left;'>
					novas
				  </div>
					<img src='images/direita_conteudo.png' />
			 <?php
				if($countNova> 0){
			 ?>
				</a>
			 <?php
				}
			 ?>
			 </div>

			 <div id='novasNextPagina'>
			   <?php
					if($countAntiga> 0){
			   ?>
				<a href='#' onclick='location="<?php echo $antigaUrl; ?>"'>
				<?php
					}
				 ?>
				  <div style='float:left;'>
					antigas
				  </div>
					<img src='images/esquerda_conteudo.png' />
			   <?php
					if($countAntiga > 0){
			   ?>				
				</a>
				<?php
					}
				 ?>
			 </div>
			 
		</div>

 	<!--  script Facebook    -->
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
	</script>


		<div id='redesSociaisDosArtigos'>
<!--				<img src='images/rede_twitter.png' />	-->		
					<a href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo @$urlFacebook ;?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
						<img src="images/rede_face.png"  />
					</a>
			

<!--				<img src='images/rede_google.png' /> -->
				<img src='images/rede_gourmand.png' />
		</div>
	</div>

</div><!-- fim divRedesSociais -->

