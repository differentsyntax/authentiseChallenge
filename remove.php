<?php

$username  = 'auth';
$password  = '1Authentise!';

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=dogBreeds', $username, $password);
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$name = $_POST["name"].trim();
$response = [];

try {
	$sql = $dbconn->prepare("

   DELETE FROM breeds
   WHERE       name = :name

  ");

$sql->execute([
	'name' => $name,
]); 

echo "True";

}
catch(PDOException $e) {
	echo $e->getMessage();
} 

?>
