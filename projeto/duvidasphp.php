<?php
/* e-mail de contato */
if (isset($_POST['pergunta'])) {
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

    $mail->Body = "Remetente: " . $nome . "<br>" . "Mensagem: " . $mensagem . "<br>" . " Enviado por: " . $email_resposta;

// Enviando o email

    if (!$mail->Send()) {

        $message = "Erro no envio do e-mail";
    } else {
        
        ?>
            <script>alert("E-mail enviado com sucesso!");</script>
        <?php
            echo "<script>location.href='index.php';</script>";
    }
      

    
               
    
    echo $message;
}
/* até aqui e-mail de contato */
?>