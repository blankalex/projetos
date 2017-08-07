<?php

include 'verifica.php';
include 'conecta.php';

$id_jogo = $_GET['id_jogo'];

$sql = "DELETE FROM jogos WHERE id_jogo='$id_jogo'";

$resultado = pg_query($conexao, $sql);

if(pg_affected_rows($resultado)>0){
    header("location: cadastrar_jogo.php");
}

?>