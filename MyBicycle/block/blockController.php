<?
namespace MyBicycle\block;

use RedBeanPHP\R as R;

class blockController extends \MyBicycle\CRUD_Controller {
	function form($action='update') {
		
		$this->data['controllers'] = array_map(function($b){return basename($b,'.php');},glob(__DIR__.DS.'blocks/*.php'));

		parent::form($action);
	}
}