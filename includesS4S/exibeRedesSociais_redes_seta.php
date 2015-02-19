
<?php 
	


	$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url = explode("&id_conteudo=", $url);
	$novaUrl = $url[0]."&id_conteudo=".$nova;

	$urlFacebook ='http://' . $_SERVER['HTTP_HOST'].'/t.php?p='.$_GET["id_conteudo"];
			
	if(strlen($url[1]) > 2){
		$parteFaltante = substr($url[1],2,strlen($url[1]));
		$novaUrl = $novaUrl.$parteFaltante;
	}

	$urlAntiga = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$urlAntiga = explode("&id_conteudo=", $urlAntiga);
	$antigaUrl = $urlAntiga[0]."&id_conteudo=".$antiga;
			
	if(strlen($urlAntiga[1]) > 2){
		$parteFaltanteAntiga = substr($url[1],2,strlen($url[1]));
		$antigaUrl = $antigaUrl.$parteFaltanteAntiga;
	}




$server = $_SERVER['SERVER_NAME'];
$endereco = $_SERVER['REQUEST_URI'];
$urlatual = "http://" . $server . $endereco;

?>

  

<div class="divRedesSociais">
   
	<div id='proximasPaginasExibeArtigo'>
		<div id='nextArtigoPaginaArtigo'>

			 <div id='antigasNextPagina'>
			 <?php
				if($countAntiga > 0){
			 ?>
				<a href='#' onclick='location="<?php echo $antigaUrl; ?>"'>
			 <?php
				}
			 ?>
				  <div style='float:left;'>
					antigas
				  </div>
					<img src='images/direita_conteudo.png' />
			 <?php
				if($countAntiga > 0){
			 ?>
				</a>
			 <?php
				}
			 ?>
			 </div>

			 <div id='novasNextPagina'>
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
					<img src='images/esquerda_conteudo.png' />
			   <?php
					if($countNova > 0){
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

