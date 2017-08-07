<?php
    include 'verificalogado.php';
    include 'verificaadm.php';
    include 'conecta.php';
?>
    
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>TMFinder</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/w3.css">
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
                <div class="cadastrar_editar_jogo">
                    
                        
                        <div class="barra_opcoes">
                            <button class="w3-bar-item w3-button tablink w3-orange" onclick="abrirJogo(event, 'cadastrarJogo')"><h2>Cadastrar Jogo</h2></button>
                            <button class="w3-bar-item w3-button tablink" onclick="abrirJogo(event, 'editarJogo')"><h2>Editar Jogos</h2></button>
                            
                        </div>

                        <div id="cadastrarJogo" class="  cadastroJogo">
                            <div class="itens_cadastro">
                                <form id="formulario_jogo" name="formulario_jogo" action="cad_jogo.php" method="post" enctype="multipart/form-date">
                                    <input class="estilo_input" placeholder="Nome do Jogo" type="text" name="nome_jogo" style="width: 100%;">
                                    <input type="button" name="cancelar" class="acaocancelar" value="Cancelar" onclick="location.href='index_adm.php'"/>
                                    <input type="submit" name="enviar" class="acaoenviar" value="Enviar" id="idenviar"/>
                                    
                                </form>
                            </div>
                        </div>

                        <div id="editarJogo" class="  cadastroJogo" style="display:none">
                            <div class="itens_editar">
                                <?php 
                                    $sql = "SELECT id_jogo, nome_jogo from jogos order by nome_jogo asc";
                                    
                                    $resultado = pg_query($conexao, $sql);
                                    $linhas = pg_num_rows($resultado);
                                    
                                    for($i=0; $i<$linhas; $i++){
                                        
                                        $registro = pg_fetch_array($resultado);
                                        $id_jogo = $registro['id_jogo'];
                                        ?>
                                        <div class="jogo_cadastrado_solo">
                                            
                                            <div class="jogo_cadastrado_solo_center">
                                            <?php
                                                echo "<tr>";
                                                    echo "<td> <h2>Jogo:</h2></td>";
                                                    echo "<td>";
                                                    echo "<h2>";
                                                    echo $registro['nome_jogo'];
                                                    echo "</h2>";
                                                    echo "</td>";
                                                    echo "<h7>|</h7>";
                                                    echo "<td> <h2>ID:</h2></td>";
                                                    echo "<td>";
                                                    echo "<h2>";
                                                    echo $registro['id_jogo'];
                                                    echo "</h2>";
                                                    echo "</td>";
                                                    

                                                    /*Editar e excluir*/

                                                    echo "<td>";
                                                        echo "<a href='editar_jogo.php?id_jogo=$id_jogo'><input type='submit' value='Editar'></a>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo "<a href='deletar_jogo.php?id_jogo=$id_jogo'><input type='submit' value='Excluir'></a>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            ?>
                                                
                                            </div>
                                        </div>
                                     
                                <?php
                                    }
                                    
                                ?>
                            </div>                            
                        </div>

                    
                </div>
                    <script>
                        function abrirJogo(evt, jogoName) {
                            var i, x, tablinks;
                            x = document.getElementsByClassName("cadastroJogo");
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
                
            </div>

        </div>


        
        <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/validacao.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
    </body>

</html>