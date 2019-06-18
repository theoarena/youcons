<?php

//require_once('PHPMailerAutoload.php');

require '/phpmailer/src/Exception.php';
require '/phpmailer/src/PHPMailer.php';
require '/phpmailer/src/SMTP.php';

echo "asd";exit;

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.youcons.com.br';
$mail->SMTPAuth = true;
$mail->Username = 'contato@youcons.com.br';
$mail->Password = 'uXq~sa]bq(7,';
$mail->SMTPSecure = 'ssl';
$mail->Port = 587;

$mail->setFrom('theoarena@gmail.com', 'Théo Arena');
//$mail->addReplyTo('emailderetorno@seudominio.com.br', 'Nome do email para retorno');

//$mail->addAttachment('local_do_anexo/arquivo.extenção', 'NomeAmigavel.extenção');

$mail->isHTML(true);
$mail->Subject = 'youcons indicação';
$mail->Body = 'email da hostgator';
$mail->AltBody = 'Conteúdo alternativo (em texto simples), caso destinatário não possa receber em HTML';

if(!$mail->send()) {
echo 'Contato não pode ser enviado.';
echo 'Erro: ' . $mail->ErrorInfo;
} else {
echo 'Contato enviado com sucesso!';
}

?>