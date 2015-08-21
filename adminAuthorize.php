<?php
$username = 'ICDP';
$password = 'temp';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
|| $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password){
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Admin"');
exit('You must have a valid username and password!');
};
?>