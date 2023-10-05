<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/home.css">
    <title>email</title>
</head>

<?php
session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $destinatario = $_SESSION['email'];
        $oggetto = "CAMBIO PASSWORD";
        $messaggio = "Vai a questo link per cambiare la tua password: http://localhost:8080/EduSogno/edusogno-esercizio/reset_password.php";

        // Configura le informazioni SMTP di Mailtrap
        $smtpServer = "smtp.mailtrap.io";
        $smtpPort = 465;
        $smtpUsername = "ca63e1fbfe9ca9";
        $smtpPassword = "0015b531a04475";

        // Puoi aggiungere ulteriori intestazioni se necessario
        $intestazioni = "From: gengi.scan@mail.com";

        // Imposta le informazioni SMTP
        ini_set("SMTP", $smtpServer);
        ini_set("smtp_port", $smtpPort);
        ini_set("sendmail_from", $smtpUsername);

        // Invia l'email
        if (mail($destinatario, $oggetto, $messaggio, $intestazioni)) {
            echo "Email inviata con successo.";
        } else {
            echo "Errore nell'invio dell'email.";
        }
    }
?>


<body>
    <form method="post" action="">
        <label for="invia_email">Invia un'email per cambiare al password</label>
        <input name="invia_email" placeholder="Inserisci l'indirizzo email">
        <button type="submit">Invia l'email</button>
    </form>
</body>
</html>

