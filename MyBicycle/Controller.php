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
    protected $_me=NULL;

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

        $reflector = $this->reflector = new \ReflectionClass(get_called_class());

        $this->ctrlName = str_replace('Controller','',$this->reflector->getShortName());

        $this->actionName = str_replace('Action','',$container->get('routeInfo')[1][1]);

        R::setup($this->config->database->type.":host=".(isset($this->config->database->host)?$this->config->database->host:'localhost').";dbname=".$this->config->database->name,$this->config->database->user, $this->config->database->password);

        unset($this->config->database);

        require 'vendor/gabordemooij/redbean/RedBeanPHP/Plugin/SQN.php';

        R::freeze( ['role','post'] );
        /*возможно, в будущем
        R::useJSONFeatures(TRUE);*/
        
        //define( 'REDBEAN_MODEL_PREFIX', $this->reflector->getNamespaceName().'\\' );
        //define( 'REDBEAN_MODEL_PREFIX', '' );
        R::getRedBean()->setBeanHelper( new MyBeanHelper );

        MyBeanHelper::setFactoryFunction( function( $name ) {
            return $this->model($name);
        } );
        
        //стандартный синглетон в данном случае не подойдет (ПРОВЕРИТЬ!)
        $this->_me = new User;
        if($this->session['user_id'])
            $this->_me->login((int)$this->session['user_id']);
        else {
            $guest = new \MyBicycle\role\Role;
            if($beanGuest = R::findOne('role','name=?',['guest'])) {
                $guest->loadBean($beanGuest);
                $this->_me->addRole($guest);
            }
        }

        $container->share('MyBicycle\user\User',$this->_me);

        $this->renderer = $container->get('MyBicycle\Templates\Renderer');

        if(!$this->_me->allowed("{$this->ctrlName}/{$this->actionName}")&&method_exists($this, 'redirect')) 
         ;//   $this->redirect($this->request->getBaseUrl(),['warning'=>'__no_rights']);
    
        foreach(R::find('block','status=? AND template=?',[1,$this->config->site->template]) as $block) {

            $blockController = '\MyBicycle\block\blocks\\'.$block->controller;
            $blockController = $container->get($blockController);
            $blockController->indexAction(['block'=>$block,'front'=>$this]);
            $this->data['blocks'][$block->position] .= (string)$blockController;
        }
    }

    protected function setMessage(Array $msg) {
        $this->data['message'] = ['type'=>key($msg),'text'=>reset($msg)];
    }

    protected function getMessage() {return $this->data['message'];}

    protected function model($name) {

        $name = "\MyBicycle\\$name\\".ucfirst($name);
        
        if(!class_exists($name)) return NULL;

        $model = $name::S();

        $model->setConfig($this->config);

        return $model;

    }

    
}