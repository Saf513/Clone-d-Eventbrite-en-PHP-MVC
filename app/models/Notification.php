<?php

    namespace APP\Models;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Notification {

        public $mail;

        public function __construct() {
            $this->mail = new PHPMailer(true);
        }

        public function notify($email, $subject, $body) {
            try {
                $this -> mail->isSMTP();
                $this -> mail->Host = 'smtp.gmail.com'; // Serveur SMTP
                $this -> mail->SMTPAuth = true;
                $this -> mail->Username = $_ENV['PHPMAILER_EMAIL']; // Votre adresse email
                $this -> mail->Password = $_ENV['PHPMAILER_PASSWORD']; // Votre mot de passe email
                $this -> mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $this -> mail->Port = 587;
    

                $this -> mail->setFrom($_ENV['PHPMAILER_EMAIL'], 'No Reply');
                $this -> mail->addAddress($email, 'Destinataire');
    

                $this -> mail->isHTML(true);
                $this -> mail->Subject = $subject;
                $this -> mail->Body    = $body;
    

                $this -> mail->send();
                return true;
            } catch (Exception $e) {
                echo "L'email n'a pas pu être envoyé. Erreur : {$this -> mail->ErrorInfo}";
                return false;
            }
        }

    }

?>