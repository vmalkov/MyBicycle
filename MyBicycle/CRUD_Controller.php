<?

namespace MyBicycle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyWheel\Config;
use MyBicycle\Templates\Renderer;
use FastRoute\RouteCollector;
use RedBeanPHP\R as R;
use League\Container\Container;

abstract class CRUD_Controller extends Controller {
    static $permissions;

	function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container) {
		
        parent::__construct($request, $response, $config, $routes, $container);
		
        $this->context = preg_replace(array('/Controller/','/'.addslashes($this->reflector->getNamespaceName()).'/','/\\\/'),'',
			get_called_class());

        $this->{$this->context} = R::dispense($this->context);


	}

	function indexAction($params) {
        $this->{$this->context} = R::find($this->context);

        $this->data[$this->context]=$this->{$this->context};

        $this->data['header'] = '__'.$this->ctrlName.'_index';
        $output = $this->renderer->render(
            $this->ctrlName.'/'.$this->ctrlName.'_index', $this->data
        );
        $this->response->setContent($output);
    }

    function readAction($params) {
        $this->{$this->context} = R::load($this->context,$params['id']);

        $this->data[$this->context]=$this->{$this->context};
        
        $output = $this->renderer->render(
            $this->ctrlName.'/'.$this->ctrlName.'_read', $this->data
        );
        $this->response->setContent($output);
    }

    function createAction() {
        $this->data['header'] = '__'.$this->ctrlName.'_create';
        $this->form('create');
    }

    function updateAction($params) {
    	$this->{$this->context} = R::load($this->context,$params['id']);
        if(!$this->{$this->context}->id) $this->redirect($this->request->getBaseUrl()."/{$this->context}/create/");

        $this->data['header'] = '__'.$this->ctrlName.'_update';
        $this->form();
    }

    function form($action='update') {
        if($this->request->getMethod()=='POST') {
            $this->{$this->context}->import($this->request->request->all());
            $id = R::store( $this->{$this->context} );
            if($action=='create') $this->redirect($this->request->getBaseUrl()."/{$this->context}/update/$id/");
            
        }

        $this->data[$this->context]=$this->{$this->context};
        
        $output = $this->renderer->render(
            $this->ctrlName.'/'.$this->ctrlName.'_form', $this->data
        );
        $this->response->setContent($output);
    }

    function deleteAction($params) {
        $this->{$this->context} = R::load($this->context,$params['id']);
        R::trash($this->{$this->context});
        $this->redirect($this->request->getBaseUrl()."/{$this->context}/");
    }

    function redirect($path,$msg=array()) {
		if($msg) $this->session['message'] = $msg;
		header("Location: ".$path);
		exit;
	}

    static function setPermissions($permissions) {
        self::$permissions = $permissions;
    }
} 