<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>TMFinder</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/grid.css">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/duvidas.css">
        <script type="text/javascript" src="jquery-3.0.0.js"></script>
        <script type="text/javascript" src="validacao1.js"></script>

    </head>

    <body>
        <div class="conteudo">
            <!--Menu-->
            <div class="linha">

                <nav id="menu">

                    <div class="coluna coluna-3">
                        <a href="index.php">
                            <figure>
                                <img id="logo" src="img/novologo2.png" alt="TMFinder">
                                <h1>TMFinder</h1>
                            </figure>
                        </a>
                    </div>
                    <div class="coluna coluna-9 ">
                        <ul class="navegacao">    
                            <li><a href="#">Jogos</a></li>
                            <li><a href="#">Equipes</a></li>
                            <li><a href="duvidas.php">Dúvidas</a></li>
                            <li><a href="#">Cadastro</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>
                    </div> 

                </nav>              
            </div>

            <div class="centro">
                <!--Contato-->
                <div class="linha">


                    <div class="contato">
                        <h2>Contato</h2><br /><br />
                        <form method="post" id="contato" name="form_contato" action="duvidas.php" onsubmit="return validacao();">

                            <select class="texto_contato" style=" width: 96.6%;" name="assunto">
                                <option value="Assunto" selected="selected">Assunto</option>
                                <option value="Outro">Outro</option>
                                <option value="Outro 2">Outro 2</option>
                                <option value="Outro 3">Outro 3</option>
                            </select><br /><br />

                            <input class="texto_contato" placeholder="NOME" type="text" name="nome" id="idnome" style=" width: 95.8%;"> <br /><br />

                            <input class="texto_contato" placeholder="E-MAIL" type="email" name="email_resposta" id="idemail_resposta" style=" width: 95.8%;"> <br /><br />

                            <textarea class="texto_contato" placeholder="MENSAGEM" name="mensagem" rows="5" style=" width: 94.5%;"></textarea> <br /><br />

                            <input class="botao" type="submit" name="enviar" value="ENVIAR" />
                        </form>                       
                    </div>

                </div>

            </div>




            <?php
            if (isset($_POST['enviar'])) {
// Inclui o arquivo PHPMailerAutoload.php localizado na pasta PHPMailer-master

                require("PHPMailer-master/PHPMailerAutoload.php");

// resgatando os dados passados pelo form

                $nome = $_POST['nome'];
                
                $assunto = $_POST['assunto'];

                $email = 'alexmblank94@gmail.com';

                $mensagem = $_POST['mensagem'];

                $email_resposta = $_POST['email_resposta'];

// instanciando a classe
                $mail = new PHPMailer();

//  opçao de idioma, setado como br	
                $mail->SetLanguage("br");

// habilitando SMTP	
                $mail->IsSMTP();

// enviando como HTML
                $mail->IsHTML(true);

// Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	
                $mail->SMTPDebug = 0;

// habilitando autenticação	
                $mail->SMTPAuth = true;

// habilitando tranferêcia segura (obrigatório)	
                $mail->SMTPSecure = 'ssl';


// Configurações para utilização do SMTP do Gmail  

                $mail->Host = 'smtp.gmail.com';

                $mail->Port = 465; // Porta de envio de e-mails do Gmail

                $mail->Username = 'alexmblank94@gmail.com';

                $mail->Password = 'adhoc200013';

                $mail->CharSet = "utf-8";

// Remetente da mensagem

                $mail->SetFrom($email);

// Endereço de destino do email
                $mail->AddAddress($email);

// Endereço para resposta

                $mail->addReplyTo($email_resposta);

// Assunto e Corpo do email

                $mail->Subject = $assunto;

                $mail->Body = "Remetente: ".$nome."<br>". "Mensagem: " . $mensagem ."<br>". " Enviado por: " . $email_resposta;

// Enviando o email

                if (!$mail->Send()) {

                    $message = "Erro no envio do e-mail";
                } else {

                    $message = "<script>alert('E-mail enviado com sucesso!')</script>";
                }
                echo $message;
            }
            ?>
        </div>

    </body>

</html>