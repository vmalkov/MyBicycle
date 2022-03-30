<?
namespace MyBicycle\product;

use RedBeanPHP\R as R;

class productController extends \MyBicycle\CRUD_Controller {

	function form($action='update') {

		if($this->request->getMethod()=='POST') {
			foreach($this->request->request as $key=>$param) if(strpos($key,'gamekey_')!==false) {
				
				$data[$key] = $param;

				$this->request->request->remove($key);
			}

			$this->product->setKeys($data);

		}

		$this->data['keys'] = $this->product->ownGamekeyList;

		parent::form($action);

	}

	function indexAction($params) {

		if(!$this->config->isAdmin) {
			
			$this->product = $this->setFilter($this->model()->getWithKeysFilter());

		}

		parent::indexAction($params);

	}

}
?>