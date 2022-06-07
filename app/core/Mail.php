<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->config();
    }

    protected function config()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
    }

    public static function send($mailview, $data)
    {
        $static = new static;
        $static->mail->addAddress($data['to'], $data['name']);
        $static->mail->Subject = $data['subject'];
        $static->mail->Body = View::mail($mailview, $data);
        return $static->mail->send();
    }
}
