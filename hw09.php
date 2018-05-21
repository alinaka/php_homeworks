<?php
/*
Задание ко вторнику (22.05.2018):
Тренируйтесь)
1. Создать фигуры: Circle, Rectangle, Triangle, у которых будут координаты. Все фигуры должны иметь методы, которые возвращают площадь и периметр (для окружности - длина окружности).
*/
class Circle {
	private $x;
	private $y;
	private $r;
	public function __construct($x, $y, $r){
		$this->x = $x;
		$this->y = $y;
		$this->r = $r;
	}
	public function getArea(){
		return M_PI * $this->r**2;
	}
	public function getLength(){
		return 2 * M_PI * $this->r;
	}
}

class Rectangle {
	private $x1;
	private $x2;
	private $y1;
	private $y2;
	public function __construct($x1, $x2, $y1, $y2){
		$this->x1 = $x1;
		$this->x2 = $x2;
		$this->y1 = $y1;
		$this->y2 = $y2;
	}
	public function getArea(){
		return abs($this->x1 - $this->x2) * abs($this->y1 - $this->y2);
	}
	public function getPerimeter(){
		return 2 * ( abs($this->x1 - $this->x2) + abs($this->y1 - $this->y2) );
	}
}

class Triangle{
	private $x1;
	private $y1;
	private $x2;
	private $y2;
	private $x3;
	private $y3;
	public function __construct($x1, $y1, $x2, $y2, $x3, $y3){
		$this->x1 = $x1;
		$this->x2 = $x2;
		$this->y1 = $y1;
		$this->y2 = $y2;
		$this->x3 = $x3;
		$this->y3 = $y3;
	}
	public function getPerimeter(){
		$ab = sqrt( ($this->x2 - $this->x1)**2 + ($this->y2 - $this->y1)**2 );
		$bc = sqrt( ($this->x3 - $this->x2)**2 + ($this->y3 - $this->y2)**2 );
		$ac = sqrt( ($this->x3 - $this->x1)**2 + ($this->y3 - $this->y1)**2 );

		return $ab + $bc + $ac;
	}
	public function getArea(){
		return abs( 
			($this->x2 - $this->x1) * ($this->y3 - $this->y1) 
			- ($this->x3 - $this->x1)*($this->y2 - $this->y1)
			) / 2;
	}
}

$tr1 = new Triangle(2, 5, 8, 4, 7, 9);
$r1 = new Rectangle(2, 5, 8, 4);
$circle = new Circle(1, 2, 5);
echo "<pre>";
var_dump($tr1->getPerimeter());
var_dump($tr1->getArea());
var_dump($r1->getPerimeter());
var_dump($r1->getArea());
var_dump($circle->getLength());
var_dump($circle->getArea());
echo "</pre>";

/*
2. Сделать библиотеку, которая ведет учет книг. Должно быть как минимум два класса: Book и Library. Library имеет два метода: void put(Book book, int quantity) и int get(Book book, int quantity). Каждой книге в библиотеке соответствует счетчик, показывающий количество хранящихся книг, при добавлении книги - счетчик увеличивается, при извлечении - уменьшается на число quantity.
Поля класса Book: author, title, pagesNum.
Библиотека хранит ограниченное число книг, сколько - на ваше усмотрение.
*/

class Book {
	private $author;
	private $title;
	private $pagesNum;
	public $count = 0;
	public function __construct($author, $title, $pagesNum){
		$this->author = $author;
		$this->title = $title;
		$this->pagesNum = $pagesNum;
	}

}
class Library{
	private $max;
	private $books = [];

	public function __construct(int $max){
		$this->max = $max;
	}

	public function put(Book $book, int $quantity){
		if ( $this->isFull() ) {
			var_dump("в библиотеке нет мест");
		} else {
			if (in_array($book, $this->books)){
				if($quantity >= $this->getVacant()){
					$book->count += $this->getVacant();
				} else {
					$book->count += $quantity;
				}
			} else {
				array_push($this->books, $book);
				if( $quantity >= $this->getVacant() ){
					$book->count = $this->getVacant();
				} else {
					$book->count = $quantity;
				}
			}
		}
	}
	public function get(Book $book, int $quantity){
		if (in_array($book, $this->books)) {
			if ($book->count >= $quantity) {
				$book->count -= $quantity;
			} else if ($book->count < $quantity && $book->count != 0){
				$res = $quantity - $book->count;
				$book->count = 0;
				echo "не хватило $res книжек";
			}
			if ($book->count == 0){
				$index = array_search($book, $this->books);
				array_splice($this->books, $index, 1);
			}
		} else {
			var_dump("нет такой книги в библиотеке");
		}
	}

    private function isFull(){
        if($this->getCountBooks() >= $this->max) {
            return true;
        }
        return false;
    }

