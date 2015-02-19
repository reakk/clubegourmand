    <?php
	require_once('../Connections/mb.php');
    if(!empty($_GET["valor"]))
    {

     
    //SELECIONA O BANCO DE DADOS QUE VAI USAR
    mysql_select_db($database_mb, $mb);
     
    // EXECUTA A INSTRUÇÃO SELECT PASSANDO O QUE O USUARIO DIGITOU
    $sql="select * from usuarios where login like '$_GET[valor]%'";
    $resultado=mysql_query($sql) or die (mysql_error());
     
    //VERIFICA A QUANTIDADE DE REGISTROS RETORNADOS
    $linhas=mysql_num_rows($resultado);
     
    if($linhas>0){
    //EXECUTA UM LOOP PARA MOSTRAR OS NOMES DAS PESSOAS
    // VALE LEMBRAR QUE TODOS ESSES RESULTADOS SERAO MOSTRADOS DENTRO DA PAGINA INDEX.PHP
    // DENTRO DO DIV 'PAGINA'
    /* 
    while($pegar=mysql_fetch_array($resultado))
    echo "$pegar[nome] <br>";
	*/
	echo "<img src='../images/cancel.png'> Indispon&iacute;vel";
    }else{
	echo	"<img src='../images/ok.png'> OK";	
	}
     
    }
    ?> 