<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
	background-color: #ebebeb;
}

h2 {
	font: normal 30px Arial, Verdana, Helvetica, sans-serif;
	margin: 0 0 0 0;
	text-align: left;
}
</style>
</head>
<body>
<script>

function validaEmail(){
	
	if(document.getElementById("email").value == "" || document.getElementById("email").value == null){
		   alert('O endereço de email é obrigatório!');
	       return false;
	}else{
	      document.forms["form"].submit();
	}
}
</script>
<form method="GET" name="form" action="emailRecomendaPagina.php">
<table width="100%" border="0" cellspacing="0" cellspadding="0" align="center">

	<tr>
		<td align = center>
				<img src='../templates/mbAssociados/images/s4s_images/elementos/header-object.png'   />
		</td>
	</tr>
</table>
<br><br>





<div align="center"><br />
Seu nome <br><input type="text" name="nome_remetente" id="nome_remetente" >
<br>
Nome do destinatário <br><input type="text" name="nome_destinatario" id="nome_destinatario" >
<br>
Email Destinatario <br><input type="text" name="email" id="email" >
<br>
<input type="button" value="Enviar" onclick="validaEmail();">
</div>
</form>
</body>
</html>