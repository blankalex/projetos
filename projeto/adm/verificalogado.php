<?php
    session_start();
    if (!isset($_SESSION['logado'])){
        echo "<script>window.location='../index.php'</script>";
    }
?>