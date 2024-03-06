<!DOCTYPE html>
<?php
setcookie('user', @$user, time() - 3600, '/');
setcookie('password', @$password, time() - 3600, '/');
?>
<html lang="pl">
<head>
    <title>Logowanie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="./car.ico">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <form method="post" action="./logowanie.php" class="log-in">
        <h3>Zaloguj się</h3>
        <p>Zaloguj się na konto phpMyAdmin, aby uzystać dostęp do panelu bazy wypożyczalni</p>

        <label for="username">Nazwa użytkownika</label>
        <input type="text" placeholder="Username" name="user" id="username">

        <label for="password">Hasło</label>
        <input type="password" placeholder="Password" name="password" id="password">
        <p>Błąd nazwy użytkownika lub/i hasła</p>

        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>