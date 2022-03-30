<?
namespace MyBicycle\block\blocks;

use RedBeanPHP\R as R;

class categories extends Controller {

	function indexAction($params) {
		$this->data['categories'] = R::find('category');
	}
	
}
?>