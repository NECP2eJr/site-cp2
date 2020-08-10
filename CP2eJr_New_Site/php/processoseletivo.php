<?php 
/*
    O código abaixo realiza o envio de dois emails no processo seletivo:

    1 - Email para a Empresa Jr. (Para a equipe do processo seletivo) com os dados do candidato.
    2 - Email para o candidato confirmando o recebimento da inscrição.

    Foi utilizado o PHPMailer para realizar a configuração e envio dos emails.
    Obs.: Verificar sempre que necessário se o PHPMailer não sofreu nehuma atualização.

*/

include 'PHPMailer/PHPMailerAutoload.php';

//Data de início das inscrições (aaaa-mm-dd)
$inicio = "2020-08-08";

//Data de término das inscrições (aaaa-mm-dd) (dia de fechamento + 1)
$fim = "2020-09-08";

//Mensagens de erro
$outOfDate = 'Infelizmente o Processo Seletivo já foi encerrado!';
$error = 'Ops! Algo deu errado, por favor tente novamente!';

$sucesso = 'Sua inscrição foi realizada com sucesso! Verifique seu e-mail para mais informações.\\n';
$sucesso .= 'ATENÇÃO!! Se você utiliza o Gmail, não faça login pelo Outlook!';

if(strtotime("now") >= strtotime($inicio) && strtotime("now") <= strtotime($fim)){
    //Campos utilizados no Formulario
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $periodo = $_POST['periodo'];
    $matricula = $_POST['matricula'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $nucleoPref = $_POST['nucleo_preferencia'];
    $nucleoOpc = $_POST['nucleo_opcional'];
    $comoSoube = $_POST['como_soube'];
    $atividades = $_POST['atividades'];

    if(isset($_FILES) && (bool) $_FILES){
        //Formatos Possiveis dos anexos
        $allowedExtensions = array("pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt");

        //Verificação se o arquivo possui as extensões permitidas.
        $files = array();
        foreach($_FILES as $name=>$file) {
            $file_name = $file['name'];
            $temp_name = $file['tmp_name'];
            $file_type = $file['type'];
            $path_parts = pathinfo($file_name);
            $ext = $path_parts['extension'];
            if(!in_array($ext,$allowedExtensions)) {
                die("O arquivo $file_name possui a extensão $ext que nao e suportada, por favor mude o formato do arquivo e tente novamente.");
            }
            array_push($files,$file);
        }
        
        // Verificação dos campos válidos
        if($nome != '' && $curso != '' && $periodo != '' && $matricula != '' && $telefone != ''
                && $email != ''&& $nucleoPref != ''&& $comoSoube != ''&& $atividades != ''){

            // Email processo seletivo: processoseletivocp2ejr@inatel.br
            // Dados para envio do email com o formulario preenchido
            $from = 'ngct@cp2ejr.com.br';                                   // Remetente
            $to = 'paolafreitas@gec.inatel.br';                       // Destinatário
            $subject = 'Processo Seletivo CP2eJr';    
            
            // Mensagem que será enviada para a Empresa Júnior.
            $message = 'Dados Cadastrados através do Formulário do Processo Seletivo da CP2eJr:' . '</br>'.'</br>';

            $message .= "Nome: $nome" . '</br>';
            $message .= "Curso: $curso" . '</br>';
            $message .= "Período: $periodo" . '</br>';
            $message .= "Matrícula: $matricula" . '</br>';
            $message .= "Telefone de Contato: $telefone" . '</br>';
            $message .= "E-Mail do Inatel: $email" . '</br>';
            $message .= "Núcleo de Preferência: $nucleoPref" . '</br>';
            $message .= "Núcleo Opcional: $nucleoOpc" . '</br>';
            $message .= "Como ficou sabendo: $comoSoube" . '</br>';
            $message .= "Atividades que participa: $atividades" . '</br>'.'</br>';

            $message .= "Formulário do Processo Seletivo CP2eJr 2º Semestre de 2020 - Criado pela Núcleo de Engenharia";

            $mail = new PHPMailer();

            $mail->CharSet = 'UTF-8';
            $mail->SetFrom($from, "Empresa Jr.");
            $mail->Subject = $subject;
            $mail->AddAddress($to);
            $mail->MsgHTML($message);
    
            // Anexos
            for($i = 0; $i < count($files); $i++){
                $mail->AddAttachment($files[$i]['tmp_name'], $files[$i]['name']);
            }
        
            //Envia o email para a Empresa Jr.
            if($mail->Send()) {
                $message = 'Muito obrigado por se interessar e se inscrever em nosso processo seletivo. ';
                $message .= 'Seu currículo será avaliado e o resultado será divulgado até dia 13 de agosto.' . '</br>' . '</br>';
                $message .= 'Att.,'.'</br>';
                $message .= 'CP2eJr – Consultoria de Projetos em Engenharia';

                $mail = new PHPMailer();

                $mail->CharSet = 'UTF-8';
                $mail->SetFrom($from, "Empresa Jr.");
                $mail->Subject = $subject;
                $mail->AddAddress($email);
                $mail->MsgHTML($message);
                
                if($mail->Send()){
                    echo "<meta charset='utf-8'/><script>alert('$sucesso')</script>";
                    echo "<script>document.location.href='https://www.cp2ejr.com.br'</script>";
                }else{
                    echo "<meta charset='utf-8'/><script>alert('$error')</script>";
                    echo "<script>document.location.href='https://www.cp2ejr.com.br/processo.html'</script>";
                }
            } else {
                echo "<meta charset='utf-8'/><script>alert('$error')</script>";
                echo "<script>document.location.href='https://www.cp2ejr.com.br/processo.html'</script>";
            }
        }else{
            echo "<script>document.location.href='https://www.cp2ejr.com.br/processo.html'</script>";
        }

    }
}else{
    echo("<meta charset='utf-8'/><script type='text/javascript'> alert('$outOfDate'); location.href='http://www.cp2ejr.com.br';</script>");
}
?>