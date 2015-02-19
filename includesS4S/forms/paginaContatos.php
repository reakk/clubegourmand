<?php
/*
 * Created on 07/02/2012
 *
 * Created by Renato Soares
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	$nome = $_POST['nome'];
	$destino = "anselmo@staff4solutions.com.br";
	

	$assunto =  "Email recebido de: " . $nome;
	
	$mensagem=				
								"Nome:\t" .$_POST["nome"]."\n". 
								"Empresa:\t" .$_POST["empresa"]."\n".
								"Estado:\t" .strtoupper($_POST["estado"])."\n". 
								"Cidade:\t" .$_POST["cidade"]."\n" .
								"Email:\t".$_POST["email"]."\n" . 	
								"Telefone: (" . $_POST[digito] . ")" .  $_POST["telefone"]. "\n" .
								"Telefone Alternativo: (" . $_POST["digitoal"] . ")" . $_POST["telefoneal"]."\n\n" .
								"Mensagem:\t\n\n" . $_POST["mensagem"] ."\n";


	//$header.= " O Usuario \t" . $nome . "\t enviou uma mensagem pela pagina de Contato";
	
?>

<script>
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
		var empresa;
		var email;
		var mensagem;

        nome=document.register.nome.value;
		empresa=document.register.empresa.value;
		email=document.register.email.value;
		mensagem=document.register.mensagem.value;
        
        if (nome==""){
                alert("Por favor, preencha o campo Nome.");
                document.register.nome.focus();
        return false;
        }

		if (empresa==""){
                alert("Por favor, preencha o campo Empresa.");
                document.register.empresa.focus();
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

</script><head>
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" href="niceforms-default.css" />

</head>

		
			

<div class="m">
</br>
</br>
<form name="register" class="niceform" method="post" action="#" onSubmit="return(valida())" autocomplete="off">
  
<div class="a"><div class="l">
  <table width="350" border="0" align="center">
    <tr>
      <td align="right" valign="top">Nome:</td>
      <td align="left" valign="top"><input type="text" name="nome" class="inputFormContato" size="51" />
        <font color="red">&lowast;</font></td>
    </tr>
    <tr>
      <td align="right" valign="top">Empresa:</td>
      <td align="left" valign="top"><input type="text" name="empresa"   class="inputFormContato" size="51"/>
        <font color="red">&lowast;</font></td>
    </tr>
    <tr>
      <td align="right" valign="top">Cidade:</td>
      <td align="left" valign="top"><input type="text" name="cidade" class="inputFormContato" size="27" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Estado:</td>
      <td align="left" valign="top"><input type="text" name="estado" class="inputFormContato" size="6" maxlength="2" onkeyup="up()" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Email:</td>
      <td align="left" valign="top"><input type="text" name="email" class="inputFormContato" size="51" />
        <font color="red">&lowast;</font></td>
    </tr>
    <tr>
      <td align="right" valign="top">Telefone:</td>
      <td align="left" valign="top"><input type="text" name="digito" class="inputFormContato" size="2" onkeypress="return numeros();" maxlength="2" />
        <input type="text" name="telefone" class="inputFormContato" size="22" onkeypress="return numeros();" />
        &nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Telefone Alternativo:</td>
      <td align="left" valign="top"><input type="text" name="digitoal" class="inputFormContato" size="2" onkeypress="return numeros();" maxlength="2"  />
        <input type="text" name="telefoneal" class="inputFormContato" size="22" onkeypress="return numeros();" />
        &nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></td>
    </tr>
    <tr>
      <td align="right" valign="top">Mensagem:</td>
      <td align="left" valign="top"><textarea name="mensagem" style="width:335px;height:157px;border: 1px solid black; overflow:hidden; margin-bottom:5px;"></textarea>
        <font color="red">&lowast;</font></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td align="left" valign="top"><span style="margin-left:-3px;" /></span>
        <input type="checkbox" name="check" value="1" />
        <span style="font-family: tahoma,georgia,arial,helvetica; font-size: 12pt;" /></span> Desejo receber uma c&oacute;pia desta mensagem</td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td align="left" valign="top"><input type="submit" name="botao" value="enviar"  onsubmit="return(valida())"/></td>
    </tr>
  </table>
  </form>
			</div>



		
<?php 
								if(isset($_POST["botao"])){

										if (isset($_POST["check"]))
												$destino .= ",".$_POST["email"];

											
												
											mail($destino,$assunto,$mensagem,"From: MB Associados <contato@mbassociados.com.br>\n\n");/*
											echo "<script>alert(\"E-mail enviado.\")</script>";
											echo "<script>parent.location.href='http://186.202.139.52/mbnovo2/portalB/index.php?option=com_content&view=article&id=46&id_conteudo=3161&id_produto=&id_menu=7364';</script>";

*/										

											echo "<script>this.location.href='../agradecimentoEmail.php?nome=".$nome."';</script>";

											
								}
								
							
?>