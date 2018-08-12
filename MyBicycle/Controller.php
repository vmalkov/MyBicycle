<?php
namespace MyBicycle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Container\Container;
use MyBicycle\Templates\Renderer;
use MyBicycle\user\User;
use MyWheel\Config;
use FastRoute\RouteCollector;
use RedBeanPHP\R as R;
use RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper as SimpleFacadeBeanHelper;

abstract class Controller implements \MyWheel\Controller
{

    //for renderer data
    protected $data=array();
    protected $_user=NULL;

    function __construct(Request $request, Response $response, Config $config, RouteCollector $routes, Container $container)
    {
        require __APP_PATH. '/vendor/autoload.php';
        //это на период начальной разработки
        error_reporting(E_ALL ^ E_NOTICE);

        $this->request = $request;
        $this->config = $config;
        $this->response = $response;
        $this->routes = $routes;
        $this->container = $container;

        session_start();
       
        $this->session =& $_SESSION;

        if($this->session['message']) $this->setMessage($this->session['message']);
        unset($this->session['message']);

        $this->reflector = new \ReflectionClass(get_called_class());

        $this->ctrlName = str_replace('Controller','',$this->reflector->getShortName());

        $this->actionName = str_replace('Action','',$container->get('routeInfo')[1][1]);

        //это на период начальной разработки
        R::setup();

        /*возможно, в будущем
        R::useJSONFeatures(TRUE);*/
        
        define( 'REDBEAN_MODEL_PREFIX', $this->reflector->getNamespaceName().'\\' );

        SimpleFacadeBeanHelper::setFactoryFunction( function( $name ) {
            $model = new $name();
            return $model;
        } );
        
        $this->_user = new User;
        if($this->session['user_id'])
            $this->_user->loadBean(R::load('user',(int)$this->session['user_id']));
        else {
            $guest = new \MyBicycle\role\Role;
            if($beanGuest = R::findOne('role','name=?',['guest'])) {
                $guest->loadBean($beanGuest);
                $this->_user->addRole($guest);
            }
        }

        $container->share('MyBicycle\user\User',$this->_user);

        $this->renderer = $container->get('MyBicycle\Templates\Renderer');

        if(!$this->_user->allowed("{$this->ctrlName}/{$this->actionName}")&&method_exists($this, 'redirect')) 
         ;//   $this->redirect($this->request->getBaseUrl(),['warning'=>'__no_rights']);
    
        foreach(R::find('block',['status'=>1]) as $block) {
            //var_dump($block->controller,$block);//exit;
            $blockController = '\MyBicycle\block\blocks\\'.$block->controller;
            $blockController = $container->get($blockController);
            $blockController->indexAction($block);
            $this->data['blocks'][$block->position] .= (string)$blockController;
        }
    }

    protected function setMessage(Array $msg) {
        $this->data['message'] = ['type'=>key($msg),'text'=>reset($msg)];
    }

    protected function getMessage() {return $this->data['message'];}

    
}