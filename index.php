<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css">
    <title>Edusogno</title>
</head>

<body>
    <div class="login">
        <form action="login.php" method="post">
            <h2>LOGIN</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?= $_GET['error'] ?></p>
            <?php } ?>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Inserisci la tua email"><br>

            <label for="pass">Password</label>
            <input type="password" name="pass"><br>

            <button class="btn btn-submit" type="submit">Login</button>

        </form>

        <h5>Non hai ancora un profile?</h5>
        <button class="btn btn-register"><a href="register.php">Registrati</a></button>
    </div>
</body>

</html>