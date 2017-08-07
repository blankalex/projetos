<?php

/*include "verifica.php";*/
?>

<?php

include "../adm/conecta.php";
include "../adm/verificalogado.php";

$id_user = $_SESSION['id'];

$sql = (" DELETE FROM usuario WHERE id_user='$id_user' ");
/*echo $sql;*/
$resultado = pg_query($sql);
/*echo $resultado;*/
if (pg_affected_rows($resultado) > 0) {
    
   header("location: ../adm/logout.php");
}
?>