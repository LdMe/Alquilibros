<?php


spl_autoload_register();

use \item\DVD;
use \item\Book;

function testAge($name,$minAge,$maxAge = -1)
{
	$age = new Age($name,$minAge,$maxAge);
	echo "Age: ". $age->getName() . " min: ". $age->getMinAge() . " max: ". $age->getMaxAge() . "\n";
	return $age;

}
function testApt($age, $num)
{
	$apt = $age->isApt($num) ? "apt" :"not apt";
	echo "age ". $num . " is ". $apt ."\n";
}

$age = testAge("joven",0,12);
testApt($age,-1);
testApt($age,0);
testApt($age,1);
testApt($age,11);
testApt($age,12);
testApt($age,13);

$dvd = new DVD("testfilm",$age);
$book = new Book("testfilm",$age);
echo $dvd->getName()."\n";

$alquilibro  = new Alquilibros();

$alquilibro->reserveDvd($dvd);
$alquilibro->addDvd($dvd);

$alquilibro->unReserveDvd($dvd);
$alquilibro->reserveDvd($dvd);
$alquilibro->unReserveDvd($dvd);

$alquilibro->reserveBook($book);
$alquilibro->addBook($book);

$alquilibro->unReserveBook($book);
$alquilibro->reserveBook($book);
$alquilibro->unReserveBook($book);

