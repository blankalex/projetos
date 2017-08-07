<?php
include "../adm/conecta.php";
include '../adm/verificalogado.php';
?>
<?php
    $id_user = $_SESSION['id'];
    
    $sql_user = "SELECT id_user, nivel
                                FROM usuario
                                WHERE id_user = '$id_user'";

    $resultado_user = pg_query($conexao, $sql_user);

    $registro_user = pg_fetch_array($resultado_user);
    
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
                <!-- Cadastro de Time -->
                
                <div class="linha">
                    <div class="coluna coluna-12 cadastro_equipe">
                        <form id="formulario_equipe" name="formulario_equipe" action="cad_equipe.php" method="post" enctype="multipart/form-data">
                                                                             
                            <input class="estilo_input" type="text" placeholder="Nome da Equipe" name="nome_time" id="idnome_time" style="width: 100%;">
                            <textarea class="estilo_input" placeholder="Descrição do Time" name="descricao" rows="5" style=" width: 100%;"></textarea>
                            <h3 class="texto_fanpage">Não obrigatório!</h3>
                            <input class="estilo_input" type="text" name="fanpage" placeholder="Link da Fanpage (Não obrigatório!)" id="idfanpage" style="width: 100%;"> 
                            <input type="hidden" name ="MAX_FILE_SIZE"  value="20000000">
                            <h3 class="texto_foto_equipe">Foto da Equipe</h3>
                            <input class="estilo_input " placeholder="Foto da Equipe" type="file" name="banner" style=" width: 100%;">
                            
                            <input type="button" name="cancelar" class="acaocancelar" value="Cancelar" onclick="location.href='index_usuario.php'"/>
                            <input type="submit" name="enviar" class="acaoenviar" value="Enviar" id="idenviar"/>
                                    
                        </form>    
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



            </div>

        </div>

    

    <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../js/validacao.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
</body>

</html>