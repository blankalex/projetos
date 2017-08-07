<?php 

include '../adm/conecta.php';

if(isset($_POST['enviar_convite'])){
    $id_jogo_user = $_POST['id_jogo_user'];
    $id_equipe2 = $_POST['id_equipe2'];
    $descricao = $_POST['descricao'];
    $data_solicitacao = date("Y-m-d"); 
    $tipo = 1;
    $status = 0;
    $tamanho_vetor_id = sizeof($id_jogo_user);
    
    for($i=0; $i<$tamanho_vetor_id; $i++){
        $id_jogo_user_vetor = $id_jogo_user[$i];
        
       
        $sql = "INSERT INTO solicitacao (id_jogo_user, id_equipe, descricao, data_solicitacao, tipo, status) VALUES ('$id_jogo_user_vetor', '$id_equipe2', '$descricao', '$data_solicitacao', '$tipo', '$status')";
        
        $resultado = pg_query($conexao, $sql);
    }
    
     if ($resultado) {
                
                ?>
                <script>alert("Convite enviado com sucesso!");</script>

                <?php
                
                    echo "<script>location.href='time.php';</script>";
                    
                ?>

                <?php

            } else {
                echo "<script>alert('Não foi possível cadastrar!');</script>";
            }
}

?>