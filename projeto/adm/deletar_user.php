<?php
include "verificalogado.php";
include "conecta.php";


$id_user = $_GET['id_user'];


$sql = (" DELETE FROM usuario WHERE id_user='$id_user' ");
/*echo $sql;*/
$resultado = pg_query($sql);
/*echo $resultado;*/
if (pg_affected_rows($resultado) > 0) {
    
    //echo"<script>if (window.confirm ('Deseja realmente excluir?')){window.alert('Excluido')}else{window.alert('Não Excluido')}</script>";
    header("location: usuarios_cadastrados.php");
    //echo "<script>alert('Excluido!')</script>";
}
?>