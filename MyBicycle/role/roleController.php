<?
namespace MyBicycle\role;

use RedBeanPHP\R as R;

class roleController extends \MyBicycle\CRUD_Controller {
	function form($action='update') {
		
		/*$crud_ctrls = array_filter(
			array_unique(
				array_values(
					array_map(function($r){return $r[0];},$this->routes->getData()[0]['GET'])
				)
			),function($c){return is_subclass_of($c, '\MyBicycle\CRUD_Controller');}
		);*/



		$this->data['permissions'] = self::$permissions;
		sort($this->data['permissions']);

		if($this->request->getMethod()=='POST') {

			//потому что request->import не поддерживает массивы в качестве GET|POST параметров

			$this->role->permissions = $this->request->get('permissions');

			$this->request->request->remove('permissions');
		}

		parent::form($action);
	}
}