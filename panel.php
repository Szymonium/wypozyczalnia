<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel bazy wypożyczalni</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" href="./car.ico">
</head>
<body>
  <?php
    $user = $_COOKIE['user'];
    $password = $_COOKIE['password'];

    @$akcja = $_POST['akcja'];

    $conn = mysqli_connect('localhost', "$user", "$password", 'rentakar');

    $tabele = ["klienci" => [], "samochody" => [], "pracownicy" => [], "wypozyczenia" => []];
    $showTables = mysqli_query($conn, "SHOW TABLES");
    while ($tables = mysqli_fetch_array($showTables)) {
      $describeTable = mysqli_query($conn, "DESCRIBE " . $tables[0]);
      while ($columns = mysqli_fetch_array($describeTable)) {
        array_push($tabele[$tables[0]], $columns['Field']);
      }
    }

  ?>
  <section class="all">
    <header>  
      <a href="./logout.php" class="log-out">Wyloguj się</a>
      <h1>
        <?php 
          echo $_COOKIE['user'] . ', ';
        ?>
        witaj w panelu zarządzania bazą danych Wypożyczalni Rentakar!
    </h1>
    </header>
    <main>
      <form method="post" action="./panel.php" class="panel">
        <h3>Wybierz akcję</h3>
        <p>Wybierz typ akcji do wykonania na bazie</p>

        <input type="radio" id="select" name="akcja" value="select">
        <label for="select">Wybieranie danych po id</label><br>

        <input type="radio" id="insert" name="akcja" value="insert">
        <label for="insert">Dodawanie danych</label><br>

        <input type="radio" id="delete" name="akcja" value="delete">
        <label for="delete">Usuwanie danych po id</label><br>

        <button type="submit">Przejdź do panelu</button>
      </form>

      <table>
        <?php 
          
        ?>
      </table>
    </main>
  </section>
</body>
</html>