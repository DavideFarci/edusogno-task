<?php include "header.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <title>Edusogno</title>
</head>

<body>
    <main>
        <h4 class="title_form">Hai già un account?</h4>
        <div class="form">
            <form action="login.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?= $_GET['error'] ?></p>
                <?php } ?>

                <label for="email">Inserisci l'e-mail</label>
                <input type="email" name="email" placeholder="nome@example.com"><br>

                <label for="pass">Inserisci la password</label>
                <input type="password" name="pass" placeholder="Scrivila qui"><br>

                <button class="btn text-center" type="submit">ACCEDI</button>

            </form>

            <div class="register">
                <span>Password dimenticata?</span>
                <a href="email.php">Recupera</a>
            </div>

            <div class="register">
                <span>Non hai ancora un profile?</span>
                <a href="register.php">Registrati</a>
            </div>
        </div>
    </main>
</body>

</html>