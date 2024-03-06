<!DOCTYPE html>
<?php 
if (isset($_COOKIE['user']) && isset($_COOKIE['password'])) {
  $user = $_COOKIE['user'];
  $password = $_COOKIE['password'];
}
?>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel bazy Warsztat</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <h1>
    <?php 
      echo $user. ', ';
    ?>
    witaj w panelu zarządzania bazą danych Warsztatu Rentakar!
  </h1>
  <a href="./logout.php">Wyloguj się</a>
</body>
</html>