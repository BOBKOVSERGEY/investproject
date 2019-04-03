<?php

namespace application\lib;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mail
{
  public static function sendMail($subject, $body, $address) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "esdipochta@gmail.com";
    $mail->Password = "1987kira1954";
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';
    $mail->setFrom('esdipochta@gmail.com', 'Подтверждение регистрации');
    $mail->addAddress($address);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    return $mail->send();

  }
}