<?php
	//Campos utilizados no Formulario ligados ao name=""
    $nome = $_POST['nome'];
	$email = $_POST['email'];
	$assunto = $_POST['assunto'];
	$mensagem = $_POST['mensagem'];
	//Dados para envio do email com o formulario preenchido
    $from = 'De: CP2e Jr';
    $to = 'contatocp2ejr@inatel.br';
    $to2 = $email;
	$subject = 'Cliente entrou em contato';
  //o que será recebido no email da empresa
	$message = " Dados do cliente que entrou em contato \n\n Nome: $nome\n E-Mail: $email \n\n Assunto: $assunto\n\n Mensagem:\n $mensagem\n";
  //resposta ao Cliente
	$message2 = " Obrigada por entrar em contato!\n Seu email sera respondido em breve.\natt\n CP2eJr-Consultoria e Projetos em Engenharia\n";

	// if(isset($_FILES) && (bool) $_FILES){
		//Formatos Possiveis dos anexos
		// $allowedExtensions = array("pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt");

	/*$files = array();
		foreach($_FILES as $name=>$file) {
			$file_name = $file['name'];
			$temp_name = $file['tmp_name'];
			$file_type = $file['type'];
			$path_parts = pathinfo($file_name);
			$ext = $path_parts['extension'];
			if(!in_array($ext,$allowedExtensions)) {
				die("O arquivo $file_name possui a extensao $ext que nao e suportada, por favor mude o formato do arquivo e tente novamente");
			}
			array_push($files,$file);
		}

	// email fields: to, from, subject, and so on
	$headers = "From: $from";

	// boundary
	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

	// headers for attachment
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

	// multipart boundary
	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"utf-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
	$message .= "--{$mime_boundary}\n";

		// preparing attachments
		for($x=0;$x<count($files);$x++){
			$file = fopen($files[$x]['tmp_name'],"rb");
			$data = fread($file,filesize($files[$x]['tmp_name']));
			fclose($file);
			$data = chunk_split(base64_encode($data));
			$name = $files[$x]['name'];
			$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" .
			"Content-Disposition: attachment;\n" . " filename=\"$name\"\n" .
			"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
			$message .= "--{$mime_boundary}\n";
		}
		*/
    if ($_POST['submit']) {
		if ($nome != '' && $mensagem != '' && $assunto != '' && $email  != '' ) {
			if (mail ($to, $subject,$message, $headers) && mail($to2, $subject, $message2, $from)) {
				echo("<script type='text/javascript'> alert('Email foi enviado com Sucesso'); location.href='http://cp2ejr.com.br/contato.html';</script>");
			} else {
				echo '<p>Algo deu errado, volte e tente novamente!</p>';
			}
		}
	}
?>
