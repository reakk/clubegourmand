<?php


	$nome = $_POST['nome'];
	$destino = "renatoz_dias@hotmail.com";
	$assunto =  "Email recebido de: " . $nome;
	
	$mensagemtoda= "<html>
						<head>
							<title> Novo email recebido 	</title>
						</head>
						safasfasfasfasfasfasfas
							<body>
								Sua empresa:"	. 	$_POST['empresa'] .
							   "Seu estado:" 	. 	$_POST["estado"]. 
								"Sua Cidade:" 	. 	$_POST["cidade"].
								"Seu email:" 	.	$_POST["email"].
								"Seu telefone: (" . 	$_POST["digito"] . ")" .  $_POST["telefone"];
								if ($digitoal != null)
									if ($telefoneal !=null)
										"Seu telefone Alternativo: (" .$_POST["digotal"] . ")" . $_POST["telefoneal"].
										
								"Sua Mensagem:" . $_POST["mensagem"].
								 
								
								
							"</body>
							 </html>";
	

	 
?>

		<center>

		
			<div class="m">

				<form name="register" method="post" action="#">

					<div class="a"><div class="l">Nome:</div><div id="r"><div id="tamanhoInput"><INPUT type="text" name="nome" class="inputFormContato" size="51" /></div></div></div>
					
					<div class="a"><div class="l">Empresa:</div><div id="r"><div id="tamanhoInput"><INPUT type="text" name="empresa"   class="inputFormContato" size="51"/></div></div></div>

					<div class="a"><div class="l">Cidade:</div><div id="r"><INPUT type="password" name="cidade" class="inputFormContato" size="29"> <span style="margin-left:14px;" /> 
					
					Estado: <INPUT type="password" name="estado" class="inputFormContato" size="6"> </div></div>

					<div class="a"><div class="l">Email:</div><div id="r"><div id="tamanhoInput"> <INPUT type="text" name="email" class="inputFormContato" size="51"></div></div></div>

					<div class="a"><div class="l">Telefone:</div><div id="r"><INPUT type="text" name="digito" class="inputFormContato" size="2"> <INPUT type="text" name="telefone" class="inputFormContato" size="22">&nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></div></div>

					<div class="a"><div class="l">Telefone Alternativo:</div><div id="r"><INPUT type="text" name="digitoal" class="inputFormContato" size="2"> <INPUT type="text" name="telefoneal" class="inputFormContato" size="22">&nbsp;&nbsp;<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: 10pt;">(apenas n&uacute;meros)</span></div></div>

					<div class="a"></div>

					<div class="a"><div class="l">Mensagem:</div><div id="r"><TEXTAREA NAME="mensagem" style="width:335px;height:157px;border: 1px solid black; overflow:hidden; margin-bottom:5px;"></TEXTAREA></div></div>

					<div class="a"></div>

					<div class="a"><div class="l">&nbsp;</div><div id="r"><span style="margin-left:-3px;" /><INPUT type="checkbox" name="concordo" value="1"><span style="font-family: tahoma,georgia,arial,helvetica; font-size: 12pt;" />  Desejo receber uma c&oacute;pia desta mensagem</div></div>

					<div class="a"></div>

					<div class="a"><div class="l">&nbsp;</div><div id="r">
			
							<a href="#" style="cursor:hand;"> <input type="submit" value="Enviar Email" name="submit" />  </a> </div>
			
					</div>
			
				</form>
			</div>
		</center>
		
	<?php 
			
			

		mail($destino,$assunto,$mensagemtoda,"Renato");
	?>