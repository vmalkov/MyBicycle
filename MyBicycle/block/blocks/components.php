<?
namespace MyBicycle\block\blocks;

class components extends Controller {

	function indexAction($params) {
		$dirs = array_filter(array_map(function($b){return is_dir($b)?basename($b):NULL;},glob(__APP_PATH. DS . 'Templates'.DS.$this->config->site->template.DS.'*')),function($d) {return $d;});

		foreach($dirs as $dir) if(get_parent_class("MyBicycle\\$dir\\$dir"."Controller")=='MyBicycle\\CRUD_Controller') $this->data['components'][] = ['title'=>"__".$dir."_component",'href'=>"$dir/","active"=>$dir==$params['front']->ctrlName];
	}
	
}