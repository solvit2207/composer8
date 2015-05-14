<?php
/////////////////////Appartment/////////////////////////////////////////////////////
class Appartment extends Building{
var $numberApp;
var $room;
var $flor;
var $square;
var $balcony;
var $person;
var $priceOtoplenie=15;
var $priceAppartment=1.3;
var $priceBalcony=5.2;
var $priceWater=24.2;
var $priceWaterHot=48.5;
var $priceGaz=10.4;
var $allRentApp=0;

function __construct($numberApp, $room, $flor, $squareApp, $balcony, $person){
$this->numberApp=mt_rand(1,20);
$this->room=mt_rand(1,3);
$this->flor=mt_rand(1,5);
$this->squareApp=mt_rand(35,70);
$this->balcony=mt_rand(1,2);
$this->person=mt_rand(1,4);
}
function about(){
echo 'Номер квартиры: '.$this->numberApp.'<br>';
echo 'Количество комнат: '.$this->room.'<br>';
echo 'Этаж: '.$this->flor.'<br>';
echo 'Общая площадь: '.$this->squareApp.'<br>';
echo 'Количество балконов: '.$this->balcony.'<br>';
echo 'Количество жильцов: '.$this->person.'<br>';
}
function appartmentPrice(){
	$sum=($this->squareApp*$this->priceAppartment)+($this->balcony*$this->priceBalcony);
		return $sum;
}
function otoplenie(){
	$sum=$this->squareApp*$this->priceOtoplenie;
		return $sum;
}
function water(){
	$sum=$this->person*$this->priceWater;
		return $sum;
}
function waterHot(){
	$sum=$this->person*$this->priceWaterHot;
		return $sum;
}
function gaz(){
	$sum=$this->person*$this->priceGaz;
		return $sum;
}
function allRent(){
	$all=$this->appartmentPrice()+$this->otoplenie()+$this->water()+$this->waterHot()+$this->gaz();
		$this->allRentApp=$all;
			return $all;
}
public function serialize () {
  $objectData = array(
	"numberApp"=>$this->numberApp,
	"room"=>$this->room,
	"flor"=>$this->flor,
	"squareApp"=>$this->squareApp,
	"balcony"=>$this->balcony,
	"person"=>$this->person);
  return json_encode($objectData);
 }
}

////////////////////////////Entrance//////////////////////////////////////////////////////////////////////
class Entrance{
public $numberEntrance=1;
public $quantityApp=20;
public $codeEntrance='123123';
public $allApp=array();

function __construct($n=1){
	$this->numberEntrance=$n;
}
function addApp($a){//добавляет квартиру в конец массива квартир
	$this->allApp[]=$a;
}
function entranceRent(){
$sum=0;
	for($i=0;$i<count($this->allApp); $i++){
		$sum+=($this->allApp[$i]->allRent());
	}
return $sum;
}
public function population(){
	$pop=0;
	for($i=0;$i<count($this->allApp);$i++){
		$pop+=$this->allApp[$i]->person;
	}
	return $pop; 
}
}

