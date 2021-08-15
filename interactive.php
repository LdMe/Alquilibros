<?php

spl_autoload_register();

class Interactive extends Alquilibros
{
	/**
     * @var User
     */
    protected $intUser = null;
	public function intAddItem()
	{
		echo "Añadir un nuevo elemento.\n";
		echo "0: Libro\n1: DVD\n";
		$type = readline();
		if($type != 0 && $type != 1)
		{
			return;
		}
		$title = readline("Título: ");
		echo "Rango de edad:\n";
		foreach ($this->ageRanges as $age) {
			$maxAge = $age->getMaxAge() > -1 ? $age->getMaxAge() : " sin límite";
			echo  $age->getName() . ": [".$age->getMinAge() ." a ".$maxAge."]\n";
		}
		$age = readline();
		if($type == 0) {
			$this->addBook($title,$age);
		}
		else {
			$this->addDvd($title,$age);
		}

	}
	public function intAddUser()
	{
		echo "Iniciar sesión como usuario\n";
		$name = readline("Nombre: ");
		$age = readline("Edad: ");
		$this->intUser = new User($name,$age);
		echo "Registrado como ". $name ."\n";
	}
	public function intAddEmployee()
	{
		if($this->intUser == null)
		{
			echo "Para poder registrarse como usuario, primero inicia sesión como usuario.\n";
			return;
		}
		$this->addEmployee($this->intUser);
	}
	public function intReserveItem()
	{
		if($this->intUser == null)
		{
			echo "Debes iniciar sesión para poder alquilar.\n";
			return;
		}
		echo "0: Reservar libro\n1: Reservar DVD\n";
		$type = readline();
		switch ($type) {
			case 0:
			$this->intReserveBook();
			break;
			case 1:
			$this->intReserveDvd();
			break;
			default:
			return;
		}     
	}
	public function intReserveBook()
	{
		$age = $this->intUser->getAge();
		$availableBooks = $this->intGetAvailableBooks($age);
		if(empty($availableBooks))
		{
			echo "No hay libros disponibles para tu edad.\n";
			return;
		}
		echo "Lista de libros disponibles para tu edad:\n";
		foreach ($availableBooks as $title => $book) {
			echo "- ".$title . "\n";
		}
		$title = readline("Título: ");
		$this->reserveBook($title,$this->intUser);
	}
	public function intReserveDvd()
	{
		$age = $this->intUser->getAge();
		$availableDvds = $this->intGetAvailableDvds($age);
		if(empty($availableDvds))
		{
			echo "No hay DVDs disponibles para tu edad.\n";
			return;
		}
		echo "Lista de DVDs disponibles para tu edad:\n";
		foreach ($availableDvds as $title => $dvd) {
			echo "- ".$title . "\n";
		}
		$title = readline("Título: ");
		$this->reserveDvd($title,$this->intUser);
	}
	public function intGetAvailableBooks($age)
	{
		$result = [];
		foreach ($this->getAvailableBooks() as $title => $book) {
			if($book->getAge()->isApt($age))
			{
				$result[$title] = $book;
			}
		}
		return $result;
	}
	public function intGetAvailableDvds($age)
	{
		$result = [];
		foreach ($this->getAvailableDvds() as $title => $dvd) {
			if($dvd->getAge()->isApt($age))
			{
				$result[$title] = $dvd;
			}
		}
		return $result;
	}
	public function intUnreserveItem()
	{
		if($this->intUser == null)
		{
			echo "Debes iniciar sesión para poder devolver un elemento.\n";
			return;
		}  
		$user = $this->intUser;
		if($this->books->userHasAReserve($user))
		{
			$title = $this->books->getUserReservedTitle($user);
			$this->unReserveBook($title,$user);

			return;
		}
		if($this->dvds->userHasAReserve($user))
		{
			$title = $this->dvds->getUserReservedTitle($user);
			$this->unReserveDvd($title,$user);
			return;
		} 
		echo "No tienes ninguna reserva pendiente de devolver.\n";
		return;
	}

	public function menu()
	{
		system('clear');
		while(true)
		{
			echo "\n-----------------Alquilibros-----------------\n";
			echo "Bienvenido a Alquilibros, ¿qué deseas hacer?\n";
			echo "0: Añadir usuario\n1: Registrarse como empleado\n2: Añadir libro / DVD\n3: Reservar libro / DVD \n4: Devolver reserva\n5: salir\n";
			$option = readline();
			if($option >= 0 && $option <= 5)
			{
				system('clear');
				switch ($option) {
					case 0:
					$this->intAddUser();
					break;
					case 1:
					$this->intAddEmployee();
					break;
					case 2:
					$this->intAddItem();
					break;
					case 3:
					$this->intReserveItem();
					break;
					case 4:
					$this->intUnReserveItem();
					break;
					default:
					return;
				}
			}
		}
	}
}