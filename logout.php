<?php
unset($_COOKIE['user']);
// empty value and expiration one day before
$res = setcookie('user', '', time() - 86400);
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Logged Out!')
    window.location.href='Login.php';
    </SCRIPT>");

exit;
?>