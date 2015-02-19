<?php require_once('../Connections/mb.php');
$comentario = $_GET['id_comentario'];
mysql_select_db($database_mb, $mb);
$sql = "UPDATE comentarios SET exibir_comentario = 'S' where id_comentario = ". $comentario."";
$permitir = mysql_query($sql, $mb) or die(mysql_error() . "Ocorreu um erro!");

echo "Concluído.";