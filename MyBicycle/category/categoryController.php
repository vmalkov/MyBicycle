<?
namespace MyBicycle\category;

use RedBeanPHP\R as R;

class categoryController extends \MyBicycle\CRUD_Controller {
	
	function form($action='update') {
		$this->data['parents'] = R::find('category');

		//иначе будет ошибка FOREIGN KEY constraint failed
		if($this->request->getMethod()=='POST' && !$this->request->get('category_id')) $this->request->request->remove('category_id');

		parent::form($action);
	}
	
}