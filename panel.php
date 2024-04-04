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
    @$password = $_COOKIE['password'];

    @$akcja = $_POST['akcja'];

    $conn = mysqli_connect('localhost', "$user", "$password", 'rentakar');

    $tabele = ["klienci" => [], "samochody" => [], "pracownicy" => [], "wypozyczenia" => []];
    $showTables = mysqli_query($conn, "SHOW FULL TABLES WHERE Table_Type != 'VIEW'");
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
        <?php 
          switch(@$akcja) {
            case "select":
              echo "
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              
              ";
            break;

            case "insert":
              echo "
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              
              ";
            break;

            case "delete":
              echo "
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              
              ";
            break;

            default:
              echo "
              <h3>Wybierz akcję</h3>
              <p>Wybierz typ akcji do wykonania na bazie</p>
              <input type='radio' id='select' name='akcja' value='select'>
               <label for='select'>Wybieranie danych</label><br>
              <input type='radio' id='insert' name='akcja' value='insert'>
               <label for='insert'>Dodawanie danych</label><br>
              <input type='radio' id='delete' name='akcja' value='delete'>
               <label for='delete'>Usuwanie danych</label><br>
              <button type='submit'>Przejdź do panelu</button>
              ";
          }
        ?>
      </form>
    </main>
  </section>
  <section class='all second'>
    <header>
      <h1>Raport zapytania</h1>
    </header>
    <main>
    <table class="panel">
        <?php 
          switch(@$akcja) {
            default:
              for ($i = 0; $i < 100; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 6; $j++) {
                  if ($i != 0) {
                    echo "<td class='td-" . $i%2 . "'>CUM</td>";
                    continue;
                  }
                  echo "<th>CUM</th>";
                }
                echo "</tr>";
              }
          }
        ?>
      </table>
    </main>
  </section>
</body>
</html>