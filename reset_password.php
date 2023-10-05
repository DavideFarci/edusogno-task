<?php include "header.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
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
            ?><div class="php_mess">
                <?php echo "La password è stata cambiata correttamente!"; ?>
            </div><?php 
            header("refresh:2;url=index.php");
            exit();
        }else {
            header("Location: reset_password.php?error=Hai inserito valori non validi");
            exit();
        }
    }
}?>

<body>
    <h4 class="title_form">Cambia la tua password</h4>
    <div class="form">
        <form action="" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?= $_GET['error'] ?></p>
            <?php } ?>

            <label for="new_pass">Inserisci la nuova password</label>
            <input type="password" name="new_pass" placeholder="Scrivila qui">

            <button class="btn text-center" type="submit">CHANGE PASSWORD</button>

        </form>
    </div>
</body>

</html>
