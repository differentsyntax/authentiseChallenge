<?php

$username  = 'auth';
$password  = '1Authentise!';

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=dogBreeds', $username, $password);
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>