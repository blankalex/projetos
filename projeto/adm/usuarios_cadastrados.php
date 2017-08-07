<?php
include "conecta.php";
include 'verificalogado.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>TMFinder</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/grid.css">
        <link rel="stylesheet" href="../css/estilo.css">
        <link rel="stylesheet" href="../css/index_adm.css">
        <!--<link rel="stylesheet" href="css/index.css">-->

        <!-- logo no site-->
        <link rel="apple-touch-icon" sizes="57x57" href="../img/icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../img/icon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../img/icon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../img/icon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../img/icon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../img/icon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../img/icon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../img/icon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/icon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../img/icon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../img/icon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/icon/favicon-16x16.png">
        <link rel="manifest" href="../img/icon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../img/icon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>

    <body>
        <div class="conteudo">
            <!--Menu-->
            <div class="linha">

                <nav id="menu">
                    <div class="centro">
                        <div class="coluna coluna-3">
                            <a href="index_adm.php">
                                <figure>
                                    <img id="logo" src="../img/novologo2.png" alt="TMFinder">
                                    <h1>Olá adm, <?php echo $_SESSION['nome']; ?>!</h1>
                                </figure>
                            </a>
                        </div>
                        <div class="coluna coluna-9 ">
                            <ul class="navegacao">    
                                <li><a href="cadastrar_jogo.php">Cadastrar Jogo</a></li>
                                <li><a href="#">Editar Equipes</a></li>
                                <li><a href="usuarios_cadastrados.php">Editar Cadastros</a></li>
                                <li><a href="logout.php">Sair</a></li>
                            </ul>
                        </div> 
                    </div>
                </nav>

            </div>
            <div class="centro empurra">

                <!-- usuario_cadastrados -->
                <div class="linha usuario_cadastrado_geral">


                    <?php
                    $sql = "SELECT id_user, nome, sobrenome, email, level_gc, adm, nivel, login, senha, rep_senha, data_nasc, foto_perfil, url_steam, img_patente
                                FROM usuario
                                join patentes on(usuario.id_patente=patentes.id_patente)
                                order by id_user asc";

                    $resultado = pg_query($conexao, $sql);
                    $linhas = pg_num_rows($resultado);


                    for ($i = 0; $i < $linhas; $i++) {
                        ?>
                        <div class="usuario_cadastrado_solo">
                            <?php
                            $registro = pg_fetch_array($resultado);

                            $id_user = $registro['id_user'];

                            echo "<tr>";
                            ?>
                            <div class="usuario_cadastrado_solo_center">
                                <?php
                                echo"<td> ID user </td>";
                                echo "<td>";
                                echo $registro['id_user'];
                                echo "</br></td>";
                                echo "<td> Nome </td>";
                                echo "<td>";
                                echo $registro['nome'];
                                echo "</br></td>";
                                echo "<td> Sobrenome </td>";
                                echo "<td>";
                                echo $registro['sobrenome'];
                                echo "</br></td>";
                                echo "<td> E-mail </td>";
                                echo "<td>";
                                echo $registro['email'];
                                echo "</br></td>";
                                echo " <td> Level_GC </td>";
                                echo "<td>";
                                echo $registro['level_gc'];
                                echo "</br></td>";
                                echo "<td> Adm </td>";
                                echo "<td>";
                                if($registro['adm'] == 1){
                                    echo "<td> Sim </td>";
                                }else{
                                    echo "<td> Não </td>";
                                }
                                echo "</br></td>";
                                echo "<td> Nível </td>";
                                echo "<td>";
                                echo $registro['nivel'];
                                echo "</br></td>";
                                echo "<td> Login </td>";
                                echo "<td>";
                                echo $registro['login'];
                                echo "</br></td>";
                                echo "<td> Senha </td>";
                                echo "<td>";
                                echo $registro['senha'];
                                echo "</br></td>";
                                echo "<td> Rep_Senha </td>";
                                echo "<td>";
                                echo $registro['rep_senha'];
                                echo "</br></td>";
                                echo "<td> Data de Nascimento </td>";
                                echo "<td>";
                                echo $registro['data_nasc'];
                                echo "</br></td>";
                                echo "<td> Foto do Perfil </td>";
                                echo "<td>";
                                echo "<img src='fotos_perfil/" . $registro['foto_perfil'] . "' width='150px' heigth='150px'/>";
                                echo "</br></td>";
                                echo "<td> URL da STEAM</td>";
                                echo "<td>";
                                echo $registro['url_steam'];
                                echo "</br></td>";
                                echo "<td> Patente</td> ";
                                echo "<td>";
                                echo "<img src='../img/patente/" . $registro['img_patente'] . " 'width='150px' heigth='150px'/>";
                                echo "</br></td>";

                                /* Mostrando horário de treino */

                                $sql_horario = "select horario.hora_treino
                                from horario
                                join usuario_horario on(horario.id_horario=usuario_horario.id_horario)
                                where usuario_horario.id_user = " . $registro['id_user'] . " 
                                order by usuario_horario.id_user desc;";


                                $resultado_horario = pg_query($conexao, $sql_horario);
                                $linhas_horario = pg_num_rows($resultado_horario);

                                echo "<td> Horário de Treino </td>";
                                for ($j = 0; $j < $linhas_horario; $j++) {
                                    $registro_horario = pg_fetch_array($resultado_horario);

                                    echo "<td>";
                                    echo $registro_horario['hora_treino'];
                                    echo "</td>";
                                }
                                echo "</br>";
                                /* Mostrando a função */

                                $sql_funcao = "select funcao.img_funcao
                                from funcao
                                join usuario_funcao on(funcao.id_funcao=usuario_funcao.id_funcao)
                                where usuario_funcao.id_user = " . $registro['id_user'] . " 
                                order by usuario_funcao.id_user desc;";


                                $resultado_funcao = pg_query($conexao, $sql_funcao);
                                $linhas_funcao = pg_num_rows($resultado_funcao);

                                echo "<td> Função </td>";
                                for ($k = 0; $k < $linhas_funcao; $k++) {
                                    $registro_funcao = pg_fetch_array($resultado_funcao);

                                    echo "<td>";
                                    echo "<img class='img_funcao_user' src='../img/funcao/" . $registro_funcao['img_funcao'] . "'/>";
                                    echo "</td>";
                                }
                                echo "</br>";
                                /* Editar e excluir */

                                echo "<td>";
                                echo "<a href='editar_adm.php?id_user=$id_user'><input type='submit' value='Editar'></a>";
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='deletar_user.php?id_user=$id_user'><input type='submit' value='Excluir'></a>";
                                echo "</td>";
                                echo "</tr>";
                                ?>

                            </div>
                        </div>
    <?php
}
?>


                    <br/><a href="index_adm.php">Voltar</a>
                    </table>

                </div>

                
            </div>
            

            <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
            <script type="text/javascript" src="../js/validacao.js"></script>
            <script type="text/javascript" src="../js/function.js"></script>
    </body>

</html>