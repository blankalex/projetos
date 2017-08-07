<?php
include "verificalogado.php";
?>

<?php
include "conecta.php";

$id_user = $_GET['id_user'];
$sql = "SELECT id_user, nome, sobrenome, email, level_gc, adm, nivel, login, senha, rep_senha, data_nasc, foto_perfil, url_steam, descricao, usuario.id_patente
                                FROM usuario
                                join patentes on(usuario.id_patente=patentes.id_patente)
                                WHERE id_user = '$id_user'";
/* $sql = "SELECT * FROM usuario WHERE id_user = '$id_user'"; */

$resultado = pg_query($conexao, $sql);

$registro = pg_fetch_array($resultado);

$sql_hora = "SELECT id_horario FROM usuario_horario                          
                                WHERE id_user = '$id_user'";
$resultado_hora = pg_query($conexao, $sql_hora);


$linhas_hora = pg_num_rows($resultado_hora);

for ($i = 0; $i < $linhas_hora; $i++) {
    $registro_hora = pg_fetch_array($resultado_hora);
    $vetor_hora[$i] = $registro_hora['id_horario'];
}

$sql_funcao = "SELECT id_funcao FROM usuario_funcao                          
                                WHERE id_user = '$id_user'";
$resultado_funcao = pg_query($conexao, $sql_funcao);


$linhas_funcao = pg_num_rows($resultado_funcao);

