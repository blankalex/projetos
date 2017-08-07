<?php 

include '../adm/conecta.php';
session_start();

if(isset($_POST['aceitar_convite'])){
    
        $id_jogo_user = $_SESSION['id_jogo_user'];

        /*$sql_usuario = "select * from usuario join jogo_user using(id_user) where id_user = $id_jogo_user";
        $resultado_usuario = pg_query($conexao, $sql_usuario);
        $registro_usuario = pg_fetch_array($resultado_usuario); */

        $id_user = $_SESSION['id'];
        
        $status = 1;
        $status_membro = 1;
        $id_equipe_convite = $_POST['id_equipe_convite'];
        
        $sql_update = "UPDATE solicitacao SET status=$status WHERE id_jogo_user=$id_jogo_user";
        $resultado_update = pg_query($conexao, $sql_update);
    
        $sql_aceitar = "INSERT INTO membros (id_user, id_equipe, status_membro) VALUES ('$id_user', '$id_equipe_convite', '$status_membro')";
        $resultado_aceitar = pg_query($conexao, $sql_aceitar);
    
    
     if ($resultado_aceitar) {
                
                ?>
                <script>alert("Convite aceito com sucesso!");</script>

                <?php
                
                    echo "<script>location.href='notificacoes.php';</script>";
                    
                ?>

                <?php

            } else {
                echo "<script>alert('Convite não aceito!');</script>";
            }
}




if(isset($_POST['cancelar_convite'])){
        $id_jogo_user_cancelar = $_SESSION['id_jogo_user'];

        $id_user_cancelar = $_SESSION['id'];
                     
        $sql_delete_recusar = "DELETE FROM solicitacao where id_jogo_user = $id_jogo_user_cancelar ";
        $resultado_delete_recusar = pg_query($conexao, $sql_delete_recusar);
    
        
    
     if ($resultado_delete_recusar) {
                
                ?>
                <script>alert("Convite Recusado!");</script>

                <?php
                
                    echo "<script>location.href='notificacoes.php';</script>";
                    
                ?>

                <?php

            } else {
                echo "<script>alert('ERRO!');</script>";
            }
}

?>