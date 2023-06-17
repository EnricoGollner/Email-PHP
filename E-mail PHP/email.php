<?
function enviarEmail($nomeDestinatario, $emailDestinatario, $nomeRemetente, $emailRemetente, $assunto, $corpo, $anexo){
	$logo = '';  // Link da logo
	$sender = '';  // e-mail que enviará
	if($nomeRemetente == '') $nomeRemetente = '';  // Nome da empresa ou pessoa
	if($emailRemetente == '') $emailRemetente = '';  // email pelo qual será enviado

	$corpo = '
        <table border="0" cellspacing="0" cellpadding="2" style="font:14px Arial">
        <tr>
            <td><img src="'.$logo.'"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>'.$corpo.'</td>
        </tr>
        </table>
    ';

	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->CharSet = 'ISO-8859-1';  // Pode ser UTF-8
	$mail->Host = '';  // DNS da hospedagem (Domínio)
	$mail->SMTPAuth = true;
	$mail->Username = '';  // Email pelo qual será enviado
	$mail->Password = '';  // Senha do e-mail pelo qual será enviado
	$mail->SMTPSecure = 'tls'; // Define se utilizado SSL/TLS - Mantenha o valor "false"
	$mail->SMTPAutoTLS = false; // Define se, por padrão, ser utilizado TLS - Mantenha o valor "false"
	$mail->Port = 587;
	$mail->SMTPDebug = 0;

	$mail->Sender = $sender;
	$mail->From = $sender;
	$mail->FromName = $nomeRemetente;
	$mail->addAddress($emailDestinatario, $nomeDestinatario);
	$mail->addReplyTo($emailRemetente, $nomeRemetente);

	$mail->isHTML(true);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	if($anexo['tmp_name'] != ""){
		$mail->addAttachment($anexo['tmp_name'], $anexo['name']);
	}
	$mail->send();
}
?>