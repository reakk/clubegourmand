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


include ('Conexao.class.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	$nome = $_POST['nome'];
	$destino = "renatodias@staff4solutions.com.br";
	

	$assunto =  "Email recebido de: " . $nome;
	
	$mensagem=				
								"Nome:\t" .$_POST["nome"]."\n". 
								"Email:\t".$_POST["email"]."\n" . 	
								"Telefone: (" . $_POST[digito] . ")" .  $_POST["telefone"]. "\n" .
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


        nome=document.register.nome.value;
		email=document.register.email.value;
		
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
		document.register.check.value='ok';
	
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
font-family:verdana,georgia,arial;
font-size:12px;
color:#916635;
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






/* ----------------------------- fim form contatos --------*/
</style>


<center>
		
			<div class="m">

				<form name="register" method="post" action="#" onSubmit="return(valida())" autocomplete="off">
				   <input type='hidden' name='check' value='false'/>

					<div class="a"><div class="l">Nome:</div><div id="r"><INPUT type="text" name="nome" maxlength="2000" style='border:1px solid #916635;border-radius:20px;' size="51" /></div></div>
					
					<div class="a"><div class="l">Email:</div><div id="r"> <INPUT type="text" name="email" maxlength="2000" style='border:1px solid #916635;border-radius:20px;' size="51"></div></div>

					<div class="a"><div class="l">Telefone:</div><div id="r"><INPUT type="text" name="digito" maxlength="2" class="inputFormContato" size="2" onKeypress="return numeros();" maxlength="2" style='border:1px solid #916635;border-radius:20px;' /> <INPUT type="text" name="telefone" maxlength="18" class="inputFormContato" size="22" style='border:1px solid #916635;border-radius:20px;' onKeypress="return numeros();"></div></div>

					<div class="a"></div>

					<div class="a"><div class="l">&nbsp;</div>
					<div id="r">
			
							<input type="submit" name="botao" value="Registrar" style="background:#E8E5E1;border-radius:10px;border:1px solid #916635; width:85px; height:20px;resize:none;cursor:pointer;color:#916635;" onSubmit="return(valida())"/>  <br />
							
							
					</div>
							
			
					</div>
			
				</form>
			</div>
		</center>


		
<?php 
	if(isset($_POST["botao"])){


			if ((isset($_POST["check"])) &&($_POST["check"]=='ok'))
														
														
				try {
					//'instancia' singleton 
					$Conexao = Conexao :: getInstance();

					//submete a consulta ao banco
					$sql = "select * from  participantes_news_letter where email ='".$_POST["email"]."'";
					$result = $Conexao->query($sql);
					//percorre o objeto mysqli_result retornado (array associativo) 

					//echo $sql;
					if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
							echo "<script>alert('Email ".$_POST["email"]." ja cadastrado!');</script>";
					}else{
							$sql = " INSERT INTO portal_gourmand.participantes_news_letter ";
							$sql .= "(nome, email, fone, data_criacao) ";
							$sql .= " VALUES ('".$_POST["nome"]."', '".$_POST["email"]."', '".$_POST["digito"].$_POST["telefone"]."', now())";
							$result = $Conexao->query($sql);
							echo "<script>alert('Registro efetuado com sucesso!');</script>";

					}

					//fecha a conexao 
					$Conexao->close();
				} catch (Exception $e) {
					//se der erro mostra na tela 
					echo $e->getMessage();
				}

				//echo "<script>this.location.href='agradecimentoEmail.php?nome=".$nome."';</script>";


				
	}
	
							
?>