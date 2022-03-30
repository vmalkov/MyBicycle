<?
namespace MyBicycle\order;

use RedBeanPHP\R as R;

Class Order extends \MyBicycle\Model {

	protected $products=[];

	function getProducts() {

		$keys = R::findCollection('gamekey','LEFT JOIN product ON (gamekey.product_id=product.id) WHERE order_id=?',[$this->id]);

		$cart = new \MyBicycle\cart\Cart;

		while($key=$keys->next()) $cart->add((object)['id'=>$key->product->id,'price'=>$key->product->price,'title'=>$key->product->title]);

		return $cart;

	}

	function setProducts($products) {

		$this->products = $products;

	}

	function after_update() {
		foreach($this->products as $product) {
			
			$keys = R::findCollection('gamekey','product_id=? LIMIT ?',[$product->id,$product->qty]);

			while($key=$keys->next()) {
				$key->order_id = $this->id;
				R::store($key);

			}
		}
	}

}