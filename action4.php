<?php
require "action.php";
$dsn = "mysql:host=localhost;dbname=solvit";
$opt = array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$DBH = new PDO($dsn, 'solvit', 'solvit', $opt);

$stmt = $DBH->query("SELECT * FROM city");
$row = $stmt->fetch(PDO::FETCH_LAZY);

$city= new City($row['nameCity'],1964, $row['coordinat'], $row['region']);
echo $city->about();
echo"<br></br>";
//////////////////////////////////////////////////////////////////////////////////
$stmt=$DBH->query("SELECT * FROM street");
while($row=$stmt->fetch(PDO::FETCH_LAZY)){
$str=new streetName($row['streetName'],$row['length'],$row['startCoordinat'],$row['finishCoordinat']);
$city->addStreetName($str);
echo $str->about();
}
//////////////////////////////////////////////////////////////////////////////////////
$stmt=$DBH->query("SELECT * FROM building");
while($row=$stmt->fetch(PDO::FETCH_LAZY)){
$building= new Building($row['streetName'], $row['buildingNumber'], $row['quantityEntrance'], $row['florBuilding'], $row['quantityApp'], $row['squareBuilding'],$row['rentM']);
echo "<br>";
$building->aboutBuilding();
$str->addBuilding($building);
}
///////////////////////////////////////////////////////////////////////////////////////////
$stmt=$DBH->query("SELECT * FROM apartment");
while($row=$stmt->fetch(PDO::FETCH_LAZY)){
$app= new Appartment($row['numberApp'], $row['room'], $row['flor'], $row['squareApp'],$row['balcony'],$row['person']);
echo "<br>";
$app->about();

}













?>