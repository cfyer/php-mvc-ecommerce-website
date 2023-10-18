<?php

namespace App\Core;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    protected PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->config();
    }

    protected function config(): void
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
    }

    /**
     * @throws Exception
     */
    public static function send($mailView, $data): bool
    {
        $static = new static;
        $static->mail->addAddress($data['to'], $data['name']);
        $static->mail->Subject = $data['subject'];
        $static->mail->Body = View::render()->mail($mailView, $data);
        return $static->mail->send();
    }
}
