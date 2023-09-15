<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

function sendEmail($address, $name, $code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp-mail.outlook.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'pitPoolCare@gmail.com'; //SMTP username
        $mail->Password = 'senhadopit123A'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('pitPoolCare@gmail.com', 'Equipe Pool Care');
        $mail->addAddress($address, $name); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Mensagem Equipe Pool Care';
        $mail->Body = 'Informe este código na tela de recuperar senha, não o compartilhe com ninguém:' . $code;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}