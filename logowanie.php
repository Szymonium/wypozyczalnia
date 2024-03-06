<!DOCTYPE html>
<?php
if (isset($_COOKIE['user']) && isset($_COOKIE['password'])) {
  @$user = $_COOKIE['user'];  
  @$password = $_COOKIE['password'];
}
else {
  @$user = $_POST['user'];
  @$password = $_POST['password'];
}

setcookie('user', @$user, time() + 86400, '/');
setcookie('password', @$password, time() + 86400, '/');
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
  <?php
    $conn = mysqli_connect('localhost', 'root', '', 'mysql');

    $validLogIn = FALSE;
    $selectPassword = mysqli_query($conn, "SELECT User, Password FROM user WHERE password = PASSWORD('$password') AND user = '$user'");
    while ($result = mysqli_fetch_array($selectPassword)) {
      $validLogIn = TRUE;
    }

    include './uri.php';
    if ($validLogIn) {
      header('Location: '.$uri.'/wypozyczalnia/panel.php');
    }

    if ($user != '' && !$validLogIn) {
      header('Location: '.$uri.'/wypozyczalnia/logowanieError.php');
    }

    mysqli_close($conn);
  ?>
    <form method="post" action="./logowanie.php">
        <h3>Zaloguj się</h3>
        <p>Zaloguj się na konto phpMyAdmin, aby uzystać dostęp do panelu bazy wypożyczalni</p>

        <label for="username">Nazwa użytkownika</label>
        <input type="text" placeholder="Username" name="user" id="username">

        <label for="password">Hasło</label>
        <input type="password" placeholder="Password" name="password" id="password">
        
        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>