<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
include "header.php";
include "database.php";
include "admin.php";

$eventController = new EventController($conn);
$emailAdmin = $_SESSION['email'];

if (in_array($emailAdmin, $admin)) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'add':
                if (isset($_POST['nome_evento']) && isset($_POST['attendees']) && isset($_POST['data_evento'])) {
                    $attendees = $_POST['attendees'];
                    $nome_evento = $_POST['nome_evento'];
                    $data_evento = $_POST['data_evento'];
                    $eventController->store($attendees, $nome_evento, $data_evento);
                }
            break;

            case 'edit':
                if (isset($_POST['id_evento']) && isset($_POST['nome_evento']) && isset($_POST['attendees']) && isset($_POST['data_evento'])) {
                    $id = $_POST['id_evento'];
                    $attendees = $_POST['attendees'];
                    $nome_evento = $_POST['nome_evento'];
                    $data_evento = $_POST['data_evento'];
                    $eventController->update($id, $attendees, $nome_evento, $data_evento);

                    $singleEmail = explode(",", $_POST['attendees']);
                    $finalAttendees = implode(", ", $singleEmail);

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
                        foreach ($singleEmail as $recipients) {
                            $mail->addAddress($recipients);
                        }
                        $mail->addReplyTo('edusogno@exaple.com');
                    
                        $mail->isHTML(true);
                        $mail->Subject = "Password Reset";
                        $mail->Body    = <<<EOD
                        Il tuo evento: '$nome_evento', e' stato modificato dall'amministratore. Il nuovo evento e' il seguente:<br>
                        NOME EVENTO: '$nome_evento'<br>
                        PARTECIPANTI: '$finalAttendees'<br>
                        DATA EVENTO: '$data_evento'
                        EOD;
                        
                        $mail->send();
                        ?><div class="php_mess">
                            <?php echo 'Il messaggio è stato inviato con successo ai partecipanti'; header('refresh:2'); ?>
                        </div><?php 
                        
                    } catch (Exception $e) {
                        ?><div class="php_mess">
                            <?php echo "Impossibile inviare il messaggio. Errore Mailer: {$mail->ErrorInfo}"; ?>
                        </div><?php 
                    }
                }
            break;

            case 'delete':
                if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                    if (isset($_POST['id_evento'])) {
                        $id = $_POST['id_evento'];
                        $eventController->delete($id);
                    }
                }
            break;
        }
    }
?>
<body>
    <h1>Dashboard</h1>

    <!-- Aggiungere un nuovo evento  -->
    <h2>Aggiungi un Evento</h2>
    <div class="form">
        <form action="" method="post">
            <input type="hidden" name="action" value="add">
            <label>Nome Evento:</label>
            <input type="text" name="nome_evento" placeholder="Test Edusogno 1" required><br>
            <label>Attendees (Email):</label>
            <input type="text" name="attendees" placeholder="nome@example.com" required><br>
            <label>Data e Ora dell'Evento:</label>
            <input type="datetime-local" name="data_evento" required><br>
            <button class="btn text-center" type="submit">AGGIUNGI EVENTO</button>
        </form>
    </div>

    <h2>Elenco Eventi</h2>
    <table>
        <tr>
            <th>NOME EVENTO</th>
            <th>ATTENDEES</th>
            <th>DATA EVENTO</th>
            <th>AZIONI</th>
        </tr>
        <?php $eventi = $eventController->index(); foreach ($eventi as $indice => $evento) { ?>
        <tr>
            <td><?= $evento->getNomeEvento(); ?></td>
            <td><?= $evento->getAttendees(); ?></td>
            <td><?= $evento->getDataEvento(); ?></td>
            <td>
                <!-- modifica  -->
                <form class="form_inline" action="edit.php" method="get">
                    <input type="hidden" name="id_evento" value="<?= $evento->getId(); ?>">
                    <button class="btn_table edit" type="submit">Modifica</button>
                </form>
                <!-- eliminazione  -->
                <form class="form_inline" action="" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="indice" value="<?= $indice; ?>">
                    <input type="hidden" name="id_evento" value="<?= $evento->getId(); ?>">
                    <button class="btn_table delete" type="submit">Elimina</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php }else {
    ?><div class="php_mess">
        <?php echo "Non sei autorizzato a vedere questa pagina!"; ?>
    </div><?php 
}?>