for ($j = 0; $j < $linhas_funcao; $j++) {
    $registro_funcao = pg_fetch_array($resultado_funcao);
    $vetor_funcao[$j] = $registro_funcao['id_funcao'];
}
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

                <!--Editar Cadastro-->

                <h2 class="h2_cliente">Alteração do Usuário</h2><br>
              
                
                <div class="linha">
                    <div class="coluna coluna-3"><p class="espaço">Espaço</p></div>

                    <div class="coluna coluna-6">

                        <form id="formulario" name="formulario" action="editado_adm.php" method="post" enctype="multipart/form-data" >

                            <ul id="progress">
                                <li class="ativo">Login</li>
                                <li>Dados pessoais</li>
                                <li>Informações</li>
                            </ul>

                            <fieldset>
                                <h2>Cadastro</h2>
                                
                                <!--Para o adm-->
                                    <?php 
                                        if($_SESSION['adm'] == 1){
                                    ?>
                                            <h3>Tornar o usuário um administrador?</h3>
                                            <h3>Sim</h3>
                                            <input type="checkbox" name="adm" value="1"/>
                                            <h3>Não</h3>
                                            <input type="checkbox" name="adm" value="2" checked/>
                                    <?php
                                        }else{
                                    ?>  
                                            <input type="hidden" name="adm" value="2"/>
                                    <?php        
                                        }

                                    ?>
                                 <!--Para o adm-->
                                 
                                <input class="estilo_input" placeholder="Login" type="text" name="login" id="idlogin" value="<?php echo $registro['login']; ?>" style=" width: 100%;">
                                <input class="estilo_input" placeholder="Senha" minlength="8" maxlength="20" type="password" name="senha" id="idsenha" value="<?php echo $registro['senha']; ?>" style=" width: 100%;">
                                <input class="estilo_input" placeholder="Repetir senha" type="password" name="rep_senha" id="idrep_senha" value="<?php echo $registro['rep_senha']; ?>" style=" width: 100%;">

                                <input type="button" name="next1" class="next acaonext1" value="Proximo"/>

                            </fieldset>

                            <fieldset>
                                <h2>Cadastro</h2>
                                <input type="hidden" value="<?php echo $registro['id_user']; ?>" name="id_user"  />                                
                                <input class="estilo_input" placeholder="Nome" type="text" name="nome" id="idnome" value="<?php echo $registro['nome']; ?>" style=" width: 100%;">
                                <input class="estilo_input" placeholder="Sobrenome" type="text" name="sobrenome" id="idsobrenome" value="<?php echo $registro['sobrenome']; ?>" style=" width: 100%;"> 
                                <input class="estilo_input" placeholder="Data de nascimento" type="date" name="data_nasc" maxlength="10" id="iddata_nasc" value="<?php echo $registro['data_nasc']; ?>" style=" width: 100%;">
                                <input class="estilo_input" placeholder="E-mail" type="e-mail" name="email" id="idemail" value="<?php echo $registro['email']; ?>" style=" width: 100%;"> 

                                <input type="button" name="prev" class="prev acaoprev" value="Anterior"/>
                                <input type="button" name="next2" class="next acaonext" value="Proximo"/>

                            </fieldset>


                            <fieldset>
                                <h2>Cadastro</h2>

                                <h6 class="url_steam">Steam Community Link (obrigatório)<br> Vá para <a target="_blank" href="https://steamcommunity.com/my">https://steamcommunity.com/my</a> para obter o seu link</h6>
                                <input class="estilo_input" type="text" name="url_steam" id="idurl_steam" value="<?php echo $registro['url_steam']; ?>" style="width: 100%">


                                <select class="opcoes_cadastro" name="level_gc">
                                    <option value="<?php echo $registro['level_gc']; ?>" selected="selected"><?php echo $registro['level_gc']; ?></option>
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
                                <!--patente-->                                                              
                                <select class="opcoes_cadastro" name="patentes" required>

                                    <option value="<?php echo $registro['id_patente']; ?>"><?php echo $registro['descricao']; ?></option>
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
                                <!--Horário de treino--> 
                                <h3>Horário de treino</h3>
                                    <?php
                                    $sql_hr = "SELECT hora_treino, id_horario FROM horario order by id_horario asc";
                                    $resultado_hr = pg_query($conexao, $sql_hr);
                                    $linhas_hr = pg_num_rows($resultado_hr);

                                    for ($i = 0; $i < $linhas_hr; $i++) {
                                        $registro_hr = pg_fetch_array($resultado_hr);
                                        if (in_array($registro_hr['id_horario'], $vetor_hora)) {
                                            ?>

                                        <input type="checkbox" name="horario[]" value="<?php echo $registro_hr['id_horario']; ?>" checked /> <h5 class="descricao_treino"><?php echo $registro_hr['hora_treino']; ?></h5><br>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="checkbox" name="horario[]" value="<?php echo $registro_hr['id_horario']; ?>" /> <h5 class="descricao_treino"><?php echo $registro_hr['hora_treino']; ?></h5><br>

                                            <?php
                                        }
                                    }
                                    ?>


                                <!--Função--> 
                                <h3>Função no jogo</h3>
                                <?php
                                $sql_fun = "SELECT funcao, img_funcao, id_funcao FROM funcao order by id_funcao asc";
                                $resultado_fun = pg_query($conexao, $sql_fun);
                                $linhas_fun = pg_num_rows($resultado_fun);
                                
                                for ($j = 0; $j < $linhas_fun; $j++) {
                                    $registro_fun = pg_fetch_array($resultado_fun);
                                    if (in_array($registro_fun['id_funcao'], $vetor_funcao)) 
                                        {
                                                                               
                                            ?>
                                            <input type="checkbox" name="funcao[]" value="<?php echo $registro_fun['id_funcao']; ?>" checked /><h5 class="descricao_treino"><?php echo $registro_fun['funcao']; ?></h5> <?php echo "<img class='img_funcao' src='../img/funcao/$registro_fun[img_funcao]'/>"; ?><br style="clear: both">

                                         <?php  
                                        } else {
                                         ?>
                                                <input type="checkbox" name="funcao[]" value="<?php echo $registro_fun['id_funcao']; ?>"  /><h5 class="descricao_treino"><?php echo $registro_fun['funcao']; ?></h5> <?php echo "<img class='img_funcao' src='../img/funcao/$registro_fun[img_funcao]'/>"; ?><br><br style="clear: both">

                                <?php
                                                }
                                        
                                }
                                ?>

                                            
                                <input type="hidden" name ="MAX_FILE_SIZE"  value="20000000">
                                <h3>Foto do perfil</h3>
                                <input placeholder="Foto do perfil" class="texto_cadastro" type="file" name="foto_perfil" style=" width: 100%;">

                                <br/><br/>

                                <input type="button" name="prev" class="prev acaoprev" value="Anterior"/>
                                <input type="submit" name="enviar" class="acaoenviar" value="Update" id="idenviar"/>

                            </fieldset>

                        </form>

                    </div>

                </div>
                <div class="coluna coluna-12">
                    <h2 class="#"><a href="usuarios_cadastrados.php">Cancelar</a></h2>
                </div>
            </div>

        </div>



        <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/validacao.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
    </body>

