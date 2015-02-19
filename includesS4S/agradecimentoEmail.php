<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
$usuario = $_GET['nome'];
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<link href="../templates/mbAssociados/css/template.css" rel="stylesheet" type="text/css" />
<style>
#agradecimentoEmail {
width:400px;
height:100px;
position:absolute;
top:50%;
left:50%;
margin-top:-50px;
margin-left:-200px;
text-align:center;
font-size: 12px;
font-family:Arial;
background-color:transparent;
}
#redir {
	background-color:#CCC;
	border-color:#999;
	text-align:right;
	font-size:10px;
	
}
</style>
<script type="text/javascript">
   
     function Redireciona(tempo, url, onde, msg) {
         var NovaMsg = msg.replace('!tempo', tempo);
         document.getElementById(onde).innerHTML = NovaMsg;
         tempo--;
         if (tempo == -1)
             parent.location.href = url;
         var nr = 'setTimeout("Redireciona(' + tempo + ',\'' + url + '\',\'' + onde + '\',\'' + msg + '\')",1000)';
         eval(nr);
     }
</script>
</head>

<body onload="Redireciona(7,'../index.php','redir','Você será redirecionado em !tempo segundos.');">
	
<div class="agradecimentoemail" id="agradecimentoEmail">
            	
                    Email enviado com sucesso!<br/>
                    Obrigado sr(a) <strong><?php echo $usuario ?></strong>,<br/>        
                    Responderemos suas solicita&ccedil;&otilde;es o mais brevemente  poss&iacute;vel.
          		
                    <br />
                    <div id="redir">...</div>
</div>
  
</body>
</html>