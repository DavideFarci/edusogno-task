<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <title>Edit Event</title>
</head>
<?php
session_start();
include "database.php";
include "admin.php";

if (isset($_GET['id_evento'])) {
    $id_evento = $_GET['id_evento'];
    // var_dump($id_evento);
    
    $sqlId = "SELECT * FROM eventi WHERE id='$id_evento'";
    $result = mysqli_query($conn, $sqlId);
    $row = mysqli_fetch_assoc($result);
    
} else {
    ?><div class="php_mess">
        <?php echo "Nessun evento specificato da poter modificare"; ?>
    </div><?php 
}
?>


<body>
    <h4 class="title_form">Modifica l'evento</h4>
    <div class="form">
        <form action="dashboard.php" method="post" style="display: inline;">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id_evento" value="<?= $row['id'];?>">
            <input type="text" name="nome_evento" value="<?= $row['nome_evento']; ?>" placeholder="Nuovo Nome Evento"><br>
            <input type="email" name="attendees" value="<?= $row['attendees']; ?>" placeholder="Nuovi Partecipanti"><br>
            <input type="datetime-local" name="data_evento" value="<?= date("Y-m-d\TH:i:s", strtotime($row['data_evento'])); ?>" placeholder="Nuova Data e Ora">
            <button class="btn text-center" type="submit">Modifica</button>
        </form>
    </div>
</body>
</html>