<?

$controllers = array_filter(glob(__DIR__.DS.'*'), 'is_dir');
$routes=array(
	array('GET','/',array('MyBicycle\index\indexController','indexAction'))
);

$permissions=array('admin/panel');

foreach ($controllers as $controller) {
	
	$basename = basename($controller);
	$class = basename(__APP_PATH)."\\".$basename.'\\'.str_replace('/','\\',$basename)."Controller";

	if($methods=get_class_methods($class)) foreach($methods as $method) if(strpos($method,"Action")) {

		$action = str_replace("Action","",$method);

		$permissions[]="$basename/$action";
		
		if(in_array($action,array('read','delete'))) {
			$routes[]=['GET',"/$basename/".$action."/{id:\d+}/",[$class,$method]];

			$permissions[]="$basename/$action"."Own";
		}
		elseif(in_array($action,array('create','update','login'))) {
			$routes[]=[['GET','POST'],"/$basename/".$action."/".($action=='update'?"{id:\d+}/":''),[$class,$method]];
			if($action=='update') $permissions[]="$basename/$action"."Own";
		}
		else $routes[]=['GET',"/$basename/".$action."/",[$class,$method]];

		if($action=='index') $routes[]=['GET',"/$basename/",[$class,$method]];
	}
}

MyBicycle\CRUD_controller::setPermissions($permissions);

return $routes;