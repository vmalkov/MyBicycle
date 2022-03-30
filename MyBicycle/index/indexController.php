<?php

namespace MyBicycle\index;

use RedBeanPHP\R as R;

Class indexController extends \MyBicycle\Controller {

    function indexAction($params) {
    	$output = $this->renderer->render(
            'index/index', $this->data
        );
        $this->response->setContent($output);
    }

}