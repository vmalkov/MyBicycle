<?
namespace MyBicycle\block\blocks;
use League\Container\Container;
use RedBeanPHP\R as R;

class categories implements \MyWheel\Controller {

	protected $data=array();

	function __construct(Container $container) {
		$this->renderer = $container->get('MyBicycle\Templates\Renderer');
	}
	function indexAction($data) {
		$this->data['categories'] = R::find('category');
	}
	function __toString() {
		return $this->renderer->fetch('blocks/categories_block',$this->data);
	}
}
?>