<?php



require "../../PHPMailer/Exception.php"; //PHPMailer/Exception.php
require "../../PHPMailer/PHPMailer.php"; //PHPMailer/PHPMailer.php
require "../../PHPMailer/SMTP.php"; //PHPMailer/SMTP.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function EnviarCorreo($Correo_login, $Correo_clave_login, $Correo_Emisor, $Nombre_Emisor, $Correo_Receptor, $Nombre_Receptor, $Asunto, $Mensaje)
{
    $mail = new PHPMailer(true);
    try {

        //Server settings
        $mail->SMTPDebug = 0;
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $Correo_login; //'pepitogarza12424@gmail.com';                     //SMTP username
        $mail->Password   = $Correo_clave_login; //'reejaxkowouztadt';                               //SMTP password
        $mail->SMTPSecure =  "tls";  // PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($Correo_Emisor, $Nombre_Emisor);
        //$mail->setFrom('pepitogarza12424@gmail.com', 'LocalHost');
        $mail->addAddress($Correo_Receptor, $Nombre_Receptor);     //Add a recipient
        //$mail->addAddress('Rricardo1988@gmail.com', 'Testing');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        // $mail->Subject = 'Prueba de Envio de Correo ';
        $mail->Subject = $Asunto;
        // $mail->Body    = 'Esto es un Correo Enviado Desde PHP <b>in bold!</b>';
        $mail->Body    = $Mensaje;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Enviado Correctamente';
        $data = array("status" => 1, "msg" => "Correo Enviado");
        return $data;
    } catch (Exception $e) {
        //echo "Error al Enviar: {$mail->ErrorInfo}";
        $data = array("status" => 0, "msg" => $mail->ErrorInfo);
        return $data;
    }
}
