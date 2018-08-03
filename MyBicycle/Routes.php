<?

$controllers = array_filter(glob(__DIR__.DS.'*'), 'is_dir');
$routes=array(
	array('GET','/',array('MyBicycle\index\indexController','indexAction'))
);

foreach ($controllers as $controller) {
	
	$basename = basename($controller);
	$class = basename(__APP_PATH)."\\".$basename.'\\'.str_replace('/','\\',$basename)."Controller";

	if($methods=get_class_methods($class)) foreach($methods as $method) if(strpos($method,"Action")) {
		
		if(in_array($method,array('readAction','deleteAction'))) $routes[]=['GET',"/$basename/".rtrim($method,"Action")."/{id:\d+}/",[$class,$method]];
		elseif(in_array($method,array('createAction','updateAction'))) $routes[]=[['GET','POST'],"/$basename/".rtrim($method,"Action")."/".($method=='updateAction'?"{id:\d+}/":''),[$class,$method]];
		else $routes[]=['GET',"/$basename/".rtrim($method,"Action")."/",[$class,$method]];

		if($method=='indexAction') $routes[]=['GET',"/$basename/",[$class,$method]];
	}
}

return $routes;