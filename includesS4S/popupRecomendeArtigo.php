<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="author" content="Adriano S.Lago"/>
<meta name="description" content=""/>
<meta http-equiv="pragma" content="no-cache"/> 
<style>
body {
	font-family: "Segoe UI", Arial, Helvetica, sans-serif;
	font-size: 85%;
    background: #ffffff;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	color: #000000;
}

h2 {
	font: normal 30px Arial, Verdana, Helvetica, sans-serif;
	margin: 0 0 0 0;
	text-align: left;
}

#tituloContainerTrocaSenha{
	position:relative;
	width:200px;
	margin:0 auto;
	margin-left:250px;
	margin-top:0px;
	float:left;
	font-size:14pt;
	font-family:georgia,tahoma,arial;
	color:#023F6E;
}

#containerTrocaSenha{
	position:relative;
	width:325px;
	border:1px solid #023F6E;
	margin:0 auto;
	margin-left:180px;
	float:left;
	font-size:10pt;
	font-family:georgia,tahoma,arial;
}

#fraseInicial{
	position:relative;
	clear:both;
	width:250px;
	float:left;
	margin-left:90px;
	margin-top:5px;
}

#linhasTrocaSenha{
	position:relative;
	clear:both;
	float:left;
	width:350px;
	margin-left:10px;
	margin-top:10px;
}

#labelTrocaSenha{
	position:relative;
	float:left;
	width:150px;
	line-height:1.7;
}

#inputTrocaSenha{
	position:relative;
	float:left;
	width:200px;
}

#btnEnviarTrocaSenha{
	position:relative;
	width:100px;
	margin-left:120px;
	margin-top:3px;
	margin-bottom:8px;
}
</style>
</head>
<body>
<script>

function validaEmail(){
	
	if(document.getElementById("email").value == "" || document.getElementById("email").value == null){
		   alert('O endere�o de email � obrigat�rio!');
	       return false;
	}
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email").value))) {
			alert("Necessario o preenchimento de um endereco de e-mail valido.");
			document.getElementById("email").value="";
			document.getElementById("email").focus();
			return false;
		}
	else{
	      document.forms["form"].submit();
	}
}
</script>
<form method="post" name="form" action="../mbnovo/mbAssociados/paginas/email/enviaEmailCron.php">
<table width="100%" border="0" cellspacing="0" cellspadding="0" align="center">

	<tr>
		<td align = center style='background :url(http://www.mbassociados.com.br/images/fundo_cabecalho_fundo.jpg) repeat-x top padding:0;'>
				<img src='http://www.mbassociados.com.br/images/fundo_cabecalho_logo.jpg'   />
		</td>
	</tr>
</table>
<br><br>





		<div align="center">
			Recomende este artigo:
			<br />
			<br />
					Seu nome:
			<br />
					<input type="text" name="nome_remetente" id="nome_remetente" >
			<br />
					Nome do destinat�rio:
			<br />
					<input type="text" name="nome_destinatario" id="nome_destinatario" >
			<br />
					Email Destinatario: 
			<br />
					<input type="text" name="email" id="email" >
			<br />
					<input type=hidden name=idConteudoSelecionado id=idConteudoSelecionado value="<?php echo $id_conteudo; ?>">
			<br />
						<input type="button" value="Enviar" onclick="validaEmail();">
		</div>
</form>
</body>
</html>