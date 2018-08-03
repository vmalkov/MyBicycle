<?php
namespace MyBicycle;

use MyBicycle\Templates\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyWheel\Config;
use MyBicycle\user\User;

abstract class Controller implements \MyWheel\Controller
{

    //for renderer data
    protected $data=array();

    function __construct(Request $request, Response $response, Config $config)
    {
        require __APP_PATH. '/vendor/autoload.php';
        //это на период начальной разработки
        error_reporting(E_ALL ^ E_NOTICE);

        $this->request = $request;
        $this->config = $config;
        $this->response = $response;

        $this->user = new User;

        $this->renderer = new Renderer($request, $config, $this->user);

        $this->reflector = new \ReflectionClass(get_called_class());

        $this->ctrlName = str_replace('Controller','',$this->reflector->getShortName());
    }

    
}