<?
namespace MyBicycle\cart;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyWheel\Config;
use FastRoute\RouteCollector;
use League\Container\Container;
use MyWheel\Cart;
use MyWheel\CartItem;
use RedBeanPHP\R as R;

class cartController extends \MyBicycle\Controller {

	function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container, Cart $cart) {
		
        parent::__construct($request, $response, $config, $routes, $container);

        $this->cart =& $_SESSION['cart'];

		// если хранилище $_SESSION['cart'] не создано, создаем
		if(!is_object($this->cart)) $this->cart = $cart;
    }

	function indexAction($params) {
		$this->data['cart'] = $this->cart;

		$output = $this->renderer->render(
            'cart/cart_index', $this->data
        );
        $this->response->setContent($output);
	}
	
	function addAction() {
		$product = R::load('product',$this->request->get('id'));
		$this->cart->add(new CartItem($product->id,$product->price,$this->request->get('qty')));

	}

	function emptyAction() {
		$this->cart->empty();
	}

	function removeAction() {
		$this->cart->delete($this->request->get('id'));
	}

	function editAction() {
		$product = R::load('product',$this->request->get('id'));
		$this->cart->edit(new CartItem($product->id,$product->price,$this->request->get('qty')));
	}
}
?>