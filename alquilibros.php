<?php

spl_autoload_register();
use Item\Stock;
use Item\DVD;
use Item\Book;
class Alquilibros
{
	/**
	 * @var Stock
	 */
	private $books;
	/**
	 * @var Stock
	 */
	private $dvds;
	/**
	 * @var array
	 */
	private $employees = [];

    private $ageRanges = [];

    public function __construct()
    {
        $this->books = new Stock();
        $this->dvds = new Stock();
        $this->ageRanges["niño"] = new AgeRange("niño",0,12);
        $this->ageRanges["joven"] = new AgeRange("joven",13,17);
        $this->ageRanges["adulto"] = new AgeRange("adulto",18);
        $this->ageRanges["default"] = new AgeRange("default",0);
    }

    //-------------------------------- BOOKS ------------------------------------------------------------------//

    /**
     * @return array
     */
    public function getAvailableBooks()
    {
        return $this->books->getAvailable();
    }
    /**
     * @param string $title
     * @param string $age
     *
     * @return bool
     */
    public function addBook(string $title, string $age)
    {
        $ageRange = array_key_exists($age, $this->ageRanges) ? $this->ageRanges[$age] : $this->ageRanges["default"];
        $book = new Book($title, $ageRange);
        $result = $this->books->addItem($book);
        echo $this->showMessage($result,"libro",$title,"añadido");
        return $result == Stock::OK;
    }
    /**
     * @return array
     */
    public function getReservedBooks()
    {
        return $this->books->getReserved();
    }
    /**
     * @param string $title
     * @param User $user
     * 
     * @return bool
     */
    public function reserveBook(string $title, User $user)
    {
        if($this->dvds->userHasAReserve($user)){
            echo $this->showMessage(Stock::RESERVED,"libro",$title,"reservado",$user->getName());
            return false;
        }
        $result = $this->books->reserveItem($title, $user);
        echo $this->showMessage($result,"libro",$title,"reservado",$user->getName());
        if($result == Stock::OK)
        {    
            echo "El precio del alquiler es de ".$this->getPriceAsString($user,Book::getPrice()) ."€.\n";
        }
        return $result == Stock::OK;
    }
    /**
     * @param string $title
     * @param User $user
     *
     * @return bool
     */
    public function unReserveBook(string $title, User $user)
    {
    	$result = $this->books->unReserveItem($title, $user);
        echo $this->showMessage($result,"libro",$title,"devuelto",$user->getName());
        return $result == Stock::OK;
    }

    //--------------------------------- DVD --------------------------------------------------------------------//
    
    /**
     * @return array
     */
    public function getAvailableDvds()
    {
        return $this->dvds->getAvailable();
    }
    /**
     * @param string $title
     * @param string $age
     *
     * @return bool
     */
    public function addDvd(string $title, string $age)
    {
        $ageRange = array_key_exists($age, $this->ageRanges) ? $this->ageRanges[$age] : $this->ageRanges["default"];
        $dvd = new DVD($title, $ageRange);
        $result = $this->dvds->addItem($dvd);
        echo $this->showMessage($result,"DVD",$title,"añadido");
        return $result == Stock::OK;
    }

    /**
     * @return array
     */
    public function getReservedDvds()
    {
        return $this->dvds->getReserved();
    }
    /**
     * @param string $title
     * @param User $user
     *
     * @return bool
     */
    public function reserveDvd(string $title, User $user)
    {
        if($this->books->userHasAReserve($user)){
            echo $this->showMessage(Stock::RESERVED,"DVD",$title,"reservado",$user->getName());
            return false;
        }
        $result = $this->dvds->reserveItem($title, $user);
        echo $this->showMessage($result,"DVD",$title,"reservado",$user->getName());
        if($result == Stock::OK)
        {
            echo "El precio del alquiler es de ".$this->getPriceAsString($user,DVD::getPrice()) ."€.\n";
        }
        return $result == Stock::OK;
    }
    /**
     * @param string $title
     * @param User $user
     *
     * @return bool
     */
    public function unReserveDvd(string $title, User $user)
    {
    	$result = $this->dvds->unReserveItem($title, $user);
        echo $this->showMessage($result,"DVD",$title,"devuelto",$user->getName());
        return $result == Stock::OK;
    }
    /**
     * @param User $employee
     * @return bool
     */

    //------------------------------ EMPLOYEES -------------------------------------------------//
    public function addEmployee(User $employee)
    {
        if(array_key_exists($employee->getId(),$this->employees))
        {
            echo "El usuario ya es empleado.\n";
            return false;
        }
        $this->employees[$employee->getId()] = $employee;
        echo "El usuario se ha registrado como empleado.\n";
        if($employee->getAge() < 18)
        {
            echo "Aviso: La explotación infantil es delito.\n";
        }
        return true;
    }
    /**
     * @return array
     */
    public function getEmployees()
    {
        return $this->employees;
    }
    /**
     * @param User $employee
     * @return bool
     */
    public function isEmployee(User $employee)
    {
        return array_key_exists($employee->getId(),$this->employees);
    }
    /**
     * @param User $user
     * @param int price
     * @return int
     */

    //----------------------------------- PRICE ---------------------------------------//
    public function getPrice(User $user, int $price)
    {
        return $this->isEmployee($user) ? round($price * 0.9) : $price; 
    }
    /**
     * @param User $user
     * @param int price
     * @return int
     */
    public function getPriceAsString(User $user, int $price)
    {
        $result = $this->isEmployee($user) ? round($price * 0.9) : $price; 
        return number_format($result / 100.0 ,2);
    }

    //------------------------------------ MESSAGES ----------------------------------------//
    /**
     * @return string
     */
    public function showMessage(int $result, string $type, string $title, string $action  ,string $username = null)
    {
        switch ($result) {
            case Stock::OK:
            $userText = $username ? " por ". $username : "";
            return "El ". $type . " '".$title . "' ha sido ".$action .$userText . " con éxito.\n";
            case Stock::EXISTS:
            return "El ". $type . " '".$title ."' ya existe.\n";
            case Stock::NOT_FOUND:
            return "El ". $type . " '".$title . "' no se ha encontrado.\n";
            case Stock::RESERVED:
            return "El usuario " . $username ." ya tiene una reserva.\n";
            case Stock::NOT_RESERVED:
            return "El ". $type . " '".$title ."' no ha sido reservado.\n";
            case Stock::NOT_RESERVED_BY_USER:
            return "El ". $type . " '".$title ."' no ha sido reservado por el usuario ".$username ."\n";
            case Stock::NOT_SUITABLE:
            return "El ". $type . " '".$title ."' no es adecuado para el usuario ".$username ."\n";

            default:
            return "Error desconocido.\n";
        }
    }

    //------------------------------------- INTERACTIVE ---------------------------------------//

    public function intAddItem()
    {
        echo "Añadir un nuevo elemento.\n";
        echo "Libro : 0\nDVD: 1\n";
        $type = readline();
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
}
