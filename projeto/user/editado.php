    <?php
    include "../adm/verificalogado.php";
    ?>

    <?php
    include "../adm/conecta.php";

    $id_user = $_POST['id_user'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $level_gc = $_POST['level_gc'];
    $adm = $_POST['adm'];
    $nivel = 2;
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $rep_senha = $_POST['rep_senha'];
    $data_nasc = $_POST['data_nasc'];
    //foto
    $sql = "select foto_perfil from usuario where id_user = $id_user"; /* Consulta a imagem no banco */
    $imagem = pg_query($conexao, $sql); /* Executa a consulta */
    $img_antiga = pg_fetch_array($imagem); /* organiza o resultado que vem do banco(a imagem) */
    //Imagens
    $nome_arquivo = $_FILES['foto_perfil']['name'];
    $tamanho_arquivo = $_FILES['foto_perfil']['size'];
    $arquivo_temporario = $_FILES['foto_perfil']['tmp_name'];
    //fim foto
    $url_steam = $_POST['url_steam'];
    $patentes = $_POST['patentes'];
    $horario = $_POST['horario'];
    $funcao = $_POST['funcao'];
    


    if (!empty($arquivo_temporario)) {
        if (move_uploaded_file($arquivo_temporario, "../adm/fotos_perfil/$nome_arquivo")) {
            unlink("fotos_perfil/" . $img_antiga["foto_perfil"]);

            $sql = "UPDATE usuario SET nome='" . $nome . "', sobrenome='" . $sobrenome . "', email='" . $email . "'" .
                    ", level_gc=" . $level_gc . ", id_patente=" . $patentes . ", adm=" . $adm . ", nivel=" . $nivel . ", login='" . $login . "', " .
                    "senha ='" . $senha . "', rep_senha='" . $rep_senha . "', data_nasc='" . $data_nasc . "', foto_perfil='" . $nome_arquivo . "', url_steam='" . $url_steam . "' WHERE id_user=$id_user ";

            $resultado = pg_query($conexao, $sql);
            /* horario */
            if ($resultado) {

                $sql_del_horario = "DELETE FROM usuario_horario where id_user = $id_user";
                $resultado_del_horario = pg_query($conexao, $sql_del_horario);

                $tamanho_vetor_horario = sizeof($horario);

                for ($i = 0; $i < $tamanho_vetor_horario; $i++) {
                    $sql_novo_horario = "INSERT INTO usuario_horario (id_user, id_horario) VALUES ('$id_user', '" . $horario[$i] . "')";
                    $resultado_novo_horario = pg_query($conexao, $sql_novo_horario);
                }
            } else {
                echo "<scrip>alert('Erro no cadastro')</scrip>";
            }
            /* Funcao */
            if ($resultado) {

                $sql_del_funcao = "DELETE FROM usuario_funcao where id_user = $id_user";
                $resultado_del_funcao = pg_query($conexao, $sql_del_funcao);

                $tamanho_vetor_funcao = sizeof($funcao);

                for ($i = 0; $i < $tamanho_vetor_funcao; $i++) {
                    $sql_nova_funcao = "INSERT INTO usuario_funcao (id_user, id_funcao) VALUES ('$id_user', '" . $funcao[$i] . "')";
                    $resultado_nova_funcao = pg_query($conexao, $sql_nova_funcao);
                }
            } else {
                echo "<scrip>alert('Erro no cadastro')</scrip>";
            }
        } else {
            echo "<scrip>alert('Não moveu a foto')</scrip>";
        }
    } else {
        $sql = "UPDATE usuario SET nome='" . $nome . "', sobrenome='" . $sobrenome . "', email='" . $email . "'," .
                " level_gc=" . $level_gc . ", id_patente=" . $patentes . ", adm=" . $adm . ", nivel=" . $nivel . ", login='" . $login . "', " .
                "senha ='" . $senha . "', rep_senha='" . $rep_senha . "', data_nasc='" . $data_nasc . "', foto_perfil='" . $img_antiga['foto_perfil'] . "', url_steam='" . $url_steam . "' WHERE id_user=$id_user ";

        $resultado = pg_query($conexao, $sql);
        /*Horario*/
        $sql_del_horario = "DELETE FROM usuario_horario where id_user = $id_user";
        $resultado_del_horario = pg_query($conexao, $sql_del_horario);

        $tamanho_vetor_horario = sizeof($horario);

        for ($i = 0; $i < $tamanho_vetor_horario; $i++) {
            $sql_novo_horario = "INSERT INTO usuario_horario (id_user, id_horario) VALUES ('$id_user', '" . $horario[$i] . "')";
            $resultado_novo_horario = pg_query($conexao, $sql_novo_horario);
        }
    }
    /*Funcao*/
    $sql_del_funcao = "DELETE FROM usuario_funcao where id_user = $id_user";
    $resultado_del_funcao = pg_query($conexao, $sql_del_funcao);

    $tamanho_vetor_funcao = sizeof($funcao);

    for ($i = 0; $i < $tamanho_vetor_funcao; $i++) {
        $sql_nova_funcao = "INSERT INTO usuario_funcao (id_user, id_funcao) VALUES ('$id_user', '" . $funcao[$i] . "')";
        $resultado_nova_funcao = pg_query($conexao, $sql_nova_funcao);
    }


    if (pg_affected_rows($resultado) > 0) {

        header("location: perfil_usuario.php");
    }
    ?>
<a href="index_usuario.php">Voltar</a>