    public function getCountBooks(){
    	$bookQ = 0;
    	foreach ($this->books as $book){
    		$bookQ += $book->count;
    	}
    	return $bookQ;
    }

    private function getVacant(){
    	return $this->max - $this->getCountBooks();
    }

    public function getBooks(){
    	return $this->books;
    }
}

$book1 = new Book("Richard Phillips Feynman", "Surely You're Joking, Mr. Feynman!", 320);
$book2 = new Book("J.D. Salinger", "the Catcher in the Rye", 220);
$lib = new Library(30);

echo "<pre>";
$lib->put($book1, 25);
print_r($lib->getBooks());
print_r($lib->getCountBooks());

$lib->put($book2, 1);
print_r($lib->getBooks());
print_r($lib->getCountBooks());

$lib->get($book1, 4);
print_r($lib->getBooks());
print_r($lib->getCountBooks());

$lib->get($book2, 4);
print_r($lib->getBooks());
print_r($lib->getCountBooks());

$lib->get($book1, 2);
print_r($lib->getBooks());
print_r($lib->getCountBooks());

$lib->put($book2, 29);
print_r($lib->getBooks());
print_r($lib->getCountBooks());
echo "</pre>";

/*
3. Дом строится со следующими характеристиками:
Что из низ задается через конструктор, а что потом - решайте сами
1. какое-то количество подъездов
2. какое-то количество этажей
3. какое-то количество квартир на этаже
4. адрес
У дома должна быть возможность сообщить, сколько в нем квартир - метод
У дома должна быть возможность показать адрес - метод
У дома должна быть возможность сообщить, сколько людей в нем живет - метод

Есть очередь людей (массив с объектами класса Human),
каждый хочет заселиться в дом , но у каждого есть пожелание - этажность дома!

Одновременно в дом можно заселить троих.
house.add(); при вызове этого метода можно заселить только 3х людей

Людей из списка можно заселять в дом (по квартире на человека),
если в нем есть еще свободные квартиры
и если их пожелание можно учесть (желаемый этаж должен быть в доме).

Если человека нельзя поселить, потому что его пожелание не выполняется,
он перемещается в конец очереди.
Если не хватило места - остается на прежнем месте, ждать нового дома
*/

class House {
	private $address;
	private $sections;
	private $floors;
	private $apts_on_floor;

	private $apts_total;
	private $apts_empty;

	private $tenants = 0;

	public function __construct($address, $sections, $floors, $apts_on_floor){
		$this->address = $address;
		$this->sections = $sections;
		$this->floors = $floors;
		$this->apts_on_floor = $apts_on_floor;
		$this->apts_total = $sections * $floors * $apts_on_floor;
		$this->apts_empty = $this->apts_total;
	}

	public function getAptsTotal(){
		return $this->apts_total;
	}

	public function getAptsEmpty(){
		return $this->apts_empty;
	}

	public function getTenants(){
		return $this->tenants;
	}

	public function getAddress(){
		return $this->address;
	}

	public function add(&$queue){
		$add = 0;
		foreach($queue as $i=>$person){
			if ($add==3) return;
			if ($person->req_floor <= $this->floors){
				if($this->apts_empty){
					unset($queue[$i]);
					$this->apts_empty--;
					$this->tenants++;
					$add++;
				} else {
					continue;
				}
			} else {
				array_push($queue, $person);
				unset($queue[$i]);
			}
		}
	}


}

class Human {
	public $req_floor;
	function __construct($req_floor, &$queue){
		$this->req_floor = $req_floor;
		array_push($queue, $this);
	}
}

$queue =[];

$a = new Human(3, $queue);
$b = new Human(8, $queue);
$c = new Human(1, $queue);
$d = new Human(2, $queue);
$e = new Human(2, $queue);
$f = new Human(1, $queue);
$g = new Human(1, $queue);
$h = new Human(1, $queue);
$house = new House("Mendeleeva 1", 1, 3, 2);
$house2 = new House("Mendeleeva 3", 1, 8, 2);

echo "<pre>";
print_r($queue);
var_dump ($house->getAptsTotal());
var_dump($house->getAptsEmpty());
var_dump($house->getTenants());

$house->add($queue);
print_r($queue);
var_dump ($house->getAptsTotal());
var_dump($house->getAptsEmpty());
var_dump($house->getTenants());

$house->add($queue);
print_r($queue);
var_dump ($house->getAptsTotal());
var_dump($house->getAptsEmpty());
var_dump($house->getTenants());

$house->add($queue);
print_r($queue);
var_dump ($house->getAptsTotal());
var_dump($house->getAptsEmpty());
var_dump($house->getTenants());

