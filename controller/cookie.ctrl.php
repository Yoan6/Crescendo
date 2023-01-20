<?php
$accepterCookies = htmlspecialchars($_GET['accepterCookies'] ?? '');

if ($accepterCookies != '') {
    header("Location: accueil.ctrl.php");
}

?>