<?php
/* login */

include "adm/conecta.php";
if ($_POST) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * from usuario WHERE login = '" . $login . "' AND senha = '" . $senha . "'";
 
      
    $resultado = pg_query($conexao, $sql);
    $linhas = pg_num_rows($resultado);
    
   

    if ($linhas > 0) {
        $registro = pg_fetch_array($resultado);
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['id'] = $registro['id_user'];
        $_SESSION['nome'] = $registro['nome'];
        $_SESSION['adm'] = $registro['adm'];
        $_SESSION['nivel'] = $registro['nivel'];
        $adm = $registro['adm'];
        
        if($adm == 1){
            header("Location: adm/index_adm.php");
       
        }
        else{
            $sql_user_jogo = "SELECT id_jogo_user, jogos.id_jogo, nome_jogo  from jogo_user join jogos using(id_jogo) WHERE id_user = '" . $registro['id_user'] . "'";
           
            $resultado_user_jogo = pg_query($conexao, $sql_user_jogo);
            $linhas_user_jogo = pg_num_rows($resultado_user_jogo);
              if ($linhas_user_jogo > 0) {
                $registro_user_jogo = pg_fetch_array($resultado_user_jogo);

                $_SESSION['id_jogo'] = $registro_user_jogo['id_jogo'];
                $_SESSION['id_jogo_user'] = $registro_user_jogo['id_jogo_user'];
                $_SESSION['nome_jogo'] = $registro_user_jogo['nome_jogo'];
                
              }
            
              
            
            echo "<script>location.href='user/index_usuario.php';</script>";
           // header("Location: index.php");
        }
        
    } else {
        echo "<script>alert('Login ou senha inválidos!');</script>";
        echo "<script>location.href='index.php#modalloginlink';</script>";
    }
}


pg_close($conexao);

/* fim do login */
?> 