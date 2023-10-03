<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/register.css">
    <title>Change Password</title>
</head>

<?php
session_start(); 
include "database.php";
if (isset($_POST['new_pass'])) {
    $newPass = $_POST['new_pass'];
    $user_id = $_SESSION['id'];


    if (empty($newPass)) {
        header("Location: reset_password.php?error=New Pasword is required");
        exit();
    }else {
        $sqlNewPass = "UPDATE utenti SET password = '$newPass' WHERE id = '$user_id'";
        
        if (mysqli_query($conn, $sqlNewPass)) {
            echo "La password è stata cambiata correttamente!";
            header("refresh:2;url=index.php");
            exit();
        }else {
            header("Location: reset_password.php?error=Hai inserito valori non validi");
            exit();
        }
    }
}?>

<body>
    <form action="" method="post">
        <h2>CHANGE PASSWORD</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?= $_GET['error'] ?></p>
        <?php } ?>

        <label for="new_pass">Nuova Password</label>
        <input type="password" name="new_pass">

        <button type="submit">Change Password</button>

    </form>
</body>

</html>
