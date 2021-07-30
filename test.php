<?php


spl_autoload_register();

$alquilibro  = new Alquilibros();

$user1 = new User("Pepe Reina",14);
$alquilibro->addEmployee($user1);
$alquilibro->addBook("Peter Pan","joven");
$alquilibro->addDvd("Peter Pan","joven");


$alquilibro->reserveBook("Peter Pan",$user1);
$alquilibro->UnreserveBook("Peter Pan",$user1);

$alquilibro->reserveDvd("Peter Pan",$user1);
$alquilibro->UnreserveDvd("Peter Pan",$user1);
foreach ($alquilibro->getAvailableBooks() as $title => $book) {
	echo "title ". $title ."\n";
	echo $book . "\n";
}