//////////////////////////Building///////////////////////////////////////////////////////////////////////
class Building{
public $streetName;
public $buildingNumber;
public $quantityEntrance=1;
public $florBuilding;
public $quantityApp;
public $squareBuilding;		//площадь прилегаемой территории
public $rentM;			//оплата за 1 м.к.
public $allApp=array();


public function __construct($streetName, $buildingNumber, $quantityEntrance, $florBuilding, $quantityApp, $squareBuilding, $rentM){
//$this->streetName=$streetName->streetNameName;
$this->buildingNumber=mt_rand(1,20);
$this->quantityEntrance=mt_rand(1,6);
$this->florBuilding=mt_rand(1,5);
$this->quantityApp=$this->quantityEntrance*$this->florBuilding*3;
$this->squareBuilding=mt_rand(750,1500);
$this->rentM=mt_rand(5,10);
}

public function electricity(){
	$allSumElect=($this->quantityEntrance+1)*$this->florBuilding*100/1000;//60 Watt
		return $allSumElect;
}
public function rent(){									//плата за землю
	$rent=($this->square*$this->rentM)/$this->$square;
}
public function aboutBuilding(){
//echo 'Данный дом расположен на улице: '.$this->streetName.'<br>';
echo 'Номер дома: '.$this->buildingNumber.'<br>';
echo 'Колличество подъездов: ' .$this->quantityEntrance.'<br>';
echo 'Колличество этажей: ' .$this->florBuilding.'<br>';
echo 'Колличество квартир: ' .$this->quantityApp.'<br>';
echo 'Общая площадь прилегаемой територии: ' .$this->squareBuilding.' кв.м<br>';
echo 'Налог на землю сосатвляет: '.$this->rentM.' грн/кв.м.<br>';
}
public function rentLand(){
	$land=$this->squareBuilding*$this->rentM;
		return $land;
}
public function addApp($app){
	$this->allApp[]=$app;//добавляем квартира в массив
}
public function rentBuilding(){
	$sum=0;
		for($i=0;$i<count($this->allApp);$i++){
			$sum+=$this->allApp[$i]->allRent();	
		}
	return $sum;
}
public function population(){
	$pop=0;
	for($i=0;$i<count($this->allApp);$i++){
		$pop+=$this->allApp[$i]->person;
	}
	return $pop; 
}
}



///////////////////////streetName////////////////////////////////////////////////////////////////////////
class streetName extends Building{
public $streetNameName;
public $length;
public $quantityJanitor=1;// 1 men for 1000 sq.m
public $startCoordinat;
public $finishCoordinat;
public $allBuilding=array();

public function __construct($streetNameName, $length, $startCoordinat, $finishCoordinat){
$street=array("Киевская","Московская","Питерская","Самарская","Пушкинская");
$name=array_rand($street);
$this->streetNameName=$street[$name];
$this->length=mt_rand(7,13);
$this->startCoordinat=mt_rand(128,187);
$this->finishCoordinat=mt_rand(187,197);
}
public function about(){
echo 'Название улицы: '.$this->streetNameName.'<br>';
echo 'Протяженность улицы '.$this->streetNameName.' составляет '.$this->length.' км.<br>';
//echo 'Колличество домов на данной улице - '.count($this->allBuilding).'<br>';
echo 'Координаты начала улицы: '.$this->startCoordinat.'<br>';
echo 'Координаты конца улицы: '.$this->finishCoordinat.'<br>';
}
public function addBuilding($b){
	$this->allBuilding[]=$b;
}
public function rentAll(){
	$sum=0;
		for($i=0;$i<count($this->allBuilding);$i++){
			$sum+=$this->allBuilding[$i]->rentBuilding();	
		}
	return $sum;
}
public function janitor(){
	$square=0;
		for($i=0;$i<count($this->allBuilding);$i++){
			$square+=$this->allBuilding[$i]->squareBuilding;	
		}
	$janitor=ceil($square/1000);
	return $janitor;
}
public function population(){
	$pop=0;
	for($i=0;$i<count($this->allBuilding);$i++){
		$pop+=$this->allBuilding[$i]->population();
	}
	return $pop; 
}

}

////////////////city//////////////////////////////
class city{
public $name;
public $year;
public $coordinates;
public $region;
public $allstreetName=array();
 
public function __construct($name, $year, $coordinates, $region){
$city=array("Киев","Москва","Питер","Самара");
$name=array_rand($city);
$this->name=$city[$name];
$this->year=mt_rand(998,1873);
$this->coordinates=mt_rand(168.263,187.574);
$this->region="Европа";
}
public function about(){
echo 'Название города: '.$this->name.'<br>';
echo 'Год основания : '.$this->year.' год<br>';
echo 'Географические координаты: '.$this->coordinates.'<br>';
echo 'Данный город находится в регионе: '.$this->region.'<br>';
}
public function addstreetName($str){
	$this->allstreetName[]=$str;
}
public function population(){
	$pop=0;
	for($i=0;$i<count($this->allstreetName);$i++){
		$pop+=$this->allstreetName[$i]->population();
	}
	return $pop; 
}
public function serialize () {
  $objectData = array($this);
  return json_encode($objectData);
 }
}



























?>