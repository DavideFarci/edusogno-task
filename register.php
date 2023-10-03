<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Register</title>
</head>

<?php 
include "database.php";
if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['pass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name = validate($_POST['name']);
    $surname = validate($_POST['surname']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);

    if (empty($name)) {
        header("Location: register.php?error=Name is required");
        exit();
    }else if (empty($surname)) {
        header("Location: register.php?error=Surname is required");
        exit();
    }else if (empty($email)) {
        header("Location: register.php?error=Email is required");
        exit();
    }else if (empty($pass)) {
        header("Location: register.php?error=Pasword is required");
        exit();
    }else {
        $sql_new_user = "INSERT INTO utenti (nome, cognome, email, password)
            VALUES ('$name', '$surname', '$email', '$pass')";
        
        if (mysqli_query($conn, $sql_new_user)) {
            echo "New user created successfully";
            header("Location: home.php");
            exit();
        }else {
            header("Location: register.php?error=Invalid input insert");
            exit();
        }
    }
} 
?>

<body>
    <form action="" method="post">
        <h2>REGISTER</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?= $_GET['error'] ?></p>
        <?php } ?>

        <label for="name">Nome</label>
        <input type="text" name="name" placeholder="Inserisci il tuo nome"><br>

        <label for="surname">Cognome</label>
        <input type="text" name="surname" placeholder="Inserisci il tuo cognome"><br>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Inserisci la tua email"><br>

        <label for="pass">Password</label>
        <input type="password" name="pass">

        <button type="submit">Register</button>

    </form>
</body>

</html>