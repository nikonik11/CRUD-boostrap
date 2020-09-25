<?php

error_reporting(-1);
ini_set('display_errors', 'On');

define('DB_HOST', 'localhost:3306');
define('DB_NAME', 'blog');
define('DB_TABLE', 'post');
define('DB_USER', 'root');
define('DB_PASSWORD', '');


try
{
    $bdd = new PDO ('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';dbtable=' . DB_TABLE . ';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
    catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}   

