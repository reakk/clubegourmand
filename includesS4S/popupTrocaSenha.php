<?php
require "/var/www/mbnovo/phpmailer/class.phpmailer.php";
require_once '/var/www/mbnovo/portalB/mbnovo/mbAssociados/includes/Conexao.class.php';
?>
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
	width:150px;
	margin:0 auto;
	margin-left:265px;
	margin-top:15px;
	float:left;
	font-size:14pt;
	font-family:georgia,tahoma,arial;
	color:#023F6E;
}

#containerTrocaSenha{
	position:relative;
	width:300px;
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
	margin-left:80px;
	margin-top:5px;
}

#linhasTrocaSenha{
	position:relative;
	clear:both;
	float:left;
	width:340px;
	margin-left:10px;
	margin-top:10px;
}

#labelTrocaSenha{
	position:relative;
	float:left;
	width:130px;
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
	margin-left:110px;
	margin-top:3px;
	margin-bottom:8px;
}
</style>
</head>

<body>
<script>

function valida(){
	
	if(document.getElementById("email").value == "" || document.getElementById("email").value == null){
		   alert('O endereço de email é obrigatório!');
	       return false;
	}

	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email").value))) {
			alert("Necessario o preenchimento de um endereco de e-mail valido.");
			document.getElementById("email").value="";
			document.getElementById("email").focus();
			return false;
	}
	
	if(document.getElementById("senha_atual").value == "" || document.getElementById("senha_atual").value == null){
		   alert('Senha atual é obrigatório!');
	       return false;
	}
	
	if(document.getElementById("nova_senha").value == "" || document.getElementById("nova_senha").value == null){
		   alert('Nova senha é obrigatório!');
	       return false;
	}

	if(document.getElementById("nova_senha_conf").value == "" || document.getElementById("nova_senha_conf").value == null){
		   alert('Nova senha confirmação é obrigatório!');
	       return false;
	}

	if(document.getElementById("nova_senha_conf").value != document.getElementById("nova_senha").value){
		   alert('Senha de confirmação não confere com a nova senha');
	       return false;
	}
	

    document.forms["form"].submit();
}
</script>
<form method="post" name="form" action="popupTrocaSenha.php?operacao=processaTroca">
<table width="100%" border="0" cellspacing="0" cellspadding="0" align="center">

	<tr>
		<td align = center style='background :url(http://www.mbassociados.com.br/images/fundo_cabecalho_fundo.jpg) repeat-x top padding:0;'>
				<img src='http://www.mbassociados.com.br/images/fundo_cabecalho_logo.jpg'   />
		</td>
	</tr>
</table>
<br><br>

<?php
if(@$operacao == "processaTroca"){
	
try {
	//'instancia' singleton 
	$Conexao = Conexao :: getInstance();

	////////// INICIO CONSULTA REGISTROS GRID////////////////
	//submete a consulta ao banco 

    $sql = "select id_usuarios, email, senha from  mbassociados.usuarios where status = 'A' and LOWER(email) = lower('$email') and senha = '$senha_atual' ";

	$result = $Conexao->query($sql);
	$totalLinhas = $result->num_rows;
	
	if($totalLinhas > 0){
			$queryUpdate = "update mbassociados.usuarios set senha = '$nova_senha' where LOWER(email) = lower('$email') and senha = '$senha_atual'";
			$result = $Conexao->query($queryUpdate);

	  		echo "<br><br><br><div align=center> Sua senha foi atualizada com sucesso! <br><br>";
	  		echo "<a href='#' onclick=window.close();>Fechar</a></div>";
		
	}else{
	  		echo "<br><br><br><div align=center> Email não localizado na base de dados e/ou usuário com acesso inativo. <br><br>";
	  		echo "<a href='#' onclick=history.back();>Voltar</a></div>";
	}

	//fecha a conexao 
	$Conexao->close();
} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
}	
	die();
}
?>
	
	<div align="center" style="margin-top:20px;">
		Troca de Senha.Digite os dados abaixo:
			<br />
			<br />
				Email:
			<br />	
				<input type="text" name="email" id="email" >
			<br />	
				Senha atual:
			<br />
				<input type="password" name="senha_atual" id="senha_atual" >
			<br />	
				Nova Senha:
			<br />		
				<input type="password" name="nova_senha" id="nova_senha" >
			<br />	
				Confirme a Senha: 
			<br />
				<input type="password" name="nova_senha_conf" id="nova_senha_conf" >
			<br />
			<br />
				<input type="button" value="Enviar" onclick="valida();">
	</div>
</form>
</body>
</html>