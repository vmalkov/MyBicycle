<?

namespace MyBicycle\product;

use RedBeanPHP\R as R;

Class Product extends \MyBicycle\Model {

	function setKeys($data) {

		foreach($data as $key=>$param) foreach($param as $id=>$val) {
			if(!$val) continue;
			
			if(!isset($keys[$id])) {
				if($id) $keys[$id] = R::load('gamekey',$id);
				else $keys[$id] = R::dispense('gamekey');
			}

			$keys[$id]->{substr($key, 8)} = $val;
		}

		$this->bean->ownGamekeyList = $keys;

	}

	function getWithKeysWhere() {
		return 'value IS NOT NULL AND value!=""';
	}

	function getWithKeysFilter() {
		return [' LEFT JOIN gamekey ON (gamekey.product_id=product.id) WHERE '.$this->getWithKeysWhere().' GROUP BY product_id '];

	}

	function open() {

		if(!$this->bean->price) {
			$keys = $this->bean->withCondition($this->getWithKeysWhere())->ownGamekeyList;

			if($keys) $this->bean->price=array_sum(array_map(function($k){return $k['cost'];},$keys))/count($keys)*(1+$this->config->shop->price_markup/100);

			if(!$this->bean->price) $this->bean->price = $this->config->shop->min_price;
		}

	}

}