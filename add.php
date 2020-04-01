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
$url = $_POST["url"].trim();
$response = [];

try {
	$sql = $dbconn->prepare("

  INSERT INTO breeds  (name, picture_url)
  VALUES(:name, :url)

  ");

$sql->execute([
	'name' => $name,
	'url'  => $url
]); 

echo "True";

}
catch(PDOException $e) {
	echo $e->getMessage();
} 

?>