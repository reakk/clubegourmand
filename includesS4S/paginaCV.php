<?php
/*
 * Created on 07/02/2012
 *
 * created by Renato
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<script language="javascript">
function numeros()
  {
tecla = event.keyCode;
if (tecla >= 48 && tecla <= 57)
    {
    return true;
    }
else
    {
    return false;
    }
  }

function valida(){
        var nome;
		var email;
		var mensagem;

        nome=document.register.nome.value;
		email=document.register.email.value;
		mensagem=document.register.mensagem.value;
        
        if (nome==""){
                alert("Por favor, preencha o campo Nome.");
                document.register.nome.focus();
        return false;
        }

		if (email==""){
                alert("Por favor, preencha o campo Email.");
                document.register.email.focus();
        return false;
        } 

		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.register.email.value))) {
			alert("Necessario o preenchimento de um endereco de e-mail valido.");
			document.register.email.value="";
			document.register.email.focus();
			return false;
		}
		if (mensagem==""){
                alert("Por favor, preencha o campo Mensagem.");
                document.register.mensagem.focus();
        return false;
        }
return true;
}



 </script>

<style>

/* ----------------------------- inicio form contatos ----- */
.m 
{

padding: 0px;
height: auto;
border : 0 solid green;
}

/* Left DIV */
.l
{
width: 180px;
margin: 0px;
padding: 0px; 
float: left;  
text-align: right;
margin-top:5px;
margin-left:-37px;
font-family:tahoma,georgia,arial,helvetica;
font-size:12pt;
}


/* Right DIV */
#r
{
width:350px;
margin: 0px;
padding: 0px; 
float: left; 
text-align: left;
font-family: georgia,arial,helvetica; 
font-size: 12pt;
margin-top:4px;
margin-left:10px;
}

 #r input{
	height:22px;
}

#tamanhoInput{
	
}

#tamanhoInput input{
	width:335px;
}

#tamanhoInput2{
	
}

#tamanhoInput2 input{
	width:30px;
}

#divBtnBusca{
	width: 100px;
	height: 25px;
	position: absolute;
	margin-left: 0px;
	margin-top: 5px;
	border: 0px solid purple;
	background: transparent;
	cursor: hand;
}

#divBtnBusca button{
	background: transparent;
}


.a
{
clear: both;
width: 540px;
padding: 4px;
border : 0 solid green;
font-family: georgia,arial,helvetica; 
font-size: 12pt;
}

.inputFormContato{
  height: 20px; 
  border: 1px solid black;
}

#blocoInicial{
	float:left;
	position:relative;
	width:300px;
	font-family: tahoma,georgia,arial,helvetica; 
	font-size: 12pt;
}

#bloco{
	float:left;
	position:relative;
	width:300px;
	font-family: tahoma,georgia,arial,helvetica; 
	font-size: 12pt;
	margin-top:20px;
}

#blocoFinal{
	float:left;
	position:relative;
	width:580px;
	font-family: tahoma,georgia,arial,helvetica; 
	font-size: 12pt;
	margin-top:20px;
	margin-bottom:50px;
}

#linhas{
	float:left;
	position:relative;
	width:300px;
}

#linhasTitulo{
	float:left;
	position:relative;
	width:300px;
	font-weight:bold;
}

#bloco linhas a{
	text-decoration:none;
	color:black;
}

#linhaFinal{
	float:left;
	position:relative;
	width:580px;
	clear:both;

}

/* ----------------------------- fim form contatos --------*/
</style>

<div id="blocoInicial">
	<div id="linhasTitulo">
		MB Associados
	</div>

	<div id="linhas">
		Av.Brig. Faria Lima, 1.739 - 5&ordm; andar
	</div>

	<div id="linhas">
		Jardim Paulistano - 01452-001
	</div>

	<div id="linhas">
		S&atilde;o Paulo - SP - Brasil
	</div>
</div>


<div id="bloco">
	<div id="linhas">
		Telefone: +55 (11) 3372 1085
	</div>

	<div id="linhas">
		Fax: +55 (11) 3372 1086
	</div>
</div>

