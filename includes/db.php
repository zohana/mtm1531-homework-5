<?php

//gets an environment variable we created in the .htaccess file
//this is the best way to keep the user names and passwords out of public GitHub repository
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dsn = getenv('DB_DSN');

//opens a connection to the database and stores it in a variable
$db = new PDO($dsn, $user, $pass);

//makes sure we talk to the database in the UTF-8, so we can support more than just english
$db->exec('SET NAMES utf-8');