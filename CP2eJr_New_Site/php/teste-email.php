<?php 
include 'PHPMailer/PHPMailerAutoload.php';

    // Email processo seletivo: processoseletivocp2ejr@inatel.br
    // Dados para envio do email com o formulario preenchido
    $from = 'ngct@cp2ejr.com.br';                                   // Remetente
    $to = 'ProcessoSeletivo20182@inatel.br';                       // Destinatário
    $subject = 'Email Teste';    
    
    $message = "Teste de envio de email para grupo do processo seletivo";

    $mail=new PHPMailer(); // Define os dados do servidor e tipo de conexão
    $mail->Port=465;
    $mail->SMTPSecure = "ssl";
    // Define o remetente
    $mail->SetFrom($from,'Empresa Jr');
    // Define os destinatário(s)
    $mail->AddAddress($to);
    //$mail->AddBCC('seu_e-mail', 'seu_nome'); // Cópia Oculta
    // Define os dados técnicos da Mensagem
    //$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    //$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
    $mail->Subject=$subject;
    $mail->Body=$message;
    //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano!";
    //$mail->AddAttachment("/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
    // Cria e imprime variável de controle
    // Exibe uma mensagem de resultado
    echo $imprime;
    if($mail->Send()){// Envia o e-mail
    echo 'E-mail enviado com sucesso!';
    }else{
    echo 'Erro ao enviar e-mail: '.$mail->ErrorInfo;
    }

    //Envia o email para a Empresa Jr.
    echo $mail->Send();
?>