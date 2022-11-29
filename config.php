<?php

$databaseHost = '127.0.0.1'; //or localhost
$databaseName = 'tourism'; // your db_name
$databaseUsername = 'root'; // root by default for localhost 
$databasePassword = '';  // by defualt empty for localhost

$con = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
