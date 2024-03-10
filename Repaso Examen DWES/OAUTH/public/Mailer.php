<?php
// PHPMailerSingleton.php

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private static $instance;
    private $mailer;
    const RUTA_CONFIG_EMAIL = '../config/email.json';

    private function __construct()
    {
        // Configuración de PHPMailer
        $credenciales = json_decode(file_get_contents(self::RUTA_CONFIG_EMAIL), true);
        $this->mailer = new PHPMailer(true);

        try {
            $this->mailer->SMTPDebug = 0;
            $this->mailer->isSMTP();
            $this->mailer->Host       = $credenciales['smtp_host'];
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = $credenciales['smtp_username'];
            $this->mailer->Password   =  $credenciales['smtp_password'];
            $this->mailer->SMTPSecure =  $credenciales['smtp_secure'];
            $this->mailer->Port       = $credenciales['smtp_port'];
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->isHTML(true);

            // Configuración de destinatarios predeterminada
            $this->mailer->setFrom($credenciales['smtp_username'], $credenciales['smtp_from']);
        } catch (Exception $e) {
            echo "Error al configurar PHPMailer: {$e->getMessage()}";
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->mailer;
    }
}
