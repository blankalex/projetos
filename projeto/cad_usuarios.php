<?php

/* Cadastro */
include "adm/conecta.php";

if (isset($_POST['enviar'])) {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $level_gc = $_POST['level_gc'];
    $adm = 2;
    $nivel = 2;
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $rep_senha = $_POST['rep_senha']; 
    $data_nasc = $_POST['data_nasc'];
    /* Foto do perfil */
    $nome_arquivo = $_FILES['foto_perfil']['name'];
    $tamanho_arquivo = $_FILES['foto_perfil']['size'];
    $arquivo_temporario = $_FILES['foto_perfil']['tmp_name'];
    /*Fim foto do perfil*/
    $url_steam = $_POST['url_steam'];
    $patentes = $_POST['patentes'];
    /*usuario_horaio*/
    $horario = $_POST['horario'];
    /*usuario_funcao*/
    $funcao = $_POST['funcao'];
    $id_jogo = $_POST['id_jogo'];


    if (!empty($nome_arquivo)) {

        if (move_uploaded_file($arquivo_temporario, "adm/fotos_perfil/$nome_arquivo")) {

            /* echo "Upload do arquivo: " . $nome_arquivo . "concluído com sucesso"; */


            $sql = "INSERT INTO usuario (nome, sobrenome, email, level_gc, adm, nivel, login, senha, rep_senha, data_nasc, foto_perfil, url_steam, id_patente)
  VALUES ('$nome', '$sobrenome', '$email', '$level_gc', '$adm', '$nivel', '$login', '$senha', '$rep_senha', '$data_nasc', '$nome_arquivo', '$url_steam','$patentes' ) RETURNING id_user";

            $resultado = pg_query($conexao, $sql);
            $registro= pg_fetch_array($resultado);
            $id_user=$registro['id_user'];
            
            $tamanho_vetor_horario= sizeof($horario);
            
            for($i=0;$i<$tamanho_vetor_horario;$i++)
            {
                $horario1=$horario[$i];
               
                $sql_horario = "INSERT INTO usuario_horario (id_user, id_horario) VALUES ('$id_user', '$horario1')";

            $resultado_horario = pg_query($conexao, $sql_horario);
            }
            
          
            $tamanho_vetor_funcao= sizeof($funcao);
            for($i=0;$i<$tamanho_vetor_funcao;$i++)
            {
                $funcao1=$funcao[$i];
                $sql_funcao = "INSERT INTO usuario_funcao (id_user, id_funcao) VALUES ('$id_user', '$funcao1')";

            $resultado_funcao = pg_query($conexao, $sql_funcao);
            }
            
                $sql_user_jogo = "INSERT INTO jogo_user (id_jogo, id_user) VALUES ('$id_jogo', '$id_user') ";
                
                $resultado_user_jogo = pg_query($conexao, $sql_user_jogo);
              
            

            if ($resultado) {
                /*mail($criarnovavarialvelnobanco);*/
                ?>
                <script>alert("Cadastrado!");</script>

                <?php
                
                    echo "<script>location.href='index.php';</script>";
                    
                ?>

                <?php

            } else {
                echo "<script>alert('Não foi possível cadastrar!');</script>";
            }
        } else {

            die("Falha no envio do arquivo");
        }
    } else {
        die("Selecione o arquivo a ser enviado");
    }
}
/* Fim do cadastro */
?>