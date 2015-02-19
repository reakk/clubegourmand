<?php require_once('../Connections/mb.php'); 

	$comentario = $_GET['comentario'];

  $deleteSQL = "DELETE FROM comentarios WHERE id_comentario=$comentario";

  mysql_select_db($database_mb, $mb);
  $Result1 = mysql_query($deleteSQL, $mb) or die(mysql_error());
  ?>
<script>
//parent.location.reload(true); // this does not work
self.close();
</script>