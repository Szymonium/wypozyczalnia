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

    $selectUser = mysqli_query($conn, "SELECT User FROM user WHERE user = '$user'");

    $userExists = FALSE;
    while ($result = mysqli_fetch_array($selectUser)) {
      if (@$result['User'] == $user) {
        $userExists = TRUE;
      }
    }

    $validPassword = FALSE;
    $selectPassword = mysqli_query($conn, "SELECT User, Password FROM user WHERE password = PASSWORD('$password') AND user = '$user'");
    while ($result = mysqli_fetch_array($selectPassword)) {
      $validPassword = TRUE;
    }

    include './uri.php';
    if ($validPassword) {
      header('Location: '.$uri.'/warsztat/panel.php');
    }
  ?>
    <form method="post" action="./logowanie.php">
        <h3>Zaloguj się</h3>
        <p>Zaloguj się na konto phpMyAdmin, aby uzystać dostęp do panelu bazy warsztatu</p>

        <label for="username">Nazwa użytkownika</label>
        <input type="text" placeholder="Username" name="user" id="username">
        <?php 
        if ($user != '' && !$userExists) {
          echo "<p>Podany użytkownik nie istnieje</p>";
        }
        ?>

        <label for="password">Hasło</label>
        <input type="password" placeholder="Password" name="password" id="password">
        <?php 
        if ($user != '' && !$validPassword) {
          echo "<p>Hasło jest błędne</p>";
          header('Location: '.$uri.'/warsztat/logowanieError.php');
        }
        ?>

        <button type="submit">Zaloguj</button>
    </form>
    <?php 
      mysqli_close($conn);
    ?>
</body>
</html>