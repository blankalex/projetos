<?php
include 'verificalogado.php';
include 'conecta.php';


if(isset($_POST['enviar'])){
    $nome_jogo = $_POST['nome_jogo'];
    
    $sql_jogos = "INSERT INTO jogos (nome_jogo) VALUES ('$nome_jogo')";
    
    $resultado_jogos = pg_query($conexao, $sql_jogos);
    
    if($resultado_jogos){
        ?>
            <script>alert("Jogo Cadastrado!");</script>
        <?php
            echo "<script>location.href='cadastrar_jogo.php';</script>";
            
    }else{
        ?>
            <script>alert("Não foi possivel cadastrar o jogo no banco!");</script>
        <?php
    }
}
?>