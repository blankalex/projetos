<?php
include "../adm/conecta.php";
include '../adm/verificalogado.php';

$nivel_if = $_SESSION['nivel'];
$id_jogo_user_status = $_SESSION['id_jogo_user'];
$id_user_equipe = $_SESSION['id'];
?>

<?php
$sql_pegar_jogo = "select id_jogo, nome_jogo
        from jogos
        order by id_jogo asc;";
$resultado_pegar_jogo = pg_query($conexao, $sql_pegar_jogo);
$linhas_pegar_jogo = pg_num_rows($resultado_pegar_jogo);

$status_solicitacao = pg_fetch_array(pg_query ("select status from solicitacao where id_jogo_user = $id_jogo_user_status"));

$status_membro = pg_fetch_array(pg_query("select status_membro from membros where id_user = $id_user_equipe"));
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
                                if ($nivel_if == 2) {
                                    if (is_null($status_membro['status_membro'])){
                                                                      
                                    ?>
                                    <li><a>Equipe</a>
                                        <ul>
                                            <li><a>Entrar</a></li> 
                                            <li><a href="cadastrar_equipe.php">Criar</a></li>
                                        </ul>

                                        <?php
                                        if (is_null($status_solicitacao['status'])) {
                                        ?>
                                            <li><a href="notificacoes.php">Notificações <span class="player-status-nao"></span> </a></li>
                                        <?php
                                        }
                                        else if($status_solicitacao['status'] == 1){
                                        ?>
                                            <li><a href="notificacoes.php">Notificações <span class="player-status-nao"></span> </a></li>
                                        <?php    
                                        }
                                        else if($status_solicitacao['status'] == 2){
                                        ?>
                                            <li><a href="notificacoes.php">Notificações <span class="player-status-nao"></span> </a></li>
                                        <?php    
                                        }
                                        else {
                                            ?>
                                        <li><a href="notificacoes.php">Notificações <span class="player-status"></span> </a></li>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <li><a href="#">Minha Equipe</a>
                                        <?php
                                    }
                                }else{
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

            <!-- SLIDER-->

            <section id="slider">

                <figure class="slide active" style="background-image: url('../img/slider/slide4.jpg');">
                    <figcaption><h2>Cansado de jogar com trolls?</h2></figcaption>
                </figure>
                <figure class="slide" style="background-image: url('../img/slider/slide2.jpg');">
                    <figcaption><h2>Cansado de jogar com noobs?</h2></figcaption>
                </figure>
                <figure class="slide" style="background-image: url('../img/slider/slide1.jpg');">
                    <figcaption><h2>Cansado de jogar com os hermanos?</h2></figcaption>
                </figure>
            </section>
            <!--FIM SLIDER-->
        

            <div class="centro empurra">
                
                <div class="cadastrar_editar_jogo">
                    
                        
                        <div class="barra_opcoes">
                            <button class="w3-bar-item w3-button tablink w3-orange" onclick="abrirNotificacao(event, 'convite')"><h2>Convite</h2></button>
                            <button class="w3-bar-item w3-button tablink" onclick="abrirNotificacao(event, 'solicitacao')"><h2>Solicitação</h2></button>
                            
                        </div>

                        <div id="convite" class="  cadastroNotificacao">
                            <div class="itens_convite">
                                <?php
                                    $id_jogo_user = $_SESSION['id_jogo_user'];
                                    $sql_convite = "select id_solicitacao, id_equipe, descricao, status from solicitacao where id_jogo_user = $id_jogo_user and status = 0";
                                    $resultado_convite = pg_query($conexao, $sql_convite);
                                    $registro_convite = pg_fetch_array($resultado_convite);
                                    $linhas_convite = pg_num_rows($resultado_convite);
                                    
                                    $id_solicitacao = $registro_convite['id_solicitacao'];
                                    $id_equipe = $registro_convite['id_equipe'];
                                    $descricao = $registro_convite['descricao'];
                                    $status = $registro_convite['status'];
                                    
                                    ?>
                                    <div class="convites">
                                        <?php
                                        if($linhas_convite==0)
                                        {
                                            echo "<h2>Você não possui nenhum convite</h2>"; 
                                        }else{
                                            
                                        
                                        if($status == 0){
                                        ?>
                                        
                                        
                                        <h2>Número da Solicitação: <?php echo $registro_convite['id_solicitacao']; ?></h2><br>
                                        <h2>Nome da Equipe: <?php echo $registro_convite['id_equipe']; ?></h2><br>
                                        <h2>Motivo: <?php echo $registro_convite['descricao']; ?></h2><br>
                                        <form id="formulario_convite_cancelar_aceitar" name="formulario_convite_cancelar_aceitar" action="cad_formulario_convite_cancelar_aceitar.php" method="post" enctype="multipart/form-data" >
                                            <input type="hidden" name="id_equipe_convite" value="<?php echo $registro_convite['id_equipe'] ?>" id="id_equipe_convite"> <br />
                                            <input type="submit" name="cancelar_convite" class="acaoprev" value="Cancelar" id="idcancelar_convite" >
                                            <input type="submit" name="aceitar_convite" class="acaoenviar" value="Aceitar" id="idaceitar_convite"/>
                                        </form>
                                                                                
                                       
                                       
                                        
                                        
                                        <?php
                                        }
                                        }
                                        ?>
                                        
                                    </div>
                                   
                            </div>
                        </div>

                        <div id="solicitacao" class="  cadastroNotificacao" style="display:none">
                            <div class="itens_solicitacao">
                                
                                                
                            </div>
                        </div>
                                
                                                        
                        
                    
                </div>
                    <script>
                        function abrirNotificacao(evt, jogoName) {
                            var i, x, tablinks;
                            x = document.getElementsByClassName("cadastroNotificacao");
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