<div id="blocoFinal">
	<div id="linhasLink">
		<a style="color:black;text-decoration:none;" href="mailto:contato@mbassociados.com.br"> contato@mbassociados.com.br </a>
	</div>

	<div id="linhaFinal">
		Trabalhe conosco, preechendo corretamente o form&uacute;lario abaixo. Em breve entraremos em contato.
	</div>
</div>

<center>

		
			<div class="m">

				<form name="register" method="post" action="#" onSubmit="return(valida())"  enctype="multipart/form-data" autocomplete="off">

					<div class="a"><div class="l">Nome:</div><div id="r"><div id="tamanhoInput"><INPUT type="text" name="nome" class="inputFormContato" size="51" /><font color="red">&lowast;</font></div></div></div>
					
					<div class="a"><div class="l">Cidade:</div><div id="r"><INPUT type="text" name="cidade" class="inputFormContato" size="27"> <span style="margin-left:14px;" /> 
					Estado: <INPUT type="text" name="estado" class="inputFormContato" size="6" maxlength="2"> </div></div>
					
					<div class="a"><div class="l">Email:</div><div id="r"><div id="tamanhoInput"> <INPUT type="text" name="email" class="inputFormContato" size="51"><font color="red">&lowast;</font></div></div></div>

					<div class="a"><div class="l">Telefone:</div><div id="r"><INPUT type="text" name="digito" class="inputFormContato" size="2" onKeypress="return numeros();" maxlength="2"> <INPUT type="text" name="telefone"  class="inputFormContato" size="22" onKeypress="return numeros();">&nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></div></div>

						
					<div class="a"><div class="l">Telefone Alternativo:</div><div id="r"><INPUT type="text" name="digitoal" class="inputFormContato" size="2" onKeypress="return numeros();" maxlength="2"> <INPUT type="text" name="telefoneal"  class="inputFormContato" size="22" onKeypress="return numeros();">&nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></div></div>

					<div class="a"></div>

					<div class="a"><div class="l">Mensagem:</div><div id="r"><TEXTAREA NAME="mensagem" style="width:335px;height:157px;border: 1px solid black; overflow:hidden; margin-bottom:5px;"></TEXTAREA><font color="red">&lowast;</font></div></div>

					<div class="a"><div class="l">Curr&iacute;culo:</div><div id="r"><input name="arquivo" type="file"></div></div>




					<div class="a"><div class="l">&nbsp;</div>
					<div id="r">
			
							<input type="submit" name="botao" value="" style="background-image:url(http://186.202.139.52/mbnovo/portalB/templates/mbAssociados/images/btnEnviar_contato.jpg); border:0px; width:120px; height:29px; cursor:pointer;" />  <br />
							
							
					</div>
							
			
					</div>
			
				</form>
			</div>
		</center>


