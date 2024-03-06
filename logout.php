<?php 
setcookie('user', "", time() - 3600, '/');
setcookie('password', "", time() - 3600, '/');

include './uri.php';
header('Location: '.$uri.'/warsztat/logowanie.php');
exit;
?>