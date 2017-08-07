<?php
include "../adm/conecta.php";
include '../adm/verificalogado.php';

$nivel_if = $_SESSION['nivel'];
$id_user = $_SESSION['id'];

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
        <link rel="stylesheet" href="../css/w3.css">
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
                                <li><a href="#linkjogo">Jogos</a> 
                                    <ul> 
                                        <li><a href="#modalcadastrolink">CS-GO</a></li> 
                                        <li><a href="#modalcadastrolink">CS-GO</a></li> 
                                        <li><a href="#modalcadastrolink">CS-GO</a></li>
                                        <li><a href="#modalcadastrolink">CS-GO</a></li> 
                                    </ul> 
                                </li>
                                <li><a href="#linkplayer">Players</a></li>
                                <?php
                                if($nivel_if == 2){
                                ?>
                                    <li><a href="#">Equipe</a>
                                    <ul>
                                        <li><a href="#">Entrar</a></li> 
                                        <li><a href="cadastrar_equipe.php">Criar</a></li>
                                    </ul>
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
                
                <div class="cadastrar_editar_jogo">
                    
                        
                        <div class="barra_opcoes">
                            <button class="w3-bar-item w3-button tablink w3-orange" onclick="abrirTime(event, 'convidarUsuario')"><h2>Convidar Usuário</h2></button>
                            <button class="w3-bar-item w3-button tablink" onclick="abrirTime(event, 'notificacao')"><h2>Notificações</h2></button>
                            <button class="w3-bar-item w3-button tablink" onclick="abrirTime(event, 'editarTime')"><h2>Editar Time</h2></button>
                           
                        </div>

                        <div id="convidarUsuario" class="cadastroTime">
                            <div class="nome_time">
                                <?php
                                    $id_jogo_user = $_SESSION['id_jogo_user'];
                                    
                                    $sql_time = "select jogo_user.id_jogo, equipe.id_user, id_equipe, nome_time from equipe join jogo_user using(id_jogo_user) where equipe.id_jogo_user = $id_jogo_user";
                                    $resultado_time = pg_query($conexao, $sql_time);
                                    $registro_time = pg_fetch_array($resultado_time); 
                                    
                                    $nome_time = $registro_time['nome_time'];
                                    $id_equipe = $registro_time['id_equipe'];
                                    $id_user_do_time = $registro_time['id_user'];
                                    $id_jogo_do_jogo = $registro_time['id_jogo'];
                                    
                                ?>
                                <h2>Nome da Equipe: <?php echo $nome_time; ?></h2>
                            </div>
                            
                            <div class="membros_equipe">
                                <h2>Membros da Equipe:</h2> <br>
                                <?php
                                    $sql_id_equipe = "select membros.id_equipe from membros join equipe using(id_user) join usuario using(id_user) join jogo_user using(id_user) where equipe.id_jogo_user = $id_jogo_user";
                                    $resultado_id_equipe = pg_query($conexao, $sql_id_equipe);
                                    $registro_id_equipe = pg_fetch_array($resultado_id_equipe); 
                                    
                                    $id_equipe_do_membro = $registro_id_equipe['id_equipe'];
                                    
                                    $sql_membros = "select nome from usuario join membros using(id_user) where membros.id_equipe = $id_equipe_do_membro 
                                                    order by nome asc;";
                                    $resultado_membros = pg_query($conexao, $sql_membros);
                                    $linhas_membros = pg_num_rows($resultado_membros);
                                     
                                    
                                    for ($i = 0; $i < $linhas_membros; $i++) {
                                        $registro_membros = pg_fetch_array($resultado_membros);
                                        
                                        ?>
                                        <h2> <?php echo $registro_membros['nome'];  ?></h2>
                                        
                                        
                                <?php
                                    }
                                ?>
                                
                                
                                
                                
                            </div>
                            
                            <div class="todos_usuarios">
                                <form id="formulario_convite" name="formulario_convite" action="cad_convite.php" method="post" enctype="multipart/form-data" >
                                
                                <input type="button" name="cancelar" class="acaoprev" value="Cancelar" onclick="location.href= 'index_usuario.php'">
                                <input type="submit" name="enviar_convite" class="acaoenviar" value="Enviar" id="idenviar"/>
                                
                                <?php
                                    $id_jogo_user2 = $_SESSION['id_jogo_user'];
                                    
                                    $sql_time2 = "select jogo_user.id_jogo, equipe.id_user, id_equipe, nome_time from equipe join jogo_user using(id_jogo_user) where equipe.id_jogo_user = $id_jogo_user";
                                    $resultado_time2 = pg_query($conexao, $sql_time2);
                                    $registro_time2 = pg_fetch_array($resultado_time2); 
                                    
                                    $id_equipe2 = $registro_time2['id_equipe'];
                                ?>
                               
                                <input type="hidden" name="id_equipe2" value="<?php echo $id_equipe2 ?>" id="id_equipe2"> <br />
                                <textarea class="texto_contato" placeholder="Mensagem para o usuário convidado" name="descricao" rows="5" style="width: 97.8%;"></textarea> <br />
                                
                                
                                
                                <?php
                                    $sql_usuario_jogo = " select nome, jogo_user.id_jogo_user
                                        from usuario join jogo_user using(id_user)
                                        left join membros using(id_user)
                                        where id_jogo = $id_jogo_do_jogo and membros.status_membro is null
                                        order by nome asc;";
                                    
                                    $resultado_usuario_jogo = pg_query($conexao, $sql_usuario_jogo);
                                    $linhas_usuario_jogo = pg_num_rows($resultado_usuario_jogo);
                                    ?>
                                
                                    <h2>Usuários Disponíveis:</h2> <br><br>
                                    <?php
                                    for ($i = 0; $i < $linhas_usuario_jogo; $i++) {
                                        $registro_usuario_jogo = pg_fetch_array($resultado_usuario_jogo);
                                    ?>
                                    
                                    <input type="checkbox" name="id_jogo_user[]" value="<?php echo $registro_usuario_jogo['id_jogo_user']; ?>"> <div class="checkbox_nome"><h2><?php echo $registro_usuario_jogo['nome'] ; ?></h2></div><br><br><br>
                                    <?php   
                                    }
                                ?>
                                    
                                  </form>
                            </div>
                            
                        </div>
                        
                        <div id="notificacao" class="cadastroTime">
                                 
                        </div>

                        <div id="editarTime" class="cadastroTime" style="display:none">
                                                       
                        </div>

                    
                </div>
                
                <script>
                        function abrirTime(evt, jogoName) {
                            var i, x, tablinks;
                            x = document.getElementsByClassName("cadastroTime");
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName("tablink");
                            for (i = 0; i < x.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" w3-orange", "");
                            }
                            document.getElementById(jogoName).style.display = "block";
                            evt.currentTarget.className += " w3-orange";
                        }
                    </script>
                    
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