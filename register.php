<?php include "header.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <title>Register</title>
</head>

<?php
session_start(); 
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
            $_SESSION['id'] = mysqli_insert_id($conn);
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $name;
            $_SESSION['cognome'] = $surname;
            header("Location: home.php");
            exit();
        }else {
            header("Location: register.php?error=Invalid input insert");
            exit();
        }
    }
}?>

<body>
    <h4 class="title_form">Crea il tuo account</h4>
    <div class="form">
        <form action="" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?= $_GET['error'] ?></p>
            <?php } ?>

            <label for="name">Inserisci il nome</label>
            <input type="text" name="name" placeholder="Mario"><br>

            <label for="surname">Inserisci il cognome</label>
            <input type="text" name="surname" placeholder="Rossi"><br>

            <label for="email">Inserisci l'e-mail</label>
            <input type="email" name="email" placeholder="nome@example.com"><br>

            <label for="pass">Inserisci la password</label>
            <input type="password" name="pass" placeholder="Scrivila qui">

            <button class="btn text-center" type="submit">Register</button>

        </form>
        <div class="register">
            <span>Hai già un account?</span>
            <a href="register.php">Accedi</a>
        </div>
    </div>
</body>

</html>
