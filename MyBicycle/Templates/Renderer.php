<?php

namespace MyBicycle\Templates;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use MyWheel\Config;
use MyBicycle\user\User;
use Symfony\Component\HttpFoundation\Request;

class Renderer extends \MyWheel\Renderer
{
    
    private $tplPath;
    private $extension=".php";

    public function __construct(Request $request, Config $config, User $user)
    {
        
        $this->config = $config;

        $this->request = $request;

        $this->tplName = isset($this->config->isAdmin)?$this->config->admin->template:$this->config->site->template;

        $this->tplPath = __APP_PATH. DS . 'Templates'.DS.$this->tplName.DS.'%name%';
    	
        $filesystemLoader = new FilesystemLoader($this->tplPath);

        $engine = new PhpEngine(new TemplateNameParser(), $filesystemLoader);

        $engine->user = $user;
        
        $this->setEngine($engine);
        
    }

    public function render($template, $data = [])
    {
        $content = $this->fetch($template,$data);
        $message = $this->fetch("message",(array)$data['message']);
        return $this->fetch($this->tplName, array(
            'content'=>$content,
            'base'=>$this->request->getBaseUrl(),
            'message'=>$message
        )+$data);
    }

    function fetch($view,$data=[]) {
        return $this->engine->render("$view{$this->extension}",$data);
    }
    
}