<?php 
 
		if(isset($_POST["botao"])){
			//Pega os dados postados pelo formulário HTML e os coloca em variaveis
			if (@preg_match('/tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$/', $_SERVER[HTTP_HOST])) {
				$email_from='trabalhe@italineaindoor.com.br';	// Substitua essa linha pelo seu e-mail@seudominio
			}else {
				@$email_from = "trabalhe@italineaindoor.com.br" . $_SERVER[HTTP_HOST];         

			}
 
 
			if(@PATH_SEPARATOR ==';'){ $quebra_linha="\r\n";
 
				} elseif (PATH_SEPARATOR==':'){ $quebra_linha="\n";
 
				} elseif ( PATH_SEPARATOR!=';' and PATH_SEPARATOR!=':' )  {echo ('Esse script não funcionará corretamente neste servidor, a função PATH_SEPARATOR não retornou o parâmetro esperado.');
 
			}
 

			$nome = $_POST["nome"];
			$cidade = $_POST["cidade"];
			$estado = $_POST["estado"];
			$emailTxt = $_POST["email"];
			$digito = $_POST["digito"];
			$telefone = $_POST["telefone"];
			$digitoal = $_POST["digitoal"];
			$telefoneal = $_POST["telefoneal"];
			$email = "renatodias@staff4solutions.com.br";
			$mensagem = $_POST["mensagem"];
			$nome = $_POST["nome"];
			$assunto = "Envio CV - Email recebido de: " . $nome; 


		$mensagem = wordwrap( $mensagem, 50, "<br>", 1); 
 
		$_UP['extensoes'] = array('pdf', 'doc', 'docx');
 
			$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE; 
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			$size_of_uploaded_file = $_FILES["arquivo"]["size"]/1024;
			
				if(@file_exists($arquivo["tmp_name"]) and !empty($arquivo)){ 
						if(array_search($extensao, $_UP['extensoes']) === false){
							echo "<script>alert('Por favor, envie arquivos somente dos sequintes tipos: PDF (*.pdf) ou MS-Word (*.doc,*.docx)');</script>'";
							echo "<script>parent.location.href='http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3934&id_produto=&id_menu=7479';</script>";
							die();
						}

						if($size_of_uploaded_file >= 1024){
							echo "<script>alert(\"Arquivo anexo excede o máximo permitido de 1MB.\")</script>";
							echo "<script>parent.location.href='http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3934&id_produto=&id_menu=7479';</script>";
							die();
						}
					$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb"); 
						$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); 
							$anexo = base64_encode($anexo); 
 
					fclose($fp); 
 
		$anexo = chunk_split($anexo); 
 
 
				$boundary = "XYZ-" . date("dmYis") . "-ZYX"; 
 
				$mens = "--$boundary" . $quebra_linha . ""; 
				$mens .= "Content-Transfer-Encoding: 8bits" . $quebra_linha . ""; 
				$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $quebra_linha . "" . $quebra_linha . ""; //plain 
				$mens .= "Nome:" . "$nome" . "\n";
				$mens .= "Cidade: " . "$cidade \n";
				$mens .= "Estado: " . "$estado" . $quebra_linha . "";
				$mens .= "Email: " . "$emailTxt" . $quebra_linha . "";
				$mens .= "Telefone: " ."(" . "$digito" . ")" . "$telefone" ."";
				$mens .= "Telefone Alternativo: " ."(" . "$digitoal" . ")" . "$telefoneal" ."";
				$mens .= "Mensagem:" . "$mensagem" . $quebra_linha . "";
				$mens .= "--$boundary" . $quebra_linha . ""; 
				$mens .= "Content-Type: ".$arquivo["type"]."" . $quebra_linha . ""; 
				$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"" . $quebra_linha . ""; 
				$mens .= "Content-Transfer-Encoding: base64" . $quebra_linha . "" . $quebra_linha . ""; 
				$mens .= "$anexo" . $quebra_linha . ""; 
				$mens .= "--$boundary--" . $quebra_linha . ""; 
 
				$headers = "MIME-Version: 1.0" . $quebra_linha . ""; 
				$headers .= "From: $email_from " . $quebra_linha . ""; 
				$headers .= "Return-Path: $email_from " . $quebra_linha . ""; 
				$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"" . $quebra_linha . ""; 
				$headers .= "$boundary" . $quebra_linha . ""; 
 
 
//envia email com anexo

			mail($email,$assunto,$mens,$headers, "-r".$email_from); 
			echo "<script>alert(\"E-mail enviado.\")</script>";
			echo "<script>parent.location.href='http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3934&id_produto=&id_menu=7479';</script>";
 
		} 
 

		else{ 
 
			$headers = "MIME-Version: 1.0" . $quebra_linha . ""; 
			$headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha . ""; 
			$headers .= "From: $email_from " . $quebra_linha . ""; 
			$headers .= "Return-Path: $email_from " . $quebra_linha . ""; 
			$menss=				
								"Nome:\t" .$_POST["nome"]."\n". 
								"Estado:\t" .strtoupper($_POST["estado"])."\n". 
								"Cidade:\t" .$_POST["cidade"]."\n" .
								"Email:\t".$_POST["email"]."\n" . 	
								"Telefone: (" . $_POST["digito"] . ")" .  $_POST["telefone"]. "\n" .
								"Telefone Alternativo: (" . $_POST["digitoal"] . ")" . $_POST["telefoneal"]."\n\n" .
								"Mensagem:\t\n\n" . $_POST["mensagem"] ."\n";
 
//envia o email sem anexo 
			mail($email,$assunto,$menss, $headers, "-r".$email_from); 
			echo "<script>alert(\"E-mail enviado.\")</script>";
			echo "<script>parent.location.href='http://186.202.139.52/mbnovo/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3934&id_produto=&id_menu=7479';</script>"; 
		} 
	}
 
?>