$house2->add($queue);
print_r($queue);
var_dump ($house2->getAptsTotal());
var_dump($house2->getAptsEmpty());
var_dump($house2->getTenants());
echo "</pre>";

/*4. Реализовать объектную модель: Яблоко, Дерево, Сад

Программа должна уметь добавлять деревья в сад.
Яблоки на деревья.
Возвращать информацию о количестве деревьяв и яблок.

Сад - это объект со списком объектов деревьев.
Дерево - это объект со списком объектов яблок.

Яблоки должны иметь определяться:
возрастом
цветом
размером
флаг испорченности (0 - свежее, 1 - испорченное)
флаг упавшего с дерева (0 - на дереве, 1 - упало)

Яблоки имею методы:
упасть с дерева
испортиться

У всего сада есть возраст (например количество суток).
Каждые 30 суток на каждом дереве рождается новое яблок.
Все яблоки каждые сутки стареют на 1 день.
Яблоки падают с дерева при возрасте 30 дней.
Можно усложнить - 50% яблок могут упасть через 28 или через 32 дня по случайному выбору.
Яблоки портятся, после падения через сутки

Сад имеет метод:
просчитать 1 сутки (т.е. метод, который фиксирует прохождение суток)

Остальные методы и атрибуты объектов необходимо предусмотреть и реализовать.

Пример результирующего кода:

$garden = new Garder(); // создать сад, может быть создано N деревьев с N2 яблоками на каждом (N и N2 любые числа не больше 100, все яблоки при инцициализации создаются со случайным возрастом от 0 до 30)

$garden->passDay(); // прошли одни сутки
$garden->passDay(); // прошли одни сутки
$garden->passDay(); // прошли одни сутки
$garden->getCountApples(); // получить список висящих яблок на деревьях$garden->passDay(); // прошли одни сутки
$garden->getCountApples(); // получить список висящих яблок на деревьях этого сададеревьях$garden->passDay(); // прошли одни сутки
$garden->getCountApples(); // получить список висящих яблок на деревьях этого сада

В задании могут быть добавлены иные условия и возможности, если будет интересно его усложнить (добавить время года, погоду и т.п. влияющие на рост/падение яблок, каждое упавшее яблоко может превращаться в новое дерево через время, следить за удалением яблок из массива, после того как они испортились и т.п.).
*/

class Garden {
	public $age = 0;
	public $trees = [];

	public function __construct($N, $N2){
		for($i = 0; $i < $N; $i++){
			$this->addTree();
		}
		foreach($this->trees as $tree){
			for($j = 0; $j < $N2; $j++){
				$tree->addApple();
			}
		}
	}
	public function passDay(){
		$this->age++;
		if( !($this->age%5) ){
			foreach($this->trees as $tree){
					$tree->addApple();
			}
		}
		foreach($this->trees as $tree){
			foreach ($tree->apples as $i=>$apple){
				if ($apple->age == 30){
					$apple->toFall();
					unset($tree->apples[$i]);
				}
				if ($apple->age == 31){
					$apple->toRot();
				}
				$apple->age++;
			}
		}
	}
	private function addTree(){
		array_push($this->trees, new Tree());
	}

	public function getApplesTotal(){ //количество яблок на всех деревьях
		for($i = 0; $i < count($this->trees); $i++){
			$sum += $this->trees[$i]->getApplesOnTree();
		}
		return $sum;
	}
	public function getCountApples(){ //список яблок по деревьям
		return $this->trees;
	}
}
class Tree {
	public $apples = [];
	public function addApple(){
		array_push($this->apples, new Apple());
	}
	public function getApplesOnTree(){ //количество яблок на дереве
		foreach($this->apples as $apple){
			if(!$apple->isFallen){
				$sum++;
			}		
		}
		return $sum;
	}

}
class Apple{
	public $age;
	private $color = "green";
	private $size = "small";
	private $isRotten = false;
	public $isFallen = false;

	public function __construct (){
		$this->age = rand(0, 30);
	}

	public function toRot(){
		$this->isRotten = true;
	}
	public function toFall(){
		$this->isFallen = true;
	}
}
$garden = new Garden(5, 5); // создать сад, может быть создано N деревьев с N2 яблоками на каждом (N и N2 любые числа не больше 100, все яблоки при инцициализации создаются со случайным возрастом от 0 до 30)

echo "<pre>";
$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

$garden->passDay(); // прошли одни сутки
print_r($garden->trees);
var_dump($garden->age);

var_dump($garden->getCountApples()); // получить список висящих яблок на деревьях
$garden->passDay(); // прошли одни сутки
$garden->getCountApples(); // получить список висящих яблок на деревьях этого сада деревьях
$garden->passDay(); // прошли одни сутки
$garden->getCountApples(); // получить список висящих яблок на деревьях этого сада */
echo "</pre>";