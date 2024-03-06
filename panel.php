<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel bazy Wypoożyczalnia</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
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

    </main>
  </section>
</body>
</html>