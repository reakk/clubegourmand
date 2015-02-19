<?php
/*
 * Created on 07/02/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script>
  // Metodo para abrir um popup centralizado na tela      
  // * adriano.lago 26/04/2012       
  function PopupCenterLogin(pageURL, title,w,h){
  	    var left = (screen.width/2)-(w/2);
  	    var top = (screen.height/2)-(h/2);  
  	    var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width='+w+', height='+h+', top='+top+', left='+left);  
  }
</script>
<?php


echo '	 <div id="divLoginAcessoHome" class = "divLoginAcessoHome">';
?>
<div align=right><a href="#" style='cursor:hand' onclick='showLoginHome()'> <image src='templates/mbAssociados/images/iconClose.png' /></a></div>
    <input type="text" id="loginHome" class="txtLoginHome" value='' onkeypress="if(event.keyCode==13) {efetuaLoginHome();}" /> 
    <input type="password" id="senhaHome" class="txtSenhaHome" value='' onkeypress="if(event.keyCode==13) {efetuaLoginHome();}" />
	
	
    
    
   <a href="#"onclick="efetuaLoginHome();" style='cursor:hand'> <div class="divBtnEntrarHome"> </div></a>
   <a href="http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3161&id_produto=0&id_menu=7479" style='cursor:hand'> <div class="divSaibaMaisLoginHome"> </div></a>
   <br>
  
   
   
	 <div id="btnsSenhas">
		<div id="btnTrocarSenha">
			<a href="#" onclick="PopupCenterLogin('includesS4S/popupTrocaSenha.php','myPop1',650,450);" style='cursor:hand'>
				<img src='templates/mbAssociados/images/botaoTrocarSenha.png' />
			</a>
		</div>

   <a href="#" onclick="PopupCenterLogin('includesS4S/popupEsqueciSenha.php','myPop1',650,350);" style='cursor:hand'>
	<img src='templates/mbAssociados/images/botaoEsqueciSenha.png' />
   </a>
   </div>   
<?php


echo '  </div>';
?>