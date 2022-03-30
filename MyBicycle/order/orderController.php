<?
namespace MyBicycle\order;
use RedBeanPHP\R as R;

class orderController extends \MyBicycle\CRUD_Controller {

	function form($action='update') {

		if($action=='update')
			$products = $this->order->getProducts();
		else {
			$cart = $this->session['cart'];
			$products = $cart;
			
		}

		$qty = $products->qty();
		$total = $products->total();

		$this->data['cart'] = $this->renderer->fetch('cart/cart_index',
			array('products'=>$products,'qty'=>$qty,'total'=>$total)
		);

		

		if($this->request->getMethod()=='POST') {

			if($action=='create') $this->order->setProducts($products);
			
		}

		parent::form($action);

	}
}
?>