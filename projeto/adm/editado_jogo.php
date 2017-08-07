<?php
include 'verificaadm.php';
include 'verificalogado.php';
include 'conecta.php';

$id_jogo = $_POST['id_jogo'];
$nome_jogo = $_POST['nome_jogo'];

$sql = "UPDATE jogos SET nome_jogo='$nome_jogo' WHERE id_jogo=$id_jogo";

$resultado = pg_query($conexao, $sql);

if(pg_affected_rows($resultado)>0){
    header("location: cadastrar_jogo.php");
}

?>