<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <title>Home</title>
</head>

<?php 
include "header.php";
include "database.php";
session_start();

$user_email = $_SESSION['email'];
$sqlEvents = "SELECT * FROM eventi WHERE attendees LIKE '%$user_email%'";
$result = mysqli_query($conn, $sqlEvents);

if (isset($_SESSION['id']) && isset($_SESSION['nome']) && isset($_SESSION['cognome'])) {
?>

<body>
    <div class="container">
        <h1 class="title_form">Ciao <?= $_SESSION['nome']?>, ecco i tuoi eventi</h1>

        <div class="cards">
            <?php while ($row = mysqli_fetch_assoc($result)) {
            $eventName = $row['nome_evento'];
            $eventDate = $row['data_evento']; ?>

            <div class="card">
                <h2 class="title_card"> <?= $eventName ?> </h2>
                <div class="date"><?= $eventDate ?></div>
                <button class="btn text-center">JOIN</button>
            </div>
            <?php } ?>
        </div>

        <button class="btn_logout"><a href="logout.php">LOGOUT</a></button>
    </div>
</body>

</html>

<?php 
}else {
    header("Location: index.php");
    exit();
}
?>