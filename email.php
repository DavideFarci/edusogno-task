<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email</title>
</head>

<?php
session_start();
include "database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

if (isset($_POST['email'])) {
    // verifico se l'email è presente nel database 
    $email = $_POST["email"];
    $sqlMail = "SELECT * FROM utenti WHERE email='$email'";
    $result = mysqli_query($conn, $sqlMail);
    if (mysqli_num_rows($result) === 1) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.mailtrap.io'; // Hostname di Mailtrap
            $mail->Username   = 'ca63e1fbfe9ca9'; // Nome utente di Mailtrap
            $mail->Password   = '0015b531a04475'; // Password di Mailtrap
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 2525; // Porta SMTP di Mailtrap
        
            $mail->setFrom('from@example.com');
            $mail->addAddress($email);
            $mail->addReplyTo('edusogno@exaple.com');
        
            $mail->isHTML(true);
            $mail->Subject = "Password Reset";
            $mail->Body    = <<<END
    
            Click <a href="http://localhost:8080/EduSogno/edusogno-esercizio/reset_password.php">here</a> to reset to password.
        
            END;;
            
            $mail->send();
            echo 'Il messaggio è stato inviato con successo, controlla la tua mail o inbox.';
            
        } catch (Exception $e) {
            echo "Impossibile inviare il messaggio. Errore Mailer: {$mail->ErrorInfo}";
        }
    }else {
        echo 'La mail non è presente nel nostro database';
    } 
}?>


<body>
    <form action="" method="post">
        <label for="email">Invia un'email per cambiare al password</label>
        <input name="email" placeholder="Inserisci l'indirizzo email">
        <button type="submit">INVIA</button>
    </form>
</body>
</html>

