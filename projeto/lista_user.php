<?php
include "adm/conecta.php";
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
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/grid.css">
        <link rel="stylesheet" href="css/estilo.css">
        <!--<link rel="stylesheet" href="css/index.css">-->

        <!-- logo no site-->
        <link rel="apple-touch-icon" sizes="57x57" href="img/icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/icon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/icon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/icon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/icon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/icon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/icon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/icon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/icon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/icon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
        <link rel="manifest" href="img/icon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/icon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>

    <body>
        <div class="conteudo">
            <!--Menu-->
            <div class="linha">

                <nav id="menu">
                    <div class="centro">
                        <div class="coluna coluna-3">
                            <a href="home">
                                <figure>
                                    <img id="logo" src="img/novologo2.png" alt="TMFinder">
                                    <h1>TMFinder</h1>
                                </figure>
                            </a>
                        </div>
                        <div class="coluna coluna-9 ">
                            <ul class="navegacao">    
                                <li><a href="#linkjogo">Jogos</a> 
                                    <ul>

                                        <?php
                                        for ($i = 0; $i < $linhas_pegar_jogo; $i++) {
                                            $registro_pegar_jogo = pg_fetch_array($resultado_pegar_jogo);

                                            $id_jogo = $registro_pegar_jogo['id_jogo'];
                                            $nome_jogo = $registro_pegar_jogo['nome_jogo'];
                                            ?>
                                            <li><a href="cadastrar_usuario.php"><?php echo $registro_pegar_jogo['nome_jogo']; ?></a></li> 

                                            <?php
                                        }
                                        ?>

                                    </ul> 
                                </li>
                                <li><a href="#linkplayer">Players</a></li>
                                <li><a href="#">Equipes</a></li>
                                <li><a href="#modalduvidaslink">Dúvidas</a></li>
                                <li><a href="#linkjogo" onclick="funcao1()">Cadastro</a></li>
                                <li><a href="#modalloginlink">Login</a></li>
                            </ul>
                        </div> 
                    </div>  
                </nav>

            </div>
            <!-- FIM Menu-->
           
            <div class="centro empurra">
                
                <div id="linkplayer" class="linha fonte_player_borda">
                  <h2 class="fonte_player">Players</h2>
                </div>
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
                                <?php echo "<img class='imgpatente' src='img/patente/" . $registro['img_patente'] . "'/>"; ?><br>
                                <?php echo "<img class='imguser' src='adm/fotos_perfil/" . $registro['foto_perfil'] . "'/>"; ?><br>
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
                                        <?php echo "<img class='img_funcao_user' src='img/funcao/" . $registro_funcao['img_funcao'] . "'/>"; ?>

                                        <?php
                                    }
                                    ?>
                                </div>                  
                                <br>
                                <?php echo "<a href='$url'><img class='imgsteam' src='img/steam1.png' alt='steam'/></a>"; ?><br>
                            </div>
                        </div>
                    <?php } ?>                       

                </div>
                


                <!--FIM dos usuário-->

                <!--Cadastro-->

                <div class="linha">
                    <div id="modalcadastrolink" class="modalcadastro">
                        <a href="#fecharmodalcadastro" title="fecharcadastro" class="fecharmodalcadastro">X</a>
                        <div class="coluna coluna-3"><p class="espaço">Espaço</p></div>

                        <div class="coluna coluna-6">

                            <form id="formulario" name="formulario" action="cad_usuarios.php" method="post" enctype="multipart/form-data" >

                                <ul id="progress">
                                    <li class="ativo">Login</li>
                                    <li>Dados pessoais</li>
                                    <li>Informações</li>
                                </ul>

                                <fieldset>
                                    <h2>Cadastro</h2>


                                    <input class="estilo_input" placeholder="Login" type="text" name="login" id="idlogin" style=" width: 100%;">
                                    <input class="estilo_input" placeholder="Senha" type="password" name="senha" id="idsenha" style=" width: 100%;">
                                    <input class="estilo_input" placeholder="Repetir senha" type="password" name="rep_senha" id="idrep_senha" style=" width: 100%;">
                                    
                                    
                                    <div><h3 class="fonte_logar_cadastro">Já é cadastrado?</h3></div>
                                    <input type="button" name="logar" class="acaoprev" value="Logar" onclick="location.href= '#modalloginlink'">                                    
                                    <input type="button" name="next1" class="next acaonext" value="Proximo"/>
                                    
                                    
                                </fieldset>

                                <fieldset>
                                    <h2>Cadastro</h2>

                                    <input class="estilo_input" placeholder="Nome" type="text" name="nome" id="idnome" style=" width: 100%;">
                                    <input class="estilo_input" placeholder="Sobrenome" type="text" name="sobrenome" id="idsobrenome" style=" width: 100%;"> 
                                    <input class="estilo_input" placeholder="Data de nascimento" type="date" name="data_nasc" id="iddata_nasc" style=" width: 100%;">
                                    <input class="estilo_input" placeholder="E-mail" type="e-mail" name="email" id="idemail" style=" width: 100%;"> 

                                    <input  type="button" name="prev" class="prev acaoprev" value="Anterior"/>
                                    <input  type="button" name="next2" class="next acaonext" value="Proximo"/>

                                </fieldset>


                                <fieldset>
                                    <h2>Cadastro</h2>

                                    <h6 class="url_steam">Steam Community Link (obrigatório)<br> Vá para <a target="_blank" href="https://steamcommunity.com/my">https://steamcommunity.com/my</a> para obter o seu link</h6>
                                    <input class="estilo_input" type="text" name="url_steam" placeholder="Steam Community Link" id="idurl_steam" style="width: 100%">

                                    <select class="opcoes_cadastro" name="level_gc">
                                        <option value="LEVEL GC" selected="selected">Level GC</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select><br />


                                    <select class="opcoes_cadastro" name="patentes" required>
                                        <option value="#">Sua Patente</option>
                                        <?php
                                        $sql = "SELECT descricao,id_patente FROM patentes order by id_patente asc";
                                        $resultado = pg_query($conexao, $sql);
                                        $linhas = pg_num_rows($resultado);

                                        for ($i = 0; $i < $linhas; $i++) {
                                            $registro = pg_fetch_array($resultado);
                                            ?>
                                            <option value="<?php echo $registro['id_patente']; ?>"> <?php echo $registro['descricao']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <br />

                                    <h3>Horário de treino</h3>
                                    <?php
                                    $sql_hr = "SELECT hora_treino,id_horario FROM horario order by id_horario asc";
                                    $resultado_hr = pg_query($conexao, $sql_hr);
                                    $linhas_hr = pg_num_rows($resultado_hr);

                                    for ($i = 0; $i < $linhas_hr; $i++) {
                                        $registro_hr = pg_fetch_array($resultado_hr);
                                        ?>
                                        <input type="checkbox" name="horario[]" value="<?php echo $registro_hr['id_horario']; ?>"> <h5 class="descricao_treino"><?php echo $registro_hr['hora_treino']; ?></h5><br>

                                        <?php
                                    }
                                    ?>

                                    <h3>Função no jogo</h3>
                                    <?php
                                    $sql_fun = "SELECT funcao, img_funcao,id_funcao FROM funcao order by id_funcao asc";
                                    $resultado_fun = pg_query($conexao, $sql_fun);
                                    $linhas_fun = pg_num_rows($resultado_fun);
                                    $cont = 0;
                                    for ($i = 0; $i < $linhas_fun; $i++) {
                                        $registro_fun = pg_fetch_array($resultado_fun);
                                        $cont++;
                                        if ($cont == 3) {
                                            ?>
                                            <input type="checkbox" name="funcao[]" value="<?php echo $registro_fun['id_funcao']; ?>"><h5 class="descricao_treino"><?php echo $registro_fun['funcao']; ?></h5> <?php echo "<img class='img_funcao' src='img/funcao/$registro_fun[img_funcao]'/>"; ?><br style="clear: both">

                                            <?php
                                        } else {
                                            ?>
                                            <input type="checkbox" name="funcao[]" value="<?php echo $registro_fun['id_funcao']; ?>"><h5 class="descricao_treino"><?php echo $registro_fun['funcao']; ?></h5> <?php echo "<img class='img_funcao' src='img/funcao/$registro_fun[img_funcao]'/>"; ?><br>

                                            <?php
                                        }
                                    }
                                    ?>

                                    
                                    <input type="hidden" name ="MAX_FILE_SIZE"  value="20000000">
                                    <h3 class="texto_foto_perfil">Foto do perfil</h3>
                                    <input class="estilo_input escolher_foto" placeholder="Foto do perfil" class="texto_cadastro" type="file" name="foto_perfil" style=" width: 100%;">

                                    <input type="button" name="prev" class="prev acaoprev" value="Anterior"/>
                                    <input type="submit" name="enviar" class="acaoenviar" value="Enviar" id="idenviar"/>

                                </fieldset>

                            </form>

                        </div>
                    </div>
                </div>

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

                <!--Login-->
                <div class="linha">

                    <div id="modalloginlink" class="modallogin">
                        <a href="#fecharmodallogin" title="fecharlogin" class="fecharmodallogin">X</a>

                        <div class="login">

                            <h2>Login</h2><br /><br />

                            <form action="loginphp.php" method="POST">

                                <input class="texto_login" type="text" placeholder="Login" name="login" id="login"/><br /><br />

                                <input class="texto_login" type="password" placeholder="Senha" name="senha" id="senha"/><br /><br />

                                <input class="botaologin" type="submit" value="Entrar" name="entrar" id="entrar"/>
                                
                                <br> <br>
                                <h3 class="nao_cadastrado_fonte">Ainda não é cadastrado?</h3><a class="nao_cadastrado_fonte" href="#linkjogo" onclick="funcao1()"><br><br>CADASTRE-SE</a>
                            </form>
                        </div>

                    </div>
                    <!--Fim do Login-->

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
                                    <img class="tamanhoicone" src="img/rodape/facebook1copia.png" alt="facebook"/>
                                </a>
                            </li>

                            <li>
                                <a href="https://twitter.com/?lang=pt-br" target="_blank">
                                    <img class="tamanhoicone" src="img/rodape/twitter1copia.png" alt="twitter"/>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <img class="tamanhoicone" src="img/rodape/instagram1copia.png" alt="instagram"/>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="img/rodape/email.png"/>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="img/rodape/chat.png" />
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <img class="tamanhoicone" src="img/rodape/steam1.png" />
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

        <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/validacao.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
    </body>

</html>