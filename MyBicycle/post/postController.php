<?
namespace MyBicycle\post;

use RedBeanPHP\R as R;

Class postController extends \MyBicycle\CRUD_Controller {
	function createAction($data=array()) {
        
        $this->data['categories'] = R::find('category');
        parent::createAction(['category','title','text']);

    }

    function updateAction($data=array()) {
        $this->data['categories'] = R::find('category');

        parent::updateAction(['category']);

    }

    function indexAction($data=array()) {
        parent::indexAction(['category']);
    }

    function readAction($data=array()) {
        parent::readAction(['category']);
    }
    
}