<?
namespace MyBicycle\block;

use RedBeanPHP\R as R;

class blockController extends \MyBicycle\CRUD_Controller {
	function form($action='update') {
		
		$this->data['controllers'] = array_filter(array_map(function($b){return basename($b,'.php');},glob(__DIR__.DS.'blocks/*.php')
				),function($b){return $b!='Controller';});

		parent::form($action);
	}
}