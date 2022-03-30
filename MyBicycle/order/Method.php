<?
namespace MyBicycle\order;

class Method {
	public $id, $title, $cost=0;

		/*$shippings = array();

		foreach(glob(__DIR__.DS.'shipping'.DS.'*.php') as $s) {
			$class=__NAMESPACE__.'\shipping\\'.basename($s,'.php'); 
			$method = new $class;

			if($method instanceof Method) $shippings[] = $method;
			
		}

		$this->data['shippings'] = $shippings;*/

	function __construct() {
		$this->id=str_replace(__NAMESPACE__.'\shipping\\','',get_called_class());
		$this->title = '__'.$this->id.'_method';
	}
}
?>