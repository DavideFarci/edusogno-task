<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Edusogno</title>
</head>

<body>
    <form action="login.php" method="post">
        <h2>REGISTER</h2>
        <p class="error"></p>

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