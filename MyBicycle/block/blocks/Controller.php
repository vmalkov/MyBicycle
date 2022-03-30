<?
namespace MyBicycle\block\blocks;
use League\Container\Container;
use MyBicycle\Templates\Renderer;
use MyWheel\Config;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FastRoute\RouteCollector;

abstract class Controller implements \MyWheel\Controller {

	protected $data=array();

	function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container, Renderer $renderer) {
		$this->renderer = $renderer;
		$this->config = $config;
		$this->response = $response;
		$this->request = $request;
		$this->container = $container;
		$this->routes = $routes;
	}
	
	function __toString() {
		return $this->renderer->fetch('blocks/'. str_replace(__NAMESPACE__.'\\', '',get_called_class()) .'_block',$this->data);
	}
}