<?php
$username = 'ICDP';
$password = 'Icdp*20151$';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
|| $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password){
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Admin"');
exit('You must have a valid username and password!');
};
?>