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
    @$tabela = $_POST['tabela'];
    @$kolumna = $_POST['kolumna'];
    @$wartosc = $_POST['wartosc'];
    @$wybor = $_POST['wybor'];
    $query;

    if ($tabela == "") {
      $tabela = "klienci";
    }

    $conn = mysqli_connect('localhost', "$user", "$password", 'rentakar');

    $tabele = [];
    $showTables = mysqli_query($conn, "SHOW FULL TABLES WHERE Table_Type != 'VIEW'");
    while ($tables = mysqli_fetch_array($showTables)) {
      $describeTable = mysqli_query($conn, "DESCRIBE " . $tables[0]);
      $tabele[$tables[0]] = [];
      while ($columns = mysqli_fetch_array($describeTable)) {
        array_push($tabele[$tables[0]], $columns['Field']);
      }
    }

    function handleTabele($array) {
      echo "<select name='tabela' onchange='form.submit()' class='tabele'>";
      foreach (@$array as $key => $value) {
        if ($key != $GLOBALS['tabela']) {
          echo "<option value='$key'>$key</option>";
          continue;
        }
        echo "<option value='$key' selected>$key</option>";
      }
      echo "</select><br>";
    }

    function handleArrayInTabele($array) {
      echo "<select name='kolumna' class='kolumny'>";
      foreach (@$array as $value) {
        if ($value != $GLOBALS['kolumna']) {
          echo "<option value='$value'>$value</option>";
          continue;
        }
        echo "<option value='$value' selected>$value</option>";
      }
      echo "</select>";
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
              <input type='checkbox' name='akcja' value='$akcja' id='sendigma' checked>
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              <h3>Tabela:</h3>
              ";
              handleTabele($tabele);
              echo "
              <input type='radio' id='all' name='wybor' value='all'>
               <label for='all'>Wszystkie rekordy z tabeli</label><br>
              <input type='radio' id='one-cond' name='wybor' value='one-cond'>
               <label for='one-cond'>Wybierz jeżeli:</label>
              ";
              handleArrayInTabele($tabele[$tabela]);
              echo "
              <b>=</b>
              <input type='text' name='wartosc' id='wartosc' class='text-input' value='$wartosc'><br>
              <button type='submit' value='$akcja' name='akcja'>Wykonaj</button>
              ";
              if ($wybor == "all") {
                $query = mysqli_query($conn, "SELECT * FROM `$tabela`");
              }
              elseif ($wybor == "one-cond") {
                $query = mysqli_query($conn, "SELECT * FROM `$tabela` WHERE $kolumna = '$wartosc'");
              }
            break;

            case "insert":
              echo "
              <input type='checkbox' name='akcja' value='$akcja' id='sendigma' checked>
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              <h3>Tabela:</h3>
              ";
              handleTabele($tabele);

              $insert = "INSERT INTO `$tabela` (";

              foreach (@$tabele[$tabela] as $key => $value) {
                if ($value != 'id') {
                  echo "
                  <label for='wartosc-$key'>$value: </label>
                  <input type='text' name='wartosc-$key' class='wartosc text-input' id='wartosc-$key'><br>
                  ";
                  if ($value == $tabele[$tabela][count($tabele[$tabela]) - 1]) {
                    $insert = $insert . $value;
                    continue;
                  }
                  $insert = $insert . $value . ", ";
                }
              }

              $insert = $insert . ') ';

              echo "<button type='submit' value='$akcja' name='akcja'>Wykonaj</button>";

              $insert = $insert . "VALUES (";

              for ($i = 1; $i < count($tabele[$tabela]); $i++) {
                if ($i == count($tabele[$tabela]) - 1) {
                  $insert = $insert . strval(@$_POST["wartosc-$i"]);
                  continue;
                }
                $insert = $insert . "'" . strval(@$_POST["wartosc-$i"] . "', ");
              }
              $insert = $insert . ')';
              if (!str_contains($insert, "'', '', '',")) {
                $query = mysqli_query($conn, $insert);
                $query = mysqli_query($conn, "SELECT * FROM `$tabela` ORDER BY id DESC LIMIT 1");
              }
            break;

            case "delete":
              echo "
              <input type='checkbox' name='akcja' value='$akcja' id='sendigma' checked>
              <button type='submit' value='' name='akcja' id='go-back'>Powrót</button>
              <h3>Tabela:</h3> 
              ";
              handleTabele($tabele);
              echo "
              <input type='radio' id='all' name='wybor' value='all'>
               <label for='all'>Wszystkie rekordy z tabeli</label><br>
              <input type='radio' id='one-cond' name='wybor' value='one-cond'>
               <label for='one-cond'>Usuń jeżeli:</label>
              ";
              handleArrayInTabele($tabele[$tabela]);
              echo "
              <b>=</b>
              <input type='text' name='wartosc' id='wartosc' class='text-input' value='$wartosc'><br>
              <button type='submit' value='$akcja' name='akcja'>Wykonaj</button>
              ";
              if ($wybor == "all") {
                $query = mysqli_query($conn, "SELECT * FROM `$tabela`");
                $delete = mysqli_query($conn, "TRUNCATE `$tabela`");
              }
              elseif ($wybor == "one-cond") {
                $query = mysqli_query($conn, "SELECT * FROM `$tabela` WHERE $kolumna = '$wartosc'");
                $delete = mysqli_query($conn, "DELETE FROM `$tabela` WHERE $kolumna = '$wartosc'");
              }
            break;

            default:
              echo "
              <h3>Wybierz akcję</h3>
              <p>Wybierz typ akcji do wykonania na bazie</p>
              <input type='radio' id='select' name='akcja' class='akcja' value='select'>
               <label for='select'>Wybieranie danych</label><br>
              <input type='radio' id='insert' name='akcja' class='akcja' value='insert'>
               <label for='insert'>Dodawanie danych</label><br>
              <input type='radio' id='delete' name='akcja' class='akcja' value='delete'>
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
            case "insert":
              echo "<tr><th colspan=" . count($tabele[$tabela]) .">Dodany rekord</th></tr>";
              echo "<tr>";
              for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                echo "<th>". $tabele[$tabela][$j] ."</th>";
              }
              echo "</tr>";
              $i = 0;
              if (@$query != NULL) {
                while ($wynik = mysqli_fetch_array($query)) {
                  echo "<tr>";
                  for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                    echo "<td class='td-". $i%2 ."'>". $wynik[$j] ."</td>";
                  }
                  echo "</tr>";
                  $i++;
                }
              }
            break;

            case "delete":
              echo "<tr><th colspan=" . count($tabele[$tabela]) .">Usunięte rekordy</th></tr>";
              echo "<tr>";
              for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                echo "<th>". $tabele[$tabela][$j] ."</th>";
              }
              echo "</tr>";
              $i = 0;
              if (@$query != NULL) {
                while ($wynik = mysqli_fetch_array($query)) {
                  echo "<tr>";
                  for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                    echo "<td class='td-". $i%2 ."'>". $wynik[$j] ."</td>";
                  }
                  echo "</tr>";
                  $i++;
                }
              }
            break;

            case "select":
              echo "<tr>";
              for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                echo "<th>". $tabele[$tabela][$j] ."</th>";
              }
              echo "</tr>";
              $i = 0;
              if (@$query != NULL) {
                while ($wynik = mysqli_fetch_array($query)) {
                  echo "<tr>";
                  for ($j = 0; $j < count($tabele[$tabela]); $j++) {
                    echo "<td class='td-". $i%2 ."'>". $wynik[$j] ."</td>";
                  }
                  echo "</tr>";
                  $i++;
                }
              }
            break;

            default:
              echo "
                <tr>
                  <th>Żadne zapytanie nie zostało wysłane do bazy</th>
                <tr>
              ";
          }
        ?>
      </table>
    </main>
  </section>
  <?php 
    mysqli_close($conn);
  ?>
</body>
</html>