<?
namespace MyBicycle\cart;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyWheel\Config;
use FastRoute\RouteCollector;
use League\Container\Container;
use RedBeanPHP\R as R;

class cartController extends \MyBicycle\Controller {

	function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container, Cart $cart) {
		
        parent::__construct($request, $response, $config, $routes, $container);

        $this->cart =& $this->session['cart'];

		// если хранилище $this->session['cart'] не создано, создаем
		if(!is_object($this->cart)) $this->cart = $cart;
    }

	function indexAction($params) {

		$this->data['products'] = $this->cart;

		$this->data['qty']	= $this->cart->qty();
		$this->data['total']= $this->cart->total();

		$output = $this->renderer->render(
            'cart/cart_index', $this->data
        );
        $this->response->setContent($output);
	}
	
	function addAction() {
		$product = R::load('product',$this->request->get('id'));
		$this->cart->add((object)['id'=>$product->id,'price'=>$product->price,'title'=>$product->title,'qty'=>$this->request->get('qty')]);

	}

	function emptyAction() {
		$this->cart->empty();
	}

	function removeAction() {
		$this->cart->delete($this->request->get('id'));
	}

	function editAction() {
		$product = R::load('product',$this->request->get('id'));
		$this->cart->edit((object)[$product->id,$this->request->get('qty')]);
	}
}
?>