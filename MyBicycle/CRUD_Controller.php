<?

namespace MyBicycle;

use MyBicycle\Templates\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyWheel\Config;
use RedBeanPHP\R as R;
use RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper as SimpleFacadeBeanHelper;


abstract class CRUD_Controller extends Controller {
	function __construct(Request $request, Response $response, Config $config) {
		
        parent::__construct($request, $response, $config);
		
        $this->context = preg_replace(array('/Controller/','/'.addslashes($this->reflector->getNamespaceName()).'/','/\\\/'),'',
			get_called_class());

		
        //это на период начальной разработки
        R::setup();
        
        define( 'REDBEAN_MODEL_PREFIX', $this->reflector->getNamespaceName().'\\' );

        SimpleFacadeBeanHelper::setFactoryFunction( function( $name ) {
            $model = new $name();
            return $model;
        } );

        $this->{$this->context} = R::dispense($this->context);

	}

	function indexAction($params) {
        $this->{$this->context} = R::find($this->context);

        foreach ($this->{$this->context} as $key=>$item) {
            $this->data[$this->context][$key] = $item;
            
        }
        $this->data['header'] = '__'.$this->ctrlName.'_index';
        $output = $this->renderer->render(
            $this->ctrlName.'/'.$this->ctrlName.'_index', $this->data
        );
        $this->response->setContent($output);
    }

    function readAction($params) {
        $this->{$this->context} = R::load($this->context,$params['id']);

        foreach ($this->{$this->context} as $k => $v) {
            $this->data[$k]=$v;
        }
        foreach($data as $field) $this->data[$field]=$this->{$this->context}->$field;
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

    static function redirect($path,$msg=array()) {
		//Session::S()->message=$msg;
		header("Location: ".$path);
		exit;
	}
} 