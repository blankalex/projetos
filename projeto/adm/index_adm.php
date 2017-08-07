<?php
include 'verificalogado.php';
include 'verificaadm.php';
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

                <div class="linha">
                    <div class="coluna coluna-12">

                        
                    </div>
                </div>

                </div>

            </div>
       
        <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/validacao.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
    </body>

</html>