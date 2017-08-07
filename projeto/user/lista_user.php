<?php
include "../adm/conecta.php";
include '../adm/verificalogado.php';

$nivel_if = $_SESSION['nivel'];

?>

<?php
$sql_pegar_jogo = "select id_jogo, nome_jogo
        from jogos
        order by id_jogo asc;";
$resultado_pegar_jogo = pg_query($conexao, $sql_pegar_jogo);
$linhas_pegar_jogo = pg_num_rows($resultado_pegar_jogo);
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <base href="./">    
        <title>TMFinder</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/grid.css">
        <link rel="stylesheet" href="../css/estilo.css">
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
                            <a href="index_usuario.php">
                                <figure>
                                    <img id="logo" src="../img/novologo2.png" alt="TMFinder">
                                    <h1>Olá, <?php echo $_SESSION['nome']; ?>!</h1>
                                </figure>
                            </a>
                        </div>
                        <div class="coluna coluna-9 ">
                            <ul class="navegacao">   
                                <li><a>Jogos</a> 
                                    <ul>

                                        <?php
                                        for ($i = 0; $i < $linhas_pegar_jogo; $i++) {
                                            $registro_pegar_jogo = pg_fetch_array($resultado_pegar_jogo);

                                            $id_jogo = $registro_pegar_jogo['id_jogo'];
                                            $nome_jogo = $registro_pegar_jogo['nome_jogo'];
                                            ?>
                                            <li><a href="../cadastrar_usuario.php"><?php echo $registro_pegar_jogo['nome_jogo']; ?></a></li> 

                                            <?php
                                        }
                                        ?>

                                    </ul> 
                                </li>
                                <li><a href="#linkplayer">Players</a></li>
                                <?php
                                if($nivel_if == 2){
                                ?>
                                    <li><a>Equipe</a>
                                    <ul>
                                        <li><a>Entrar</a></li> 
                                        <li><a href="cadastrar_equipe.php">Criar</a></li>
                                    </ul>
                                        <li><a href="notificacoes.php">Notificações</a></li>
                                <?php        
                                }
                                ?>
                                <?php
                                if($nivel_if == 1){
                                ?>
                                    <li><a href="time.php">Meu Time</a>
                                <?php   
                                }
                                ?>
                                
                                </li>
                                <li><a href="#modalduvidaslink">Dúvidas</a></li>
                                <li><a href="perfil_usuario.php">Editar Perfil</a></li>
                                <li><a href="../adm/logout.php">Sair</a></li>
                            </ul>
                        </div> 
                    </div>  
                </nav>

            </div>
            <!-- FIM Menu-->
           
            <div class="centro empurra">
               
                <!-- Usuário -->
                <div id="player" class="linha usuarios">
                    <?php
                    $sql = "select id_user, foto_perfil, login, url_steam, img_patente
                      from usuario
                      join patentes on(usuario.id_patente=patentes.id_patente)
                      order by id_user desc;";
                    $resultado = pg_query($conexao, $sql);
                    $linhas = pg_num_rows($resultado);

                    for ($i = 0; $i < $linhas; $i++) {
                        $registro = pg_fetch_array($resultado);

                        $id_user = $registro['id_user'];
                        $login = $registro['login'];
                        $url = $registro['url_steam'];
                        $patente = $registro['img_patente'];
                        ?>

                        <div class="forcoluna forcoluna-3">
                            <div class="jogadores">
                                <?php echo "<img class='imgpatente' src='../img/patente/" . $registro['img_patente'] . "'/>"; ?><br>
                                <?php echo "<img class='imguser' src='../adm/fotos_perfil/" . $registro['foto_perfil'] . "'/>"; ?><br>
                                <h3> <?php echo $registro['login']; ?></h3><br> <br>


                                <?php
                                /* Mostrando o horário de treino */
                                $sql_horario = "select horario.hora_treino
                      from horario
                      join usuario_horario on(horario.id_horario=usuario_horario.id_horario)
                      where usuario_horario.id_user = " . $registro['id_user'] . " 
                      order by usuario_horario.id_user desc;";


                                $resultado_horario = pg_query($conexao, $sql_horario);
                                $linhas_horario = pg_num_rows($resultado_horario);


                                for ($j = 0; $j < $linhas_horario; $j++) {
                                    $registro_horario = pg_fetch_array($resultado_horario);
                                    ?>

                                    <h2> <?php echo $registro_horario['hora_treino']; ?></h2>

                                    <?php
                                }
                                ?>

                                <br><br>

                                <?php
                                /* Mostrando a função no jogo */
                                $sql_funcao = "select funcao.img_funcao
                      from funcao
                      join usuario_funcao on(funcao.id_funcao=usuario_funcao.id_funcao)
                      where usuario_funcao.id_user = " . $registro['id_user'] . " 
                      order by usuario_funcao.id_user desc;";


                                $resultado_funcao = pg_query($conexao, $sql_funcao);
                                $linhas_funcao = pg_num_rows($resultado_funcao);
                                ?>
                                <div class="div_img_funcao">
                                    <?php
                                    for ($k = 0; $k < $linhas_funcao; $k++) {
                                        $registro_funcao = pg_fetch_array($resultado_funcao);
                                        ?>
                                        <?php echo "<img class='img_funcao_user' src='../img/funcao/" . $registro_funcao['img_funcao'] . "'/>"; ?>

                                        <?php
                                    }
                                    ?>
                                </div>                  
                                <br>
                                <?php echo "<a href='$url'><img class='imgsteam' src='../img/steam1.png' alt='steam'/></a>"; ?><br>
                            </div>
                        </div>
                    <?php } ?>                       

                </div>
       
                <!--FIM dos usuário-->

                <!--Dúvidas-->
                <div class="linha">
                    <div id="modalduvidaslink" class="modalduvidas">
                        <a href="#fecharmodalduvidas" title="fecharduvidas" class="fecharmodalduvidas">X</a>

                        <div class="contato">
                            <h2>Contato</h2><br /><br />
                            <form method="post" id="contato" name="form_contato" action="duvidasphp.php" onsubmit="return validacao();">

                                <select class="texto_contato" name="assunto" style="width: 102.5%">
                                    <option value="Assunto" selected="selected">Assunto</option>
                                    <option value="Outro">Outro</option>
                                    <option value="Outro 2">Outro 2</option>
                                    <option value="Outro 3">Outro 3</option>
                                </select><br /><br />

                                <input class="texto_contato" placeholder="Nome" type="text" name="nome" id="idnome"> <br /><br />

                                <input class="texto_contato" placeholder="E-mail" type="email" name="email_resposta" id="idemail_resposta"> <br /><br />

                                <textarea class="texto_contato" placeholder="Mensagem" name="mensagem" rows="5"></textarea> <br /><br />

                                <input class="botaocontato" type="submit" name="pergunta" value="ENVIAR" />
                            </form>                       
                        </div>

                    </div>
                </div>

                </div>

            </div>

        </div>
        <!-- Começa o rodapé-->

        <footer>
            <div class="footer">
                <div class="linha">
                    <div class="coluna coluna-12">
                        <div class="coluna coluna-6 contato_rodape_centro"><h3 class="contato_rodape1">Redes Sociais</h3></div>
                        <div class="coluna coluna-6 contato_rodape_centro"><h3 class="contato_rodape2">Contato</h3></div>
                    </div>
                </div>
                
                <div class="linha">
                    <div class="coluna coluna-12">
                        <ul>                                                                       
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img class="tamanhoicone" src="../img/rodape/facebook1copia.png" alt="facebook"/>
                                </a>
                            </li>

                            <li>
                                <a href="https://twitter.com/?lang=pt-br" target="_blank">
                                    <img class="tamanhoicone" src="../img/rodape/twitter1copia.png" alt="twitter"/>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <img class="tamanhoicone" src="../img/rodape/instagram1copia.png" alt="instagram"/>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="../img/rodape/email.png"/>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="../img/rodape/chat.png" />
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="../img/rodape/steam1.png" />
                            </li>

                        </ul>
                    </div>

                </div>

            </div>

            <div class="copyright">
                <div class="coluna coluna-4"><p class="espaço">Espaço</p></div>
                <div class="linha">
                    <h3 class="coluna coluna-4 copyrightborda">Copyright 2017 - by Alex Blank </h3>
                </div>

            </div>
        </footer>

        <!-- Termina Rodapé-->

        <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/validacao.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
    </body>

</html>