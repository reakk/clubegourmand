<?php


/*
 * Created on 15/01/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

//echo ' <div class="divRedesSociais">'; 

//echo '</div>';
?>

<?php

$server = $_SERVER['SERVER_NAME'];
$endereco = $_SERVER['REQUEST_URI'];
$urlatual = "http://" . $server . $endereco;
?>

<script language="Javascript" type="text/Javascript">


var tagAlvo = new Array('p','div','span'); //pega todas as tags p//
 
// Especificando os possíveis tamanhos de fontes, poderia ser: x-small, small...
//var tamanhos = new Array( '9px','10px','11px','12px','13px','14px','15px' );
var tamanhos = new Array( 'xx-small','x-small','small','medium','large','x-large','xx-large' );
var tamanhoInicial = 2;
 
function mudaTamanho( idAlvo,acao ){
  if (!document.getElementById) return
  var selecionados = null,tamanho = tamanhoInicial,i,j,tagsAlvo;
  tamanho += acao;
  if ( tamanho < 0 ) tamanho = 0;
  if ( tamanho > 6 ) tamanho = 6;
  tamanhoInicial = tamanho;
  if ( !( selecionados = document.getElementById( idAlvo ) ) ) selecionados = document.getElementsByTagName( idAlvo )[ 0 ];
  
  selecionados.style.fontSize = tamanhos[ tamanho ];
  
  for ( i = 0; i < tagAlvo.length; i++ ){
    tagsAlvo = selecionados.getElementsByTagName( tagAlvo[ i ] );
    for ( j = 0; j < tagsAlvo.length; j++ ) tagsAlvo[ j ].style.fontSize = tamanhos[ tamanho ];
  }
}


</script>
 	<!--  script Facebook    -->
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
	</script>

<script>
  // Metodo para abrir um popup centralizado na tela      
  // * adriano.lago 26/04/2012       
  function PopupCenter(pageURL, title,w,h){
  	    var left = (screen.width/2)-(w/2);
  	    var top = (screen.height/2)-(h/2);  
  	    var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width='+w+', height='+h+', top='+top+', left='+left);  
  }
</script>

<div class="divRedesSociais">



<div class="btnTwitter">
  
  <?php $tituloTwitter = substr($nome,0,80); ?>
  
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo getUrlTwitter($idConteudo); ?>" data-text="<?php echo $tituloTwitter; ?>" data-lang="en">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


</div><!-- fim btnTwitter -->


<div class="btnLike">
	
    	<a name="fb_share">Compartilhar</a> 
	
    

	
</div><!-- fim btnLike -->



<div class="btnLinkedIn">

			 
			<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/Share" data-url="<?php echo $urlatual;?>"></script>
</div><!-- fim btnLinkedIn -->
<?php
if (count($rowConteudo) > 0) {
	if ($acessoAutorizado > 0) {
?>
	<div class="divMail">
		<a href="#" style="cursor:hand" onclick="PopupCenter('includesS4S/popupRecomendeArtigo.php?id_conteudo=<?php echo $rowConteudo[0]['id_conteudo']?>','myPop1',650,350);">  
			<img src="templates/mbAssociados/images/emailButton.png" />
		</a>
	</div>
<!-- fim divmail -->
<?
	}
}	
?>


<div class="divBtnAumentaFont">
      <img src=images/fonteMaisMenos.png border=0 usemap="#fonte" style="margin-top:5px">
	  <map name="fonte">
		<area alt="" coords="1,0,28,20" href="#" onclick="javascript:mudaTamanho('textoArtigo',1)" shape="RECT">
		<area alt="" coords="29,1,53,20" href="#" onclick="javascript:mudaTamanho('textoArtigo',-1)" shape="RECT">
	  </map>

</div><!-- fim divBtnAumentaFont -->
<?php
if (count($rowConteudo) > 0) {
	if ($acessoAutorizado > 0) {
?>
<div class="divBtnImprimePDF">
   <a href="includesS4S/printPdfArtigo.php?id_conteudo=<?php echo $rowConteudo[0]['id_conteudo']?>">
     <img src=images/iconPdf.png border=0 style=margin-left:5px;margin-top:5px></a>

   <a href="#" onclick="PopupCenter('includesS4S/executaBtnImprimeArtigo.php?id_conteudo=<?php echo $rowConteudo[0]['id_conteudo']?>','myPop1',650,550);"  ><img src=images/iconPrint.png border=0 style='margin-left:5px;margin-top:5px;margin-right:5px;cursor:hand'></a> 
</div><!-- fim divBtnImprimePDF -->

<?php
	}
}
?>
</div><!-- fim divRedesSociais -->

