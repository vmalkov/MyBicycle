<?php

namespace MyBicycle\Templates;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use MyWheel\Config;
use MyBicycle\user\User;
use Symfony\Component\HttpFoundation\Request;

class Renderer implements \MyWheel\Renderer
{
    private $engine;
    private $tplPath;

    public function __construct(Request $request, Config $config, User $user)
    {
        
        $this->config = $config;

        $this->request = $request;

        $this->tplName = isset($this->config->isAdmin)?$this->config->admin->template:$this->config->site->template;

        $this->tplPath = __APP_PATH. DS . 'Templates'.DS.$this->tplName.DS.'%name%';
    	
        $filesystemLoader = new FilesystemLoader($this->tplPath);

        $engine = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
        
        $this->engine = $engine;

        $this->engine->user = $user;
        
    }

    public function render($template, $data = [])
    {
        $content = $this->engine->render("$template.php",$data);
        return $this->engine->render($this->tplName.".php", array(
            'content'=>$content,
            'base'=>$this->request->getBaseUrl()
        )+$data);
    }
}