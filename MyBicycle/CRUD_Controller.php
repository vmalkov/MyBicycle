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

    protected $_limit, $_start, $_order, $_filter;


	function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container) {
		
        parent::__construct($request, $response, $config, $routes, $container);
		
        $this->context = preg_replace(array('/Controller/','/'.addslashes($this->reflector->getNamespaceName()).'/','/\\\/'),'',
			get_called_class());


	}

	function indexAction($params) {
        if(!isset($this->_count)) $this->_count = R::count($this->context, $this->getFilterQuery(), $this->getQueryParams());

        if(!isset($this->{$this->context})) {
            $this->setOrder('-id');

            $this->{$this->context} = R::findCollection($this->context, $this->getQuery(), $this->getQueryParams());
        }

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
        $this->{$this->context} = R::dispense($this->context);
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

    function setPagination($limit,$start=0) {
        if($start) {
            $this->_start=$limit;
            $this->_limit=$start;
        } else $this->_limit=$limit;
    }

    function setOrder($order) {
        $this->_order = $order;
    }

    function setFilter($query=array()) {
        $this->_filter = $query;
    }

    protected function getFilterQuery() {
        return isset($this->_filter)?$this->_filter[0]:NULL;
    }

    protected function getQuery() {
        $query = '';

        $query.=$this->getFilterQuery();

        if(isset($this->_order)) $query.=" ORDER BY {$this->_order}";

        if(isset($this->_limit)) $query.=" LIMIT ".(isset($this->_start)?"{$this->_start}, ":"").$this->_limit;

        return $query;
    }

    protected function getQueryParams() {
        return isset($this->_filter[1])?$this->_filter[1]:array();
    }

    protected function model($name=NULL) {
        if(!$name) $name=$this->context;
        return parent::model($name);

    }
} 