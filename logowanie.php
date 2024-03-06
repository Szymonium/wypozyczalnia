<!DOCTYPE html>
<?php
if (isset($_COOKIE['user']) && isset($_COOKIE['password'])) {
  $user = $_COOKIE['user'];
  $password = $_COOKIE['password'];
}
else {
  @$user = $_POST['user'];
  @$password = $_POST['password'];
}

if (@$user && $password) {
  setcookie('user', @$user, time() + (86400), '/');
  setcookie('password', @$password, time() + (86400), '/');
}

?>
<html lang="pl">
<head>
    <title>Logowanie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="./car.ico">
    <style>
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #212121;
}
form{
    height: 570px;
    width: 400px;
    background-color: #0D7377;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid #323232;
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

form p {
  font-size: 16px;
  font-weight: 400;
  text-align: center;
  margin-top: 10px;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.1);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #212121;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
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

    

  ?>
    <form method="post" action="./logowanie.php">
        <h3>Zaloguj się</h3>
        <p>Zaloguj się na konto phpMyAdmin, aby uzystać dostęp do panelu bazy warsztatu</p>

        <label for="username">Nazwa użytkownika</label>
        <input type="text" placeholder="Username" name="user" id="username">
        <?php 
        if ($user != '' && !$userExists) {
          echo "<p>Użytkownik o podanej nazwie nie istnieje</p>";
        }
        ?>

        <label for="password">Hasło</label>
        <input type="password" placeholder="Password" name="password" id="password">
        <?php 
        if ($user != '' && !$validPassword) {
          echo "<p>Hasło jest błędne</p>";
        }
        ?>

        <button type="submit">Zaloguj</button>
    </form>
    <?php 
      mysqli_close($conn);
    ?>
</body>
</html>