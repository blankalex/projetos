<?php

include '../adm/verificalogado.php';
include '../adm/conecta.php';

if (isset($_POST['enviar'])) {

    $id_user = $_SESSION['id'];
    $nivel = 1;
    $total = 1;
    $id_jogo_user = $_SESSION['id_jogo_user'];
    $descricao = $_POST['descricao'];
    $fanpage = $_POST['fanpage'];

    /* Foto da equipe */
    $nome_arquivo = $_FILES['banner']['name'];
    $tamanho_arquivo = $_FILES['banner']['size'];
    $arquivo_temporario = $_FILES['banner']['tmp_name'];
    /* Fim foto da equipe */
    
    $nome_time = $_POST['nome_time'];

    if (!empty($nome_arquivo)) {
        if (move_uploaded_file($arquivo_temporario, "fotos_times/$nome_arquivo")) {
            $sql = "INSERT INTO equipe (id_user, total, id_jogo_user, descricao, fanpage, banner, nome_time)
                     VALUES ('$id_user', '$total', '$id_jogo_user', '$descricao', '$fanpage', '$nome_arquivo', '$nome_time') RETURNING id_equipe";
            
            $resultado = pg_query($conexao, $sql);
            $registro= pg_fetch_array($resultado);
            $id_equipe=$registro['id_equipe'];
           
            $sql_update = "UPDATE usuario SET nivel=$nivel WHERE id_user=$id_user";
            $resultado_update = pg_query($conexao, $sql_update);
            
            $sql_jogo_user_equipe = "INSERT INTO jogo_user_equipe (id_jogo_user, id_equipe) VALUES ('$id_jogo_user', '$id_equipe') ";
            $resultado_jogo_user_equipe = pg_query($conexao, $sql_jogo_user_equipe);
            
            $status_membro = 1;
            $sql_membros = "INSERT INTO membros (status_membro, id_user, id_equipe) VALUES ('$status_membro', '$id_user', '$id_equipe')";
            $resultado_membros = pg_query($conexao, $sql_membros);
                if ($resultado && $resultado_update && $resultado_jogo_user_equipe && $resultado_membros) {
                    ?>
                    <script>alert("Time criado com sucesso!");</script>
                    <?php

                    echo "<script>location.href='index_usuario.php';</script>";
                } else {
                    echo "<script>alert('Não foi possivel cadastrar o time!');</script>";
                }
            } else {
                die("Falha no envio da foto :\!");
            }
        } else {
            die("Selecione a foto novamente :)!");
        }
    
}
?>