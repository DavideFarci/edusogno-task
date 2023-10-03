<?php 
include "database.php";
session_start();

$user_email = $_SESSION['email'];
$sqlEvents = "SELECT * FROM eventi WHERE attendees LIKE '%$user_email%'";
$result = mysqli_query($conn, $sqlEvents);

if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Home</title>
</head>

<body>
    <h1>Ciao, <?= $_SESSION['nome']?></h1>

    <?php while ($row = mysqli_fetch_assoc($result)) {
        $eventName = $row['nome_evento'];
        $eventDate = $row['data_evento']; ?>
    
        <div class="card">
            <h3> <?= $eventName ?> </h3>
            <div class="date"><?= $eventDate ?></div>
            <button>JOIN</button>
        </div>
    <?php } ?>
</body>

</html>

<?php 
}else {
    header("Location: index.php");
    exit();
}
?>