<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css">
    <title>Dashboard</title>
</head>
<?php
session_start();
include "database.php";
include "admin.php";

$eventController = new EventController($conn);
// var_dump($eventi) ;

// if (in_array($_SESSION['email'], $admin)) {

// }



?>



<body>
    <h1>Ciao a tutti!</h1> 
    <h2>Elenco Eventi</h2>
        <ul>
    <?php $eventi = $eventController->index(); foreach ($eventi as $indice => $evento) { ?>
        <li>
            <strong>Nome Evento:</strong> <?php echo $evento->getNomeEvento(); ?><br>
            <strong>Attendees:</strong> <?php echo $evento->getAttendees(); ?><br>
            <strong>Data e Ora dell'Evento:</strong> <?php echo $evento->getDataEvento(); ?><br>
            <!-- <form action="admin_dashboard.php" method="post" style="display: inline;">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id_evento" value="<?php echo $evento->getId(); ?>">
                <label for="nome_evento">Nuovo Nome Evento:</label>
                <input type="text" name="nome_evento" value="<?php echo $evento->getNomeEvento(); ?>" placeholder="Nuovo Nome Evento">
                <label for="attendees">Nuovi Attendees:</label>
                <input type="email" name="attendees" value="<?php echo $evento->getAttendees(); ?>" placeholder="Nuovi Partecipanti">
                <label for="data_evento">Nuova Data e Ora dell'Evento:</label>
                <input type="datetime-local" name="data_evento" value="<?php echo date("Y-m-d\TH:i:s", strtotime($evento->getDataEvento())); ?>" placeholder="Nuova Data e Ora">
                <button type="submit">Modifica</button>
            </form> -->


            <form action="admin_dashboard.php" method="post" style="display: inline;">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                <input type="hidden" name="id_evento" value="<?php echo $evento->getId(); ?>">
                <button type="submit">Elimina</button>
            </form>
        </li>
    <?php } ?>
</ul>   
</body>
</html>