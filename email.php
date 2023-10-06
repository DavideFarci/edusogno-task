<?php include "header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
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
            ?><div class="php_mess">
                <?php echo 'Il messaggio è stato inviato con successo, controlla la tua mail o inbox.'; ?>
            </div><?php 
            
        } catch (Exception $e) {
            ?><div class="php_mess">
                <?php echo "Impossibile inviare il messaggio. Errore Mailer: {$mail->ErrorInfo}"; ?>
            </div><?php 
        }
    }else {
        ?><div class="php_mess">
            <?php echo 'La mail non è presente nel nostro database'; ?>
        </div><?php 
            
    } 
}?>


<body>
    <h4 class="title_form">Invia un'email al tuo indirizzo per cambiare la password</h4>
    <div class="form">
        <form action="" method="post">
            <label for="email">Inserisci la tua e-mail</label>
            <input name="email" placeholder="nome@example.com">
            <button class="btn text-center" type="submit">INVIA</button>
        </form>
    </div>
</body>
</html>

