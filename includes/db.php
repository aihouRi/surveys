<?php

$user = 'aihou';
$pass = 'aihou';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=surveys;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '接続成功';
} catch (PDOException $e) {
    echo 'Error:' . $e->getMessage();
    die();
}