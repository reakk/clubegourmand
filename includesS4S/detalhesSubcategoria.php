<?php

require('../mbnovo/mbAssociados/includes/Conexao.class.php');

		try {
	//'instancia' singleton 
	$Conexao = Conexao :: getInstance();


	$menuQUAL = $_GET['identificacaoMenu'];

	$sql2 = 'SELECT * FROM mbAssociados.home_menu_portal where id_menu_raiz_fk ='.$menuQUAL;
	$result = $Conexao->query($sql2);
	$row2 = $result->fetch_array(MYSQLI_ASSOC); 
	} catch (Exception $e) {
	//se der erro mostra na tela 
	echo $e->getMessage();
	}
			
		for ($j = 0; $j < count($row2); $j++){
			echo '<li><a href="#" title="">'. $row2[$j]["nome"] .'</a></li>';
		}

?>