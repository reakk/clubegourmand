<?php require_once('Connections/mb.php'); 
//include('includesS4S/funcoesGerais.php');
?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_mb, $mb);
$query_banner = "SELECT c.*,b.*,ct.descricao_resumo,cc.nome as nome_conteudo FROM banner_conteudo c inner join banner b on c.id_banner_fk = b.id_banner  ";
$query_banner .= " inner join conteudos ct on c.id_conteudo_fk = ct.id_conteudo ";
$query_banner .= " inner join conteudos cc on c.id_conteudo_fk = cc.id_conteudo ORDER BY c.id_banner_conteudo ASC ";
$banner = mysql_query($query_banner, $mb) or die(mysql_error());
$row_banner = mysql_fetch_assoc($banner);
$totalRows_banner = mysql_num_rows($banner);
?>
<script type="text/javascript" src="templates/mbAssociados/js/jquery.cycle.all.js"></script>


<script>
	    $(document).ready(function(){  
        $('#slide_fotos').cycle({  
        fx:'<?php echo $row_banner['efeito_banner'];?>',
        timeout: <?php echo $row_banner['tempo'];?>,
            pager: '#pager',
        });  
		$('#pause').click(function() {
            $('#slide_fotos').cycle('pause');
        });
        $('#play').click(function() {
            $('#slide_fotos').cycle('resume');
        });
    });  

/******************************opcoes de "fx"

    blindX
    blindY
    blindZ
    cover
    curtainX
    curtainY
    fade
    fadeZoom
    growX
    growY
    none
    scrollUp
    scrollDown
    scrollLeft
    scrollRight
    scrollHorz
    scrollVert
    shuffle
    slideX
    slideY
    toss
    turnUp
    turnDown
    turnLeft
    turnRight
    uncover
    wipe
    zoom
****************************************************/



</script>

	  
        <ul id="slide_fotos">  

			<?php do { ?>

			<li>
				
				<div id='ladoFotoDestaqueConteudo'>
            	<?php if(empty($row_banner['link_banner'])){ //tirando o href caso o link seja vazio?>
                
					<img src="imagensBanner/<?php echo $row_banner['imagem_banner']; ?>" alt="" title="<?php echo $row_banner['texto_banner']; ?>" />
                    
                <?php }else{  ?>
                
                        <a href="<?php echo $row_banner['link_banner']; ?>" target="_blank">
                              <img src="imagensBanner/<?php echo $row_banner['imagem_banner']; ?>" alt="" title="<?php echo $row_banner['texto_banner']; ?>" />
                        </a>
                        
				<?php }?>
				</div>
					<div id='titulosConteudoDireito'>
					  
					  <div id='tituloContDest'>
						<?php 
							$nome = $row_banner['nome_conteudo']; 
							echo $nome;
						?>	
					  </div>
					  
					  <div id='conteudoExtContDir'>
						<?php 
							$descricaoResumido = formataDescricaoResumo($row_banner['descricao_resumo'],'',$row_banner['id_conteudo_fk']); 
							$resumirDescricao = strlen($descricaoResumido);
							echo "<div id='formatacaoDescricaoResumoArtigo'>";
								if($resumirDescricao > 200){
									echo substr(formataDescricaoResumo($row_banner['descricao_resumo'],'',$row_banner['id_conteudo_fk']),0,200)."...";
									
								} else {
									echo formataDescricaoResumo($row_banner['descricao_resumo'],'',$row_banner['id_conteudo_fk']);
								}						
							
						?>	
					  </div>
					  
					</div>
					
					
					
       	      </li>

					



			  
        	  <?php } while ($row_banner = mysql_fetch_assoc($banner)); ?>

        </ul><!-- /fotos -->  
							<div id='pagersTotais'>
								<div id="pager">

								</div><!-- /pager -->
								<div id='pagerPausePlay'>
									<a href='#' id='pause'>&ndash;</a>
									<a href='#' id='play'>&#8227;</a>
								</div>
							</div>


    


	<!-- CSS DO BANNER ------------------------------------------------->

<style>
#ladoFotoDestaqueConteudo{
	float:left;
	width:490px;
	min-width:490px;
	height:100%;
	min-height:100%;
	border-right:1px solid #B7AFA0;
}

#ladoFotoDestaqueConteudo img{
	width:490px;
	height:100%;
	min-height:100%;
	float:left;
}

@media screen and (-webkit-min-device-pixel-ratio:0) { #ladoFotoDestaqueConteudo img{margin-top: -17px;} }

#slideshow {  
    width: 100%;  
    height:100%;
    position: relative;  
} 

#slide_fotos {  
	width:95%;
	margin-top:2px;
    overflow: hidden;  
	list-style:none;
	height:100%;
}  

#titulosConteudoDireito{
	height:140px;
	min-height:140px;
	float:right;
	width:230px;
	min-width:230px;
	padding-left:20px;
	padding-top:10px;
}

#tituloContDest{
	font-family:verdana,georgia,arial;
	font-size:12px;
	font-weight:bold;
	color:black;
}

#conteudoExtContDir{
	font-family:verdana,georgia,arial;
	font-size:11px;
	color:black;
}

#pagerPausePlay{
	position:relative;
	display:table-cell;
	z-index:10000;
}

#pagerPausePlay a{
    color: #000;  
    width: 17px;  
    height: 17px;  
    line-height: 15px;  
    text-align: center;  
    float:left;  
    font-size: 13px;  
	font-weight:bold;
    margin: 2px;
	border:1px solid gray; 
	text-decoration:none;
}

#pagerPausePlay a:active{ 
	font-weight:bold;
    color: #000;  
    background-color:#CCC;  
} 

#pagerPausePlay a:hover{
	font-weight:bold;
    color: #000;  
    background-color:#CCC;  
}

#pagersTotais{
	float:right;
	margin-right:40px;
	margin-top:-50px;
	z-index:10000;
	width:190px;
}

#pager {   
	position:relative;
	z-index:10000;
	float:left;
}  

#pager a {  
    color: #000;  
    width: 17px;  
    height: 17px;  
    line-height: 15px;  
    text-align: center;  
    display: inline-block;  
    font-size: 10px;  
    margin: 2px;
	border:1px solid gray;    
}  
#pager a:hover {  
     background-color: #999;
    
}  
#pager a.activeSlide { 
	font-weight:bold;
    color: #000;  
    background-color:#CCC;  
} 
</style>
<?php
mysql_free_result($banner);
?>
