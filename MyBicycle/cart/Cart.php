<?
namespace MyBicycle\cart;

// класс объекта корзины
/*
Class item {
	
	public $id; // идентификатор товара
	public $price=0; // цена товара
	public $qty=1; // кол-во товара для добавления в корзину
	public $subtotal = 0; // сумма за товар с учетом его кол-ва

	
	public function __construct($id=NULL,$price=0,$qty=1) {
		if(isset($id)) {
			$this->id=$id;
			$this->price=$price;
			$this->qty=!$qty?1:$qty;
			$this->subtotal();
		}
	}

	function subtotal() {
		$this->subtotal = $this->price*$this->qty;

		return $this->subtotal;
	}
}
*/

// класс корзины покупок, хранящейся в сессии
Class Cart implements \Iterator, \Countable {
	
	protected $items=array(),$ids=array();

	// добавляем товар в корзину. Если в ней уже есть товар с таким же id, просто меняем его количество
	function add($item) {
		if(!$item->qty) $item->qty=1;

		if(isset($this->items[$item->id])) {
			$item->qty += $this->items[$item->id]->qty;
		} else $this->ids[] = $item->id;
		$this->edit($item);
	}

	// редактируем товар в корзине, либо добавляем новый (кол-во не суммируется, для суммирования используется метод add(item $item))
	function edit($item) {
		$item->subtotal = $item->qty*$item->price;
		$this->items[$item->id] = $item;
	}

	function delete($id) {
		unset($this->items[$id]);
		$index = array_search($id, $this->ids);
		unset($this->ids[$index]);

		
		$this->ids = array_values($this->ids);
	}

	function empty() {
		$this->items=$this->ids=array();
	}

	// считаем, сколько всего товаров в корзине
	function qty() {
		$qty = 0;
		foreach($this->items as $item) $qty += $item->qty;
		return $qty;
	}

	function total() {
		$total = 0;
		foreach($this->items as $item) $total += $item->subtotal;
		return $total; 
	}

	// возвращаем либо один товар по идентификатору, либо все
	function get($id) {
		return $this->items[$id];
	}
	
	public function current() {
		
		$id= $this->ids[$this->position];
	    return $this->items[$id];

	}

	public function key() {
	    return $this->position;
	}

	public function next() {
	    $this->position++;
	}

	public function rewind() {
	    $this->position = 0;
	}

	public function valid() {
		return (isset($this->ids[$this->position]));
	}
	
	public function count() {
		return count($this->items);
	}

	public function isEmpty() {
		return (empty($this->items));
	}
}